<?php
 
//  use Vendor\Illuminate\Support\Facades\Crypt;

if(isset($_GET['user_login'])){
    user_login();
}
if(isset($_GET['get_user_data'])){
    get_user_data();
}
if(isset($_GET['user_complain'])){
    user_complain();
}
if(isset($_GET['user_complain_reply'])){
    user_complain_reply();
}
if(isset($_GET['all_user_complains'])){
    all_user_complains();
}

if(isset($_GET['show_all_complains_replies'])){
    show_all_complains_replies();
}
if(isset($_GET['show_user_notifications'])){
    show_user_notifications();
}
if(isset($_GET['show_general_notes'])){
    show_general_notes();
}
if(isset($_GET['show_user_balance'])){
    show_user_balance();
}
if(isset($_GET['show_user_salary_details'])){
    show_user_salary_details();
}
if(isset($_GET['fcm'])){
    fcm();
}

if(isset($_GET['check_mobile_id'])){
    check_mobile_id();
}

function check_mobile_id()
{
    if (isset($_GET['mobile_id'])) {
        $mobile_id = $_GET['mobile_id'];

        $con = mysqli_connect("localhost", "root", "DejavuIt@150519", "dejavu_db1");
        mysqli_set_charset($con, "utf8");

        if (mysqli_connect_errno()) {
            echo "Failed to connect to MYSQL : " . mysqli_connect_error();
        }

        $sql = "SELECT * FROM mobile_app_id WHERE mobile_id = '$mobile_id'";

        $result = $con->query($sql);
        if ($result->num_rows > 0) {
            if ($resultMobileMac = mysqli_query($con, $sql)) {
                $mobile_id_active = $resultMobileMac->fetch_assoc()["active"];

                $response["active"] = $mobile_id_active;

                //                echo $mobile_id;

                if ($mobile_id_active == 1) {
                    $response["message"] = "Your mobile phone is allowed to use this application";
                } else {
                    $response["message"] = "Your mobile phone is not allowed to use this application";

                    $ID_sql = "SELECT Log_id FROM djv_logs ORDER BY Log_id DESC LIMIT 1;";
                    if ($resultID = mysqli_query($con, $ID_sql)) {
                        $oldLogId = $resultID->fetch_assoc()["Log_id"];
                        $newLogId = $oldLogId + 1;

                        $time = date("H:i:s");
                        $date = date("Y/m/d");
                        $res_message =  'this ID : ' . $mobile_id . ' try to access the mobile sales app';

                        if (isset($_SERVER['HTTP_CLIENT_IP']))
                            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
                        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
                            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
                        else if (isset($_SERVER['HTTP_X_FORWARDED']))
                            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
                        else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
                            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
                        else if (isset($_SERVER['HTTP_FORWARDED']))
                            $ipaddress = $_SERVER['HTTP_FORWARDED'];
                        else if (isset($_SERVER['REMOTE_ADDR']))
                            $ipaddress = $_SERVER['REMOTE_ADDR'];
                        else
                            $ipaddress = 'UNKNOWN';


                        $q = "INSERT INTO djv_logs(Log_id,log_IP,log_timestr,log_datestr,log_userName,log_access , log_desc1 , log_app , log_func )
                                                VALUES ('$newLogId','$ipaddress','$time','$date','Wrong Mobile ID' ,'Splash_screen' ,  '$res_message' , 'mobile_sales_app' , 'Splash_screen')";
                        if (mysqli_query($con, $q)) {
                            $response["log_message"] = "the record inserted successfully";
                            $response["log_success"] = 1;
                        } else {

                            $response["log_message"] = "the record not inserted !";
                            $response["log_success"] = 0;
                        }
                    }
                }
            }
        } else {
            $response["message"] = "Your mobile phone is not allowed to use this application";
        }
    }

    echo json_encode(array($response));
}

