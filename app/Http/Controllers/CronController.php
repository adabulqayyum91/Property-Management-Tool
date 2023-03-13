<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Survey;
use Carbon\Carbon;

class CronController extends Controller
{
    public function surveyResults()
    {
    	// $now = Carbon::now()->format('Y-m-d');
    	// $surveys = Survey::where('result_sent',0)
    	// 				->whereDate('due_date','<=',$now)
    	// 				->get();

    	// foreach ($surveys as $key => $survey) {
    	// 	# code...
    	// }


    	$curl = curl_init();

    	curl_setopt_array($curl, [
    		CURLOPT_URL => "https://rapidprod-sendgrid-v1.p.rapidapi.com/mail/send",
    		CURLOPT_RETURNTRANSFER => true,
    		CURLOPT_FOLLOWLOCATION => true,
    		CURLOPT_ENCODING => "",
    		CURLOPT_MAXREDIRS => 10,
    		CURLOPT_TIMEOUT => 30,
    		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    		CURLOPT_CUSTOMREQUEST => "POST",
    		CURLOPT_POSTFIELDS => "{\n    \"personalizations\": [\n        {\n            \"to\": [\n                {\n                    \"email\": \"sample210@gmail.com\"\n                }\n            ],\n            \"subject\": \"Hello, World!\"\n        }\n    ],\n    \"from\": {\n        \"email\": \"sample@stackcru.com\"\n    },\n    \"content\": [\n        {\n            \"type\": \"text/plain\",\n            \"value\": \"Hello, World!\"\n        }\n    ]\n}",
    		CURLOPT_HTTPHEADER => [
    			"content-type: application/json",
    			"x-rapidapi-host: test",
    			"x-rapidapi-key: test"
    		],
    	]);

    	$response = curl_exec($curl);
    	$err = curl_error($curl);

    	curl_close($curl);

    	if ($err) {
    		echo "cURL Error #:" . $err;
    	} else {
    		echo $response;
    	}
    }
}
