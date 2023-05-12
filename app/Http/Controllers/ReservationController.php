<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationRequest;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class ReservationController extends Controller
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
        return view('reservation.index');
    }

    public function all()
    {
        $reservations = Reservation::with(['vehicule', 'client', 'user'])->latest()->paginate(10);
        return response()->json(['code' => 200, 'reservations' => $reservations], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReservationRequest $request)
    {
        $formData = $request->validated();
        $formData['user_id'] = auth()->user()->id;
        $dateDebut = [
            'date_debut' => $this->separateDateTime($request->date_debut)['date'],
            'heure_debut' => $this->separateDateTime($request->date_debut)['time'],
        ];
        $dateFin = [
            'date_fin' => $this->separateDateTime($request->date_fin)['date'],
            'heure_fin' => $this->separateDateTime($request->date_fin)['time'],
        ];
        $formData = array_merge($formData, $dateDebut, $dateFin);
        Reservation::create($formData);

        // Return success response if data is inserted successfully
        return response()->json(['code' => 200, 'msg' => 'Opération effectuée avec succès.'], 200); 

    }

    /**
     * Search for specified resource.
     */
    public function search(Request $request)
    {
      $value = $request->search;
      $result = Reservation::with(['vehicule', 'client', 'user'])
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
      return response()->json(['code' => 200, "reservations" => $result], 200);
    }

    public function filter(Request $request)
    {
      $dateDebut = $request->date_debut;
      $dateFin = $request->date_fin;
      $status = $request->status;
      $reservations = Reservation::with(['vehicule', 'client', 'user'])
      ->when($dateDebut && $dateFin && $status, function ($query) use ($dateDebut, $dateFin, $status) {
          $query->where('date_debut', '>=', $dateDebut)
                ->where('date_fin', '<=', $dateFin)
                ->whereIn('status', $status);
      })
      ->when($dateDebut && $dateFin && !$status, function ($query) use ($dateDebut, $dateFin) {
          $query->where('date_debut', '>=', $dateDebut)
                ->where('date_fin', '<=', $dateFin);
      })
      ->when($dateDebut && !$dateFin && $status, function ($query) use ($dateDebut, $status) {
          $query->where('date_debut', '>=', $dateDebut)
                ->whereIn('status', $status);
      })
      ->when(!$dateDebut && $dateFin && $status, function ($query) use ($dateFin, $status) {
          $query->where('date_fin', '<=', $dateFin)
                ->whereIn('status', $status);
      })
      ->when(!$dateDebut && !$dateFin && $status, function ($query) use ($status) {
          $query->whereIn('status', $status);
      })
      ->when(!$dateDebut && $dateFin && !$status, function ($query) use ($dateFin) {
          $query->where('date_fin', '<=', $dateFin);
      })
      ->when($dateDebut && !$dateFin && !$status, function ($query) use ($dateDebut) {
          $query->where('date_debut', '>=', $dateDebut);
      })
      ->paginate(10);
      $reservations->appends($request->all());
      return response()->json(['reservations' => $reservations], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $reservation = Reservation::find($id);
        if ($reservation) {
            return response()->json(['status' => 200, 'reservation' => $reservation], 200); 
        }
        return response()->json(['status' => 404, 'msg' => "Cette information n'existe pas"], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ReservationRequest $request, $id)
    {
        // Validation
        $formData = $request->validated();
        $formData['user_id'] = auth()->user()->id;
        $dateDebut = [
            'date_debut' => $this->separateDateTime($request->date_debut)['date'],
            'heure_debut' => $this->separateDateTime($request->date_debut)['time'],
        ];
        $dateFin = [
            'date_fin' => $this->separateDateTime($request->date_fin)['date'],
            'heure_fin' => $this->separateDateTime($request->date_fin)['time'],
        ];
        $formData = array_merge($formData, $dateDebut, $dateFin);
        $reservation = Reservation::find($id);
        if ($reservation) {
            $reservation->update($formData);
            // Return success response if data is updated successfully
            return response()->json(['status' => 200, 'msg' => 'Opération effectuée avec succès.'], 200); 
        } 
        return response()->json(['status' => 404,'msg' => "Cette information n'existe pas"], 404);
    }

    public function delete($id)
    {
        $reservation = Reservation::find($id);
        if ($reservation) {
            return response()->json(['status' => 200, 'reservation' => $reservation], 200); 
        }
        return response()->json(['status' => 404, 'msg' => "Cette information n'existe pas"], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $reservation = Reservation::find($id);
        if ($reservation) {
            $reservation->delete();
            return response()->json(['status' => 200, 'success' => 'Opération effectuée avec succès.'], 200);
        }
        return response()->json(['status' => 404,'msg' => "Cette information n'existe pas"], 404);
    }

    private function separateDateTime($datetime)
    {
        $carbonDateTime = Carbon::parse($datetime);
        return [
            'date' => $carbonDateTime->format('Y-m-d'),
            'time' => $carbonDateTime->format('H:i'),
        ];
    }

}
