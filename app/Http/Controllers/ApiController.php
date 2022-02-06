<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\complain;
use App\complain_replies;
use Carbon\Carbon;
use App\User;
use DB;

class ApiController extends Controller
{


    public function user_login(Request $request)
    {

        $password=$request->pass;
        $email=$request->email;
        $username=$request->username;

        if (!empty($request->all())) 
        { 
            if (empty($username))
            { 
                $response["success"] = 0; 
                $response["message"] = "username field is empty ."; 
                $username=" "; 
 
            }
            if (empty($password))
            { 
                $response["success"] = 0; 
                $response["message"] = "Password field is empty ."; 
                 $password=" "; 
            }
            $Hashedpass = '';
            
            $credentials = [
                'username' => $request['username'],
                'password' => $request['pass'],
            ];
            if (Auth::attempt($credentials)) 
                {
                    $user = auth()->user();
                    $response["success"] = 1; 
                    $response["message"] = "You have been sucessfully login";
                    $response["username"] = $username; 
                    $response["password"] = $password;
                    $userToken = $request->user_token;
                    $response["tokeeeen"] = $userToken;

                // DB::table('users')->whereColumn([
                //     ['username', '=', $username],
                // ])->update(['user_device_token' => $userToken]);


                // ->where('username', $username)
                // ->where('password', $password)  
                // ->limit(1)

                DB::table('users')
                ->where('username', $username)
                ->limit(1)
                ->update(array('user_device_token' => $userToken)); 

                }else{
                    $response["success"] = 0; 
                    $response["message"] = "invalid username or password ";
                    $response["username"] = $username; 
                    $response["password"] = $password;
                }
        }else{ 
            $response["success"] = 0; 
            $response["message"] = " One or both of the fields are empty ";
            $response["username"] = $username; 
            $response["password"] = $password;
        }
        return json_encode(array($response));
     }

     
    public function get_user_data(Request $request){
        

        $con=mysqli_connect("localhost","root","DejavuIt@150519","djv_hr1");
        mysqli_set_charset($con,"utf8");


        if (mysqli_connect_errno())
        {
          echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }

            $Hashedpass = '';    
            $email = $request->email;
            $password = $request->pass;
            $username = $request->username;

            if (Auth::attempt(array(
                'username' => $username,
                'password' => $password
                    ))) 
                    {
                
                $user = auth()->user();
                $Hashedpass = $user->getAuthPassword();
            } 
            $sql = "SELECT * FROM users where username ='$username' and password= '$Hashedpass'";

            $result = mysqli_query($con, $sql);
            if ($result->num_rows > 0)
            {
        
            $all_user_info= array();
        
                while($row_user_info= $result->fetch_object())
                {
        
                    $row_user_info->message = 'Notnull';
        
                    $tempUserInfoeArray= $row_user_info;
                    array_push($all_user_info, $tempUserInfoeArray);
        
                }
             
        }else
        {
           $test=['message' , 'null'];
           $all_user_info = array(['message'=> 'null']); 
        }
        
        return json_encode($all_user_info);
    }


    public function user_complain(Request $request)
    {
        $complain = new complain();

        $emp_code=$request->emp_code;
        $emp_id =$request->emp_id;
        $content=$request->content;
        $image=$request->image;
        $secret =$request->secret;

        if($secret == true)
        {
            $complain->secret = 'yes';
        }else{
            $complain->secret = 'no';
        }

        $complain->content = $content;
        $complain->user_id = $emp_id;
        $complain->emp_code = $emp_code;
        $complain->complain_image = $image;
        

        if($complain->save())
        {
            $response["message"] = "success"; 
        }else{
            $response["message"] = "faild";
        }
        return json_encode($response);
    }


    public function user_complain_reply(Request $request)
    {
        $complain_reply = new complain_replies();

        $emp_code=$request->emp_code;
        $emp_id =$request->emp_id;
        $reply_content=$request->reply_content;
        $complain_id = $request->complain_id;


        $complain_reply->reply = $reply_content;
        $complain_reply->user_id = $emp_id;
        $complain_reply->employee_code = $emp_code;
        $complain_reply->complain_id = $complain_id;


        

        if($complain_reply->save())
        {
            $response["message"] = "success"; 
        }else{
            $response["message"] = "faild";
        }
        return json_encode($response);
    }


