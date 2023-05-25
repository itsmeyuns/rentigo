@extends('layouts.master')
@section('css')
  <link rel="stylesheet" href="{{ asset('css/clients.css') }}">
  <link rel="stylesheet" href="{{ asset('css/table.css') }}">
@endsection
@section('title', 'Clients')
@section('content')
<div id="AddClientModal" class="modal">
  @include('clients.modals.create')
</div>
<div id="DeleteClientModal" class="modal delete-modal">
  @include('clients.modals.delete')
</div>
<div id="EditClientModal" class="modal">
  @include('clients.modals.edit')
</div>
<div id="ShowClientModal" class="modal show-modal">
  @include('clients.modals.show')
</div>
<div class="bar">
  <form action="">
    <div class="input-holder">
      <input type="text" name="rechercher" placeholder="Rechercher" id="rechercher">
      <button type="button">
        <span class="material-icons-round">
          search
        </span>
      </button>
    </div>
    <div class="ajouter">
      <span class="material-icons-round">
        person_add
      </span>
    </div>
  </form>
</div>
<div class="table-container">
  <table class="table">
    <thead>
      <tr>
        <th>Nom</th>
        <th>Prénom</th>
        <th>CIN</th>
        <th>Numéro permis</th>
        <th>Télephone</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody></tbody>
  </table>
  <div id="loader-container" class="loader-container">
    <div class="loader"></div>
  </div>
  <div id="no-result" class="no-result">
    <img src="{{asset('pics/no-data.svg')}}" alt="">
    <p class="text">Aucun résultat trouvé</p>
  </div>
</div>

<div class="pagination" id="clients-pagination">
  <div class="details"></div>
  <div class="links">
    
  </div>
</div>
<a class="print" href="{{route('clients.pdf')}}">
  <span class="material-icons-round">
    print
  </span>Imprimer
</a>
@stop
@section('js')
<script src="{{ asset('js/clients/clients.js') }}"></script>
<script src="{{ asset('js/clients/ajax.js') }}"></script>
@stop
