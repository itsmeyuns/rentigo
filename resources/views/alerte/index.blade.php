@extends('layouts.master')
@section('css')
  <link rel="stylesheet" href="{{asset('css/alerte.css')}}">
@endsection
@section('title', 'Alertes')
@section('content')

  <div class="alerts-container">

    <div class="alert">
      <div class="alert-title">Contrats</div>
      <div class="alert-body">
        @forelse ($contrats as $contrat)
          <p class="alert-text">
            Contrat <span class='italic-bold'>N°:{{$contrat->id}}</span>, reste: <span class="danger">{{$contrat->reste}}Jours</span> 
          </p>  
        @empty
          <p>Rien à signaler</p>
        @endforelse 
      </div>
    </div>

    <div class="alert">
      <div class="alert-title">Vidanges</div>
      <div class="alert-body">
        @forelse ($vidanges as $vidange)
          <p class="alert-text">
            Vehicule <a href="/vehicules/{{$vidange->vehicule_id}}/show" class='italic-bold'>N°:{{$vidange->matricule}}</a>, reste: <span class="danger">{{$vidange->reste}}KM</span> 
          </p>  
        @empty
          <p>Rien à signaler</p>
        @endforelse
      </div>
    </div>

    <div class="alert">
      <div class="alert-title">Assurances</div>
      <div class="alert-body">
        @forelse ($assurances as $assurance)
          <p class="alert-text">
            Vehicule <a href="/vehicules/{{$assurance->vehicule_id}}/show" class='italic-bold'>N°:{{$assurance->matricule}}</a>, reste: <span class="danger">{{$assurance->reste}}Jours</span> 
          </p>
        @empty
          <p>Rien à signaler</p>
        @endforelse 
      </div>
    </div>

    <div class="alert">
      <div class="alert-title">Carte Grises</div>
      <div class="alert-body">
        @forelse ($carteGrises as $carteGrise)
          <p class="alert-text">
            Vehicule <a href="/vehicules/{{$carteGrise->vehicule_id}}/show" class='italic-bold'>N°:{{$carteGrise->matricule}}</a>, reste: <span class="danger">{{$carteGrise->reste}}Jours</span> 
          </p>
        @empty
          <p>Rien à signaler</p>
        @endforelse
      </div>
    </div>

    <div class="alert">
      <div class="alert-title">Visite Techniques</div>
      <div class="alert-body">
        @forelse ($visiteTechniques as $visiteTechnique)
        <p class="alert-text">
          Vehicule <a href="/vehicules/{{$visiteTechnique->vehicule_id}}/show" class='italic-bold'>N°:{{$visiteTechnique->matricule}}</a>, reste: <span class="danger">{{$visiteTechnique->reste}}Jours</span> 
        </p>
        @empty
          <p>Rien à signaler</p>
        @endforelse
      </div>
    </div>

  </div>

@stop
