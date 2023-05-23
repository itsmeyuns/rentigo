<?php

namespace App\Http\Controllers;

use App\Http\Requests\ACVRequest;
use App\Models\CarteGrise;
use Illuminate\Http\Request;

class CarteGriseController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function all($id)
    {
        $carteGrises = CarteGrise::where('vehicule_id', $id)->orderBy('date_fin', 'desc')->paginate(5);
        $prochaineCarteGrise = CarteGrise::where('vehicule_id', $id)->max('date_fin') ?? "-";
        return response()->json(['carte_grises' => $carteGrises, 'prochaine_carte_grise' => $prochaineCarteGrise], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ACVRequest $request)
    {   
        $formData = $request->validated();
        CarteGrise::create($formData);
        return response()->json(['msg' => 'Opération effectuée avec succès.']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $carteGrise = CarteGrise::find($id);
        if ($carteGrise) {
            return response()->json(['status' => 200, 'carte_grise' => $carteGrise], 200); 
        }
        return response()->json(['status' => 404,'msg' => "Cette information n'existe pas"], 404); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ACVRequest $request, string $id)
    {
        // Validation
        $validatedData = $request->validated();
        $carteGrise = CarteGrise::find($id);
        if ($carteGrise) {
            $carteGrise->update($validatedData);
            // Return success response if data is updated successfully
            return response()->json(['status' => 200, 'msg' => 'Opération effectuée avec succès.'], 200); 
        } 
        return response()->json(['status' => 404,'msg' => "Cette information n'existe pas"], 404);
    }

    public function delete($id)
    {
        $carteGrise = CarteGrise::find($id);
        if ($carteGrise) {
            return response()->json(['status' => 200, 'carte_grise' => $carteGrise], 200); 
        }
        return response()->json(['status' => 404, 'msg' => "Cette information n'existe pas"], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $carteGrise = CarteGrise::find($id);
        if ($carteGrise) {
            $carteGrise->delete();
            return response()->json(['status' => 200, 'success' => 'Opération effectuée avec succès.'], 200);
        }
        return response()->json(['status' => 404,'msg' => "Cette information n'existe pas"], 404);
    }
}
