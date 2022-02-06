<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewUserAdded
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $username;
    public function __construct($username)
    {
        $this->username = $username;
    }


    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