function user_login(){
    if(isset($_GET['username'])&& isset($_GET['password'])){
        $username = $_GET['username'];
        $response["username"]= $username ;
        $password =$_GET['password'];
        $response["password"]= $password;
        $user_token='';
        $con = mysqli_connect("localhost","root","DejavuIt@150519","djv_hr1");
        mysqli_set_charset($con , "utf8");

        if(mysqli_connect_errno()){
            echo "Failed to connect to MYSQL : ". mysqli_connect_error();
        }
            $password_sql = "SELECT password FROM users WHERE username = '$username' LIMIT 1";
            if($resultPassword= mysqli_query($con, $password_sql)){
                $password_q = $resultPassword->fetch_assoc()["password"];
                $verify = password_verify($_GET['password'],$password_q);

                if($verify){

                    $sql = "SELECT * FROM users WHERE username = '$username'";
                    $result = $con->query($sql);
                    if($result->num_rows > 0){
                        if(isset($_GET['user_token'])){
                            $user_token =$_GET['user_token']; 
                            $update_userToken ="UPDATE users SET user_device_token='$user_token' WHERE username='$username'";
                            if (mysqli_query($con, $update_userToken)) {
                                $response["token_message"]= "user token updated successfully" ;
                                $response["token_success"]= 1 ;
                            } else {
            
                                $response["token_message"]= "user token not updated !" ;
                                $response["token_success"]= 0 ;
                                echo "Error: " . $update_query . "" . mysqli_error($con);
                            }
                        }
                        $response["success"] = 1; 
                        $response["message"] = "You have been sucessfully login";
                        $response["username"] = $username; 
                        $response["password"] = $password;
                        $userToken = $user_token;
                        $response["tokeeeen"] = $user_token;
                    }else{
                        $response["message"]= "invalid username or password" ;
                        $response["success"]= 0 ;
                    }
                }else{
                    $response["message"]= "invalid username or password" ;
                    $response["success"]= 0 ;
                }

            }

    }else{
        $response["message"]= "one or both fields are empty" ;

    }
    echo json_encode(array($response));
}

