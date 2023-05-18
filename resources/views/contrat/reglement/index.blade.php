@extends('layouts.master')
@section('css')
  <link rel="stylesheet" href="{{ asset('css/table.css') }}">
@endsection
@section('title', 'Réglements')
@section('content')
<div id="reglements-section" data-contrat-id="{{$contrat->id}}">
  <button id="ajouter-reglement" class="material-icons-round ajouter-button" title="Ajouter Réglement">add_circle</button>
    {{-- Start Modals --}}

      <div id="AddReglementModal" class="modal">
        @include('contrat.reglement.modals.create')
      </div>
      <div id="DeleteReglementModal" class="modal delete-modal">
        @include('contrat.reglement.modals.delete')
      </div>
      <div id="EditReglementModal" class="modal">
        @include('contrat.reglement.modals.edit')
      </div>
  
    {{-- End Modals --}}
  
  <div class="table-container">
    <div id="reglements-loader-container" class="loader-container">
      <div class="loader"></div>
    </div>
    <table class="table">
      <thead>
        <tr>
          <th>N° réglement</th>
          <th>date réglement</th>
          <th>montant</th>
          <th>type</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>100</td>
          <td>10/10/2023 </td>
          <td>500</td>
          <td>Espece</td>
          <td>Action</td>
        </tr>
      </tbody>
    </table>
  </div>
  <div>
    <h4 id="total"></h4>
    <h4 id="paye"></h4>
    <h4 id="rest"></h4>
  </div>
  <div class="pagination" id="reglements-pagination">
    <div class="details"></div>
    <div class="links">
    </div>
  </div>
</div>

@endsection

@section('js')
  <script src="{{ asset('js/contrat/reglement/reglement.js') }}"></script>
  <script src="{{ asset('js/contrat/reglement/ajax.js') }}"></script>
@endsection