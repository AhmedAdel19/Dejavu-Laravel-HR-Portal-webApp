<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

// Broadcast::channel('chat', function($user){
//     return ['name'=>$user->name];
// });


Broadcast::channel('chat.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
    // return ['name'=>$user->name];
});

Broadcast::channel('typingevent', function ($user) {
    return Auth::check();
});

Broadcast::channel('onlineuser', function ($user) {
    return $user;
});