function get_user_data(){

    $con=mysqli_connect("localhost","root","DejavuIt@150519","djv_hr1");
    mysqli_set_charset($con,"utf8");


    if (mysqli_connect_errno())
    {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

        $username = $_GET['username'];
        $response["username"]= $username ;
        $password =$_GET['password'];
        $response["password"]= $password;

            $password_sql = "SELECT password FROM users WHERE username = '$username' LIMIT 1";
            if($resultPassword= mysqli_query($con, $password_sql)){
                $password_q = $resultPassword->fetch_assoc()["password"];
                $verify = password_verify($_GET['password'],$password_q);

                if($verify){

                    $sql = "SELECT * FROM users WHERE username = '$username'";
                    $result = $con->query($sql);
            
            
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
                
                }else{
                    $test=['message' , 'null'];
                    $all_user_info = array(['message'=> 'null']); 
                }

            }else{
                $test=['message' , 'null'];
                $all_user_info = array(['message'=> 'null']); 
            }

            echo json_encode($all_user_info);


}

function user_complain()
{
    $con=mysqli_connect("localhost","root","DejavuIt@150519","djv_hr1");
    mysqli_set_charset($con,"utf8");


    if (mysqli_connect_errno())
    {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    if(isset($_GET['emp_code'])){
        $emp_code=$_GET['emp_code'];
    }
    if(isset($_GET['emp_id'])){
        $emp_id=$_GET['emp_id'];
    }
    if(isset($_GET['content'])){
        $content=$_GET['content'];
    }
    if(isset($_GET['image'])){
        $image=$_GET['image'];
    }
    if(isset($_GET['secret'])){
        $secret=$_GET['secret'];
    }


    if($secret == true)
    {
        $complain_insert_q=" INSERT INTO complains (content , secret , complain_image , emp_code , user_id )
        VALUES
        ('$content','yes', '$image' ,'$emp_code','$emp_id')";
    }else{
        $complain_insert_q=" INSERT INTO complains (content , secret , complain_image , emp_code , user_id )
        VALUES
        ('$content','no', '$image' ,'$emp_code','$emp_id')";
        }

        if (mysqli_query($con, $complain_insert_q)) {
            $response["message"] = "success"; 

        } else {

            $response["message"] = "faild";

            echo "Error: " . $complain_insert_q . "" . mysqli_error($con);
        }
    
    echo json_encode($response);
}

function user_complain_reply()
{

    $con=mysqli_connect("localhost","root","DejavuIt@150519","djv_hr1");
    mysqli_set_charset($con,"utf8");


    if (mysqli_connect_errno())
    {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    if(isset($_GET['emp_code'])){
        $emp_code=$_GET['emp_code'];
    }
    if(isset($_GET['emp_id'])){
        $emp_id=$_GET['emp_id'];
    }
    if(isset($_GET['reply_content'])){
        $reply_content=$_GET['reply_content'];
    }
    if(isset($_GET['complain_id'])){
        $complain_id=$_GET['complain_id'];
    }

    $complain_reply_insert_q=" INSERT INTO complain_replies (user_id , complain_id  , reply , employee_code)
    VALUES
    ('$emp_id','$complain_id', '$reply_content' ,'$emp_code')";

    if (mysqli_query($con, $complain_reply_insert_q)) {
        $response["message"] = "success"; 

    } else {

        $response["message"] = "faild";

        echo "Error: " . $complain_reply_insert_q . "" . mysqli_error($con);
    }


    


    echo json_encode($response);
}

function all_user_complains()
{

    $con=mysqli_connect("localhost","root","DejavuIt@150519","djv_hr1");
    $resultArray = array();

    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    if(isset($_GET['emp_code'])){
        $emp_code = $_GET['emp_code'];
    }


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
    echo json_encode($user_all_complains);

}

function show_all_complains_replies()
{

    $con=mysqli_connect("localhost","root","DejavuIt@150519","djv_hr1");
    mysqli_set_charset($con,"utf8");
    $resultArray = array();

    if (mysqli_connect_errno())
    {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    if(isset($_GET['complain_id'])){
        $complain_id=$_GET['complain_id'];
    }
    if(isset($_GET['complain_emp_code'])){
        $complain_emp_code=$_GET['complain_emp_code'];
    }


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

    echo json_encode($user_all_complains_replies);

}

function show_user_notifications()
{

    $con=mysqli_connect("localhost","root","DejavuIt@150519","djv_hr1");
    mysqli_set_charset($con,"utf8");
    $resultArray = array();

    if (mysqli_connect_errno())
    {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    if(isset($_GET['emp_code'])){
        $emp_code =$_GET['emp_code'];
    }

    $current = date("Y-m-d");

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

        echo json_encode($user_all_notifications);

}

function show_general_notes()
{
    $con=mysqli_connect("localhost","root","DejavuIt@150519","djv_hr1");
    mysqli_set_charset($con,"utf8");
    $resultArray = array();

    if (mysqli_connect_errno())
    {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    $current = date("Y-m-d");


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
        echo json_encode($g_notifications);
}

function show_user_balance(){

    $con=mysqli_connect("localhost","root","DejavuIt@150519","djv_hr1");
    mysqli_set_charset($con,"utf8");
    $resultArray = array();

    if (mysqli_connect_errno())
    {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }


    if(isset($_GET['emp_code'])){
        $emp_code=$_GET['emp_code'];
    }
    
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

    echo json_encode($all_user_balance);

}

function show_user_salary_details(){

$encryptionMethod = "AES-256-CBC";  // AES is used by the U.S. gov't to encrypt top secret documents.
$secretHash = "25c6c7ff35b9979b151f2136cd13b0ff";

    $con=mysqli_connect("localhost","root","DejavuIt@150519","djv_hr1");
    mysqli_set_charset($con,"utf8");
    $resultArray = array();

    if (mysqli_connect_errno())
    {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }


    if(isset($_GET['emp_code'])){
        $emp_code=$_GET['emp_code'];
    }
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
            $row_user_salary->basic_salary =  openssl_decrypt($row_user_salary->basic_salary, $encryptionMethod, $secretHash);
            $row_user_salary->t_allowence = openssl_decrypt($row_user_salary->t_allowence, $encryptionMethod, $secretHash);
            $row_user_salary->other_exempt = openssl_decrypt($row_user_salary->other_exempt, $encryptionMethod, $secretHash);
            $row_user_salary->s_commission = openssl_decrypt($row_user_salary->s_commission, $encryptionMethod, $secretHash);
            $row_user_salary->day_off = openssl_decrypt($row_user_salary->day_off, $encryptionMethod, $secretHash);
            $row_user_salary->acting_allow = openssl_decrypt($row_user_salary->acting_allow, $encryptionMethod, $secretHash);
            $row_user_salary->overtime = openssl_decrypt($row_user_salary->overtime, $encryptionMethod, $secretHash);
            $row_user_salary->late = openssl_decrypt($row_user_salary->late, $encryptionMethod, $secretHash);
            $row_user_salary->absense = openssl_decrypt($row_user_salary->absense, $encryptionMethod, $secretHash);
            $row_user_salary->card = openssl_decrypt($row_user_salary->card, $encryptionMethod, $secretHash);
            $row_user_salary->other_deduct = openssl_decrypt($row_user_salary->other_deduct, $encryptionMethod, $secretHash);
            $row_user_salary->unpaid_leave = openssl_decrypt($row_user_salary->unpaid_leave, $encryptionMethod, $secretHash);
            $row_user_salary->penalty_day = openssl_decrypt($row_user_salary->penalty_day, $encryptionMethod, $secretHash);
            $row_user_salary->advance = openssl_decrypt($row_user_salary->advance, $encryptionMethod, $secretHash);
            $row_user_salary->loan = openssl_decrypt($row_user_salary->loan, $encryptionMethod, $secretHash);
            $row_user_salary->emp_insu = openssl_decrypt($row_user_salary->emp_insu, $encryptionMethod, $secretHash);
            $row_user_salary->net_salary = openssl_decrypt($row_user_salary->net_salary, $encryptionMethod, $secretHash);
            
            // $row_user_salary->nameee = $row_user_salary['emp_name'];
            $tempUserSalaryArray= $row_user_salary;
            array_push($all_user_salary_details, $tempUserSalaryArray);

        }
     
    }else
    {
    $test=['message' , 'null'];
    $all_user_salary_details = array(['message'=> 'null']); 
    }

    echo json_encode($all_user_salary_details);
}

function fcm(){


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
?>


