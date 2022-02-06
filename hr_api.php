<?php

if(isset($_GET['user_login'])){
    user_login();
}
// if(isset($_GET['get_user_data'])){
//     get_user_data();
// }
// if(isset($_GET['user_complain'])){
//     user_complain();
// }
// if(isset($_GET['user_complain_reply'])){
//     user_complain_reply();
// }
// if(isset($_GET['all_user_complains'])){
//     all_user_complains();
// }

// if(isset($_GET['show_all_complains_replies'])){
//     show_all_complains_replies();
// }
// if(isset($_GET['show_user_notifications'])){
//     show_user_notifications();
// }
// if(isset($_GET['show_general_notes'])){
//     show_general_notes();
// }
// if(isset($_GET['show_user_balance'])){
//     show_user_balance();
// }
// if(isset($_GET['show_user_salary_details'])){
//     show_user_salary_details();
// }
// if(isset($_GET['fcm'])){
//     fcm();
// }



// function check_mobile_mac(){
//     if(isset($_GET['mobile_mac'])){
//         $mobile_mack = $_GET['mobile_mac'];

//         $con = mysqli_connect("localhost","root","DejavuIt@150519","dejavu_db1");
//         mysqli_set_charset($con , "utf8");

//         if(mysqli_connect_errno()){
//             echo "Failed to connect to MYSQL : ". mysqli_connect_error();
//         }

//         $sql = "SELECT * FROM mobile_app_mac WHERE mobile_mac = '$mobile_mack'";

//         $result = $con->query($sql);
//         if($result->num_rows > 0){
//             if($resultMobileMac= mysqli_query($con, $sql)){
//                 $mobile_mac_active= $resultMobileMac->fetch_assoc()["active"] ;

//                 $response["active"]= $mobile_mac_active ;

// //                echo $mobile_mack;

//                 if($mobile_mac_active == "yes"){
//                     $response["message"]= "Your mobile phone is allowed to use this application" ;

//                 }else{
//                     $response["message"]= "Your mobile phone is not allowed to use this application" ;

//                     $ID_sql = "SELECT Log_id FROM djv_logs ORDER BY Log_id DESC LIMIT 1;";
//                     if($resultID = mysqli_query($con, $ID_sql)){
//                         $oldLogId = $resultID->fetch_assoc()["Log_id"] ;
//                         $newLogId = $oldLogId + 1;

//                         $time = date("H:i:s");
//                         $date = date("Y/m/d");
//                         $res_message=  'this Mac Address : '.$mobile_mack.' try to access the mobile sales app';

//                         if (isset($_SERVER['HTTP_CLIENT_IP']))
//                             $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
//                         else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
//                             $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
//                         else if (isset($_SERVER['HTTP_X_FORWARDED']))
//                             $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
//                         else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
//                             $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
//                         else if (isset($_SERVER['HTTP_FORWARDED']))
//                             $ipaddress = $_SERVER['HTTP_FORWARDED'];
//                         else if (isset($_SERVER['REMOTE_ADDR']))
//                             $ipaddress = $_SERVER['REMOTE_ADDR'];
//                         else
//                             $ipaddress = 'UNKNOWN';


//                         $q = "INSERT INTO djv_logs(Log_id,log_IP,log_timestr,log_datestr,log_userName,log_access , log_desc1 , log_app , log_func )
//                                                 VALUES ('$newLogId','$ipaddress','$time','$date','Wrong Mac Address' ,'Splash_screen' ,  '$res_message' , 'mobile_sales_app' , 'Splash_screen')";
//                         if (mysqli_query($con, $q)) {
//                             $response["log_message"]= "the record inserted successfully" ;
//                             $response["log_success"]= 1 ;
//                         } else {

//                             $response["log_message"]= "the record not inserted !" ;
//                             $response["log_success"]= 0 ;
//                         }

//                     }

//                 }


//             }


//         }else{
//             $response["message"]= "Your mobile phone is not allowed to use this application" ;

//         }
//     }

//     echo json_encode(array($response));

// }


