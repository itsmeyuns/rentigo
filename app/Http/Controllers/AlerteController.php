<?php

namespace App\Http\Controllers;

use App\Models\Assurance;
use App\Models\CarteGrise;
use App\Models\Contrat;
use App\Models\Vehicule;
use App\Models\Vidange;
use App\Models\VisiteTechnique;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlerteController extends Controller
{
    public function index()
    {
        $vidanges = self::getVidanges();
        $assurances = self::getAssurances();
        $carteGrises = self::getCarteGrises();
        $visiteTechniques = self::getVisiteTechniques();
        $contrats = self::getContrats();

        return view('alerte.index', compact('vidanges', 'assurances', 'visiteTechniques', 'carteGrises', 'contrats'));
    }

    private static function getVidanges()
    {
        return Vidange::select('vidanges.vehicule_id', 'vidanges.id', 'vehicules.matricule', 'vehicules.marque', DB::raw('MAX(vidanges.km_prochain_vidange) - vehicules.kilometrage as reste'))
            ->join('vehicules', 'vidanges.vehicule_id', '=', 'vehicules.id')
            ->whereNull('vidanges.deleted_at')
            ->whereRaw('(vidanges.km_prochain_vidange - vehicules.kilometrage) <= 1000')
            ->groupBy('vidanges.vehicule_id')
            ->get();
    }

    private static function getAssurances()
    {
        return DB::select("CALL get_assurances()");
    }

    private static function getCarteGrises()
    {
        return DB::select("CALL get_carte_grises()");
    }

    private static function getVisiteTechniques()
    {
        return DB::select("CALL get_visite_techniques()");
    }

    private static function getContrats()
    {
        return Contrat::select('id', 'date_contrat', 'date_debut', 'date_fin', DB::raw('DATEDIFF(date_fin, CURRENT_DATE) AS reste'))
            ->whereRaw('DATEDIFF(date_fin, CURRENT_DATE) <= 7')
            ->where('terminee', '0')
            ->get();
    }

    public static function alertesCount()
    {
        $vidanges = self::getVidanges();
        $assurances = self::getAssurances();
        $carteGrises = self::getCarteGrises();
        $visiteTechniques = self::getVisiteTechniques();
        $contrats = self::getContrats();

        return $vidanges->count() + count($assurances) + count($carteGrises) + count($visiteTechniques) + $contrats->count();
    }
}
