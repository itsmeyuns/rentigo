<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChargeRequest;
use App\Models\Charge;
use Illuminate\Http\Request;
use PDF;

class ChargeController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('is_admin');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('charge.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ChargeRequest $request)
    {
        $formData = $request->validated();
        Charge::create($formData);
        // Return success response if data is inserted successfully
        return response()->json(['code' => 200, 'msg' => 'Opération effectuée avec succès.'], 200); 
    }

    public function fetch()
    {
        $charges = Charge::latest()->paginate(10);
        $total = $charges->sum('cout');
        return response()->json(['code' => 200, 'charges' => $charges, 'total' => $total], 200); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $charge = Charge::find($id);
        if ($charge) {
            return response()->json(['status' => 200, 'charge' => $charge], 200); 
        }
        return response()->json(['status' => 404, 'msg' => "Cette information n'existe pas"], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ChargeRequest $request, $id)
    {
        // Validation
        $formData = $request->validated();
        $charge = Charge::find($id);
        if ($charge) {
            $charge->update($formData);
            // Return success response if data is updated successfully
            return response()->json(['status' => 200, 'msg' => 'Opération effectuée avec succès.'], 200); 
        } 
        return response()->json(['status' => 404,'msg' => "Cette information n'existe pas"], 404);
    }

    public function delete($id)
    {
        $charge = Charge::find($id);
        if ($charge) {
            return response()->json(['status' => 200, 'charge' => $charge], 200); 
        }
        return response()->json(['status' => 404, 'msg' => "Cette information n'existe pas"], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $charge = Charge::find($id);
        if ($charge) {
            $charge->delete();
            return response()->json(['status' => 200, 'success' => 'Opération effectuée avec succès.'], 200);
        }
        return response()->json(['status' => 404,'msg' => "Cette information n'existe pas"], 404);
    }

    public function search(Request $request) {
        $value = $request->search;
        $result = Charge::where('type', 'like', "%$value%")
                        ->orWhere('observation', 'like', "%$value%")
                        ->latest()
                        ->paginate(10);
        $result->appends($request->all());
        return response()->json(['charges' => $result]);
    }

    public function filter(Request $request)
    {
        $dateDebut = $request->date_debut;
        $dateFin = $request->date_fin;
        $charges = Charge::when($dateDebut, function ($query) use ($dateDebut) {
                            $query->where('date', '>=', $dateDebut);
                        })
                        ->when($dateFin, function ($query) use ($dateFin) {
                            $query->where('date', '<=', $dateFin);
                        })
                        ->latest()
                        ->paginate(10);
        $charges->appends($request->all());
        return response()->json(['charges' => $charges], 200);
    }

    public function pdf()
    {
        $charges = Charge::all();
        $pdf = PDF::loadView('charge.pdf', ['charges' => $charges]);
        return $pdf->stream();
    }

}
