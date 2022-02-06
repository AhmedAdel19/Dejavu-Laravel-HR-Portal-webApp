<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\complain;
use App\complain_replies;
use DB;

class ComplainController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
     $all_complain = complain::get();
     return view('complain_pages.index',compact('all_complain'));
    }

    public function create()
    {
        $all_complain = DB::table('complains')->where('emp_code','=', Auth::user()->employee_code)->get();
        return view('complain_pages.create',compact('all_complain'));
    }

    public function store(Request $request)
    {
        $complain = new complain();

        if($request->hasFile('img1'))
        {
            $file1 = $request->file('img1');
            $ext1 = $file1->getClientOriginalExtension();
            $file_name1 = 'complain_image1' . '_' . time() . '.' . $ext1 ;
            $file1->storeAs('public/complainImages' , $file_name1);
            //dd($path1);
        }
        else
        {
            $file_name1 = 'NoImage.png';
        }

        if (isset($request->chek_identy)) {
            $complain->secret = 'yes';
        }
        else{
            $complain->secret = 'no';
        }
    
        $complain->content = $request->content;
        $complain->complain_image = $file_name1;
        $complain->emp_code = Auth::user()->employee_code;
        $complain->user()->associate($request->user());

        $complain->save();

        return redirect('/complains/create')->with('status' , 'complain was sent Successfully !');
    }


    public function storeReply(Request $request)
    {
        $Reply = new complain_replies();

        // if($request->hasFile('img1'))
        // {
        //     $file1 = $request->file('img1');
        //     $ext1 = $file1->getClientOriginalExtension();
        //     $file_name1 = 'complain_image1' . '_' . time() . '.' . $ext1 ;
        //     $file1->storeAs('public/complainImages' , $file_name1);
        //     //dd($path1);
        // }
        // else
        // {
        //     $file_name1 = 'NoImage.png';
        // }

        // if (isset($request->chek_identy)) {
        //     $complain->secret = 'yes';
        // }
        // else{
        //     $complain->secret = 'no';
        // }
    
        $Reply->reply = $request->reply_content;
        $Reply->user_id = Auth::user()->id;
        $Reply->employee_code = Auth::user()->employee_code;

        $Reply->complain_id = $request->complain_id;

        // $complain->complain_image = $file_name1;

        // $complain->emp_code = Auth::user()->employee_code;
        // $complain->user()->associate($request->user());

        $Reply->save();

        return redirect('/complains/create')->with('status' , 'complain Replay was sent Successfully !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $complain = complain::find($id);
        $complain->delete();
        return redirect(url('/complains/create'))->with('SuccessMessage','your complain Deleted successfully!');
    }
}
