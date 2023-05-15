<?php

namespace App\Listeners;

use App\Events\ContratDeleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class UpdateVehicleStatusOnContratDeleted
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
    public function handle(ContratDeleted $event)
    {
        $contrat = $event->contrat;
        DB::table('vehicules')->where('id', $contrat->vehicule_id)->update(['status' => 'Disponible']);
    }
}
