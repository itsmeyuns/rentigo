@extends('layouts.master')
@section('css')
  <link rel="stylesheet" href="{{ asset('css/vehicule.css') }}">
  <link rel="stylesheet" href="{{ asset('css/table.css') }}">
@stop
@section('title', 'Vehicule Informations')

@section('content')
<div class="vehicule-infos">

  <div class="vehicule-demo" data-vehicule-id="{{$vehicule->id}}">
    <div class="left-box">
      <div class="vehicule-demo-head">
        <img src="{{asset($vehicule->photo)}}" alt="vehicule-pic" width="250px">
        <h3>
          Véhicule: {{$vehicule->marque}} {{$vehicule->modele}}
        </h3>
      </div>
      @if (count($vehicule->extras) > 0)
      <div class="extra-infos-conatiner">
          <h3>Extra Information: </h3>
          <ul class="extra-infos">
            @foreach ($vehicule->extras as $extra)
              <li>{{$extra->nom}}</li>
            @endforeach
          </ul>
      </div>
      @endif
    </div>
    <div class="right-box">
      <div class="vehicule-infos-container">
        <div class="main-row">
          <div class="vi-title">
            <i class="material-icons-round">
              info
            </i> 
            <span>
              Information de Véhicule
            </span>
          </div>
          <div class="vi-box">
            <div class="row">
              <div class="column">
                <p class="info-label">Véhicule</p>
                <span>{{$vehicule->marque}} {{$vehicule->modele}}</span>
              </div>
              <div class="column">
                <p class="info-label">Modéle</p>
                <span> {{$vehicule->modele}}</span>
              </div>
            </div>
            <div class="row">
              <div class="column">
                <p class="info-label">Matricule</p>
                <span>{{$vehicule->matricule}}</span>
              </div>
              <div class="column">
                <p class="info-label">Carburant</p>
                <span> {{$vehicule->carburant}}</span>
              </div>
            </div>
            <div class="row">
              <div class="column">
                <p class="info-label">Prix jour (DH)</p>
                <span>{{$vehicule->prix_location}}</span>
              </div>
              <div class="column">
                <p class="info-label">Couleur</p>
                <span> {{$vehicule->couleur}}</span>
              </div>
            </div>
            <div class="row">
              <div class="column">
                <p class="info-label">Automatique</p>
                <span> {{$vehicule->automatique ? 'Oui' : 'Non'}}</span>
              </div>
            </div>
          </div>
        </div>
        <div class="main-row">
          <div class="vi-title">
            <i class="material-icons-round">
              info
            </i> 
            <span>
              Utilisation
            </span>
          </div>
          <div class="vi-box">
            <div class="row">
              <div class="column">
                <p class="info-label">Kilométrage</p>
                <span>{{$vehicule->kilometrage}}</span>
              </div>
              <div class="column">
                <p class="info-label">Vidange à</p>
                <span id="prochain-vidange">-</span>
              </div>
            </div>
            <div class="row">
              <div class="column">
                <p class="info-label">Status</p>
                <span>{{$vehicule->status}}</span>
              </div>
            </div>
          </div>
        </div>
        <div class="main-row">
          <div class="vi-title">
            <i class="material-icons-round">
              info
            </i> 
            <span>
              Légal
            </span>
          </div>
          <div class="vi-box">
            <div class="row">
              <div class="column">
                <p class="info-label">Assurance</p>
                <span id="prochaine-assurance">-</span>
              </div>
              <div class="column">
                <p class="info-label">La visite technique</p>
                <span id="prochaine-visite-tech">-</span>
              </div>
            </div>
            <div class="row">
              <div class="column">
                <p class="info-label">carte grise</p>
                <span id="prochaine-carte-g">-</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- Vidange --}}
    @include('vehicule.vidange.index')
  {{-- Vidange --}}

  {{-- Assurance --}}
    @include('vehicule.assurance.index')
  {{-- Assurance --}}

  {{-- Carte Grise --}}
    @include('vehicule.carte_grise.index')
  {{-- Carte Grise --}}

  {{-- Visite Technique --}}
    @include('vehicule.visite_technique.index')
  {{-- Visite Technique --}}

  {{-- Entretien --}}
    @include('vehicule.entretien.index')
  {{-- Entretien --}}

</div>
@stop

@section('js')
<script src="{{ asset('js/vehicule/vidange/vidange.js') }}"></script>
<script src="{{ asset('js/vehicule/vidange/ajax.js') }}"></script>
<script src="{{ asset('js/vehicule/assurance/assurance.js') }}"></script>
<script src="{{ asset('js/vehicule/assurance/ajax.js') }}"></script>
<script src="{{ asset('js/vehicule/carte_grise/carte_grise.js') }}"></script>
<script src="{{ asset('js/vehicule/carte_grise/ajax.js') }}"></script>
<script src="{{ asset('js/vehicule/visite_technique/visite_technique.js') }}"></script>
<script src="{{ asset('js/vehicule/visite_technique/ajax.js') }}"></script>
<script src="{{ asset('js/vehicule/entretien/entretien.js') }}"></script>
<script src="{{ asset('js/vehicule/entretien/ajax.js') }}"></script>
@stop