function user_login(){

      // Plaintext password entered by the user
  $plaintext_password = "Password@123";
  
  // The hashed password retrieved from database
  $hash = 
"$2y$10$8sA2N5Sx/1zMQv2yrTDAaOFlbGWECrrgB68axL.hBb78NhQdyAqWm";
  
  // Verify the hash against the password entered
  $verify = password_verify($plaintext_password, $hash);
  
  // Print the result depending if they match
  if ($verify) {
    echo json_encode( 'Password Verified!');
  } else {
    echo json_encode( 'Incorrect Password!');
  }

//     if(isset($_GET['username'])&& isset($_GET['password'])){
//         $username = $_GET['username'];
//         $response["username"]= $username ;

//         $password = sha1($_GET['password']);
//         $response["password"]= $password;

//         $con = mysqli_connect("localhost","root","DejavuIt@150519","djv_hr1");
//         mysqli_set_charset($con , "utf8");

//         if(mysqli_connect_errno()){
//             echo "Failed to connect to MYSQL : ". mysqli_connect_error();
//         }

// //        echo $username ." ----- ".$password;

//         $sql = "SELECT * FROM djv_users_tbl WHERE User_name = '$username' AND User_Pass = '$password'";

//         $result = $con->query($sql);
//         if($result->num_rows > 0){

//             $store_group_sql = "SELECT G_Name , Store_Code FROM djv_users_tbl WHERE User_name = '$username' AND User_Pass = '$password' LIMIT 1";
//             if($resultGroup = mysqli_query($con, $store_group_sql)){
//                 $group = $resultGroup->fetch_assoc()["G_Name"] ;
//                 $storeCode = $resultGroup->fetch_assoc()["Store_Code"] ;

//                 $response["UserGroup"]= $group ;
//                 $response["storeCode"]= $storeCode ;

//             }

//             $store_code_sql = "SELECT  Store_Code FROM djv_users_tbl WHERE User_name = '$username' AND User_Pass = '$password' LIMIT 1";
//             if($resultCode = mysqli_query($con, $store_code_sql)){
//                 $storeCode = $resultCode->fetch_assoc()["Store_Code"] ;
//                 $response["storeCode"]= $storeCode ;

//             }

//             $response["access"]= "you have permission" ;
//             $response["message"]= "you have been successfully login" ;
//             $response["success"]= 1 ;



//             // $user_usingApp_sql = "SELECT use_app FROM djv_users_tbl WHERE User_name = '$username' AND User_Pass = '$password' LIMIT 1";
//             // if($resultUsingApp = mysqli_query($con, $user_usingApp_sql)){
//             //     $useApp = $resultUsingApp->fetch_assoc()["use_app"] ;

//             //     $response["use_app"]= $useApp ;

//             //     if($useApp ==="yes"){
//             //         $response["access"]= "you have permission" ;
//             //         $response["message"]= "you have been successfully login" ;
//             //         $response["success"]= 1 ;


//             //     }else{
//             //         $response["access"]= "you don't have permission" ;
//             //         $response["message"]= "you don't have permission" ;
//             //         $response["success"]= 0 ;
//             //     }

//             // }


//         }else{
//             $response["message"]= "invalid username or password" ;
//             $response["success"]= 0 ;
//         }

//     }else{
//         $response["message"]= "one or both fields are empty" ;

//     }
//     $con = mysqli_connect("localhost","root","DejavuIt@150519","dejavu_db1");
//     mysqli_set_charset($con , "utf8");

// //    $stmtLog= $con->prepare("SELECT Log_id FROM djv_logs ORDER BY Log_id DESC LIMIT 1;");
// //    $stmtLog->execute();
// //    $rowLog = $stmtLog->fetch();
// //    $newLogId = $rowLog['Log_id'] + 1;

//     $ID_sql = "SELECT Log_id FROM djv_logs ORDER BY Log_id DESC LIMIT 1;";
//     if($resultID = mysqli_query($con, $ID_sql)){
//         $oldLogId = $resultID->fetch_assoc()["Log_id"] ;
//         $newLogId = $oldLogId + 1;

//         $time = date("H:i:s");
//         $date = date("Y/m/d");
//         $res_message=  $response["message"];

//         if (isset($_SERVER['HTTP_CLIENT_IP']))
//             $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
//         else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
//             $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
//         else if (isset($_SERVER['HTTP_X_FORWARDED']))
//             $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
//         else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
//             $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
//         else if (isset($_SERVER['HTTP_FORWARDED']))
//             $ipaddress = $_SERVER['HTTP_FORWARDED'];
//         else if (isset($_SERVER['REMOTE_ADDR']))
//             $ipaddress = $_SERVER['REMOTE_ADDR'];
//         else
//             $ipaddress = 'UNKNOWN';


//         $q = "INSERT INTO djv_logs(Log_id,log_IP,log_timestr,log_datestr,log_userName,log_access , log_desc1 , log_app , log_func )
//                                                 VALUES ('$newLogId','$ipaddress','$time','$date','$username' ,'Login_page' ,  '$res_message' , 'mobile_sales_app' , 'Login')";
//         if (mysqli_query($con, $q)) {
//             $response["log_message"]= "the record inserted successfully" ;
//             $response["log_success"]= 1 ;
//         } else {

//             $response["log_message"]= "the record not inserted !" ;
//             $response["log_success"]= 0 ;
//         }

//     }


//     echo json_encode(array($response));
}

// function insert_sales(){
//     if(isset($_GET['sales_amt'])&& isset($_GET['sales_comment']) && isset($_GET['sales_date']) && isset($_GET['username'])&& isset($_GET['password'])&& isset($_GET['storeCode'])){
//         date_default_timezone_set('Africa/Cairo');
//         $time = date("h:i:s");
//         $entry_date = date("Y/m/d");
//         $sales_date = $_GET['sales_date'];

//         $username = $_GET['username'];
//         $response["username"]= $username ;

//         $password = sha1($_GET['password']);
//         $response["password"]= $password;

//         $sales_amt = $_GET['sales_amt'];
//         $response["sales_amt"]= $sales_amt;

//         $sales_amt_full = $_GET['sales_amt'];
// //        $sales_amt = number_format($sales_amt_full , 1);
// //        $sales_amt =$sales_amt_full ;
// //        $sales_amt = number_format($sales_amt_full,2,'.',',');
//         $sales_amt = $sales_amt_full;


//         $response["sales_amt"]= $sales_amt;

//         $sales_comment = $_GET['sales_comment'];
//         $response["sales_comment"]= $sales_comment ;

//         $store_code_get = $_GET['storeCode'];
//         $response["storeCode"]= $store_code_get ;


//         $con = mysqli_connect("localhost","root","DejavuIt@150519","dejavu_db1");
//         mysqli_set_charset($con , "utf8");

//         if(mysqli_connect_errno()){
//             echo "Failed to connect to MYSQL : ". mysqli_connect_error();
//         }

