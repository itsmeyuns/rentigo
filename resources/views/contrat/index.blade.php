@extends('layouts.master')
@section('css')
  <link rel="stylesheet" href="{{ asset('css/contrats.css') }}">
@endsection
@section('title', 'Contrats')

@section('content')
  <div class="contrats-section">

    {{-- Start Modals --}}

      <div id="AddContratModal" class="modal">
        @include('contrat.modals.create')
      </div>
      <div id="DeleteContratModal" class="modal delete-modal">
        @include('contrat.modals.delete')
      </div>
      <div id="EditContratModal" class="modal">
        @include('contrat.modals.edit')
      </div>

    {{-- End Modals --}}



    <div class="contrats-section-header">
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
          <div class="ajouter" id="ajouter-contrat">
            <span class="material-icons-round plus">
              add
            </span>
            <span class="material-icons-round">
              description
            </span>
          </div>
        </form>
        <form class="filter" id="filter-form">
          {{-- <div class="select-box-container">
            <div class="select-box">
              <div class="select-field">
                <div class="select-text">Clients</div>
                <span class="material-icons-round arrow-down">
                  expand_more
                </span>
              </div>
              <div class="select-options">
                <div class="select-option">
                  <input type="checkbox" name="" id="">
                  <label for="">Ahmed Ali</label>
                </div>
                <div class="select-option">
                  <input type="checkbox" name="" id="">
                  <label for="">Ahmed Ali</label>
                </div>
                <div class="select-option">
                  <input type="checkbox" name="" id="">
                  <label for="">Ahmed Ali</label>
                </div>
                <div class="select-option">
                  <input type="checkbox" name="" id="">
                  <label for="">Ahmed Ali</label>
                </div>
                <div class="select-option">
                  <input type="checkbox" name="" id="">
                  <label for="">Ahmed Ali</label>
                </div>
                <div class="select-option">
                  <input type="checkbox" name="" id="">
                  <label for="">Ahmed Ali</label>
                </div>
                <div class="select-option">
                  <input type="checkbox" name="" id="">
                  <label for="">Ahmed Ali</label>
                </div>
              </div>
            </div>
            <div class="select-box">
              <div class="select-field">
                <div class="select-text">Véhicules</div>
                <span class="material-icons-round arrow-down">
                  expand_more
                </span>
              </div>
              <div class="select-options">
                <div class="select-option">
                  <input type="checkbox" name="" id="">
                  <label for="">Ahmed Ali Ali Ali</label>
                </div>
                <div class="select-option">
                  <input type="checkbox" name="" id="">
                  <label for="">Ahmed Ali</label>
                </div>
                <div class="select-option">
                  <input type="checkbox" name="" id="">
                  <label for="">Ahmed Ali</label>
                </div>
                <div class="select-option">
                  <input type="checkbox" name="" id="">
                  <label for="">Ahmed Ali</label>
                </div>
                <div class="select-option">
                  <input type="checkbox" name="" id="">
                  <label for="">Ahmed Ali</label>
                </div>
                <div class="select-option">
                  <input type="checkbox" name="" id="">
                  <label for="">Ahmed Ali</label>
                </div>
                <div class="select-option">
                  <input type="checkbox" name="" id="">
                  <label for="">Ahmed Ali</label>
                </div>
              </div>
            </div>
          </div> --}}
          <div class="date-picker">
            <div class="start-date">
              <label for="startDate">De:</label>
              <input type="date" id="startDate" name="date_debut">
            </div>
            <div class="end-date">
              <label for="endDate">À:</label>
              <input type="date" id="endDate" name="date_fin">
            </div>
            <div>
              <button type="submit" id="filter-button"  class="btn">Filter</button>
              <button type="reset" id="resetButton" class="btn">Reset</button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <div class="contrats-section-body">
      <div class="table-container">
        <table class="table">
          <thead>
            <tr>
              <th>N° contrat</th>
              <th>date contrat</th>
              <th>Date départ</th>
              <th>date arrivée</th>
              <th>durée</th>
              <th>client</th>
              <th>véhicule</th>
              <th>agent</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
        <div id="contrats-loader-container" class="loader-container">
          <div class="loader"></div>
        </div>
        <div id="contrats-no-result" class="no-result">
          <img src="{{asset('pics/no-data.svg')}}" alt="">
          <p class="text">Aucun résultat trouvé</p>
        </div>
      </div>
    </div>

    <div class="pagination" id="contrats-pagination">
      <div class="details"></div>
      <div class="links">
        
      </div>
    </div>

  </div>

@stop
@section('js')
  <script src="{{ asset('js/contrat/contrat.js') }}"></script>
  <script src="{{ asset('js/contrat/ajax.js') }}"></script>
@endsection

