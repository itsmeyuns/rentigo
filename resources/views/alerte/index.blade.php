@extends('layouts.master')
@section('title', 'Alertes')
@section('content')

  <div class="alerts-container">

    <div class="alert">
      <div class="alert-title">Contrats</div>
      <div class="alert-body">
        @forelse ($contrats as $contrat)
          <p class="alert-text">
            Contrat <span class='italic-bold'>N°:{{$contrat->id}}</span>, reste: <span class="danger">{{$contrat->rest}}Jours</span> 
          </p>  
        @empty
          <p>Rien à signaler</p>
        @endforelse 
      </div>
    </div>

    <div class="alert">
      <div class="alert-title">Vidanges</div>
      <div class="alert-body">
        @foreach ($vidanges as $vidange)
          <p class="alert-text">
            Vehicule <a href="/vehicules/{{$vidange->vehicule_id}}/show" class='italic-bold'>N°:{{$vidange->matricule}}</a>, reste: <span class="danger">{{$vidange->rest}}KM</span> 
          </p>  
        @endforeach
      </div>
    </div>

    <div class="alert">
      <div class="alert-title">Assurances</div>
      <div class="alert-body">
        @foreach ($assurances as $assurance)
          <p class="alert-text">
            Vehicule <a href="/vehicules/{{$assurance->id}}/show" class='italic-bold'>N°:{{$assurance->matricule}}</a>, reste: <span class="danger">{{$assurance->rest}}Jours</span> 
          </p>
        @endforeach 
      </div>
    </div>

    <div class="alert">
      <div class="alert-title">Carte Grises</div>
      <div class="alert-body">
        @foreach ($carteGrises as $carteGrise)
          <p class="alert-text">
            Vehicule <a href="/vehicules/{{$carteGrise->id}}/show" class='italic-bold'>N°:{{$carteGrise->matricule}}</a>, reste: <span class="danger">{{$carteGrise->rest}}Jours</span> 
          </p>
        @endforeach
      </div>
    </div>

    <div class="alert">
      <div class="alert-title">Visite Techniques</div>
      <div class="alert-body">
        @foreach ($visiteTechniques as $visiteTechnique)
        <p class="alert-text">
          Vehicule <a href="/vehicules/{{$visiteTechnique->id}}/show" class='italic-bold'>N°:{{$visiteTechnique->matricule}}</a>, reste: <span class="danger">{{$visiteTechnique->rest}}Jours</span> 
        </p>
        @endforeach
      </div>
    </div>

  </div>

@stop
