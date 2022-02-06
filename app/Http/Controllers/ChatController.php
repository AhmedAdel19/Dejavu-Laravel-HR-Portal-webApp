<?php

namespace App\Http\Controllers;

use App\Events\ChatEvent;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function chat()
    {
        return view('chat');
    }

    public function send(request $request)
    {
        // return $request->all();
        $user = User::find(Auth::id());
        $message = $request->message;
        $this->saveToSession($request);
        event(new ChatEvent($message , $user));

    }

    public function saveToSession(request $request)
    {
        session()->put('chatSession' , $request->chat);
    }

    public function getOldMessages()
    {
        return session('chatSession');
    }

    public function deleteSession(Request $request)
    {
        $request->session()->forget('chatSession');
    }


}
