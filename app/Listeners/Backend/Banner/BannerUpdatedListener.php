<?php

namespace App\Listeners\Backend\Banner;

use App\Events\Backend\Banner\BannerUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class BannerUpdatedListener
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
     * @param  BannerUpdated  $event
     * @return void
     */
    public function handle(BannerUpdated $event)
    {
        //
    }
}
