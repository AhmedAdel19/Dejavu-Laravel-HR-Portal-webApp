@extends('layouts.chatMaster')

@section('content')
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta name="user-id" content="{{ Auth::user()->id }}">
    <meta name="auth-user-name" content="{{ Auth::user()->name}}">
    <meta name="auth-user-chatFlag" content="{{ Auth::user()->chat_flag}}">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <div id="app">
        <main-app  :user="{{ Auth::user() }}"></main-app>
    </div>
<script src="{{asset('js/app.js')}}"></script>
    {{-- @if (auth()->check())
    <script>
        var authuser = @JSON(auth()->user())
    </script>     
    @endif --}}

<style>
    .card{
    height: 500px;
    border-radius: 15px !important;
    background-color: rgba(81, 38, 144, 0.67) !important;
}
</style>
@endsection