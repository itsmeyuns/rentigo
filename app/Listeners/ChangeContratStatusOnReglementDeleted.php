<?php

namespace App\Listeners;

use App\Events\ReglementDeleted;
use App\Models\Contrat;
use App\Models\Reglement;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class ChangeContratStatusOnReglementDeleted
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
    public function handle(ReglementDeleted $event): void
    {
        $reglement = $event->reglement;
        $sumReg = Reglement::amountPaidContrat($reglement->contrat_id);
        $montantContrat = DB::select("SELECT montant_contrat($reglement->contrat_id) AS result")[0]->result;
        if ($sumReg->total >= $montantContrat) {
            Contrat::where('id', $reglement->contrat_id)->update(['status' => 'payé']);
        } else {
            Contrat::where('id', $reglement->contrat_id)->update(['status' => 'impayé']);
        }
    }
}
