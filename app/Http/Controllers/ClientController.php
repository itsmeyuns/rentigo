<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        return view('clients.index');
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {   
        // $validator = $request->validated();
        $validator = \Validator::make($request->all(),[
            'nom' => 'required | string | max:80',
            'prenom' => 'required | string | max:80',
            'sexe' => 'required | string | max:1',
            'date_naissance' => 'required | date',
            'lieu_naissance' => 'required | string',
            'cin' => 'required | string | max:20 | unique:clients',
            'telephone' => 'required | string | max:20 | unique:clients',
            'email' => 'nullable | unique:clients',
            'numero_permis' => 'required | string | unique:clients',
            'observation' => ''
        ]);

        if ($validator->fails()) {
            // Return validation errors if validation fails
            return response()->json(['errors' => $validator->errors()], 422); 
        }

      // Client::create([
      //     'nom' => $request->nom,
      //     'prenom' => $request->prenom,
      //     'sexe' => $request->sexe,
      //     'date_naissance' => $request->date_naissance,
      //     'lieu_naissance' => $request->lieu_naissance,
      //     'cin' => $request->cin,
      //     'adresse' => $request->adresse,
      //     'telephone' => $request->telephone,
      //     'email' => $request->email,
      //     'observation' => $request->observation,
      //     'numero_permis' => $request->numero_permis,
      // ]);
      // Return success response if data is inserted successfully
      return response()->json(['success' => 'le client a été ajouté avec succès'], 200); 
      }

}
