<?php

namespace App\Http\Controllers;

use App\Models\Extra;
use Illuminate\Http\Request;

class ExtraController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_admin')->except('all');
    }

    public function index()
    {
        return view('vehicule.extra.index');
    }

    public function all()
    {
        $extras = Extra::all();
        return response()->json(['extras' => $extras]);
    }

    public function store(Request $request)
    {
        $date = $request->validate([
            'nom' => 'required | string'
        ]);
        Extra::create( ['nom' => $date['nom'] ] );
        return response()->json(['code' => 200, 'msg' => "Opération effectuée avec succès."], 200); 
    }

    public function edit($id)
    {
        $extra = Extra::find($id);
        if ($extra) {
            return response()->json(['status' => 200, 'extra' => $extra], 200); 
        }
        return response()->json(['status' => 404,'msg' => "Cette information n'existe pas"], 404); 
    }

    public function update(Request $request, $id)
    {
        $extra = Extra::find($id);
        if ($extra) {
            // Validation
            $data = $request->validate([
                'nom' => 'required | string'
            ]);
            $extra->update($data);
            return response()->json(['status' => 200, 'msg' => 'Opération effectuée avec succès.'], 200); 
        } 
        return response()->json(['status' => 404,'msg' => "Cette information n'existe pas"], 404); 
    }

    public function delete($id)
    {
        $extra = Extra::find($id);
        if ($extra) {
            return response()->json(['status' => 200, 'extra' => $extra], 200); 
        }
        return response()->json(['status' => 404, 'msg' => "Cette information n'existe pas"], 404);
    }

    public function destroy($id)
    {
        $extra = Extra::find($id);
        if ($extra) {
            $extra->delete();
            return response()->json(['status' => 200, 'success' => 'Opération effectuée avec succès.'], 200);
        }
        return response()->json(['status' => 404,'msg' => "Cette information n'existe pas"], 404); 
    }

}
