<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class globalFunctions extends Model
{
    public function fcm($title , $note , $token){


        $API_ACCESS_KEY = "AAAAhQLwUjg:APA91bEy4G-dBQWQMkwzkbSKxcRzlBb0KV0-hv0gyMD_gASfWc-NRgTfDdJUErvWQjAkXPLpA7Y6T78esPbmknJ_iphivlEjwSq6RSbfU81wfMxsbF0y67WRs4yITMovBi_75Jrqe9GI";
        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
        ;
       
           $notification = [
                   'title' => $title,
                   'body' => $note,
                   'icon' =>'myIcon', 
                   'sound' => 'mySound'
               ];
               $extraNotificationData = ["message" => $notification,"moredata" =>'dd'];
       
               $fcmNotification = [
                   //'registration_ids' => $tokenList, //multple token array
                   'to'        => $token, //single token
                   'notification' => $notification,
                   'data' => $extraNotificationData
               ];
       
               $headers = [
                   'Authorization: key=' . $API_ACCESS_KEY,
                   'Content-Type: application/json'
               ];
       
       
               $ch = curl_init();
               curl_setopt($ch, CURLOPT_URL,$fcmUrl);
               curl_setopt($ch, CURLOPT_POST, true);
               curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
               curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
               curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
               curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
               $result = curl_exec($ch);
               curl_close($ch);
       
       
               echo $result;
       
       
       
           // // $title = $request->title;
           // // $message = $request->message;
           // // $type = $request->type;
           // // $notification_ids= $request->notification_ids =array();
           // define( 'API_ACCESS_KEY', 'AAAAhQLwUjg:APA91bHYk1RefpNhAgVXfXvLDmQmfALr-0vZeqnI8coZG-zwh2XIrNBR9y0NSd0knfP3bh9LvRyOEPmOKKECzUVuO3Edz5tLKdVrbXpxLqMzav6xbMfmj4WwZCBOnfO-jSThdnmDbPJ6');
           // // $registrationIds = $notification_ids;
           // $registrationIds = array('eiDb_fUSQOq4NjH9I1YuXI:APA91bFhcrLcyqNHY8yApABEYxHLbqJebhcEriUiFl2mPiZx6qGtRhvER2Pv1XJ_obH6n7RL3SiB9aC_-tbGLMLwmQ2H4FK0J9HFsSCbRnmK9ykzf2neC5e4vBVQyBs0-8Toqfu2BNRb');
           // $msg = array
           //     ( 
           //         'title'         => "test title",
           //         'message'       => "test message message",
           //         'summaryText'   => 'The internet is built on cat pictures',
           //         'click_action'  => 'FCM_PLUGIN_ACTIVITY',
           //         'vibrate'       => 1,
           //         'sound'         => 1,
           //         'type'          => "get"
           //     );
        
           // $fields = array
           // (
           //     'registration_ids'  => $registrationIds,
           //     'data'              => $msg
              
           // );
            
           // $headers = array
           // (
           //     'Authorization: key=' . API_ACCESS_KEY,
           //     'Content-Type: application/json'
           // );
            
           // $ch = curl_init();
           // curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
           // curl_setopt( $ch,CURLOPT_POST, true );
           // curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
           // curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
           // curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
           // curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
           // $result = curl_exec($ch );
           // curl_close( $ch );
           // return $result;
           // // var_dump($fields);
       }
}
