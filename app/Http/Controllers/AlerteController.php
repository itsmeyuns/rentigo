<?php

namespace App\Http\Controllers;

use App\Models\Assurance;
use App\Models\CarteGrise;
use App\Models\Contrat;
use App\Models\Vidange;
use App\Models\Vehicule;
use App\Models\VisiteTechnique;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlerteController extends Controller
{
    public function index()
    {

      $vidanges = Vidange::select('vidanges.vehicule_id', 'vidanges.id', 'vehicules.matricule', 'vehicules.marque', DB::raw('MAX(vidanges.km_prochain_vidange) - vehicules.kilometrage as rest'))
      ->join('vehicules', 'vidanges.vehicule_id', '=', 'vehicules.id')
      ->whereNull('vidanges.deleted_at')
      ->whereRaw('(vidanges.km_prochain_vidange - vehicules.kilometrage) <= 1000')
      ->groupBy('vidanges.vehicule_id')
      ->get();

      $assurances = Assurance::select('vehicules.id', 'vehicules.marque', 'vehicules.matricule', 'assurances.date_debut', 'assurances.date_fin', DB::raw('DATEDIFF(assurances.date_fin, CURRENT_DATE) AS rest'))
                              ->join('vehicules', 'vehicules.id', '=', 'assurances.vehicule_id')
                              ->whereRaw('DATEDIFF(assurances.date_fin, CURRENT_DATE) <= 15')
                              ->whereNull('assurances.deleted_at')
                              ->get();

      $carteGrises = CarteGrise::select('vehicules.id', 'vehicules.marque', 'vehicules.matricule', 'carte_grises.date_debut', 'carte_grises.date_fin', DB::raw('DATEDIFF(carte_grises.date_fin, CURRENT_DATE) AS rest'))
                                ->join('vehicules', 'vehicules.id', '=', 'carte_grises.vehicule_id')
                                ->whereRaw('DATEDIFF(carte_grises.date_fin, CURRENT_DATE) <= 15')
                                ->whereNull('carte_grises.deleted_at')
                                ->get();

      $visiteTechniques = VisiteTechnique::select('vehicules.id', 'vehicules.marque', 'vehicules.matricule', 'visite_techniques.date_debut', 'visite_techniques.date_fin', DB::raw('DATEDIFF(visite_techniques.date_fin, CURRENT_DATE) AS rest'))
                                          ->join('vehicules', 'vehicules.id', '=', 'visite_techniques.vehicule_id')
                                          ->whereRaw('DATEDIFF(visite_techniques.date_fin, CURRENT_DATE) <= 15')
                                          ->whereNull('visite_techniques.deleted_at')
                                          ->get();

      $contrats = Contrat::select('id', 'date_contrat', 'date_debut', 'date_fin', DB::raw('DATEDIFF(date_fin, CURRENT_DATE) AS rest'))->whereRaw('DATEDIFF(date_fin, CURRENT_DATE) <= 7')->get();

      return view('alerte.index', compact('vidanges', 'assurances', 'visiteTechniques', 'carteGrises', 'contrats'));
    }
}
