@extends('layouts.master')
@section('css')
  <link rel="stylesheet" href="{{ asset('css/table.css') }}">
@endsection
@section('title', 'Clients')

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
    <a href="/agents/create" class="ajouter"><span class="material-icons-round">
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
      <th>Email</th>
      <th>Téléphone</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td data-label="Nom">User</td>
      <td data-label="Prénom">User</td>
      <td data-label="CIN">BK1234</td>
      <td data-label="Email">agent@rentigo.com</td>
      <td data-label="Téléphone">0767564119</td>
      <td data-label="Actions">
        <a href="/agents/{agent}" class="material-icons-round show">visibility</a>
        <a href="/agents/{agent}/edit" class="material-icons-round edit">edit</a>
        <span class="material-icons-round delete">delete</span>
      </td>
    </tr>
    <tr>
      <td data-label="Nom">User</td>
      <td data-label="Prénom">User</td>
      <td data-label="CIN">BK1234</td>
      <td data-label="Email">agent@rentigo.com</td>
      <td data-label="Téléphone">0767564119</td>
      <td data-label="Actions">
        <a href="/agents/{agent}" class="material-icons-round show">visibility</a>
        <a href="/agents/{agent}/edit" class="material-icons-round edit">edit</a>
        <span class="material-icons-round delete">delete</span>
      </td>
    </tr>
    <tr>
      <td data-label="Nom">User</td>
      <td data-label="Prénom">User</td>
      <td data-label="CIN">BK1234</td>
      <td data-label="Email">agent@rentigo.com</td>
      <td data-label="Téléphone">0767564119</td>
      <td data-label="Actions">
        <a href="/agents/{agent}" class="material-icons-round show">visibility</a>
        <a href="/agents/{agent}/edit" class="material-icons-round edit">edit</a>
        <span class="material-icons-round delete">delete</span>
      </td>
    </tr>
    <tr>
      <td data-label="Nom">User</td>
      <td data-label="Prénom">User</td>
      <td data-label="CIN">BK1234</td>
      <td data-label="Email">agent@rentigo.com</td>
      <td data-label="Téléphone">0767564119</td>
      <td data-label="Actions">
        <a href="/agents/{agent}" class="material-icons-round show">visibility</a>
        <a href="/agents/{agent}/edit" class="material-icons-round edit">edit</a>
        <span class="material-icons-round delete">delete</span>
      </td>
    </tr>
  </tbody>
</table>
@stop

