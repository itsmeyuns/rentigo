@extends('layouts.master')
@section('css')
  <link rel="stylesheet" href="{{ asset('css/contrats.css') }}">
@endsection
@section('title', 'Réservations')
@section('content')
<div class="reservations-section">
  {{-- Start Modals --}}
    <div id="AddReservationModal" class="modal">
      @include('reservation.modals.create')
    </div>
    <div id="DeleteReservationModal" class="modal delete-modal">
      @include('reservation.modals.delete')
    </div>
    <div id="EditReservationModal" class="modal">
      @include('reservation.modals.edit')
    </div>
  {{-- End Modals --}}

  <div class="reservations-section-header">
    <div class="bar">
      <form>
        <div class="input-holder">
          <input type="text" name="rechercher" placeholder="Rechercher" id="rechercher">
          <button type="button">
            <span class="material-icons-round">
              search
            </span>
          </button>
        </div>
        <div class="ajouter" id="ajouter-reservation">
          <span class="material-icons-round plus">
            add
          </span>
          <span class="material-icons-round">
            description
          </span>
        </div>
      </form>
      <form class="filter" id="filter-form">
        <div class="select-box">
          <div class="select-field">
            <div class="select-text">Status</div>
            <span class="material-icons-round arrow-down">
              expand_more
            </span>
          </div>
          <div class="select-options">
            <div class="select-option">
              <input type="checkbox" id="en-attente" name="status[]" value="En attente">
              <label for="en-attente">En attente</label>
            </div>
            <div class="select-option">
              <input type="checkbox" id="confirmee" name="status[]" value="Confirmée">
              <label for="confirmee">Confirmée</label>
            </div>
            <div class="select-option">
              <input type="checkbox" id="annulee" name="status[]" value="Annulée">
              <label for="annulee">Annulée</label>
            </div>
            <div class="select-option">
              <input type="checkbox" id="en-cours" name="status[]" value="En cours">
              <label for="en-cours">En cours</label>
            </div>
            <div class="select-option">
              <input type="checkbox" id="terminee" name="status[]" value="Terminée">
              <label for="terminee">Terminée</label>
            </div>
          </div>          
        </div>
        <div class="date-picker">
          <div class="start-date">
            <label for="startDate">De:</label>
            <input type="date" id="startDate" name="date_debut">
          </div>
          <div class="end-date">
            <label for="endDate">À:</label>
            <input type="date" id="endDate" name="date_fin">
          </div>
        </div>
        <div>
          <button type="submit" id="filter-button"  class="btn">Filter</button>
          <button type="reset" id="resetButton" class="btn">Reset</button>
        </div>
      </form>
    </div>
  </div>


  <div class="reservations-section-body">
    <div class="table-container">
      <table class="table">
        <thead>
          <tr>
            <th>date réservation</th>
            <th>client</th>
            <th>véhicule</th>
            <th>Date début</th>
            <th>date fin</th>
            <th>status</th>
            <th>agent</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
      <div id="reservations-loader-container" class="loader-container">
        <div class="loader"></div>
      </div>
      <div id="reservations-no-result" class="no-result">
        <img src="{{asset('pics/no-data.svg')}}" alt="">
        <p class="text">Aucun résultat trouvé</p>
      </div>
    </div>
  </div>

  <div class="pagination" id="reservations-pagination">
    <div class="details"></div>
    <div class="links">
      
    </div>
  </div>

</div>



@stop
@section('js')
    <script src="{{ asset('js/reservation/reservation.js') }}"></script>
    <script src="{{ asset('js/reservation/ajax.js') }}"></script>
@endsection

