@extends('layouts.master')
@section('css')
  <link rel="stylesheet" href="{{ asset('css/clients.css') }}">
  <link rel="stylesheet" href="{{ asset('css/table.css') }}">
@endsection
@section('title', 'Clients')
<div id="AddClientModal" class="modal">
  @include('clients.modal.create')
</div>
@section('content')
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
    <a href="#AddClientModal" rel="modal:open" class="ajouter"><span class="material-icons-round">
      person_add
    </span></a>
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
    <tr>
      <td data-label="Nom">User</td>
      <td data-label="Prénom">User</td>
      <td data-label="CIN">BK1234</td>
      <td data-label="N° Permis">ZYOUNE1231103</td>
      <td data-label="Téléphone">0767564119</td>
      <td data-label="Actions">
        <a href="/clients/{client}" class="material-icons-round show">visibility</a>
        <a href="/clients/{client}/edit" class="material-icons-round edit">edit</a>
        <span class="material-icons-round delete">delete</span>
      </td>
    </tr>
    <tr>
      <td data-label="Nom">User</td>
      <td data-label="Prénom">User</td>
      <td data-label="CIN">BK1234</td>
      <td data-label="N° Permis">ZYOUNE1231103</td>
      <td data-label="Téléphone">0767564119</td>
      <td data-label="Actions">
        <a href="/clients/{client}" class="material-icons-round show">visibility</a>
        <a href="/clients/{client}/edit" class="material-icons-round edit">edit</a>
        <span class="material-icons-round delete">delete</span>
      </td>
    </tr>
    <tr>
      <td data-label="Nom">User</td>
      <td data-label="Prénom">User</td>
      <td data-label="CIN">BK1234</td>
      <td data-label="N° Permis">ZYOUNE1231103</td>
      <td data-label="Téléphone">0767564119</td>
      <td data-label="Actions">
        <a href="/clients/{client}" class="material-icons-round show">visibility</a>
        <a href="/clients/{client}/edit" class="material-icons-round edit">edit</a>
        <span class="material-icons-round delete">delete</span>
      </td>
    </tr>
    <tr>
      <td data-label="Nom">User</td>
      <td data-label="Prénom">User</td>
      <td data-label="CIN">BK1234</td>
      <td data-label="N° Permis">ZYOUNE1231103</td>
      <td data-label="Téléphone">0767564119</td>
      <td data-label="Actions">
        <a href="/clients/{client}" class="material-icons-round show">visibility</a>
        <a href="/clients/{client}/edit" class="material-icons-round edit">edit</a>
        <span class="material-icons-round delete">delete</span>
      </td>
    </tr>
    <tr>
      <td data-label="Nom">User</td>
      <td data-label="Prénom">User</td>
      <td data-label="CIN">BK1234</td>
      <td data-label="N° Permis">ZYOUNE1231103</td>
      <td data-label="Téléphone">0767564119</td>
      <td data-label="Actions">
        <a href="/clients/{client}" class="material-icons-round show">visibility</a>
        <a href="/clients/{client}/edit" class="material-icons-round edit">edit</a>
        <span class="material-icons-round delete">delete</span>
      </td>
    </tr>
    <tr>
      <td data-label="Nom">User</td>
      <td data-label="Prénom">User</td>
      <td data-label="CIN">BK1234</td>
      <td data-label="N° Permis">ZYOUNE1231103</td>
      <td data-label="Téléphone">0767564119</td>
      <td data-label="Actions">
        <a href="/clients/{client}" class="material-icons-round show">visibility</a>
        <a href="/clients/{client}/edit" class="material-icons-round edit">edit</a>
        <span class="material-icons-round delete">delete</span>
      </td>
    </tr>
  </tbody>
</table>
@stop
@section('js')
<script src="{{ asset('js/clients.js') }}"></script>
@stop
