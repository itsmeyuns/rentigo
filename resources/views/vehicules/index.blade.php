@extends('layouts.master')
@section('css')
<link rel="stylesheet" href="{{ asset('css/vehicules.css') }}">
@stop
@section('title', 'Véhicules')

@section('content')
<div class="vehicules-section">

  {{-- Start Modals --}}
  <div id="AddVehiculeModal" class="modal">
    @include('vehicules.modals.create')
  </div>
  <div id="DeleteVehiculeModal" class="modal delete-modal">
    @include('vehicules.modals.delete')
  </div>
  <div id="EditVehiculeModal" class="modal">
    @include('vehicules.modals.edit')
  </div>
  {{-- End Modals --}}

  {{-- Start Head Section --}}
  <div class="vehicule-section-head">
    <div class="bar">
      <form id="search-vehicule-form">
        <div class="input-holder">
          <input type="text" name="rechercher" placeholder="Rechercher" id="rechercher">
          <button type="button">
            <span class="material-icons-round">
              search
            </span>
          </button>
        </div>
        <div class="ajouter">
          <span class="material-icons-round plus">
            add
          </span>
          <span class="material-icons-round car">
            directions_car
          </span>
        </div>
      </form>
      <form>
        <div class="filter">
          <div class="option">
            <input type="checkbox"  name="status" value="En panne">
            <span>En panne</span>
          </div>
          <div class="option">
            <input type="checkbox"  name="status" value="Loué">
            <span>Loué</span>
          </div>
          <div class="option">
            <input type="checkbox"  name="status" value="Disponible">
            <span>Disponible</span> 
          </div>
        </div>
      </form>
    </div>
  </div>
  {{-- End Head Section --}}

  {{-- Start Body Section --}}
  <div class="vehicule-section-body">
    <div class="box-container"></div>
    <div id="loader-container">
      <div class="loader"></div>
    </div>
    <div id="no-result">
      <img src="{{asset('pics/no-data.svg')}}" alt="no data picture">
      <p class="text">Aucun résultat trouvé</p>
    </div>

    <div id="empty-data">
      il n'y a aucun véhicule à afficher pour le moment.
    </div>

  </div>
  {{-- Start Body Section --}}

  <div class="pagination">
    <div class="details"></div>
    <div class="links">
    </div>
  </div>

</div>
@stop

@section('js')
<script src="{{ asset('js/vehicules/vehicules.js') }}"></script>
<script src="{{ asset('js/vehicules/ajax.js') }}"></script>
@stop
