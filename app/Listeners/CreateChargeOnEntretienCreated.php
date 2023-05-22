<?php

namespace App\Listeners;

use App\Events\EntretienCreated;
use App\Models\Charge;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateChargeOnEntretienCreated
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
    public function handle(EntretienCreated $event): void
    {
        $entretien = $event->entretien;
        Charge::create([
            'type' => $entretien->type,
            'cout' => $entretien->cout,
            'date' => $entretien->date,
            'observation' => "Vehicule N°: ".$entretien->vehicule->matricule,
            'externe_id' => $entretien->id
        ]);
    }
}
