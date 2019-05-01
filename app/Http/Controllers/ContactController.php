<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class ContactController extends Controller
{

    public function create(){
        return view('kontakt');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('kontakt');
    }

    /**
     * Send the form by mail.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function send(Request $request)
    {
        $name = request('name');
        $surname = request('surname');
        $msg = request('message');
        $phone = request('phone');

        $mail = new PHPMailer(true); // notice the \  you have to use root namespace here
        try {
            $mail->isSMTP(); // tell to use smtp
            $mail->CharSet = "utf-8"; // set charset to utf8
            $mail->SMTPAuth = true;  // use smpt auth
            $mail->SMTPSecure = "tls"; // or ssl
            $mail->Host = "smtp.world4you.com";
            $mail->Port = 587; // most likely something different for you. This is the mailtrap.io port i use for testing.
            $mail->Username = "ie@gabriel-hq.at";
            $mail->Password = 'xxxxxx';
            $mail->setFrom("ie@gabriel-hq.at",  $name.' '.$surname);
            $mail->Subject = "Neue Nachricht von Knödel";
            $mail->Body = "Telefonnummer: ".$phone."\r\nNachricht:\r\n".$msg;
            $mail->addAddress("ie@gabriel-hq.at");
            $mail->send();
        } catch (phpmailerException $e) {
            dd($e);
        } catch (Exception $e) {
            dd($e);
        }
        //die('success');

        return redirect()->back()->with('message', 'Erfolgreich gesendet! Vielen Dank für Ihre Nachricht!');
    }

}
