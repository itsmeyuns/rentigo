@extends('layouts.master')
@section('css')
  <link rel="stylesheet" href="{{ asset('css/clients.css') }}">
  <link rel="stylesheet" href="{{ asset('css/table.css') }}">
@endsection
@section('title', 'Clients')
@section('content')
<div id="AddClientModal" class="modal">
  @include('clients.modal.create')
</div>
<div id="DeleteClientModal" class="modal">
  @include('clients.modal.delete')
</div>
<div id="EditClientModal" class="modal">
  @include('clients.modal.edit')
</div>
<div class="bar">
  <form action="">
    <div class="input-holder">
      <input type="text" name="rechercher" placeholder="Rechercher" id="rechercher">
      <button type="submit">
        <span class="material-icons-round">
          search
        </span>
      </button>
    </div>
    <div class="ajouter"><span class="material-icons-round">
      person_add
    </span></div>
  </form>
</div>
<table>
  <thead>
    <tr>
      <th>Nom</th>
      <th>Prénom</th>
      <th>CIN</th>
      <th>N° permis</th>
      <th>Téléphone</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
  </tbody>
</table>
@stop
@section('js')
<script src="{{ asset('js/clients/clients.js') }}"></script>
<script src="{{ asset('js/clients/ajax.js') }}"></script>
@stop
