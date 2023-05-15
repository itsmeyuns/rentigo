<?php

namespace App\Http\Controllers;

use App\Helpers\DateTimeHelper;
use App\Http\Requests\ContratRequest;
use App\Models\Contrat;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ContratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('contrat.index');
    }

    public function fetch()
    {
        $contrats = Contrat::with(['vehicule', 'client', 'user'])->latest()->paginate(10);
        return response()->json(['code' => 200, 'contrats' => $contrats], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ContratRequest $request)
    {
        $formData = $request->validated();
        $formData['user_id'] = auth()->user()->id;
        $dateDebut = [
            'date_debut' => DateTimeHelper::separateDateTime($request->date_debut)['date'],
            'heure_debut' => DateTimeHelper::separateDateTime($request->date_debut)['time'],
        ];
        $dateFin = [
            'date_fin' => DateTimeHelper::separateDateTime($request->date_fin)['date'],
            'heure_fin' => DateTimeHelper::separateDateTime($request->date_fin)['time'],
        ];
        $formData = array_merge($formData, $dateDebut, $dateFin);
        Contrat::create($formData);
        
        // Return success response if data is inserted successfully
        return response()->json(['code' => 200, 'msg' => 'Opération effectuée avec succès.'], 200); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $contrat = Contrat::with('vehicule')->find($id);
        $contrat->montant = "1500";
        $dateDebut = Carbon::parse($contrat->date_debut);
        $dateFin = Carbon::parse($contrat->date_fin);
        $contrat['montant'] = $contrat->vehicule->prix_location * $dateFin->diffInDays($dateDebut);
        if ($contrat) {
            return response()->json(['status' => 200, 'contrat' => $contrat], 200); 
        }
        return response()->json(['status' => 404, 'msg' => "Cette information n'existe pas"], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ContratRequest $request, $id)
    {
        // Validation
        $formData = $request->validated();
        $formData['user_id'] = auth()->user()->id;
        $dateDebut = [
            'date_debut' => DateTimeHelper::separateDateTime($request->date_debut)['date'],
            'heure_debut' => DateTimeHelper::separateDateTime($request->date_debut)['time'],
        ];
        $dateFin = [
            'date_fin' => DateTimeHelper::separateDateTime($request->date_fin)['date'],
            'heure_fin' => DateTimeHelper::separateDateTime($request->date_fin)['time'],
        ];
        $formData = array_merge($formData, $dateDebut, $dateFin);
        $contrat = Contrat::find($id);
        if ($contrat) {
            $contrat->update($formData);
            // Return success response if data is updated successfully
            return response()->json(['status' => 200, 'msg' => 'Opération effectuée avec succès.'], 200); 
        } 
        return response()->json(['status' => 404,'msg' => "Cette information n'existe pas"], 404);
    }

    public function delete($id)
    {
        $contrat = Contrat::find($id);
        if ($contrat) {
            return response()->json(['status' => 200, 'contrat' => $contrat], 200); 
        }
        return response()->json(['status' => 404, 'msg' => "Cette information n'existe pas"], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $contrat = Contrat::find($id);
        if ($contrat) {
            $contrat->delete();
            return response()->json(['status' => 200, 'success' => 'Opération effectuée avec succès.'], 200);
        }
        return response()->json(['status' => 404,'msg' => "Cette information n'existe pas"], 404);
    }

    /**
     * Search for specified resource.
     */
    public function search(Request $request)
    {
      $value = $request->search;
      $result = Contrat::with(['vehicule', 'client', 'user'])
                                  ->whereHas('vehicule', function ($query) use ($value) {
                                        $query->where('matricule', 'LIKE', "%$value%")
                                              ->orWhere('marque', 'LIKE', "%$value%");
                                    })
                                  ->orWhereHas('client', function ($query) use ($value) {
                                    $query->where('nom', 'LIKE', "%$value%")
                                          ->orWhere('prenom', 'LIKE', "%$value%");
                                  })
                                  ->orWhereHas('user', function ($query) use ($value) {
                                    $query->where('nom', 'LIKE', "%$value%")
                                          ->orWhere('prenom', 'LIKE', "%$value%");
                                  })
                                  ->latest()
                                  ->paginate(1);
      $result->appends($request->all());
      return response()->json(['code' => 200, "contrats" => $result], 200);
    }

    public function filter(Request $request)
    {
      $dateDebut = $request->date_debut;
      $dateFin = $request->date_fin;
      $contrats = Contrat::with(['vehicule', 'client', 'user'])
                              ->when($dateDebut && $dateFin , function ($query) use ($dateDebut, $dateFin) {
                                  $query->where('date_debut', '>=', $dateDebut)
                                          ->where('date_fin', '<=', $dateFin);
                              })
                              ->when($dateDebut && !$dateFin, function ($query) use ($dateDebut) {
                                  $query->where('date_debut', '>=', $dateDebut);
                              })
                              ->when(!$dateDebut && $dateFin, function ($query) use ($dateFin) {
                                  $query->where('date_fin', '<=', $dateFin);
                              })
                              ->paginate(10);
      $contrats->appends($request->all());
      return response()->json(['contrats' => $contrats], 200);
    }
}
