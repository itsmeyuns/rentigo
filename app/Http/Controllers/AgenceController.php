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
        $agence = Agence::first();
        return view('agence.index', compact('agence'));
    }

    public function storeOrUpdate(AgenceRequest $request)
    {
        $data = $request->validated();
        Agence::updateOrCreate(['id' => $request->agence_id], $data);
        return response()->json(['msg' => 'Les informations a été modifié avec succès'],200);

    }

}
