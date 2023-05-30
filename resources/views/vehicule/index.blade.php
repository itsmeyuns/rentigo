@extends('layouts.master')
@section('css')
  <link rel="stylesheet" href="{{ asset('css/vehicule.css') }}">
@stop
@section('title', 'Véhicules')

@section('content')
<div class="vehicules-section">

  {{-- Start Modals --}}
  <div id="AddVehiculeModal" class="modal">
    @include('vehicule.modals.create')
  </div>
  <div id="DeleteVehiculeModal" class="modal delete-modal">
    @include('vehicule.modals.delete')
  </div>
  <div id="EditVehiculeModal" class="modal">
    @include('vehicule.modals.edit')
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
        @if (auth()->user()->role == 'admin')
          <a href="{{route('extras.index')}}" class="btn" id="extras">Extras</a>
        @endif
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
    <div id="loader-container" class="loader-container">
      <div class="loader"></div>
    </div>
    <div id="no-result" class="no-result"> 
      <img src="{{asset('pics/no-data.svg')}}" alt="no data picture">
      <p class="text">Aucun résultat trouvé</p>
    </div>

    <div id="empty-data" class="empty-data">
      il n'y a aucun véhicule à afficher pour le moment.
    </div>

  </div>
  {{-- Start Body Section --}}

  <div class="pagination" id="vehicules-pagination">
    <div class="details"></div>
    <div class="links">
    </div>
  </div>

</div>
@stop

@section('js')
<script src="{{ asset('js/vehicule/vehicule.js') }}"></script>
<script src="{{ asset('js/vehicule/ajax.js') }}"></script>
@stop
