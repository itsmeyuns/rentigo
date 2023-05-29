@extends('layouts.master')
@section('css')
  <link rel="stylesheet" href="{{ asset('css/vehicules.css') }}">
@endsection
@section('title', 'Extras')
@section('content')
<div id="extras-section">
  <button id="ajouter-extra" class="material-icons-round ajouter-button" title="Ajouter Extra">add_circle</button>

    {{-- Start Modals --}}
      <div id="AddExtraModal" class="modal">
        @include('vehicule.extra.create')
      </div>
      <div id="EditExtraModal" class="modal">
        @include('vehicule.extra.edit')
      </div>
      <div id="DeleteExtraModal" class="modal delete-modal">
        @include('vehicule.extra.delete')
      </div>
    {{-- End Modals --}}
  
  <div class="extras-body">
    <div id="extras-loader-container" class="loader-container">
      <div class="loader"></div>
    </div>
    <div id="extras-empty-data" class="empty-data"> 
      il n'y a aucune donnée à afficher pour le moment.
    </div>
    <div class="extras-box-container box-container"></div>
  </div>
</div>

@endsection

@section('js')
  <script src="{{ asset('js/vehicule/extra/ajax.js') }}"></script>
@endsection