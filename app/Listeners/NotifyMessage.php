<?php

namespace App\Listeners;

use App\Events\NewUserAdded;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyMessage
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NewUserAdded  $event
     * @return void
     */
    public function handle(NewUserAdded $event)
    {
        dump('new user was added with name '.$event->username);
    }
}
