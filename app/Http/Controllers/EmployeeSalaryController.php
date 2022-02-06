<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use DB;
use App\User;
use App\employee_salary;
class EmployeeSalaryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //Add new Salary
    public function create_salary($id , $emp_code)
    {
        return view('employee_salary_pages.create', compact('id' , 'emp_code'));
    }


    public function encrypt_funcation($data = null)
    {
        $encryptionMethod = "AES-256-CBC";  // AES is used by the U.S. gov't to encrypt top secret documents.
        $secretHash = "25c6c7ff35b9979b151f2136cd13b0ff";
        
        //To encrypt
        $encrypted_data = openssl_encrypt($data, $encryptionMethod, $secretHash);
        return $encrypted_data;
    }

    public function decrypt_funcation($data = null)
    {
        $encryptionMethod = "AES-256-CBC";  // AES is used by the U.S. gov't to encrypt top secret documents.
        $secretHash = "25c6c7ff35b9979b151f2136cd13b0ff";
        //To Decrypt
        $decrypted_data = openssl_decrypt($data, $encryptionMethod, $secretHash);

        return $decrypted_data;

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




    //edit salary
    public function edit_employee_salary($id)
    {
        $salary = employee_salary::find($id);
        return view('employee_salary_pages.edit' , compact('salary'));
    }


    //update salary
    public function update_employee_salary(Request $request , $id)
    {

        $salary = employee_salary::find($id);

        $salary->month = $request->month;
        $salary->basic_salary = $this->encrypt_funcation($request->basic_salary);
        $salary->t_allowence = $this->encrypt_funcation($request->t_allowence);
        $salary->other_exempt = $this->encrypt_funcation($request->other_exempt);
        $salary->s_commission = $this->encrypt_funcation($request->s_commission);
        $salary->day_off = $this->encrypt_funcation($request->day_off);
        $salary->acting_allow = $this->encrypt_funcation($request->acting_allow);
        $salary->overtime = $this->encrypt_funcation($request->overtime);
        $salary->late = $this->encrypt_funcation($request->late);
        $salary->absense = $this->encrypt_funcation($request->absense);
        $salary->card = $this->encrypt_funcation($request->card);
        $salary->other_deduct = $this->encrypt_funcation($request->other_deduct);
        $salary->unpaid_leave = $this->encrypt_funcation($request->unpaid_leave);
        $salary->penalty_day = $this->encrypt_funcation($request->penalty_day);
        $salary->advance = $this->encrypt_funcation($request->advance);
        $salary->loan = $this->encrypt_funcation($request->loan);
        $salary->emp_insu = $this->encrypt_funcation($request->emp_insu);
        $salary->net_salary = $this->encrypt_funcation($request->net_salary);
        // $token = User::select('user_device_token')->where('employee_code', $emp_code)->get();
        $user_device_token = DB::table('users')->select('user_device_token')->where('employee_code', '=', $salary->emp_code)->value('user_device_token');

        $this->fcm("New HR Notification" ,'Check Your Updated Salary Please' , $user_device_token);
        $salary->save();

        return redirect('/employees_salary/search_salary')->with('status' , 'Salary was updated Successfully !');

    }

    public function user_index()
    {
        
        $all_users = DB::table('users')->select('id','name' , 'email' , 'mobile' , 'Djv_Group' , 'Djv_Access' , 'title','user_pp','employee_code')->orderBy('ID')->get();
        // $all_users = User::orderBy('id' , 'desc')->paginate(5);
        $count = $all_users->count();
        return view('employee_salary_pages.index' , compact('all_users' , 'count'));
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
           return view('employee_salary_pages.index' , compact('all_users' ));
    
            //return redirect('/home')->with('status' , 'User Added Successfully !');
    
        }



    public function store_salary(Request $request,$id,$emp_code)
    {
        $salary = new employee_salary();
        $user = User::find($id);
        $salary->user_id  = $id;
        $salary->emp_name = $user->name;
        $salary->emp_email = $user->email;
        $salary->emp_mobile = $user->mobile;
        $salary->emp_code = $user->employee_code;

        $salary->month = $request->month;
        $salary->basic_salary = $this->encrypt_funcation($request->basic_salary);
        $salary->t_allowence = $this->encrypt_funcation($request->t_allowence);
        $salary->other_exempt = $this->encrypt_funcation($request->other_exempt);
        $salary->s_commission = $this->encrypt_funcation($request->s_commission);
        $salary->day_off = $this->encrypt_funcation($request->day_off);
        $salary->acting_allow = $this->encrypt_funcation($request->acting_allow);
        $salary->overtime = $this->encrypt_funcation($request->overtime);
        $salary->late = $this->encrypt_funcation($request->late);
        $salary->absense = $this->encrypt_funcation($request->absense);
        $salary->card = $this->encrypt_funcation($request->card);
        $salary->other_deduct = $this->encrypt_funcation($request->other_deduct);
        $salary->unpaid_leave = $this->encrypt_funcation($request->unpaid_leave);
        $salary->penalty_day = $this->encrypt_funcation($request->penalty_day);
        $salary->advance = $this->encrypt_funcation($request->advance);
        $salary->loan = $this->encrypt_funcation($request->loan);
        $salary->emp_insu = $this->encrypt_funcation($request->emp_insu);
        $salary->net_salary = $this->encrypt_funcation($request->net_salary);
        // $token = User::select('user_device_token')->where('employee_code', $emp_code)->get();
        $user_device_token = DB::table('users')->select('user_device_token')->where('employee_code', '=', $user->employee_code)->value('user_device_token');

        $this->fcm("New HR Notification" ,'Check Your Updated Salary Please' , $user_device_token);
        $salary->save();


        return redirect('/employees_salary/'.$id.'')->with('status' , 'Salary Details was add Successfully !');
    }

    public function show_employee_salary($id)
    {

        $user = User::find($id);

        $all_emp_salaries = employee_salary::where('user_id' ,'=', $id)->orderBy('id')->paginate(4);
        $count = $all_emp_salaries->count();
        return view('employee_salary_pages.show' , compact('user' , 'count' , 'all_emp_salaries'));

    }

    public function destroy_employee_salary($user_id , $id)
    {

        DB::table('employee_salaries')->where('id', '=', $id)->delete();

        return redirect('/employees_salary/'.$user_id.'')->with('status' , 'Salary Card was deleted Successfully !');

        
    }



    //show form upload
   public function showForm()
   {
    return view('employee_salary_pages.upload_file');
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
        $month = $data['month'];
        $basic_salary =$data['basicsalary'];
        $t_allowence = $data['tallowence'];
        $other_exempt =$data['otherexempt'];
        $s_commission = $data['scommission'];
        $day_off =$data['dayoff'];
        $acting_allow = $data['actingallow'];
        $overtime =$data['overtime'];
        $late = $data['late'];
        $absense =$data['absense'];
        $card = $data['card'];
        $other_deduct =$data['otherdeduct'];
        $unpaid_leave = $data['unpaidleave'];
        $penalty_day =$data['penaltyday'];
        $advance = $data['advance'];
        $loan =$data['loan'];
        $emp_insu = $data['empinsu'];
        $net_salary =$data['netsalary'];

        $emp_id = DB::table('users')->select('id')->where('employee_code', '=', $emp_code)->value('id');
        $check_user_count = DB::table('users')->where('employee_code', $emp_code)->count();

        $user_device_token = DB::table('users')->select('user_device_token')->where('employee_code', '=', $emp_code)->value('user_device_token');

        $this->fcm("New HR Notification" ,'Check Your Updated Salary Please' , $user_device_token);

        if($check_user_count > 0)
        {
            $check_user_salary_count = DB::table('employee_salaries')->where('user_id', $emp_id)->count();

            if($check_user_salary_count > 0)
            {
                DB::table('employee_salaries')->where('user_id', $emp_id)->update(
                    [
                    'month'=> $month ,
                    'basic_salary'=> $this->encrypt_funcation($basic_salary),
                    't_allowence'=> $this->encrypt_funcation($t_allowence) ,
                    'other_exempt' =>$this->encrypt_funcation($other_exempt),
                    's_commission'=> $this->encrypt_funcation($s_commission) ,
                    'day_off'=> $this->encrypt_funcation($day_off),
                    'acting_allow'=> $this->encrypt_funcation($acting_allow) ,
                    'overtime' =>$this->encrypt_funcation($overtime),
                    'late'=> $this->encrypt_funcation($late) ,
                    'absense'=> $this->encrypt_funcation($absense),
                    'card'=> $this->encrypt_funcation($card) ,
                    'other_deduct' =>$this->encrypt_funcation($other_deduct),
                    'unpaid_leave'=> $this->encrypt_funcation($unpaid_leave) ,
                    'penalty_day'=> $this->encrypt_funcation($penalty_day),
                    'advance'=> $this->encrypt_funcation($advance) ,
                    'loan' =>$this->encrypt_funcation($loan),
                    'emp_insu'=> $this->encrypt_funcation($emp_insu) ,
                    'net_salary'=> $this->encrypt_funcation($net_salary),
                    ]
                );

            }else
            {
                $uploaded_emp_salary = new employee_salary();
                $user = User::find($emp_id);
                

                $uploaded_emp_salary->user_id  = $emp_id;
                $uploaded_emp_salary->emp_name = $user->name;
                $uploaded_emp_salary->emp_email = $user->email;
                $uploaded_emp_salary->emp_mobile = $user->mobile;
                $uploaded_emp_salary->emp_code = $user->employee_code;
                $uploaded_emp_salary->month = $month;
                $uploaded_emp_salary->basic_salary = $this->encrypt_funcation($basic_salary);
                $uploaded_emp_salary->t_allowence = $this->encrypt_funcation($t_allowence);
                $uploaded_emp_salary->other_exempt = $this->encrypt_funcation($other_exempt);
                $uploaded_emp_salary->s_commission = $this->encrypt_funcation($s_commission);
                $uploaded_emp_salary->day_off = $this->encrypt_funcation($day_off);
                $uploaded_emp_salary->acting_allow = $this->encrypt_funcation($acting_allow);
                $uploaded_emp_salary->overtime = $this->encrypt_funcation($overtime);
                $uploaded_emp_salary->late = $this->encrypt_funcation($late);
                $uploaded_emp_salary->absense = $this->encrypt_funcation($absense);
                $uploaded_emp_salary->card = $this->encrypt_funcation($card);
                $uploaded_emp_salary->other_deduct = $this->encrypt_funcation($other_deduct);
                $uploaded_emp_salary->unpaid_leave = $this->encrypt_funcation($unpaid_leave);
                $uploaded_emp_salary->penalty_day = $this->encrypt_funcation($penalty_day);
                $uploaded_emp_salary->advance = $this->encrypt_funcation($advance);
                $uploaded_emp_salary->loan = $this->encrypt_funcation($loan);
                $uploaded_emp_salary->emp_insu = $this->encrypt_funcation($emp_insu);
                $uploaded_emp_salary->net_salary = $this->encrypt_funcation($net_salary);
                $uploaded_emp_salary->save();
            }

        }
        else{
            return redirect('/employees_salary/search_salary')->with('status' , 'may one or more employee code not valid try again please!');
        }
       }
       return redirect('/employees_salary/search_salary')->with('status' , 'Employees Salary Details file uploaded Successfully !');
    }else
    {
        return redirect()->back()->with('status' , 'No File Selected !');
    }
   }
}
