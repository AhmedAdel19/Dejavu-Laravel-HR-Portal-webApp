<?php

namespace App\Http\Controllers;
use DB;
use App\general_note;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GeneralNotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $current = Carbon::today()->toDateString();
        $all_general_notes = DB::table('general_notes')->select('*')->orderBy('id')->paginate(4);
        // $all_general_notes = general_note::orderBy('id')->paginate(4);
        // $all_general_notes = DB::table('general_notes')->where('start_date','<=',$current)->where('end_date','>=',$current)->get();
        // $all_users = User::orderBy('id' , 'desc')->paginate(5);
        $count = $all_general_notes->count();
        


        return view('general_note_pages.index' , compact('all_general_notes' , 'count', 'current'));
    }

    public function create_note()
    {
        return view('general_note_pages.create');

    }


    public function store_note(Request $request)
    {
        $note = new general_note();

        if($request->hasFile('img1'))
        {
            $file1 = $request->file('img1');
            $ext1 = $file1->getClientOriginalExtension();
            $file_name1 = 'general_note_image1' . '_' . time() . '.' . $ext1 ;
            $file1->storeAs('public/GeneralNotificationImages' , $file_name1);
            //dd($path1);
        }
        else
        {
            $file_name1 = 'NoImage.png';
        }

        if($request->hasFile('img2'))
        {
            $file2 = $request->file('img2');
            $ext2 = $file2->getClientOriginalExtension();
            $file_name2 = 'general_note_image2' . '_' . time() . '.' . $ext2 ;
            $file2->storeAs('public/GeneralNotificationImages' , $file_name2);
           // dd($path2);
        }
        else
        {
            $file_name2 = 'NoImage.png';
        }

        $dateTimeStart = Carbon::parse($request->start_date);
        $dateTimeEnd = Carbon::parse($request->end_date);

        $start =$request['start_date'] = $dateTimeStart->format('Y-m-d');
        $end =$request['end_date'] = $dateTimeEnd->format('Y-m-d');
    
        $note->note_text1 = $request->note1;
        $note->note_text2 = $request->note2;
        $note->start_date = $start;
        $note->end_date = $end;
        $note->note_image1 = $file_name1;
        $note->note_image2 =$file_name2;


        $all_users_device_token = DB::table('users')->select('user_device_token')->where('user_device_token' , '!=' , null)->get();
        //  dd($all_users_device_token);die();
        


        foreach ($all_users_device_token as $token => $value) {
            if($value != null){
                $this->fcm("New HR Notification" ,$request->note1 , $value->user_device_token);

            }
        }

        $note->save();

        return redirect('/generaklNotifications')->with('status' , 'General Note was add Successfully !');
    }

    public function fcm($title , $note , $token){


        $API_ACCESS_KEY = "AAAAxBaGf1M:APA91bFFhS_nmiC9mse3f2A6MO4x6rB6afCIqNn-O0NIMcSOIKuABrhsc2WFT9u9zPysyqJ0A-vg3dbMRxibMiOBnA9sRZW6y6xfP3gMlxTo0RjcKpckaElGUjAFVppHIfffxWay8SWT";
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

    public function edit_note($id)
    {
        $note = general_note::find($id);
        return view('general_note_pages.edit' , compact('note'));
    }


    public function update_note(Request $request , $id)
    {


        $note = general_note::find($id);

        
        if($request->hasFile('img1'))
        {
            $file1 = $request->file('img1');
            $ext1 = $file1->getClientOriginalExtension();
            $file_name1 = 'general_note_image1' . '_' . time() . '.' . $ext1 ;
            $file1->storeAs('public/GeneralNotificationImages' , $file_name1);
            //dd($path1);
        }
        else
        {
            $file_name1 = $note->note_image1;
        }

        if($request->hasFile('img2'))
        {
            $file2 = $request->file('img2');
            $ext2 = $file2->getClientOriginalExtension();
            $file_name2 = 'general_note_image2' . '_' . time() . '.' . $ext2 ;
            $file2->storeAs('public/GeneralNotificationImages' , $file_name2);
           // dd($path2);
        }
        else
        {
            $file_name2 = $note->note_image2;
        }

        $dateTimeStart = Carbon::parse($request->start_date);
        $dateTimeEnd = Carbon::parse($request->end_date);

        $start =$request['start_date'] = $dateTimeStart->format('Y-m-d');
        $end =$request['end_date'] = $dateTimeEnd->format('Y-m-d');

        $note->note_text1 = $request->note1;
        $note->note_text2 = $request->note2;
        $note->start_date = $start;
        $note->end_date = $end;
        $note->note_image1 = $file_name1;
        $note->note_image2 = $file_name2;

        $note->save();

        return redirect('/generaklNotifications')->with('status' , 'Notification was updated Successfully !');

    }

    public function destroy_note($id)
    {

        DB::table('general_notes')->where('id', '=', $id)->delete();

        return redirect('/generaklNotifications')->with('status' , 'Notification was deleted Successfully !');

        
    }
}
