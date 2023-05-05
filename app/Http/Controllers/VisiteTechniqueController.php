<?php

namespace App\Http\Controllers;

use App\Http\Requests\VisiteTechniqueRequest;
use App\Models\VisiteTechnique;
use Illuminate\Http\Request;

class VisiteTechniqueController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function all($id)
    {
        $visiteTechniques = VisiteTechnique::where('vehicule_id', $id)->orderBy('id', 'desc')->paginate(5);
        return response()->json(['visite_techniques' => $visiteTechniques], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VisiteTechniqueRequest $request)
    {   
        $formData = $request->validated();
        VisiteTechnique::create($formData);
        return response()->json(['msg' => 'Opération effectuée avec succès.']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $visiteTechnique = VisiteTechnique::find($id);
        if ($visiteTechnique) {
            return response()->json(['status' => 200, 'visite_technique' => $visiteTechnique], 200); 
        }
        return response()->json(['status' => 404,'msg' => "Cette information n'existe pas"], 404); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VisiteTechniqueRequest $request, string $id)
    {
        // Validation
        $validatedData = $request->validated();
        $visiteTechnique = VisiteTechnique::find($id);
        if ($visiteTechnique) {
            $visiteTechnique->update($validatedData);
            // Return success response if data is updated successfully
            return response()->json(['status' => 200, 'msg' => 'Opération effectuée avec succès.'], 200); 
        } 
        return response()->json(['status' => 404,'msg' => "Cette information n'existe pas"], 404);
    }

    public function delete($id)
    {
        $visiteTechnique = VisiteTechnique::find($id);
        if ($visiteTechnique) {
            return response()->json(['status' => 200, 'visite_technique' => $visiteTechnique], 200); 
        }
        return response()->json(['status' => 404, 'msg' => "Cette information n'existe pas"], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $visiteTechnique = VisiteTechnique::find($id);
        if ($visiteTechnique) {
            $visiteTechnique->delete();
            return response()->json(['status' => 200, 'success' => 'Opération effectuée avec succès.'], 200);
        }
        return response()->json(['status' => 404,'msg' => "Cette information n'existe pas"], 404);
    }
}
