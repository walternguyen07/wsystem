<?php

namespace App\Listeners\Backend\Banner;

use App\Events\Backend\Banner\BannerDeleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class BannerDeletedListener
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
     * @param  BannerDeleted  $event
     * @return void
     */
    public function handle(BannerDeleted $event)
    {
        //
    }
}