//         $store_id_sql = "SELECT id FROM djv_actual_sales ORDER BY id DESC LIMIT 1";
//         if($resultId = mysqli_query($con, $store_id_sql)){
//             $id = $resultId->fetch_assoc()["id"] ;
//             $new_sales_id = $id + 1;

//             $response["id"]= $new_sales_id  ;

//         }

//         if(!empty($store_code_get)){
//             $store_codeee = $store_code_get;
//             $response["StoreCode"]= $store_codeee  ;

//             $last_sales_date_sql = "SELECT  sales_date FROM djv_actual_sales WHERE store_code = '$store_codeee' ORDER BY id DESC LIMIT 1";
//             if($resultLastSalesDate = mysqli_query($con, $last_sales_date_sql)){
//                 $last_sales_date = $resultLastSalesDate->fetch_assoc()["sales_date"] ;
//                 $response["last_sales_date"]= $last_sales_date ;

//             }


//             $store_n_sql = "SELECT store_no FROM djv_stores WHERE store_code = '$store_codeee' LIMIT 1";
//             if($resultNum = mysqli_query($con, $store_n_sql)){
//                 $store_nummm = $resultNum->fetch_assoc()["store_no"] ;
//                 $response["StoreNumber"]= $store_nummm  ;

//             }

//         }else{
//             $store_c_sql = "SELECT Store_Code FROM djv_users_tbl WHERE User_name = '$username' AND User_Pass = '$password' LIMIT 1";
//             if($resultCode = mysqli_query($con, $store_c_sql)){
//                 $store_codeee = $resultCode->fetch_assoc()["Store_Code"] ;
//                 $response["StoreCode"]= $store_codeee  ;


//                 $last_sales_date_sql = "SELECT  sales_date FROM djv_actual_sales WHERE store_code = '$store_codeee' ORDER BY id DESC LIMIT 1";
//                 if($resultLastSalesDate = mysqli_query($con, $last_sales_date_sql)){
//                     $last_sales_date = $resultLastSalesDate->fetch_assoc()["sales_date"] ;
//                     $response["last_sales_date"]= $last_sales_date ;

//                 }


//                 $store_n_sql = "SELECT store_no FROM djv_stores WHERE store_code = '$store_codeee' LIMIT 1";
//                 if($resultNum = mysqli_query($con, $store_n_sql)){
//                     $store_nummm = $resultNum->fetch_assoc()["store_no"] ;
//                     $response["StoreNumber"]= $store_nummm  ;

//                 }

//             }
//         }


//         $sql = "SELECT * FROM djv_users_tbl WHERE User_name = '$username' AND User_Pass = '$password'";



//         if($result = mysqli_query($con, $sql)){



//             if($sales_date === ""){

//                 $sql_check_if_exist =  "SELECT  id FROM djv_actual_sales WHERE store_code = '$store_codeee' AND sales_date = '$entry_date' ORDER BY id DESC LIMIT 1";
// //                echo $sql_check_if_exist;

//                 $result_check_if_exist = $con->query($sql_check_if_exist);
//                 if($result_check_if_exist->num_rows > 0){
//                     if($result_check_if_exist = mysqli_query($con, $sql_check_if_exist)){
//                         $check_id = $result_check_if_exist->fetch_assoc()["id"] ;

//                         $update_query =  "UPDATE djv_actual_sales SET store_code = '$store_codeee' , sales_amt = '$sales_amt' , sales_comment = '$sales_comment' , store_num = '$store_nummm' ,sales_date = '$entry_date' WHERE id = '$check_id'";

//                         if (mysqli_query($con, $update_query)) {
//                             $response["message"]= "already exist , it will be overwritten" ;
//                             $response["success"]= 1 ;
//                         } else {

//                             $response["message"]= "the record not updated !" ;
//                             $response["success"]= 0 ;
//                             echo "Error: " . $update_query . "" . mysqli_error($con);
//                         }

//                     }
//                 } else{
//                     $insert_query = "INSERT INTO djv_actual_sales (id , entry_date , sales_date , sales_time , store_num , store_code , sales_amt , sales_comment)
//                                  VALUES
//                                  ('$new_sales_id','$entry_date', '$entry_date' ,'$time','$store_nummm','$store_codeee','$sales_amt','$sales_comment')";

//                     if (mysqli_query($con, $insert_query)) {
//                         $response["message"]= "the record inserted successfully" ;
//                         $response["success"]= 1 ;
//                     } else {

//                         $response["message"]= "the record not inserted !" ;
//                         $response["success"]= 0 ;
//                         echo "Error: " . $insert_query . "" . mysqli_error($con);
//                     }
//                 }


//             }else{


//                 $sql_check_if_exist =  "SELECT  id FROM djv_actual_sales WHERE store_code = '$store_codeee' AND sales_date = '$sales_date' ORDER BY id DESC LIMIT 1";

// //                echo $sql_check_if_exist;
//                 $result_check_if_exist = $con->query($sql_check_if_exist);
//                 if($result_check_if_exist->num_rows > 0){
//                     if($result_check_if_exist = mysqli_query($con, $sql_check_if_exist)){
//                         $check_id = $result_check_if_exist->fetch_assoc()["id"] ;

//                         $update_query =  "UPDATE djv_actual_sales SET store_code = '$store_codeee' , sales_amt = '$sales_amt' , sales_comment = '$sales_comment' , store_num = '$store_nummm' ,sales_date = '$sales_date' WHERE id = '$check_id'";

