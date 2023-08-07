<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\App;

class FirebaseService
{
    public static function sendNotification($title,$body,Collection $tokens)
    {
        $headers = [

            'Authorization' => 'key=' . env('FCM_SERVER_KEY'),

            'Content-Type'=>'application/json',

        ];

       
        //initial request
        $http = Http::withHeaders($headers);
        
        //chunk tokens
        foreach ($tokens->chunk(100) as $firebaseToken){
            $data = [

                "registration_ids" => $firebaseToken,
    
                "notification" => [
    
                    "title" => $title,
    
                    "body" => $body,  
    
                ]
            ];
          
            try {
                $response = $http->post('https://fcm.googleapis.com/fcm/send',$data);
            } catch (\Throwable $th) {
                return false;
            }

            // return $response->object();
        }

        return true;
    }
}