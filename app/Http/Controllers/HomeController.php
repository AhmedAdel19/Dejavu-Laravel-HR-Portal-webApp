<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\employee_note;
use App\employee_balance;
use Carbon\Carbon;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $current = Carbon::today()->toDateString();
        $auth_user_annual_leave = DB::table('employee_balances')->where('emp_id', '=', auth()->user()->id)->latest()->value('annual_leave'); // considers created_at field by default.
        $auth_user_sick_leave = DB::table('employee_balances')->where('emp_id', '=', auth()->user()->id)->latest()->value('sick_leave'); // considers created_at field by default.
 

        $hr_tips = DB::table('hr_tips_sliders')->select('*')->orderBy('id')->take(3)->get();
        $count_of_tips = $hr_tips->count();
        if($count_of_tips == 0)
        {
            $last_tips = 'No Any Tips Yet'; 
        }
        if($count_of_tips <= 3)
        {
            $last_tips = DB::table('hr_tips_sliders')->select('*')->latest()->take($count_of_tips)->get();
        }


        $last_notes = DB::table('general_notes')->where('start_date','<=',$current)->where('end_date','>=',$current)->take(2)->get();
        $count_of_Gnotes = $last_notes->count();
        if($count_of_Gnotes == 0)
        {
            $last_notes = 'no any  General Notification yet'; 
        }
        if($count_of_Gnotes <= 2)
        {
            $last_notes = DB::table('general_notes')->where('start_date','<=',$current)->where('end_date','>=',$current)->latest()->take($count_of_Gnotes)->get();
        }

        //-------------------------------
        $last_hr_notes = DB::table('employee_notes')->where('emp_id', '=', auth()->user()->id)->where('start_date','<=',$current)->where('end_date','>=',$current)->take(1)->get();
        $count_of_Enotes = $last_hr_notes->count();
        if($count_of_Enotes == 0)
        {
            $last_hr_notes = 'no any  Hr Notification for you yet'; 
        }
        if($count_of_Enotes <= 1)
        {
            $last_hr_notes = DB::table('employee_notes')->where('emp_id', '=', auth()->user()->id)->where('start_date','<=',$current)->where('end_date','>=',$current)->latest()->take($count_of_Enotes)->get();
        }
        //-------------------------------

        //-------------------------------
        $salary_q = DB::table('employee_salaries')->where('user_id', '=', auth()->user()->id)->get();
        $count_of_salary = $salary_q->count();
        if($count_of_salary == 0)
        {
            $salary_details = ''; 
        }else
        {
            $salary_details = DB::table('employee_salaries')->where('user_id', '=', auth()->user()->id)->latest()->take(1)->get();
        }
        //-------------------------------
        

        if($auth_user_annual_leave == null)
        {
            $auth_user_annual_leave = 'no annual leave for you yet now';
        }

        if($auth_user_sick_leave == null)
        {
            $auth_user_sick_leave = 'no sick leave for you yet now';
        }


        return view('home' , compact('auth_user_annual_leave' , 'auth_user_sick_leave'  , 'last_notes' , 'last_hr_notes','salary_details','last_tips'));
    }
}
