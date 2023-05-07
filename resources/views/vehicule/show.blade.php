@extends('layouts.master')
@section('css')
  <link rel="stylesheet" href="{{ asset('css/vehicules.css') }}">
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
                <span> {{$vehicule->automatique}}</span>
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
    <div class="section" id="vidange-section">
      <div id="AddVidangeModal" class="modal">
        @include('vehicule.vidange.modals.create')
      </div>
      <div id="DeleteVidangeModal" class="modal delete-modal">
        @include('vehicule.vidange.modals.delete')
      </div>
      <div id="EditVidangeModal" class="modal">
        @include('vehicule.vidange.modals.edit')
      </div>
      <div class="section-header">
        <h2 class="main-title">Vidange</h2>
        <button id="ajouter-vidange" class="material-icons-round ajouter-button" title="Ajouter Vidange">add_circle</button>
      </div>
      <div class="section-body"> 
        <div id="vidange-loader-container" class="loader-container">
          <div class="loader"></div>
        </div>
        <table class="table">
          <thead>
            <tr>
              <th>Type</th>
              <th>Date</th>
              <th>Km</th>
              <th>Prochain vidange</th>
              <th>Coût</th>
              <th>Observation</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
      <div class="pagination" id="vidange-pagination">
        <div class="details"></div>
        <div class="links">
        </div>
      </div>
    </div>
  {{-- Vidange --}}

  {{-- Assurance --}}
  <div class="section"id="assurance-section">
    <div id="AddAssuranceModal" class="modal">
      @include('vehicule.assurance.modals.create')
    </div>
    <div id="DeleteAssuranceModal" class="modal delete-modal">
      @include('vehicule.assurance.modals.delete')
    </div>
    <div id="EditAssuranceModal" class="modal">
      @include('vehicule.assurance.modals.edit')
    </div>
    <div class="section-header">
      <h2 class="main-title">Assurance</h2>
      <button id="ajouter-assurance" class="material-icons-round ajouter-button" title="Ajouter Assurance">add_circle</button>
    </div>
    <div class="section-body"> 
      <div id="assurance-loader-container" class="loader-container">
        <div class="loader"></div>
      </div>
      <table class="table">
        <thead>
          <tr>
            <th>Date début</th>
            <th>Date fin</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
    </div>
    <div class="pagination" id="assurance-pagination">
      <div class="details"></div>
      <div class="links">
      </div>
    </div>
  </div>
  {{-- Assurance --}}

  {{-- Carte Grise --}}
  <div class="section" id="carte-grise-section">
    <div id="AddCarteGModal" class="modal">
      @include('vehicule.carte_grise.modals.create')
    </div>
    <div id="DeleteCarteGModal" class="modal delete-modal">
      @include('vehicule.carte_grise.modals.delete')
    </div>
    <div id="EditCarteGModal" class="modal">
      @include('vehicule.carte_grise.modals.edit')
    </div>
    <div class="section-header">
      <h2 class="main-title">Carte Grise</h2>
      <button id="ajouter-carte-g" class="material-icons-round ajouter-button" title="Ajouter Carte Grise">add_circle</button>
    </div>
    <div class="section-body"> 
      <div id="carte-g-loader-container" class="loader-container">
        <div class="loader"></div>
      </div>
      <table class="table">
        <thead>
          <tr>
            <th>Date début</th>
            <th>Date fin</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
    </div>
    <div class="pagination" id="carte-g-pagination">
      <div class="details"></div>
      <div class="links">
      </div>
    </div>
  </div>
  {{-- Carte Grise --}}

  {{-- Visite Technique --}}
  <div class="section" id="visite-technique-section">
    <div id="AddVisiteTechModal" class="modal">
      @include('vehicule.visite_technique.modals.create')
    </div>
    <div id="DeleteVisiteTechModal" class="modal delete-modal">
      @include('vehicule.visite_technique.modals.delete')
    </div>
    <div id="EditVisiteTechModal" class="modal">
      @include('vehicule.visite_technique.modals.edit')
    </div>
    <div class="section-header">
      <h2 class="main-title">Visite Technique</h2>
      <button id="ajouter-visite-tech" class="material-icons-round ajouter-button" title="Ajouter Visite Technique">add_circle</button>
    </div>
    <div class="section-body"> 
      <div id="visite-tech-loader-container" class="loader-container">
        <div class="loader"></div>
      </div>
      <table class="table">
        <thead>
          <tr>
            <th>Date début</th>
            <th>Date fin</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
    </div>
    <div class="pagination" id="visite-tech-pagination">
      <div class="details"></div>
      <div class="links">
      </div>
    </div>
  </div>
  {{-- Visite Technique --}}

  {{-- Entretien --}}
  <div class="section" id="entretien-section">
    <div id="AddEntretienModal" class="modal">
      @include('vehicule.entretien.modals.create')
    </div>
    <div id="DeleteEntretienModal" class="modal delete-modal">
      @include('vehicule.entretien.modals.delete')
    </div>
    <div id="EditEntretienModal" class="modal">
      @include('vehicule.entretien.modals.edit')
    </div>
    <div class="section-header">
      <h2 class="main-title">Entretien</h2>
      <button id="ajouter-entretien" class="material-icons-round ajouter-button" title="Ajouter Entretien">add_circle</button>
    </div>
    <div class="section-body"> 
      <div id="entretien-loader-container" class="loader-container">
        <div class="loader"></div>
      </div>
      <table class="table">
        <thead>
          <tr>
            <th>Type</th>
            <th>Date</th>
            <th>Km</th>
            <th>Coût</th>
            <th>Observation</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
    </div>
    <div class="pagination" id="entretien-pagination">
      <div class="details"></div>
      <div class="links">
      </div>
    </div>
  </div>
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
