<?php

namespace App\Http\Controllers;

use App\Http\Requests\VidangeRequest;
use App\Models\Vehicule;
use App\Models\Vidange;
use Illuminate\Support\Facades\Route;

class VidangeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function all($id)
    {
        $vidanges = Vidange::where('vehicule_id', $id)->orderBy('id', 'desc')->paginate(5);
        // $vidanges = Vehicule::find($id)->vidanges()->paginate(1);
        $prochaineVidange = Vidange::where('vehicule_id', $id)->min('km_prochain_vidange') ?? "-";
        return response()->json(['vidanges' => $vidanges, 'prochaine_vidange' => $prochaineVidange], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VidangeRequest $request)
    {
        $formData = $request->validated();
        Vidange::create($formData);
        return response()->json(['msg' => 'Opération effectuée avec succès.']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $vidange = Vidange::find($id);
        if ($vidange) {
            return response()->json(['status' => 200, 'vidange' => $vidange], 200); 
        }
        return response()->json(['status' => 404,'msg' => "Cette information n'existe pas"], 404); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VidangeRequest $request, string $id)
    {
        // Validation
        $validatedData = $request->validated();
        $vidange = Vidange::find($id);
        if ($vidange) {
            $vidange->update($validatedData);
            // Return success response if data is updated successfully
            return response()->json(['status' => 200, 'msg' => 'Vidange a été modifié avec succès'], 200); 
        } 
        return response()->json(['status' => 404,'msg' => "Cette information n'existe pas"], 404);
    }

    public function delete($id)
    {
        $vidange = Vidange::find($id);
        if ($vidange) {
            return response()->json(['status' => 200, 'vidange' => $vidange], 200); 
        }
        return response()->json(['status' => 404, 'msg' => "Cette information n'existe pas"], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $vidange = Vidange::find($id);
        if ($vidange) {
            $vidange->delete();
            return response()->json(['status' => 200, 'success' => 'Vidange a été supprimé avec succès'], 200);
        }
        return response()->json(['status' => 404,'msg' => "Cette information n'existe pas"], 404);
    }
}
