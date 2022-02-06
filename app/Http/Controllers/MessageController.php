<?php

namespace App\Http\Controllers;

use App\Message;
use App\User;
use App\djv_group;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

// use App\Events\messageSent;
// use App\Events\sendMessageEvent;
use App\Events\ChatEvent;

use DB;
class MessageController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function chat()
    {
        return view('chat_home');
    }

    public function get_all_messages_by_user_id($id)
    {
        $user = User::findOrFail($id);
        $messages = Message::where(function($q) use($id){
            $q->where('from' , auth()->user()->id);
            $q->where('to' , $id);
            $q->where('type' , 0);
        })->orWhere(function($q) use($id){
            $q->where('from' ,$id);
            $q->where('to' , auth()->user()->id);
            $q->where('type' , 1);
        })->with('user')->get();

        return $messages;
    }


    public function user_list()
    {
        $users = User::latest()->where('id','!=',auth()->user()->id)->where('chat_flag','=','yes')->get();
        if(\Request::ajax())
        {
            return response()->json($users , 200);
        }

        return abort(404);
    }

    public function all_users_groups(){
        $groups = djv_group::get();
        return response()->json($groups , 200);

    }

    public function all_group_users(Request $request){
        $group_users = User::latest()->where('Djv_Group','=',$request->group_name)->where('id','!=',auth()->user()->id)->where('chat_flag','=','yes')->get();
        return response()->json($group_users , 200);

    }

    public function all_users_list()
    {
        $users = User::latest()->where('id','!=',auth()->user()->id)->where('chat_flag','=','yes')->get();
        if(\Request::ajax())
        {
            return response()->json($users , 200);
        }

        return abort(404);
    }

    public function search_users(Request $request)
    {
        $emp_name = $request->name;
        $dataarr = array(
            'name' => $emp_name,

        );
        $sql = '';
        foreach ($dataarr as $key => $item) {

            if($dataarr[$key]){

                $sql .= $key . ' Like ' . "'%" .$dataarr[$key] .  "%' or ";
            }
        }
        $last3char = substr($sql, -3);
        if(strtolower($last3char) == 'or '){
            $sql = substr_replace($sql ,"",-3);
            $sql.=" and id !=".auth()->user()->id."";
            $sql.=" and chat_flag = yes";
        }
        if($sql != ""){
            $all_users =  DB::select('select * from users where '.$sql.' order by id desc');
        }
        // else{
        //     $all_users =  DB::select('select * from users order by id desc');
        // }
        // return view('employee_pages.index' , compact('all_users'));

        return response()->json($all_users , 200);


    }

    public function user_messages($id = null)
    {
        // if(!\Request::ajax())
        // {
        //     return abort(404);
        // }
        $messages = $this->get_all_messages_by_user_id($id);
        $messagesCount = $messages->count();
        $user = User::findOrFail($id);
        return response()->json([
            'messages' => $messages,
            'user' => $user,
            'messagesCount' => $messagesCount,
            'authUserId' => auth()->user()->id
        ]);
    }

    public function send_message(Request $request)
    {
        // if(!$request::ajax())
        // {
        //     return abort(404);
        // }
        $message = Message::create([
            'message'=> $request->message,
            'from'=> auth()->user()->id,
            'to'=> $request->user_id,
            'type' => 0
        ]);

        $message = Message::create([
            'message'=> $request->message,
            'from'=> auth()->user()->id,
            'to'=> $request->user_id,
            'type' => 1
        ]);
        
        event(new ChatEvent($message));
        return response()->json($message , 201);
    }

    public function delete_single_message($id=null)
    {
        if(!\Request::ajax())
        {
            return abort(404);
        }

        if(Message::findOrFail($id)->delete())
        {
            return response()->json('message deleted successfully',200);
        }else{
            return response()->json('message not deleted',200);
        }
        
    }

    public function delete_all_message($id=null){
        $messages = $this->get_all_messages_by_user_id($id);

        foreach ($messages as $message) {
            Message::findOrFail($message->id)->delete();
        }

        return response()->json('all messages deleted successfully' , 200);
    }


}
