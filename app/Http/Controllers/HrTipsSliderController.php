<?php

namespace App\Http\Controllers;
use DB;
use App\HrTipsSlider;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HrTipsSliderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $current = Carbon::today()->toDateString();
        $all_tips = DB::table('hr_tips_sliders')->select('*')->orderBy('id')->paginate(4);
        $count = $all_tips->count();
        return view('HrTipsSlider.index', compact('all_tips', 'count', 'current'));
    }

    public function create_tip()
    {
        return view('HrTipsSlider.create');
    }


    public function store_tip(Request $request)
    {
        $tip= new HrTipsSlider();

        if ($request->hasFile('img')) {
            $file1 = $request->file('img');
            $ext1 = $file1->getClientOriginalExtension();
            $file_name1 = 'slider_tip_image' . '_' . time() . '.' . $ext1;
            $file1->storeAs('public/SlideTipImages', $file_name1);
            //dd($path1);
        } else {
            $file_name1 = 'NoImage.png';
        }


        $tip->slide_text = $request->tip;
        $tip->slide_image = $file_name1;


        $all_users_device_token = DB::table('users')->select('user_device_token')->where('user_device_token', '!=', null)->get();
        //  dd($all_users_device_token);die();

        foreach ($all_users_device_token as $token => $value) {
            if ($value != null) {
                $this->fcm("New HR Notification", $request->tip, $value->user_device_token);
            }
        }

        $tip->save();

        return redirect('/HrTipsSlider')->with('status', 'Tip was add Successfully !');
    }

    public function fcm($title, $tip, $token)
    {


        $API_ACCESS_KEY = "AAAAxBaGf1M:APA91bFFhS_nmiC9mse3f2A6MO4x6rB6afCIqNn-O0NIMcSOIKuABrhsc2WFT9u9zPysyqJ0A-vg3dbMRxibMiOBnA9sRZW6y6xfP3gMlxTo0RjcKpckaElGUjAFVppHIfffxWay8SWT";
        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';;

        $notification = [
            'title' => $title,
            'body' => $tip,
            'icon' => 'myIcon',
            'sound' => 'mySound'
        ];
        $extraNotificationData = ["message" => $notification, "moredata" => 'dd'];

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
        curl_setopt($ch, CURLOPT_URL, $fcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
        $result = curl_exec($ch);
        curl_close($ch);


        echo $result;
    }

    public function edit_tip($id)
    {
        $tip= HrTipsSlider::find($id);
        return view('HrTipsSlider.edit', compact('tip'));
    }


    public function update_tip(Request $request, $id)
    {


        $tip = HrTipsSlider::find($id);


        if ($request->hasFile('img')) {
            $file1 = $request->file('img');
            $ext1 = $file1->getClientOriginalExtension();
            $file_name1 = 'slider_tip_image' . '_' . time() . '.' . $ext1;
            $file1->storeAs('public/SlideTipImages', $file_name1);
            //dd($path1);
        } else {
            $file_name1 = $tip->slide_image;
        }

        $tip->slide_text = $request->tip;

        $tip->slide_image = $file_name1;

        $tip->save();

        return redirect('/HrTipsSlider')->with('status', 'Tip was updated Successfully !');
    }

    public function destroy_tip($id)
    {

        DB::table('hr_tips_sliders')->where('id', '=', $id)->delete();

        return redirect('/HrTipsSlider')->with('status', 'Tip was deleted Successfully !');
    }
}