//                         if (mysqli_query($con, $update_query)) {
//                             $response["message"]= "already exist , it will be overwritten" ;
//                             $response["success"]= 1 ;
//                         } else {

//                             $response["message"]= "the record not updated !" ;
//                             $response["success"]= 0 ;
//                             echo "Error: " . $update_query . "" . mysqli_error($con);
//                         }

//                     }
//                 } else{
//                     $insert_query = "INSERT INTO djv_actual_sales (id , entry_date , sales_date , sales_time , store_num , store_code , sales_amt , sales_comment)
//                                  VALUES
//                                  ('$new_sales_id','$entry_date', '$sales_date' ,'$time','$store_nummm','$store_codeee','$sales_amt','$sales_comment')";

//                     if (mysqli_query($con, $insert_query)) {
//                         $response["message"]= "the record inserted successfully" ;
//                         $response["success"]= 1 ;
//                     } else {

//                         $response["message"]= "the record not inserted !" ;
//                         $response["success"]= 0 ;
//                         echo "Error: " . $insert_query . "" . mysqli_error($con);
//                     }
//                 }

//             }


//         }

//     }else{
//         $response["message"]= "one or both fields are empty" ;

//     }

//     $ID_sql = "SELECT Log_id FROM djv_logs ORDER BY Log_id DESC LIMIT 1;";
//     if($resultID = mysqli_query($con, $ID_sql)){
//         $oldLogId = $resultID->fetch_assoc()["Log_id"] ;
//         $newLogId = $oldLogId + 1;

//         $User_ID_sql = "SELECT User_ID FROM djv_users_tbl WHERE User_name = '$username' AND User_Pass = '$password' LIMIT 1";

//         if($resultUserID = mysqli_query($con, $User_ID_sql)){
//             $user_id = $resultUserID->fetch_assoc()["User_ID"] ;
//         }
//         $time = date("H:i:s");
//         $date = date("Y/m/d");
//         $res_message=  $response["message"];

//         if (isset($_SERVER['HTTP_CLIENT_IP']))
//             $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
//         else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
//             $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
//         else if (isset($_SERVER['HTTP_X_FORWARDED']))
//             $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
//         else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
//             $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
//         else if (isset($_SERVER['HTTP_FORWARDED']))
//             $ipaddress = $_SERVER['HTTP_FORWARDED'];
//         else if (isset($_SERVER['REMOTE_ADDR']))
//             $ipaddress = $_SERVER['REMOTE_ADDR'];
//         else
//             $ipaddress = 'UNKNOWN';

//         $log_func= 'add_sales_'.$store_codeee;
// //        echo $log_func;

//         $q = "INSERT INTO djv_logs(Log_id,log_IP,log_timestr,log_datestr,log_userName,log_userID,log_access , log_desc1 , log_app , log_func )
//                                                 VALUES ('$newLogId','$ipaddress','$time','$date','$username' , '$user_id', 'add_sales' ,  '$res_message' , 'mobile_sales_app' , '$log_func')";

// //       echo  $q;
//         if (mysqli_query($con, $q)) {

//             $response["log_message"]= "the record inserted successfully" ;
//             $response["log_success"]= 1 ;
//         } else {

//             $response["log_message"]= "the record not inserted !" ;
//             $response["log_success"]= 0 ;
//         }

//     }


//     echo json_encode(array($response));
// }

// function get_last_sales_date(){
//     if(isset($_GET['username'])&& isset($_GET['password'])){
//         $username = $_GET['username'];
//         $response["username"]= $username ;

//         $password = sha1($_GET['password']);
//         $response["password"]= $password;


//         $con = mysqli_connect("localhost","root","DejavuIt@150519","dejavu_db1");
//         mysqli_set_charset($con , "utf8");

//         if(mysqli_connect_errno()){
//             echo "Failed to connect to MYSQL : ". mysqli_connect_error();
//         }


//         $store_code_sql = "SELECT  Store_Code FROM djv_users_tbl WHERE User_name = '$username' AND User_Pass = '$password' LIMIT 1";
//         if($resultCode = mysqli_query($con, $store_code_sql)){
//             $storeCode = $resultCode->fetch_assoc()["Store_Code"] ;
//             $response["storeCode"]= $storeCode ;

//         }

//         $last_sales_date_sql = "SELECT  sales_date FROM djv_actual_sales WHERE store_code = '$storeCode' ORDER BY id DESC LIMIT 1";
//         if($resultLastSalesDate = mysqli_query($con, $last_sales_date_sql)){
//             $last_sales_date = $resultLastSalesDate->fetch_assoc()["sales_date"] ;
//             $response["last_sales_date"]= $last_sales_date ;

//         }
//     }
//     echo json_encode(array($response));
// }

// function get_sales(){
//     if(isset($_GET['username'])&& isset($_GET['password']) && isset($_GET['dateFrom']) && isset($_GET['dateTo']) && isset($_GET['storeCode'])){
//         $total_amount = 0;

//         $dateFrom = $_GET['dateFrom'];
//         $response["dateFrom"]= $dateFrom ;

//         $dateTo = $_GET['dateTo'];
//         $response["dateTo"]= $dateTo;

//         $storeCode = $_GET['storeCode'];
//         $response["storeCode"]= $storeCode;

//         $username = $_GET['username'];
//         $response["username"]= $username ;

//         $password = sha1($_GET['password']);
//         $response["password"]= $password;

