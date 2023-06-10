@extends('layouts.master-pdf')
@section('title', "Les Réglements du Contrat N° $numero_contrat")
@section('table')
  <div class="table-container">
    <table class="table">
      <thead>
        <tr>
          <th>N° Réglement{{$numero_contrat}}</th>
          <th>Date Réglement</th>
          <th>Montant</th>
          <th>Type</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($reglements as $reglement)
            <tr>
              <td>{{$reglement->id}}</td>
              <td>{{\Carbon\Carbon::parse($reglement->date_reglement)->format('d/m/Y')}}</td>
              <td>{{$reglement->montant}}</td>
              <td>{{$reglement->type}}</td>
            </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <p>Nombre de lignes: <b>{{$reglements->count()}}</b></p>
  <div>
    <p id="total">Montant Total du contrat: <b>{{$total}}DH<b></p>
    <p id="paye">Payé: <b>{{$paye}}DH<b></p>
    <p id="reste">Reste: <b>{{$reste}}DH<b></p>
  </div>
@endsection

