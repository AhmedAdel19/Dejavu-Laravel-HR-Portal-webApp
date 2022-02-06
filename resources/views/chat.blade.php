@extends('layouts.master')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{csrf_token()}}">
    
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link rel="stylesheet" href="{{asset('css/app.css')}}"> --}}
    <title>Chat</title>
    <style>
        .list-group{
            overflow-y: scroll;
            max-height: 400px;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="row" id="app">
            <div class="col-md-6 offset-md-3">
            <li class="list-group-item active">Chat Room <span class="badge badge-pill badge-danger">@{{ numOfUsers }}</span><a type="button" style="margin-left: 50%" href='' class="btn btn-warning" @click="deleteSession">Delete Chat</a></li>
            <div class="badge badge-pill badge-primary">@{{ typing }}</div>
                <ul class="list-group" v-chat-scroll>
                    <message v-for="value,index in chat.message"
                    :key='value.index'
                    :color=chat.color[index]
                    :user=chat.userData[index]
                    :time=chat.time[index]>
                        @{{value}}
                    </message>
                  </ul>
                  <input type="text" class="form-control" placeholder="type your message here..." v-model="message" @keyup.enter="send"/>                  
                  
            </div>    
        </div>
    </div>

<script src="{{asset('js/app.js')}}"></script>
</body>
</html>
@endsection