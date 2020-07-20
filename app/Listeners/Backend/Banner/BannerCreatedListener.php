<?php

namespace App\Listeners\Backend\Banner;

use App\Events\Backend\Banner\BannerCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class BannerCreatedListener
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
     * @param  BannerCreated  $event
     * @return void
     */
    public function handle(BannerCreated $event)
    {
        //
    }
}
