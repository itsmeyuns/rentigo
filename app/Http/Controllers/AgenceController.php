<?php

namespace App\Http\Controllers;

use App\Http\Requests\AgenceRequest;
use App\Models\Agence;

class AgenceController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_admin');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $agence = Agence::with('representantLegal')->first();
        return view('agence.index', compact('agence'));
    }

    public function storeOrUpdate(AgenceRequest $request)
    {
        $data = $request->validated();
        $id = $request->agence_id;
        $agenceData = [
            'raison_sociale' => $data['raison_sociale'],
            'adresse' => $data['adresse'],
            'ville' => $data['ville'],
            'telephone' => $data['telephone'],
            'fax' => $data['fax'],
            'email' => $data['email'],
            'patent' => $data['patent'],
            'IF' => $data['IF'],
            'RC' => $data['RC'],
            'ICE' => $data['ICE'],
            'CNSS' => $data['CNSS'],
        ];
    
        $representantLegalData = [
            'nom' => $data['nom'],
            'prenom' => $data['prenom'],
            'cin' => $data['cin'],
        ];
    
        $agence = Agence::updateOrCreate(['id' => $id], $agenceData);
        $agence->representantLegal()->updateOrCreate([], $representantLegalData);

        return response()->json(['msg' => 'Les informations a été modifié avec succès'],200);

    }

}
