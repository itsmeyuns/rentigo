<?php

namespace App\Listeners;

use App\Events\EntretienUpdated;
use App\Models\Charge;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateChargeOnEntretienUpdated
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
    public function handle(EntretienUpdated $event): void
    {
        $entretien = $event->entretien;
        Charge::where('externe_id', $entretien->id)->update([
            'type' => $entretien->type,
            'cout' => $entretien->cout,
            'date' => $entretien->date,
            'observation' => "Vehicule N°: ".$entretien->vehicule->matricule,
            'externe_id' => $entretien->id
        ]);
    }
}
