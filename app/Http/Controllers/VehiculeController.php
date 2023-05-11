<?php

namespace App\Http\Controllers;

use App\Http\Requests\VehiculeRequest;
use App\Models\Extra;
use App\Models\Vehicule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VehiculeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('vehicule.index');
    }

    public function all()
    {
        $vehicules = Vehicule::orderBy('id', 'desc')->paginate(12);
        return response()->json(['vehicules' => $vehicules], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VehiculeRequest $request)
    {
        $formData =  $request->validated();
        $this->uploadImage($request, $formData);
        // Insert a Vehicule to database
        $vehicule = Vehicule::create($formData);
        // Insert Vehicule Extras
        $extras = $request->extras;
        $vehicule->extras()->attach($extras);

        // Return success response if data is inserted successfully
        return response()->json(['code' => 200, 'msg' => "Le véhicule a été ajouté avec succès."], 200); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $vehicule = Vehicule::find($id);
        if ($vehicule) {
            return response()->json(['status' => 200, 'vehicule' => $vehicule, 'extras_vehicule' => $vehicule->extras], 200); 
        }
        return response()->json(['status' => 404,'msg' => "Ce véhicule n'existe pas"], 404); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VehiculeRequest $request, string $id)
    {
        // Validation
        $validatedData = $request->validated();
        $vehicule = Vehicule::find($id);
        $this->uploadImage($request, $validatedData);
        $extras = $request->extras;
        if ($vehicule) {
            $vehicule->update($validatedData);
            $vehicule->extras()->sync($extras);
            // Return success response if data is updated successfully
            return response()->json(['status' => 200, 'msg' => 'Le véhicule a été modifié avec succès'], 200); 
        } 
        // If The Véhicule Doesn't Exists
        return response()->json(['status' => 404,'msg' => "Ce véhicule n'existe pas"], 404); 
    }

    public function delete($id)
    {
        $vehicule = Vehicule::find($id);
        if ($vehicule) {
            return response()->json(['status' => 200, 'vehicule' => $vehicule], 200); 
        }
        // If The Vehicule Doesn't Exists
        return response()->json(['status' => 404, 'msg' => "Ce vehicule n'existe pas"], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $vehicule = Vehicule::find($id);
        if ($vehicule) {
            // Detach all extras from the vehicle
            $vehicule->extras()->detach();
            $vehicule->delete();
            return response()->json(['status' => 200, 'success' => 'Le vehicule a été supprimé avec succès'], 200);
        }
        return response()->json(['status' => 404,'msg' => "Ce vehicule n'existe pas"], 404); 
    }

    public function search(Request $request)
    {

      $value = $request->search;
      $result = Vehicule::where('matricule', 'like', "%$value%")
                          ->orWhere('marque', 'like', "%$value%")
                          ->orWhere('modele', 'like', "%$value%")
                          ->get();

        return response()->json(['result' => $result], 200);
    }

    public function filterDisponibilite(Request $request)
    {
        $arrayFilter = $request->filter;
        $result = Vehicule::whereIn('status', $arrayFilter)
                            ->orderBy('id', 'desc')
                            ->get();

        return response()->json(['result' => $result], 200);
    }

    public function show($id)
    {
        $vehicule = Vehicule::findOrFail($id);
        return view('vehicule.show', compact('vehicule'));
    }

    private function uploadImage(VehiculeRequest $request, &$form)
    {
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = $file->move('pics/vehicules/', $filename);
            $form['photo'] = $path;
        }
    }
}
