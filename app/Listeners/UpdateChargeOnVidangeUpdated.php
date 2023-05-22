<?php

namespace App\Listeners;

use App\Events\VidangeUpdated;
use App\Models\Charge;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateChargeOnVidangeUpdated
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
    public function handle(VidangeUpdated $event): void
    {
        $vidange = $event->vidange;
        Charge::where('externe_id', $vidange->id)->update([
            'type' => "Vidange $vidange->type",
            'cout' => $vidange->cout,
            'date' => $vidange->date,
            'observation' => "Vehicule N°: ".$vidange->vehicule->matricule,
            'externe_id' => $vidange->id
        ]);
    }
}
