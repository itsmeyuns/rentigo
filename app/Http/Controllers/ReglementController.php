<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReglementRequest;
use App\Models\Contrat;
use App\Models\Reglement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class ReglementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $contrat = Contrat::findOrFail($id);
        if (!auth()->user()->isAdmin()) {
            if ($contrat->user_id !== auth()->user()->id) {
                abort(401);
            }
        }
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
        $reglements = $contrat->reglements()->orderBy('date_reglement', 'desc')->paginate(5);
        $total = DB::select("SELECT montant_contrat($contrat->id) AS result")[0]->result;
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

    public function pdf($contratID)
    {
        $contrat = Contrat::findOrFail($contratID);
        $total = DB::select("SELECT montant_contrat($contratID) AS result")[0]->result;
        $paye = $contrat->reglements()->sum('montant');
        $reste = $total - $paye;
        $pdf = PDF::loadView('contrat.reglement.pdf', ['numero_contrat' => $contratID, 'reglements' => $contrat->reglements, 'total' => $total, 'paye' => $paye, 'reste' => $reste]);
        return $pdf->stream();
    }
}
