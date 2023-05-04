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
                <span> {{$prochainVidange}}</span>
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
                <span>2022-09-03</span>
              </div>
              <div class="column">
                <p class="info-label">La visite technique</p>
                <span>2022-09-03</span>
              </div>
            </div>
            <div class="row">
              <div class="column">
                <p class="info-label">carte grise</p>
                <span>2022-09-03</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="vidange-section">
    <div id="AddVidangeeModal" class="modal">
      @include('vehicules.vidange.modals.create')
    </div>
    <div id="DeleteVidangeModal" class="modal delete-modal">
      @include('vehicules.vidange.modals.delete')
    </div>
    <div id="EditVidangeModal" class="modal">
      @include('vehicules.vidange.modals.edit')
    </div>
    <div class="vidange-section-header">
      <h2 class="main-title">Vidange</h2>
      <button id="ajouter-vidange" class="material-icons-round" title="Ajouter Vidange">add_circle</button>
    </div>
    <div class="vidange-section-body"> 
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
</div>
@stop

@section('js')
{{-- <script src="{{ asset('js/vehicules/vehicules.js') }}"></script>
<script src="{{ asset('js/vehicules/ajax.js') }}"></script> --}}
<script src="{{ asset('js/vehicules/vidange/vidange.js') }}"></script>
<script src="{{ asset('js/vehicules/vidange/ajax.js') }}"></script>
@stop