//         $con = mysqli_connect("localhost","root","DejavuIt@150519","dejavu_db1");
//         mysqli_set_charset($con , "utf8");

//         if(mysqli_connect_errno()){
//             echo "Failed to connect to MYSQL : ". mysqli_connect_error();
//         }

//         $user_Group_sql = "SELECT  G_Name FROM djv_users_tbl WHERE User_name = '$username' AND User_Pass = '$password' LIMIT 1";
//         if($resultGroup = mysqli_query($con, $user_Group_sql)){
//             $userGroup = $resultGroup->fetch_assoc()["G_Name"] ;
//             $response["userGroup"]= $userGroup ;

//             /////////////////start////////////
//             if (!empty($dateFrom) && !empty($dateTo))
//             {
//                 if (!empty($storeCode)) {
//                     if($userGroup == "area_manager_b" || $userGroup == "TManagers" ){
//                         $user_Regional_sql = "SELECT  Regional_Stores FROM djv_users_tbl WHERE User_name = '$username' AND User_Pass = '$password' LIMIT 1";
//                         if($resultRegional = mysqli_query($con, $user_Regional_sql)){
//                             $userRegional = $resultRegional->fetch_assoc()["Regional_Stores"] ;
//                             $response["userRegional"]= $userRegional ;

//                             $sql1 = "SELECT s1.store_code, s1.store_no , s2.id, s2.sales_date , s2.sales_time , s2.sales_amt , s2.sales_comment
//                                     FROM djv_stores AS s1
//                                     LEFT JOIN djv_actual_sales AS s2
//                                     ON s1.store_code = s2.store_code 
//                                     AND s2.store_code ='$storeCode' 
//                                     AND (s2.sales_date BETWEEN '$dateFrom' AND '$dateTo')
//                                     where (s1.store_no >= 0 AND  s1.store_no <= 99)
//                                     AND s1.store_type != 'InActive'
//                                     AND s1.store_no IN ($userRegional)
//                                     ORDER BY s1.sort_option1  ,s2.sales_date  ASC ";


//                         }
//                     }else{
//                         $sql1 = "SELECT s1.store_code, s1.store_no , s2.id, s2.sales_date , s2.sales_time , s2.sales_amt , s2.sales_comment
//                                     FROM djv_stores AS s1
//                                     LEFT JOIN djv_actual_sales AS s2
//                                     ON s1.store_code = s2.store_code 
//                                     AND s2.store_code ='$storeCode' 
//                                     AND (s2.sales_date BETWEEN '$dateFrom' AND '$dateTo')
//                                     where (s1.store_no >= 0 AND  s1.store_no <= 99)
//                                     AND s1.store_type != 'ONL'
//                                     AND s1.store_type != 'InActive'
//                                     ORDER BY s1.sort_option1  ,s2.sales_date  ASC ";

//                         $sql2 = "SELECT s1.store_code, s1.store_no , s2.id, s2.sales_date , s2.sales_time , s2.sales_amt , s2.sales_comment
//                                     FROM djv_stores AS s1
//                                     LEFT JOIN djv_actual_sales AS s2
//                                     ON s1.store_code = s2.store_code 
//                                     AND s2.store_code ='$storeCode' 
//                                     AND (s2.sales_date BETWEEN '$dateFrom' AND '$dateTo')
//                                     where (s1.store_no >= 0 AND  s1.store_no <= 99)
//                                     AND s1.store_type = 'ONL'
//                                     AND s1.store_type != 'InActive'
//                                      ORDER BY s1.sort_option1  ,s2.sales_date  ASC ";
//                     }
// //

//                 } else {
// //                        $sting = "SELECT * FROM djv_actual_sales
// //                       WHERE  (sales_date BETWEEN '$dateFrom' AND '$dateTo') ORDER BY id DESC ";
//                     if($userGroup == "area_manager_b" || $userGroup == "TManagers"){
//                         $user_Regional_sql = "SELECT  Regional_Stores FROM djv_users_tbl WHERE User_name = '$username' AND User_Pass = '$password' LIMIT 1";
//                         if($resultRegional = mysqli_query($con, $user_Regional_sql)){
//                             $userRegional = $resultRegional->fetch_assoc()["Regional_Stores"] ;
//                             $response["userRegional"]= $userRegional ;

//                             $sql1 = "SELECT s1.store_code, s1.store_no , s2.id, s2.sales_date , s2.sales_time , s2.sales_amt , s2.sales_comment
//                                     FROM djv_stores AS s1
//                                     LEFT JOIN djv_actual_sales AS s2
//                                     ON s1.store_code = s2.store_code  
//                                     AND (s2.sales_date BETWEEN '$dateFrom' AND '$dateTo')
//                                     where (s1.store_no >= 0 AND  s1.store_no <= 99)
//                                     AND s1.store_type != 'InActive'
//                                     AND s1.store_no IN ($userRegional)
//                                     ORDER BY s1.sort_option1  ,s2.sales_date ASC ";


//                         }
//                     }else{
//                         $sql1 = "SELECT s1.store_code, s1.store_no , s2.id,  s2.sales_date , s2.sales_time , s2.sales_amt , s2.sales_comment
//                                     FROM djv_stores AS s1
//                                     LEFT JOIN djv_actual_sales AS s2
//                                     ON s1.store_code = s2.store_code  
//                                     AND  (s2.sales_date BETWEEN '$dateFrom' AND '$dateTo')
//                                     where (s1.store_no >= 0 AND  s1.store_no <= 99)
//                                     AND s1.store_type != 'ONL'
//                                     AND s1.store_type != 'InActive'
//                                      ORDER BY s1.sort_option1 , s2.sales_date  ASC ";