    public function all_user_complains(Request $request)
    {

        $con=mysqli_connect("localhost","root","DejavuIt@150519","djv_hr1");
        $resultArray = array();

        if (mysqli_connect_errno())
        {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }

        $complain = new complain();

        $emp_code=$request->emp_code;

        $sql_admin = "SELECT * FROM users where employee_code ='$emp_code'";
        $result_admin = mysqli_query($con, $sql_admin);
        $admin_array = $result_admin->fetch_object();
        $is_admin = $admin_array->Djv_Group;

        if($is_admin === 'admin')
        {
            $sql = "SELECT * FROM complains";
        }else
        {
            $sql = "SELECT * FROM complains where emp_code ='$emp_code'";
        }

         mysqli_set_charset($con,"utf8");
         $result = mysqli_query($con, $sql);

        if ($result->num_rows > 0)
        {

            $user_all_complains= array();


            while($row_user_complain = $result->fetch_object())
            {

                $row_user_complain->message = 'Notnull';
                $tempUsersComplainsArray = $row_user_complain;
                array_push($user_all_complains, $tempUsersComplainsArray);
            }



        }else
        {
            $user_all_complains = array(['message'=> 'null']);
        }
        return json_encode($user_all_complains);

    }


    public function show_all_complains_replies(Request $request)
    {

        $con=mysqli_connect("localhost","root","DejavuIt@150519","djv_hr1");
        mysqli_set_charset($con,"utf8");
        $resultArray = array();

        if (mysqli_connect_errno())
        {
          echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }

        $complain = new complain();

        $complain_id=$request->complain_id;
        $complain_emp_code=$request->complain_emp_code;


        $sql = "SELECT * FROM complain_replies where complain_id ='$complain_id'";

        $result = mysqli_query($con, $sql);

        if ($result->num_rows > 0)
        {
 
        $user_all_complains_replies= array();

            while($row_reply_complain = $result->fetch_object())
            {
    
    
                if($row_reply_complain->employee_code === $complain_emp_code)
                {
                    $row_reply_complain->check_auth = 'auth';
    
                }else{
                    $row_reply_complain->check_auth = 'Notauth';
                }
                $row_reply_complain->message = 'Notnull';
    
                $tempRepliesComplainsArray = $row_reply_complain;
                array_push($user_all_complains_replies, $tempRepliesComplainsArray);
    
            }
         
    }else
    {
         $test=['message' , 'null'];
       $user_all_complains_replies = array(['message'=> 'null']); 
    }

    return json_encode($user_all_complains_replies);

    }


    
public function show_user_notifications(Request $request)
{

    $con=mysqli_connect("localhost","root","DejavuIt@150519","djv_hr1");
    mysqli_set_charset($con,"utf8");
    $resultArray = array();

    if (mysqli_connect_errno())
    {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    $emp_code=$request->emp_code;

    $current = Carbon::today()->toDateString();

    $sql = "SELECT * FROM employee_notes where emp_code ='$emp_code' and start_date <= '$current' and end_date >= '$current' ";


    
    $result = mysqli_query($con, $sql);

    if ($result->num_rows > 0)
    {

    $user_all_notifications= array();

        while($row_user_note = $result->fetch_object())
        {



            $row_user_note->message = 'Notnull';

            $tempRusernotesArray= $row_user_note;
            array_push($user_all_notifications, $tempRusernotesArray);

        }
     
}else
{
     $test=['message' , 'null'];
   $user_all_notifications = array(['message'=> 'null']); 
}

return json_encode($user_all_notifications);

}



public function show_general_notes(Request $request)
{

    $con=mysqli_connect("localhost","root","DejavuIt@150519","djv_hr1");
    mysqli_set_charset($con,"utf8");
    $resultArray = array();

    if (mysqli_connect_errno())
    {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    $current = Carbon::today()->toDateString();

    $sql = "SELECT * FROM general_notes where start_date <= '$current' and end_date >= '$current' ";

 
    
    $result = mysqli_query($con, $sql);

    if ($result->num_rows > 0)
    {

    $g_notifications= array();

        while($row_g_note = $result->fetch_object())
        {

            $row_g_note->message = 'Notnull';

            $tempGeneralnotesArray= $row_g_note;
            array_push($g_notifications, $tempGeneralnotesArray);

        }
     
}else
{
   $test=['message' , 'null'];
   $g_notifications = array(['message'=> 'null']); 
}

return json_encode($g_notifications);

}



public function show_user_balance(Request $request){

    $con=mysqli_connect("localhost","root","DejavuIt@150519","djv_hr1");
    mysqli_set_charset($con,"utf8");
    $resultArray = array();

    if (mysqli_connect_errno())
    {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }



    $emp_code=$request->emp_code;
    $sql = "SELECT * FROM employee_balances where emp_code ='$emp_code' ORDER BY created_at DESC ";


    $result = mysqli_query($con, $sql);

    if ($result->num_rows > 0)
    {

    $all_user_balance= array();

        while($row_user_balance = $result->fetch_object())
        {

            $row_user_balance->message = 'Notnull';

            $tempUserBalanceArray= $row_user_balance;
            array_push($all_user_balance, $tempUserBalanceArray);

        }
     
}else
{
   $test=['message' , 'null'];
   $all_user_balance = array(['message'=> 'null']); 
}

return json_encode($all_user_balance);

}


public function show_user_salary_details(Request $request){

    $con=mysqli_connect("localhost","root","DejavuIt@150519","djv_hr1");
    mysqli_set_charset($con,"utf8");
    $resultArray = array();

    if (mysqli_connect_errno())
    {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }



    $emp_code=$request->emp_code;
    $sql = "SELECT * FROM employee_salaries where emp_code ='$emp_code' ORDER BY created_at DESC ";


    $result = mysqli_query($con, $sql);

    if ($result->num_rows > 0)
    {

    $all_user_salary_details= array();

        while($row_user_salary = $result->fetch_object())
        {

            $row_user_salary->message = 'Notnull';
            $row_user_salary->emp_name = $row_user_salary->emp_name;
            $row_user_salary->emp_email = $row_user_salary->emp_email;
            $row_user_salary->emp_mobile = $row_user_salary->emp_mobile;
            $row_user_salary->emp_code = $row_user_salary->emp_code;
            $row_user_salary->month = $row_user_salary->month;
            $row_user_salary->basic_salary = \Illuminate\Support\Facades\Crypt::decrypt($row_user_salary->basic_salary);
            $row_user_salary->t_allowence = \Illuminate\Support\Facades\Crypt::decrypt($row_user_salary->t_allowence);
            $row_user_salary->other_exempt = \Illuminate\Support\Facades\Crypt::decrypt($row_user_salary->other_exempt);
            $row_user_salary->s_commission = \Illuminate\Support\Facades\Crypt::decrypt($row_user_salary->s_commission);
            $row_user_salary->day_off = \Illuminate\Support\Facades\Crypt::decrypt($row_user_salary->day_off);
            $row_user_salary->acting_allow = \Illuminate\Support\Facades\Crypt::decrypt($row_user_salary->acting_allow);
            $row_user_salary->overtime = \Illuminate\Support\Facades\Crypt::decrypt($row_user_salary->overtime);
            $row_user_salary->late = \Illuminate\Support\Facades\Crypt::decrypt($row_user_salary->late);
            $row_user_salary->absense = \Illuminate\Support\Facades\Crypt::decrypt($row_user_salary->absense);
            $row_user_salary->card = \Illuminate\Support\Facades\Crypt::decrypt($row_user_salary->card);
            $row_user_salary->other_deduct = \Illuminate\Support\Facades\Crypt::decrypt($row_user_salary->other_deduct);
            $row_user_salary->unpaid_leave = \Illuminate\Support\Facades\Crypt::decrypt($row_user_salary->unpaid_leave);
            $row_user_salary->penalty_day = \Illuminate\Support\Facades\Crypt::decrypt($row_user_salary->penalty_day);
            $row_user_salary->advance = \Illuminate\Support\Facades\Crypt::decrypt($row_user_salary->advance);
            $row_user_salary->loan = \Illuminate\Support\Facades\Crypt::decrypt($row_user_salary->loan);
            $row_user_salary->emp_insu = \Illuminate\Support\Facades\Crypt::decrypt($row_user_salary->emp_insu);
            $row_user_salary->net_salary = \Illuminate\Support\Facades\Crypt::decrypt($row_user_salary->net_salary);
            
            // $row_user_salary->nameee = $row_user_salary['emp_name'];
            $tempUserSalaryArray= $row_user_salary;
            array_push($all_user_salary_details, $tempUserSalaryArray);

        }
     
}else
{
   $test=['message' , 'null'];
   $all_user_salary_details = array(['message'=> 'null']); 
}

return json_encode($all_user_salary_details);

}

public function fcm(){


 define('API_ACCESS_KEY','AAAAhQLwUjg:APA91bEy4G-dBQWQMkwzkbSKxcRzlBb0KV0-hv0gyMD_gASfWc-NRgTfDdJUErvWQjAkXPLpA7Y6T78esPbmknJ_iphivlEjwSq6RSbfU81wfMxsbF0y67WRs4yITMovBi_75Jrqe9GI');
 $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
 $token='eiDb_fUSQOq4NjH9I1YuXI:APA91bFhcrLcyqNHY8yApABEYxHLbqJebhcEriUiFl2mPiZx6qGtRhvER2Pv1XJ_obH6n7RL3SiB9aC_-tbGLMLwmQ2H4FK0J9HFsSCbRnmK9ykzf2neC5e4vBVQyBs0-8Toqfu2BNRb';

    $notification = [
            'title' =>'title',
            'body' => 'body of message.',
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
            'Authorization: key=' . API_ACCESS_KEY,
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
}

}
?>