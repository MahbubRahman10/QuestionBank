<?php

namespace App\Listeners;

use App\Events\AdminChatEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AdminChatListener
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
     * @param  AdminChatEvent  $event
     * @return void
     */
    public function handle(AdminChatEvent $event)
    {
        //
    }
}
