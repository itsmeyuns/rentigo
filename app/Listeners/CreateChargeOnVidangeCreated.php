<?php

namespace App\Listeners;

use App\Events\VidangeCreated;
use App\Models\Charge;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateChargeOnVidangeCreated
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
    public function handle(VidangeCreated $event): void
    {
        $vidange = $event->vidange;
        Charge::create([
            'type' => "Vidange $vidange->type",
            'cout' => $vidange->cout,
            'date' => $vidange->date,
            'observation' => "Vehicule N°: ".$vidange->vehicule->matricule,
            'externe_id' => "vidange".$vidange->id
        ]);
    }
}