//                         $sql2 = "SELECT s1.store_code, s1.store_no , s2.id,  s2.sales_date , s2.sales_time , s2.sales_amt , s2.sales_comment
//                                     FROM djv_stores AS s1
//                                     LEFT JOIN djv_actual_sales AS s2
//                                     ON s1.store_code = s2.store_code  
//                                     AND  (s2.sales_date BETWEEN '$dateFrom' AND '$dateTo')
//                                     where (s1.store_no >= 0 AND  s1.store_no <= 99)
//                                     AND s1.store_type = 'ONL'
//                                     AND s1.store_type != 'InActive'
//                                      ORDER BY s1.sort_option1 ,s2.sales_date  ASC ";
//                     }


//                 }

//             }
//             else {
//                 if (!empty($storeCode)) {
// //                        $sting = "SELECT * FROM djv_actual_sales
// //                           WHERE store_code ='$select_store_code' ORDER BY id DESC ";

//                     if($userGroup == "area_manager_b" || $userGroup == "TManagers"){
//                         $user_Regional_sql = "SELECT  Regional_Stores FROM djv_users_tbl WHERE User_name = '$username' AND User_Pass = '$password' LIMIT 1";
//                         if($resultRegional = mysqli_query($con, $user_Regional_sql)){
//                             $userRegional = $resultRegional->fetch_assoc()["Regional_Stores"] ;
//                             $response["userRegional"]= $userRegional ;

//                             $sql1 = "SELECT s1.store_code, s1.store_no , s2.id, s2.sales_date , s2.sales_time , s2.sales_amt , s2.sales_comment
//                                     FROM djv_stores AS s1
//                                     LEFT JOIN djv_actual_sales AS s2
//                                     ON s1.store_code = s2.store_code 
//                                     AND s2.store_code ='$storeCode' AND DATE(s2.sales_date) = DATE(NOW())
//                                     where (s1.store_no >= 0 AND  s1.store_no <= 99)
//                                     AND s1.store_type != 'InActive'
//                                     AND s1.store_no IN ($userRegional)
//                                     ORDER BY s1.sort_option1  ,s2.sales_date  ASC ";


//                         }
//                     }else{
//                         $sql1 = "SELECT s1.store_code, s1.store_no , s2.id, s2.sales_date , s2.sales_time , s2.sales_amt , s2.sales_comment
//                                     FROM djv_stores AS s1
//                                     LEFT JOIN djv_actual_sales AS s2
//                                     ON s1.store_code = s2.store_code 
//                                     AND s2.store_code ='$storeCode' AND DATE(s2.sales_date) = DATE(NOW())
//                                     where (s1.store_no >= 0 AND  s1.store_no <= 99)
//                                     AND s1.store_type != 'ONL'
//                                     AND s1.store_type != 'InActive'
//                                      ORDER BY s1.sort_option1  ,s2.sales_date  ASC";

//                         $sql2 = "SELECT s1.store_code, s1.store_no , s2.id, s2.sales_date , s2.sales_time , s2.sales_amt , s2.sales_comment
//                                     FROM djv_stores AS s1
//                                     LEFT JOIN djv_actual_sales AS s2
//                                     ON s1.store_code = s2.store_code 
//                                     AND s2.store_code ='$storeCode' AND DATE(s2.sales_date) = DATE(NOW())
//                                     where (s1.store_no >= 0 AND  s1.store_no <= 99)
//                                     AND s1.store_type = 'ONL'
//                                     AND s1.store_type != 'InActive'
//                                      ORDER BY s1.sort_option1  ,s2.sales_date  ASC";
//                     }


//                 } else {
// //                        $sting = "SELECT * FROM djv_actual_sales ORDER BY id DESC ";

//                     if($userGroup == "area_manager_b" || $userGroup == "TManagers"){
//                         $user_Regional_sql = "SELECT  Regional_Stores FROM djv_users_tbl WHERE User_name = '$username' AND User_Pass = '$password' LIMIT 1";
//                         if($resultRegional = mysqli_query($con, $user_Regional_sql)){
//                             $userRegional = $resultRegional->fetch_assoc()["Regional_Stores"] ;
//                             $response["userRegional"]= $userRegional ;

//                             $sql1 = "SELECT s1.store_code, s1.store_no , s2.id, s2.sales_date , s2.sales_time , s2.sales_amt , s2.sales_comment
//                                     FROM djv_stores AS s1
//                                     LEFT JOIN djv_actual_sales AS s2
//                                     ON s1.store_code = s2.store_code AND DATE(s2.sales_date) = DATE(NOW())
//                                     where (s1.store_no >= 0 AND  s1.store_no <= 99)
//                                     AND s1.store_type != 'InActive'
//                                     AND s1.store_no IN ($userRegional)
//                                     ORDER BY s1.sort_option1  ,s2.sales_date  ASC ";


