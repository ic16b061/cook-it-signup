<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use GuzzleHttp;

class SignupController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('registrieren');
    }

    /**
     * Create OpenShift resources via API calls
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $givenname = request('givenname');
        $surname = request('surname');
        $email = request('email');
        $subdomain = strtolower(request('subdomain'));
        $subscription = request('subscription');

        $user = new User;
        $user->givenname = $givenname;
        $user->surname = $surname;
        $user->email = $email;
        $user->subdomain = $subdomain;
        $user->subscription = $subscription;
        
        $user->save();

        // app parameters
        switch ($subscription) {
            case 1:
                $memory = '1Gi';
                $capacity = '1Gi';
                break;
            case 2:
                $memory = '2Gi';
                $capacity = '2Gi';
                break;
            case 3:
                $memory = '4Gi';
                $capacity = '3Gi';
                break;
        }
        $token = shell_exec('cat /var/run/secrets/kubernetes.io/serviceaccount/token');
        $token = trim($token);
        $endpoint = 'https://openshift.default.svc.cluster.local';
        $namespace = 'production-'.strtolower($surname).'-'.$subdomain;

        $client = new GuzzleHttp\Client([
            'base_uri' => $endpoint,
            'verify' => '/var/run/secrets/kubernetes.io/serviceaccount/..data/ca.crt'
        ]);
		$headers = [
            'Authorization' => 'Bearer '.$token,
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        ];
        
        // create project for new tenant
        $response = $client->request('POST', '/apis/project.openshift.io/v1/projectrequests', [
                'headers'   => $headers,
                'json'      => [
                                'kind' => 'ProjectRequest',
                                'apiVersion' => 'project.openshift.io/v1',
                                'metadata' => [
                                    'name' => $namespace
                                ]
                ]
        ]);

        // make default user also admin for the project
        $response = $client->request('POST', '/apis/rbac.authorization.k8s.io/v1beta1/namespaces/'
                .$namespace.'/rolebindings', [
                'headers'   => $headers,
                'json'      => [
                                'kind' => 'RoleBinding',
                                'apiVersion' => 'rbac.authorization.k8s.io/v1beta1',
                                'metadata' => [
                                    'name' => 'admin-gabriel'
                                ],
                                'roleRef' => [
                                    'apiGroup' => 'rbac.authorization.k8s.io',
                                    'kind' => 'ClusterRole',
                                    'name' => 'admin'
                                ],
                                'subjects' => [
                                    [
                                        'kind' => 'User',
                                        'apiGroup' => 'rbac.authorization.k8s.io',
                                        'name' => 'gabriel'
                                    ]
                                ]
                ]
        ]);

        // store template parameters
        $response = $client->request('POST', '/api/v1/namespaces/'.$namespace.'/secrets', [
                'headers'   => $headers,
                'json'      => [
                                'kind' => 'Secret',
                                'apiVersion' => 'v1',
                                'metadata' => [
                                    'name' => 'secret'
                                ],
                                'stringData' => [
                                        'NAME' => 'cookit',
                                        'LARAVEL_APP_ENV' => 'production',
                                        'IMAGE_NAMESPACE' => 'development',
                                        'IMAGE_NAME' => 'cookit',
                                        'IMAGE_TAG' => 'promotePROD',
                                        'APPLICATION_SUBDOMAIN' => $subdomain,
                                        'MEMORY_LIMIT' => $memory,
                                        'MEMORY_POSTGRESQL_LIMIT' => $memory,
                                        'VOLUME_CAPACITY' => $capacity
                                ]
                ]
        ]);

        // unfortunately, TemplateInstance creation via api call (see below) is not possible
        // via php, so it is done via a local shell script
        $output = shell_exec('ENDPOINT='.$endpoint.' TOKEN='.$token.' NAMESPACE='
                .$namespace.' ./create-openshift-app.sh');

        // NOT POSSIBLE YET (json data from GET cannot be used in subsequent POST)
        // fetch template
        // $response = $client->request('GET', 'https://' . $endpoint .
        //         '/apis/template.openshift.io/v1/namespaces/openshift/templates/laravel-postgresql-persistent-dependent', [
        //         'headers'   => $headers
        // ]);
        // $template = json_decode($response->getbody(), true);

        // $response = $client->request('POST', 'https://' . $endpoint .
        //         '/apis/template.openshift.io/v1/namespaces/' . $namespace . '/templateinstances', [
        //         'headers'   => $headers,
        //         'json'      => [
        //                         'kind' => 'TemplateInstance',
        //                         'apiVersion' => 'template.openshift.io/v1',
        //                         'metadata' => [
        //                             'name' => 'templateinstance'
        //                         ],
        //                         'spec' => [
        //                             'secret' => [
        //                                 'name' => 'secret'
        //                             ],
        //                         ], 
        //                         'template'  => $template
        //         ]
        // ]);
        
        return redirect()->back()->with('message', 'Registrierung erfolgreich! Vielen Dank für
                Ihr Vertrauen! Sie erreichen Ihre Knödel Homepage in wenigen Minuten unter
                https://'.$subdomain.'.apps.gabriel-hq.at');
    }

}
