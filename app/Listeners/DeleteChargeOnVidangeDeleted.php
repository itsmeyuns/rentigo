<?php

namespace App\Listeners;

use App\Events\VidangeDeleted;
use App\Models\Charge;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class DeleteChargeOnVidangeDeleted
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(VidangeDeleted $event): void
    {
        Charge::where('externe_id', "vidange".$event->vidange->id)->delete();
    }
}
