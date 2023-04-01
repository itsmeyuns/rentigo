@extends('layouts.master')
@section('css')
  <link rel="stylesheet" href="{{ asset('css/contrats.css') }}">
  
@endsection
@section('title', 'Réservations')

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
    <a href="/contrats/create" class="ajouter">
      <span class="material-icons-round plus">
        add
      </span>
      <span class="material-icons-round">
        description
      </span>
    </a>
  </form>
  <form action="" class="filter">
    <div class="select-box-container">
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
    </div>
    <div class="date-picker">
      <div class="start-date">
        <label for="startDate">De:</label>
        <input type="date" id="startDate" name="startDate">
      </div>
      <div class="end-date">
        <label for="endDate">À:</label>
        <input type="date" id="endDate" name="endDate">
      </div>
    </div>
  </form>
</div>
<table>
  <thead>
    <tr>
      <th>N° réservation</th>
      <th>date réservation</th>
      <th>client</th>
      <th>véhicule</th>
      <th>Date début</th>
      <th>date fin</th>
      <th>agent</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td data-label="N° Réservation">R1000</td>
      <td data-label="Date Réservation">01/01/2022</td>
      <td data-label="client">User User</td>
      <td data-label="véhicule">A12336 - Dacia</td>
      <td data-label="Date Début">01/01/022</td>
      <td data-label="Date Fin">01/01/022</td>
      <td data-label="durée">User User</td>
      <td data-label="actions">
        <a href="/contrats/{contrat}/edit" class="material-icons-round edit">
          edit
        </a>
        <span class="material-icons-round delete">
          delete
        </span>
      </td>
    </tr>
    <tr>
      <td data-label="N° Réservation">R1000</td>
      <td data-label="Date Réservation">01/01/2022</td>
      <td data-label="client">User User</td>
      <td data-label="véhicule">A12336 - Dacia</td>
      <td data-label="Date Début">01/01/022</td>
      <td data-label="Date Fin">01/01/022</td>
      <td data-label="durée">User User</td>
      <td data-label="actions">
        <a href="/contrats/{contrat}/edit" class="material-icons-round edit">
          edit
        </a>
        <span class="material-icons-round delete">
          delete
        </span>
      </td>
    </tr>
    <tr>
      <td data-label="N° Réservation">R1000</td>
      <td data-label="Date Réservation">01/01/2022</td>
      <td data-label="client">User User</td>
      <td data-label="véhicule">A12336 - Dacia</td>
      <td data-label="Date Début">01/01/022</td>
      <td data-label="Date Fin">01/01/022</td>
      <td data-label="durée">User User</td>
      <td data-label="actions">
        <a href="/contrats/{contrat}/edit" class="material-icons-round edit">
          edit
        </a>
        <span class="material-icons-round delete">
          delete
        </span>
      </td>
    </tr>
    <tr>
      <td data-label="N° Réservation">R1000</td>
      <td data-label="Date Réservation">01/01/2022</td>
      <td data-label="client">User User</td>
      <td data-label="véhicule">A12336 - Dacia</td>
      <td data-label="Date Début">01/01/022</td>
      <td data-label="Date Fin">01/01/022</td>
      <td data-label="durée">User User</td>
      <td data-label="actions">
        <a href="/contrats/{contrat}/edit" class="material-icons-round edit">
          edit
        </a>
        <span class="material-icons-round delete">
          delete
        </span>
      </td>
    </tr>
    
  </tbody>
</table>
@stop
@section('js')
    <script src="{{ asset('js/contrats.js') }}"></script>
@endsection