//                         }
//                     }else{
//                         $sql1 = "SELECT s1.store_code , s1.store_no , s2.id , s2.sales_date , s2.sales_time , s2.sales_amt , s2.sales_comment
//                                     FROM djv_stores AS s1
//                                     LEFT JOIN djv_actual_sales AS s2
//                                     ON s1.store_code = s2.store_code 
//                                     AND DATE(s2.sales_date) = DATE(NOW())
//                                     where (s1.store_no >= 0 AND  s1.store_no <= 99)
//                                     AND s1.store_type != 'ONL'
//                                     AND s1.store_type != 'InActive'
//                                     ORDER BY s1.sort_option1  ,s2.sales_date  ASC ";

//                         $sql2 = "SELECT s1.store_code , s1.store_no , s2.id , s2.sales_date , s2.sales_time , s2.sales_amt , s2.sales_comment
//                                     FROM djv_stores AS s1
//                                     LEFT JOIN djv_actual_sales AS s2
//                                     ON s1.store_code = s2.store_code 
//                                     AND DATE(s2.sales_date) = DATE(NOW())
//                                     where (s1.store_no >= 0 AND  s1.store_no <= 99)
//                                     AND s1.store_type = 'ONL'
//                                     AND s1.store_type != 'InActive'
//                                     ORDER BY s1.sort_option1  ,s2.sales_date  ASC ";
//                     }



//                 }

//             }


//             if($userGroup == "area_manager_b" || $userGroup == "TManagers"){
//                 $result = $con->query($sql1);
//                 if($result->num_rows > 0){
//                     $all_sales = array();
//                     $offAmount = 0;
//                     while ($row_sales = $result->fetch_object()){
//                         $temp_all_sales = $row_sales;

//                         $temp_all_sales->message = "notNull";
//                         $offAmount = $offAmount + str_replace(",","",$row_sales->sales_amt) ;
//                         $row_sales->sales_amt = number_format($row_sales->sales_amt,null,null,',');
//                         array_push($all_sales , $temp_all_sales);
// //                $response["message"]= "notNull";
//                     }

//                     $total_amount = $total_amount + $offAmount;

//                     $offAmount_formated = number_format($offAmount,null,null,',');
//                     $response["OFFdata"]= $all_sales ;
//                     $response["OFFamount"]= number_format($offAmount,null,null,',') ;
//                     $response["OFFamountF"]= $offAmount_formated ;


//                 }else{
//                     $all_sales = array();
//                     array_push($all_sales , "no data found" );

//                     $response["message"]= "Null";
//                     $response["OFFdata"]= $all_sales ;

//                 }


//             }else{
//                 $result = $con->query($sql1);
//                 if($result->num_rows > 0){
//                     $all_sales = array();
//                     $offAmount = 0;
//                     while ($row_sales = $result->fetch_object()){
//                         $temp_all_sales = $row_sales;

//                         $temp_all_sales->message = "notNull";
//                         $offAmount = $offAmount + str_replace(",","",$row_sales->sales_amt) ;
//                         $row_sales->sales_amt = number_format($row_sales->sales_amt,null,null,',');
//                         array_push($all_sales , $temp_all_sales);
// //                $response["message"]= "notNull";
//                     }

//                     $total_amount = $total_amount + $offAmount;

//                     $offAmount_formated = number_format($offAmount,null,null,',');
//                     $response["OFFdata"]= $all_sales ;
//                     $response["OFFamount"]= number_format($offAmount,null,null,',') ;
//                     $response["OFFamountF"]= $offAmount_formated ;


//                 }else{
//                     $all_sales = array();
//                     array_push($all_sales , "no data found" );

//                     $response["message"]= "Null";
//                     $response["OFFdata"]= $all_sales ;

//                 }

//                 $result2 = $con->query($sql2);
//                 if($result2->num_rows > 0){
//                     $all_sales2 = array();
//                     $onAmount = 0;
//                     while ($row_sales2 = $result2->fetch_object()){
//                         $temp_all_sales2 = $row_sales2;
//                         $temp_all_sales2->message = "notNull";
//                         $onAmount = $onAmount + str_replace(",","",$row_sales2->sales_amt);
//                         $row_sales2->sales_amt = number_format($row_sales2->sales_amt,null,null,',');
//                         array_push($all_sales2 , $temp_all_sales2);
// //                $response["message"]= "notNull";
//                     }
//                     $total_amount = $total_amount + $onAmount;

//                     $onAmount_formated = number_format($onAmount,null,null,',');

//                     $response["ONLdata"]= $all_sales2 ;
//                     $response["ONLamount"]= number_format($onAmount,null,null,',') ;
//                     $response["ONLamountF"]= $onAmount_formated ;



//                 }else{
//                     $all_sales2 = array();
//                     array_push($all_sales2 , "no data found" );

//                     $response["message"]= "Null";
//                     $response["ONLdata"]= $all_sales2 ;

//                 }
//             }
//         }



//         /////////////////end/////////////





//     }else{
//         $response["message"]= "Null";

//         $response["data"]= "one or both fields are empty" ;

//     }

//     $totalAmount_formated = number_format($total_amount,null,null,',');

//     $response["TotalAmount"]= $total_amount ;
//     $response["TotalAmountF"]= $totalAmount_formated ;

//     $ID_sql = "SELECT Log_id FROM djv_logs ORDER BY Log_id DESC LIMIT 1;";
//     if($resultID = mysqli_query($con, $ID_sql)){
//         $oldLogId = $resultID->fetch_assoc()["Log_id"] ;
//         $newLogId = $oldLogId + 1;

//         $User_ID_sql = "SELECT User_ID FROM djv_users_tbl WHERE User_name = '$username' AND User_Pass = '$password' LIMIT 1";


