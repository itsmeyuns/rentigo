@extends('layouts.master-pdf')
@section('title', 'Les Clients')
@section('table')
  <div class="table-container">
    <table class="table">
      <thead>
        <tr>
          <th>nom</th>
          <th>prénom</th>
          <th>sexe</th>
          <th>date Naissance</th>
          <th>CIN</th>
          <th>adresse</th>
          <th>Téléphone</th>
          <th>email</th>
          <th>Numéro de permis</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($clients as $client)
            <tr>
              <td>{{$client->nom}}</td>
              <td>{{$client->prenom}}</td>
              <td>{{$client->sexe}}</td>
              <td>{{\Carbon\Carbon::parse($client->date_naissance)->format('d/m/y')}}</td>
              <td>{{$client->cin}}</td>
              <td>{{$client->adresse}}</td>
              <td>{{$client->telephone}}</td>
              <td>{{$client->email}}</td>
              <td>{{$client->numero_permis}}</td>
            </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <p>Nombre de lignes: <b>{{$client->count()}}</b></p>
@endsection

