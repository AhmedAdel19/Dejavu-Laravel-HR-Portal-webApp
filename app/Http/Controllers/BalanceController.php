<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use App\employee_balance;


class BalanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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

    //Add new Balance
    public function create_balance($id , $emp_code)
    {
        return view('employee_balance_pages.create', compact('id' , 'emp_code'));
    }



    //edit balance
    public function edit_employee_balance($id)
    {
        $balance = employee_balance::find($id);
        return view('employee_balance_pages.edit' , compact('balance'));
    }


    //update balance
    public function update_employee_balance(Request $request , $id)
    {


        $balance = employee_balance::find($id);

        $balance->annual_leave = $request->annual_leave;
        $balance->sick_leave = $request->sick_leave;
        $user_device_token = DB::table('users')->select('user_device_token')->where('employee_code', '=',$balance->emp_code)->value('user_device_token');

        $this->fcm("New HR Notification" ,"Check Your Updated Balance" , $user_device_token);

        $balance->save();

        return redirect('/employees_balance/search_balance')->with('status' , 'Balance was updated Successfully !');

    }

    public function user_index()
    {
        
        $all_users = DB::table('users')->select('id','name' , 'email' , 'mobile' , 'Djv_Group' , 'Djv_Access' , 'title','user_pp','employee_code')->orderBy('ID')->get();
        // $all_users = User::orderBy('id' , 'desc')->paginate(5);
        $count = $all_users->count();
        return view('employee_balance_pages.index' , compact('all_users' , 'count'));
    }

        //store user Page
        public function search(Request $request)
        {
            $emp_name = $request->name;
            $emp_email =$request->email;
            $emp_mobile = $request->mobile;
            $emp_group = $request->emp_group;
            $emp_code = $request->employee_code;
            $dataarr = array(
                'name' => $emp_name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'Djv_Group' => $request->emp_group,
                'employee_code' =>$request->employee_code,
            );
            $sql = '';
            // foreach ($dataarr as $key => $item) {
    
            //     if($dataarr[$key]){
    
            //         $sql .= $key . ' Like ' . "'%" .$dataarr[$key] .  "%' and";
            //     }
            // }
            // $last3char = substr($sql, -3);
            // if(strtolower($last3char) == 'and'){
            //     $sql = substr_replace($sql ,"",-3);
            // }
            foreach ($dataarr as $key => $item) {

                if($dataarr[$key]){
    
                    $sql .= $key . ' Like ' . "'%" .$dataarr[$key] .  "%' or ";
                }
            }
            $last3char = substr($sql, -3);
            if(strtolower($last3char) == 'or '){
                $sql = substr_replace($sql ,"",-3);
            }
            if($sql != ""){
                $all_users =  DB::select('select * from users where '.$sql.' order by id desc');
            }else{
                $all_users =  DB::select('select * from users order by id desc');
            }
           return view('employee_balance_pages.index' , compact('all_users' ));
    
            //return redirect('/home')->with('status' , 'User Added Successfully !');
    
        }


    public function store_balance(Request $request,$id,$emp_code)
    {
        $balance = new employee_balance();
    
        $balance->annual_leave = $request->annual_leave;
        $balance->sick_leave = $request->sick_leave;
        $balance->emp_id = $id;
        $balance->emp_code = $emp_code;

        $user_device_token = DB::table('users')->select('user_device_token')->where('employee_code', '=',$balance->emp_code)->value('user_device_token');

        $this->fcm("New HR Notification" ,"Check Your Updated Balance" , $user_device_token);
        $balance->save();

        return redirect('/employees_balance/'.$id.'')->with('status' , 'Balance was add Successfully !');
    }

    public function show_employee_balance($id)
    {

        $user = User::find($id);

        $all_emp_balances = employee_balance::where('emp_id' ,'=', $id)->orderBy('id')->paginate(4);
        //$all_emp_balances = User::orderBy('id' , 'desc')->paginate(5);
        $count = $all_emp_balances->count();
        return view('employee_balance_pages.show' , compact('user' , 'count' , 'all_emp_balances'));

    }

    public function destroy_employee_balance($user_id , $id)
    {

        DB::table('employee_balances')->where('id', '=', $id)->delete();

        return redirect('/employees_balance/'.$user_id.'')->with('status' , 'Balance was deleted Successfully !');

        
    }



    //show form upload
   public function showForm()
   {
    return view('employee_balance_pages.upload_file');
   }

   //store upload file

   public function storeData(Request $request)
   {
    
    if( $request->file('upload_file')) {

       //get file
       $upload =$request->file('upload_file');
       $filePath = $upload->getRealPath();

       //open and read
       $file = fopen($filePath , 'r');
       $hrader = fgetcsv($file);

       $escapedHeader = [];

       //validate
       foreach ($hrader as $key => $value) 
       {
           $lheader = strtolower($value);
           $escapedItem = preg_replace('/[^a-z]/' , '' , $lheader);
           array_push($escapedHeader , $escapedItem);
       }

       //dd($escapedHeader);

       //loading other columns
       while($columns=fgetcsv($file))
       {
           if($columns[0] == "")
           {
               continue;
           }

           //trim data
        $data = array_combine($escapedHeader , $columns);


        $emp_code = $data['code'];
        $annual_leave = $data['annualleave'];
        $sick_leave =$data['sickleave'];

        $emp_id = DB::table('users')->select('id')->where('employee_code', '=', $emp_code)->value('id');
        $check_user_count = DB::table('users')->where('employee_code', $emp_code)->count();

        if($check_user_count > 0)
        {
            $check_user_balance_count = DB::table('employee_balances')->where('emp_id', $emp_id)->count();

            if($check_user_balance_count > 0)
            {
                DB::table('employee_balances')->where('emp_id', $emp_id)->update(
                    ['annual_leave'=> $annual_leave ,
                    'sick_leave'=> $sick_leave,
                    'emp_id'=> $emp_id ,
                    'emp_code' =>$emp_code,
                    ]
                );

            }else
            {
                $uploaded_emp_balance = new employee_balance();
        
                $uploaded_emp_balance->annual_leave = $annual_leave;
                $uploaded_emp_balance->sick_leave = $sick_leave;
                $uploaded_emp_balance->emp_id = $emp_id;
                $uploaded_emp_balance->emp_code = $emp_code;
                $user_device_token = DB::table('users')->select('user_device_token')->where('employee_code', '=',$emp_code)->value('user_device_token');

                $this->fcm("New HR Notification" ,"Check Your Updated Balance" , $user_device_token);
                $uploaded_emp_balance->save();
            }

        }
        else{
            return redirect('/employees_balance/search_balance')->with('status' , 'may one or more employee code not valid try again please!');
        }
       }
       return redirect('/employees_balance/search_balance')->with('status' , 'Employees balance file uploaded Successfully !');
    }else
    {
        return redirect()->back()->with('status' , 'No File Selected !');
    }
   }
}
