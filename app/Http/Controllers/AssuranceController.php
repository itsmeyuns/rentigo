<?php

namespace App\Http\Controllers;

use App\Http\Requests\ACVRequest;
use App\Models\Assurance;
use Illuminate\Http\Request;

class AssuranceController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function all($id)
    {
        $assurances = Assurance::where('vehicule_id', $id)->orderBy('date_fin', 'desc')->paginate(5);
        $prochaineAssurance = Assurance::where('vehicule_id', $id)->max('date_fin') ?? "-";
        return response()->json(['assurances' => $assurances, 'prochaine_assurance' => $prochaineAssurance], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ACVRequest $request)
    {   
        $formData = $request->validated();
        Assurance::create($formData);
        return response()->json(['msg' => 'Opération effectuée avec succès.']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $assurance = Assurance::find($id);
        if ($assurance) {
            return response()->json(['status' => 200, 'assurance' => $assurance], 200); 
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
        $assurance = Assurance::find($id);
        if ($assurance) {
            $assurance->update($validatedData);
            // Return success response if data is updated successfully
            return response()->json(['status' => 200, 'msg' => 'Opération effectuée avec succès.'], 200); 
        } 
        return response()->json(['status' => 404,'msg' => "Cette information n'existe pas"], 404);
    }

    public function delete($id)
    {
        $assurance = Assurance::find($id);
        if ($assurance) {
            return response()->json(['status' => 200, 'assurance' => $assurance], 200); 
        }
        return response()->json(['status' => 404, 'msg' => "Cette information n'existe pas"], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $assurance = Assurance::find($id);
        if ($assurance) {
            $assurance->delete();
            return response()->json(['status' => 200, 'success' => 'Opération effectuée avec succès.'], 200);
        }
        return response()->json(['status' => 404,'msg' => "Cette information n'existe pas"], 404);
    }
}
