@extends('layouts.master')
@section('css')
  <link rel="stylesheet" href="{{ asset('css/charges.css') }}">
@endsection
@section('title', 'Charges')

@section('content')

<div id="charges-section">

  {{-- Start Modals --}}

    <div id="AddChargeModal" class="modal">
      @include('charge.modals.create')
    </div>
    <div id="DeleteChargeModal" class="modal delete-modal">
      @include('charge.modals.delete')
    </div>
    <div id="EditChargeModal" class="modal">
      @include('charge.modals.edit')
    </div>

  {{-- End Modals --}}

  <div class="charges-section-header">
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
        <div class="ajouter" id="ajouter-charge">
          <span class="material-icons-round plus">
            add
          </span>
          <span class="material-icons-round">
            paid
          </span>
        </div>
      </form>
      <form class="filter" id="filter-form">
        <div class="date-picker">
          <div class="start-date">
            <label for="date_debut">De:</label>
            <input type="date" id="date_debut" name="date_debut">
          </div>
          <div class="end-date">
            <label for="date_fin">À:</label>
            <input type="date" id="date_fin" name="date_fin">
          </div>
        </div>
        <div>
          <button type="submit" id="filter-button"  class="btn">Filter</button>
          <button type="reset" id="resetButton" class="btn">Reset</button>
        </div>
      </form>
    </div>
  </div>

  <div class="charges-section-body">
    <div class="table-container">
      <table class="table">
        <thead>
          <tr>
            <th>Date</th>
            <th>Type Charge</th>
            <th>Coût</th>
            <th>Observation</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
      <div id="charges-loader-container" class="loader-container">
        <div class="loader"></div>
      </div>
      <div id="charges-no-result" class="no-result">
        <img src="{{asset('pics/no-data.svg')}}" alt="">
        <p class="text">Aucun résultat trouvé</p>
      </div>
    </div>
  </div>
  <div>
    <h4>Total: <span id="total"></span> MAD</h4>
  </div>
  <div class="pagination" id="charges-pagination">
    <div class="details"></div>
    <div class="links">
      
    </div>
  </div>

</div>

@stop
@section('js')
    <script src="{{ asset('js/charge/charge.js') }}"></script>
    <script src="{{ asset('js/charge/ajax.js') }}"></script>
@endsection