//         if($resultUserID = mysqli_query($con, $User_ID_sql)){
//             $user_id = $resultUserID->fetch_assoc()["User_ID"] ;
// //            echo $user_id;
//         }
//         $time = date("H:i:s");
//         $date = date("Y/m/d");


//         if (isset($_SERVER['HTTP_CLIENT_IP']))
//             $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
//         else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
//             $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
//         else if (isset($_SERVER['HTTP_X_FORWARDED']))
//             $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
//         else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
//             $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
//         else if (isset($_SERVER['HTTP_FORWARDED']))
//             $ipaddress = $_SERVER['HTTP_FORWARDED'];
//         else if (isset($_SERVER['REMOTE_ADDR']))
//             $ipaddress = $_SERVER['REMOTE_ADDR'];
//         else
//             $ipaddress = 'UNKNOWN';


//         $q = "INSERT INTO djv_logs(Log_id,log_IP,log_timestr,log_datestr,log_userName,log_userID,log_access , log_desc1 , log_app , log_func )
//                                                 VALUES ('$newLogId','$ipaddress','$time','$date','$username' , '$user_id', 'show_sales' ,  'show all store sales' , 'mobile_sales_app' , 'show_sales')";

// //        echo  $q;
//         if (mysqli_query($con, $q)) {

//             $response["log_message"]= "the record inserted successfully" ;
//             $response["log_success"]= 1 ;
//         } else {

//             $response["log_message"]= "the record not inserted !" ;
//             $response["log_success"]= 0 ;
//         }

//     }


//     echo json_encode(array($response));
// }

// function getStoreList(){
//     $con = mysqli_connect("localhost","root","DejavuIt@150519","dejavu_db1");
//     mysqli_set_charset($con , "utf8");

//     if(mysqli_connect_errno()){
//         echo "Failed to connect to MYSQL : ". mysqli_connect_error();
//     }

//     if(isset($_GET['username'])&& isset($_GET['password'])){
//         $username = $_GET['username'];
//         $response["username"]= $username ;

//         $password = sha1($_GET['password']);
//         $response["password"]= $password;

//         $user_Regional_sql = "SELECT  Regional_Stores FROM djv_users_tbl WHERE User_name = '$username' AND User_Pass = '$password' LIMIT 1";
//         if($resultRegional = mysqli_query($con, $user_Regional_sql)){
//             $userRegional = $resultRegional->fetch_assoc()["Regional_Stores"] ;
//             $response["userRegional"]= $userRegional ;

//         }
//         $storeQuery = "SELECT store_code FROM djv_stores where (store_no >= 0 AND  store_no <= 99) AND store_no IN ($userRegional) ORDER BY sort_option1 ASC ";


//     }else{
//         $storeQuery = "SELECT store_code FROM djv_stores where (store_no >= 0 AND  store_no <= 99) ORDER BY sort_option1 ASC ";

//     }
// //        echo $storeQuery."<br/><br/><br/>";

//     $resultStores = $con->query($storeQuery);

//     if($resultStores->num_rows > 0){
//         $all_stores = array();
//         array_push($all_stores , ["value"=>"Select Store Code"]);

//         while ($row_store = $resultStores->fetch_object()){
//             $temp_all_stores = ["value"=> $row_store->store_code];

//             array_push($all_stores , $temp_all_stores);
//         }
//         $response["allStores"]= $all_stores ;

//     }else{
//         $all_stores = array();
//         array_push($all_stores , "no data found" );
//         $response["message"]= "Null";
//     }

//     echo json_encode(array($response));

// }


// function getStoreList2(){
//     $con = mysqli_connect("localhost","root","DejavuIt@150519","dejavu_db1");
//     mysqli_set_charset($con , "utf8");

//     if(mysqli_connect_errno()){
//         echo "Failed to connect to MYSQL : ". mysqli_connect_error();
//     }

//     if(isset($_GET['username'])&& isset($_GET['password'])){
//         $username = $_GET['username'];
//         $response["username"]= $username ;

//         $password = sha1($_GET['password']);
//         $response["password"]= $password;

//         $user_Regional_sql = "SELECT  Regional_Stores FROM djv_users_tbl WHERE User_name = '$username' AND User_Pass = '$password' LIMIT 1";
//         if($resultRegional = mysqli_query($con, $user_Regional_sql)){
//             $userRegional = $resultRegional->fetch_assoc()["Regional_Stores"] ;
//             $response["userRegional"]= $userRegional ;

//         }
//         $storeQuery = "SELECT store_code FROM djv_stores where (store_no >= 0 AND  store_no <= 99) AND store_no IN ($userRegional) ORDER BY sort_option1 ASC ";


//     }else{
//         $storeQuery = "SELECT store_code FROM djv_stores where (store_no >= 0 AND  store_no <= 99) ORDER BY sort_option1 ASC ";

//     }
// //        echo $storeQuery."<br/><br/><br/>";

//     $resultStores = $con->query($storeQuery);

//     if($resultStores->num_rows > 0){
//         $all_stores = array();
//         $all_stores[] = "Select Store Code";

//         while ($row_store = $resultStores->fetch_object()){
// //            $temp_all_stores = ["value"=> $row_store->store_code];

//             $all_stores[]= $row_store->store_code;
//         }
//         $response["allStores"]= $all_stores ;

//     }else{
//         $all_stores = array();
//         array_push($all_stores , "no data found" );
//         $response["message"]= "Null";
//     }

//     echo json_encode(array($response));

// }

?>


