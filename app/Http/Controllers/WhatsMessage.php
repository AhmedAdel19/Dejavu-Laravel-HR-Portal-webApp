<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
class WhatsMessage extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('whatsapp_messages.index');
    }

    public function fcm($title , $note , $token){

        $API_ACCESS_KEY = "AAAAxBaGf1M:APA91bFFhS_nmiC9mse3f2A6MO4x6rB6afCIqNn-O0NIMcSOIKuABrhsc2WFT9u9zPysyqJ0A-vg3dbMRxibMiOBnA9sRZW6y6xfP3gMlxTo0RjcKpckaElGUjAFVppHIfffxWay8SWT";

        // define('API_ACCESS_KEY','AAAAhQLwUjg:APA91bEy4G-dBQWQMkwzkbSKxcRzlBb0KV0-hv0gyMD_gASfWc-NRgTfDdJUErvWQjAkXPLpA7Y6T78esPbmknJ_iphivlEjwSq6RSbfU81wfMxsbF0y67WRs4yITMovBi_75Jrqe9GI');
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
       }

    public function readFromCsv($file_name = "")
    {
        // Read from csv.
        $file = fopen($file_name, 'r');
        fputs($file, $bom = (chr(0xEF) . chr(0xBB) . chr(0xBF)));

        $headers = fgetcsv($file);
        $result = array();

        while ($row = fgetcsv($file)) {
            if (!$row[0]) continue;
            $nextItem = array();
            for ($i = 0; $i < count($headers); ++$i) {
                $nextItem[$headers[$i]] = $row[$i];
            }
            $result[] = $nextItem;
        }
        fclose($file);
        ////////////////////
        return $result;
    }

    public function sendWMessages(Request $request)
    {
        $html = "";
        $count = 0;
        if ($request->file('filename')) {

            //get file
            $upload = $request->file('filename');
            $filePath = $upload->getRealPath();
            $subject = $request->message_subject;

            //open and read
            $file = fopen($filePath, 'r');
            $hrader = fgetcsv($file);

            $escapedHeader = [];

            //validate
            foreach ($hrader as $key => $value) {
                $lheader = strtolower($value);
                $escapedItem = preg_replace('/[^a-z]/', '', $lheader);
                array_push($escapedHeader, $escapedItem);
            }

            //dd($escapedHeader);

            //loading other columns
            while ($columns = fgetcsv($file)) {
                if ($columns[0] == "") {
                    continue;
                }

                //trim data
                $data = array_combine($escapedHeader, $columns);


                $emp_code = $data['code'];
                $month = $data['month'];
                $basic_salary = $data['basicsalary'];
                $t_allowence = $data['tallowence'];
                $other_exempt = $data['otherexempt'];
                $s_commission = $data['scommission'];
                $day_off = $data['dayoff'];
                $acting_allow = $data['actingallow'];
                $overtime = $data['overtime'];
                $late = $data['late'];
                $absense = $data['absense'];
                $card = $data['card'];
                $other_deduct = $data['otherdeduct'];
                $unpaid_leave = $data['unpaidleave'];
                $penalty_day = $data['penaltyday'];
                $advance = $data['advance'];
                $loan = $data['loan'];
                $emp_insu = $data['empinsu'];
                $net_salary = $data['netsalary'];

                $emp_id = DB::table('users')->select('id')->where('employee_code', '=', $emp_code)->value('id');
                $check_user_count = DB::table('users')->where('employee_code', $emp_code)->count();

                $user_device_token = DB::table('users')->select('user_device_token')->where('employee_code', '=', $emp_code)->value('user_device_token');

                $this->fcm("New HR Notification", 'Check Your Updated Salary Please', $user_device_token);

                if ($check_user_count > 0) {
                    $token = 'fq9r6ylooby13gia';
                    $instanceId = '387144';

                    $f_name = $_FILES['filename']['tmp_name'];
                    $csvData  =  $this->readFromCsv($f_name);
                    $m_subject = $subject;
                    date_default_timezone_set('Africa/Cairo');



                    $html .= "<div class='center' style='padding:5px;width: 70%;  margin-left: auto;
                            margin-right: auto;'>Date :  " . date("Y/m/d") . "------Time :  " . date('h:i:s') . "</div><br>";


                    foreach ($csvData as $key => $item) {
                        $count++;
                        $array_keys = array_keys($item);
                        // var_dump($array_keys);

                        $html .= "<table class='center' style='width: 70%;  margin-left: auto;
                            margin-right: auto;' border='1' cellspacing='3' cellpadding='4'>\n";

                        for ($i = 0; $i < count($array_keys); ++$i) {
                            $html .= "<tr>\n";
                            $html .= "<th style='border: 1px solid black;font-size:18px;
                                text-align:center;
                                background-color:#24292e;
                                color:#fff;
                                height:25px;
                                margin-top:20px;
                                justify-content:center;'> " . $array_keys[$i] . "</th>";
                            $html .= " <td style='border: 1px solid black;text-align:center;padding:2px;font-size:18px' >" . $item[$array_keys[$i]] . "</td>";
                            $html .= "</tr>\n";

                            echo "</br>".$array_keys[$i]."  :  ".$item[$array_keys[$i]]."</br>";
                        }
                        // die();

                        $html .= "</table>\n";

                        // require_once "vendor/autoload.php";

                        $m_sub = $m_subject;

                        //    var_dump($item[$array_keys[0]]);die();

                        $name = $item[$array_keys[0]];
                        $email = strval($item[$array_keys[1]]);
                        $cust_mobile = strval($item[$array_keys[2]]);

                        //    echo "cust mobile : ".$cust_mobile;

                        $arr_m_to[0][1] = $email;
                        $arr_m_to[0][2] = $name;

                        //  $arr_m_to[0][1] = 'it.dep@oxygencom.com';
                        //  $arr_m_to[0][2] = 'IT Dept';

                        //  $arr_m_to[1][1] = 'fady@oxygencom.com';
                        //  $arr_m_to[1][2] = 'fady';

                        //  $arr_m_to[2][1] = 'andre0azrak@gmail.com';
                        //  $arr_m_to[2][2] = 'andy';
                        $number = "+2" . $cust_mobile; // Number

                        if (!empty($cust_mobile)) {

                            $data = [
                                'phone' => $number, // Receivers phone
                                'body' => $m_sub, // Message
                            ];
                            $json = json_encode($data); // Encode data to JSON
                            // URL for request POST /message

                            $url = 'https://api.chat-api.com/instance' . $instanceId . '/message?token=' . $token;
                            // Make a POST request
                            $options = stream_context_create([
                                'http' => [
                                    'method'  => 'POST',
                                    'header'  => 'Content-type: application/json',
                                    'content' => $json
                                ]
                            ]);
                            // Send a request
                            $result = file_get_contents($url, false, $options);

                            //    $curl = curl_init();
                            //    curl_setopt_array($curl, array(
                            //      CURLOPT_URL => 'http://chat-api.phphive.info/message/send/text',
                            //      CURLOPT_RETURNTRANSFER => true,
                            //      CURLOPT_ENCODING => '',
                            //      CURLOPT_MAXREDIRS => 10,
                            //      CURLOPT_TIMEOUT => 0,
                            //      CURLOPT_FOLLOWLOCATION => true,
                            //      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            //      CURLOPT_CUSTOMREQUEST => 'POST',
                            //      CURLOPT_POSTFIELDS =>json_encode(array("jid"=> $number."@s.whatsapp.net", "message" => $m_sub)),
                            //      CURLOPT_HTTPHEADER => array(
                            //        'Authorization: Bearer '.$chatApiToken,
                            //        'Content-Type: application/json'
                            //      ),
                            //    ));

                            //    $response = curl_exec($curl);
                            // // echo count($array_keys); die();
                            //    curl_close($curl);
                            for ($i = 0; $i < count($array_keys); ++$i) {
                                if ($i == 0 || $i == 1 || $i == 2 || $i == 3) {
                                    continue;
                                } else {
                                    // echo $array_keys[$i]." : ".$item[$array_keys[$i]]."</br>";
                                    $message .= $array_keys[$i] . " : " . $item[$array_keys[$i]] . "                                                                     ";
                                    //  echo $message ."</br>";

                                }
                            }


                            $data = [
                                'phone' => $number, // Receivers phone
                                'body' => $message, // Message
                            ];
                            $json = json_encode($data); // Encode data to JSON
                            // URL for request POST /message
                            $url = 'https://api.chat-api.com/instance' . $instanceId . '/message?token=' . $token;
                            // Make a POST request
                            $options = stream_context_create([
                                'http' => [
                                    'method'  => 'POST',
                                    'header'  => 'Content-type: application/json',
                                    'content' => $json
                                ]
                            ]);
                            // Send a request
                            $result = file_get_contents($url, false, $options);


                            //    $curl = curl_init();
                            //    curl_setopt_array($curl, array(
                            //      CURLOPT_URL => 'http://chat-api.phphive.info/message/send/text',
                            //      CURLOPT_RETURNTRANSFER => true,
                            //      CURLOPT_ENCODING => '',
                            //      CURLOPT_MAXREDIRS => 10,
                            //      CURLOPT_TIMEOUT => 0,
                            //      CURLOPT_FOLLOWLOCATION => true,
                            //      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            //      CURLOPT_CUSTOMREQUEST => 'POST',
                            //      CURLOPT_POSTFIELDS =>json_encode(array("jid"=> $number."@s.whatsapp.net", "message" => $message)),
                            //      CURLOPT_HTTPHEADER => array(
                            //        'Authorization: Bearer '.$chatApiToken,
                            //        'Content-Type: application/json'
                            //      ),
                            //    ));

                            //    $response = curl_exec($curl);
                            //    curl_close($curl);
                            // echo $response;
                        }

                        // if (!empty($hr_email) && !empty($hr_email_password)) {
                        //     if ($opbudget_c->djv_salary_mail($hr_email, $hr_email_password, $arr_m_to, $m_sub, $html)) {
                        //         $success++;
                        //         $arr_m_to = [];
                        //         $m_sub = "";
                        //         $html = "";
                        //     } else {
                        //         $faild++;
                        //         array_push($faild_mails, $arr_m_to[0][1]);
                        //     }
                        // }
                        $message = "";
                        // echo $response;

                    }
                } else {
                    return redirect()->back()->with('status', 'may one or more employee code not valid try again please!');
                }
            }
            return redirect('/wMessages')->with('status', 'Employees Salary Details file uploaded Successfully !');
        } else {
            return redirect()->back()->with('status', 'No File Selected !');
        }
    }
}
