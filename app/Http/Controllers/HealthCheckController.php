<?php

namespace App\Http\Controllers;

use DB;

class HealthCheckController extends Controller
{
    /**
     * Perform a health check by testing the
     * database connection
     *
     * @return \Illuminate\Http\Response
     */
    public function check()
    {
		try {
    		DB::connection()->getPdo();
		} catch (\Exception $e) {
            header("HTTP/1.1 503 Service Unavailable");
    		die("Could not connect to the database. Please check your configuration. error:" . $e );
		}

		echo "OK";
    }
}
