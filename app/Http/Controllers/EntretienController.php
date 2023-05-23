<?php

namespace App\Http\Controllers;

use App\Http\Requests\EntretienRequest;
use App\Models\Entretien;
use Illuminate\Http\Request;

class EntretienController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function all($id)
    {
        $entretiens = Entretien::where('vehicule_id', $id)->orderBy('date', 'desc')->paginate(5);
        // $entretiens = Vehicule::find($id)->entretiens()->paginate(1);
        return response()->json(['entretiens' => $entretiens], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EntretienRequest $request)
    {
        $formData = $request->validated();
        Entretien::create($formData);
        return response()->json(['msg' => 'Opération effectuée avec succès.']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $entretien = Entretien::find($id);
        if ($entretien) {
            return response()->json(['status' => 200, 'entretien' => $entretien], 200); 
        }
        return response()->json(['status' => 404,'msg' => "Cette information n'existe pas"], 404); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EntretienRequest $request, string $id)
    {
        // Validation
        $validatedData = $request->validated();
        $entretien = Entretien::find($id);
        if ($entretien) {
            $entretien->update($validatedData);
            // Return success response if data is updated successfully
            return response()->json(['status' => 200, 'msg' => 'Opération effectuée avec succès.'], 200); 
        } 
        return response()->json(['status' => 404,'msg' => "Cette information n'existe pas"], 404);
    }

    public function delete($id)
    {
        $entretien = Entretien::find($id);
        if ($entretien) {
            return response()->json(['status' => 200, 'entretien' => $entretien], 200); 
        }
        return response()->json(['status' => 404, 'msg' => "Cette information n'existe pas"], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $entretien = Entretien::find($id);
        if ($entretien) {
            $entretien->delete();
            return response()->json(['status' => 200, 'success' => 'Opération effectuée avec succès.'], 200);
        }
        return response()->json(['status' => 404,'msg' => "Cette information n'existe pas"], 404);
    }
}
