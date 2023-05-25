<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use App\Models\Client;
use PDF;
use Illuminate\Http\Request;

class ClientController extends Controller
{

  public function __construct()
  {
      $this->middleware('auth');
  }

  public function index()
  {
    return view('clients.index');
  }

  public function all()
  {
    $clients = Client::orderByDesc('id')->get();
    return response()->json(['clients' => $clients]);
  }

  public function show($id)
  {
    $client = Client::find($id);
    if ($client) {
      // Return success response if data is updated successfully
      return response()->json(['code' => 200 , 'client' => $client], 200);
    } 
    // If The Client Doesn't Exists
    return response()->json(['code' => 422, 'msg' => "Ce client n'existe pas"], 404);  
  }

  public function fetch()
  {
    $clients = Client::latest()->paginate(10);
    return response()->json(['clients' => $clients]);
  }

  public function store(ClientRequest $request)
  {   
    // Validation
    $request->validated();

    // Insert a client to database
    Client::create([
      'nom' => $request->nom,
      'prenom' => $request->prenom,
      'sexe' => $request->sexe,
      'date_naissance' => $request->date_naissance,
      'lieu_naissance' => $request->lieu_naissance,
      'cin' => $request->cin,
      'adresse' => $request->adresse,
      'telephone' => $request->telephone,
      'email' => $request->email,
      'observation' => $request->observation,
      'numero_permis' => $request->numero_permis,
    ]);
    // Return success response if data is inserted successfully
    return response()->json(['success' => 'Le client a été ajouté avec succès'], 200); 
  }

  public function delete($id)
  {
    $client = Client::find($id);
    if ($client) {
      return response()->json(['status' => 200, 'client' => $client]); 
    }
    // If The Client Doesn't Exists
    return response()->json(['status' => 422, 'msg' => "Ce client n'existe pas"]);
  }

  public function destroy($id)
  {
    $client = Client::find($id);
    if ($client) {
      $client->delete();
      return response()->json(['status' => 200, 'success' => 'Le client a été supprimé avec succès']);
    }
    return response()->json(['status' => 422,'msg' => "Ce client n'existe pas"]); 
  }

  public function edit($id)
  {
    $client = Client::find($id);
    if ($client) {
      return response()->json(['status' => 200,'client' => $client]); 
    }
    return response()->json(['status' => 422,'msg' => "Ce client n'existe pas"]); 
  }

  public function update(ClientRequest $request, $id)
  {
    // Validation
    $validatedDate = $request->validated();
    $client = Client::find($id);
    if ($client) {
      $client->update($validatedDate);
      // Return success response if data is updated successfully
      return response()->json(['status' => 200, 'success' => 'Le client a été modifié avec succès']); 
    } 
    // If The Client Doesn't Exists
    return response()->json(['status' => 422,'msg' => "Ce client n'existe pas"]);  
  }

  public function search(Request $request)
  {

    $value = $request->search;
    $result = Client::where('nom', 'like', "%$value%")
      ->orWhere('prenom', 'like', "%$value%")
      ->orWhere('cin', 'like', "%$value%")
      ->orWhere('numero_permis', 'like', "%$value%")
      ->orWhere('telephone', 'like', "%$value%")
      ->latest()
      ->paginate(10);
    $result->appends($request->all());
    return response()->json(['clients' => $result]);
  }

  public function pdf()
    {
        $clients = Client::all();
        $pdf = PDF::loadView('clients.pdf', ['clients' => $clients])->setPaper('A2', 'portrait');
        return $pdf->stream();
    }

}
