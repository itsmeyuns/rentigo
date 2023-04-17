<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use App\Models\Client;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;

class ClientController extends Controller
{
  public function index()
  {
    // $clients = Client::orderBy('id', 'desc')->paginate(10);
    return view('clients.index');
  }

  public function all()
  {
    $clients = Client::orderBy('id', 'desc')->paginate(10);
    return response()->json(['clients' => $clients]);
  }

  public function create()
  {
      return view('clients.modal.create');
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
    return response()->json(['success' => 'le client a été ajouté avec succès'], 200); 
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
      return response()->json(['status' => 200, 'success' => 'le client a été supprimé avec succès']);
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
      return response()->json(['status' => 200, 'success' => 'le client a été supprimé avec succès']); 
    } 
    // If The Client Doesn't Exists
    return response()->json(['status' => 422,'msg' => "Ce client n'existe pas"]);  
  }

}
