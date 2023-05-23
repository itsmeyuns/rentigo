<?php

namespace App\Listeners;

use App\Events\EntretienDeleted;
use App\Models\Charge;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DeleteChargeOnEntretienDeleted
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
    public function handle(EntretienDeleted $event): void
    {
        Charge::where('externe_id', "entretien".$event->entretien->id)->delete();
    }
}
