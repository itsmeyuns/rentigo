<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReglementRequest;
use App\Models\Contrat;
use App\Models\Reglement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReglementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $contrat = Contrat::findOrFail($id);
        return view('contrat.reglement.index', compact('contrat'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(ReglementRequest $request)
    {
        $formData = $request->validated();
        Reglement::create($formData);
        return response()->json(['msg' => 'Opération effectuée avec succès.'], 200);
    }

    public function fetch(Contrat $contrat)
    {
        $reglements = $contrat->reglements()->latest()->paginate(5);
        $result = DB::select("SELECT montant_contrat($contrat->id) AS result");
        $total = $result[0]->result;
        $paye = $contrat->reglements()->sum('montant');
        $reste = $total - $paye;
        return response()->json(['reglements' => $reglements, 'total' => $total, 'paye' => $paye, 'reste' => $reste], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $reglement = Reglement::find($id);
        if ($reglement) {
            return response()->json(['status' => 200, 'reglement' => $reglement], 200); 
        }
        return response()->json(['status' => 404,'msg' => "Cette information n'existe pas"], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ReglementRequest $request, $id)
    {
        // Validation
        $validatedData = $request->validated();
        $reglement = Reglement::find($id);
        if ($reglement) {
            $reglement->update($validatedData);
            // Return success response if data is updated successfully
            return response()->json(['status' => 200, 'msg' => 'Opération effectuée avec succès.'], 200); 
        } 
        return response()->json(['status' => 404,'msg' => "Cette information n'existe pas"], 404);
    }

    public function delete($id)
    {
        $reglement = Reglement::find($id);
        if ($reglement) {
            return response()->json(['status' => 200, 'reglement' => $reglement], 200); 
        }
        return response()->json(['status' => 404, 'msg' => "Cette information n'existe pas"], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $reglement = Reglement::find($id);
        if ($reglement) {
            $reglement->delete();
            return response()->json(['status' => 200, 'success' => 'Opération effectuée avec succès.'], 200);
        }
        return response()->json(['status' => 404,'msg' => "Cette information n'existe pas"], 404);
    }
}
