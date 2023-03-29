@extends('layouts.master')
@section('css')
  <link rel="stylesheet" href="{{ asset('css/contrats.css') }}">
  
@endsection
@section('title', 'Contrats')

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
      <th>Réf contrat</th>
      <th>date contrat</th>
      <th>Date départ</th>
      <th>date arrivée</th>
      <th>client</th>
      <th>véhicule</th>
      <th>durée</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td data-label="Réf contrat">C1000</td>
      <td data-label="date contrat">01/01/2022</td>
      <td data-label="date départ">01/01/022</td>
      <td data-label="date arrivée">01/01/022</td>
      <td data-label="client">User User</td>
      <td data-label="véhicule">A12336 - Dacia</td>
      <td data-label="durée">5</td>
      <td data-label="actions">
        <a href="/contrats/{contrat}/edit" class="material-icons-round edit">
          edit
        </a>
        <span class="material-icons-round delete">
          delete
        </span>
        <span class="material-icons-round more-icon">
          more_vert
          <ul class="more">
            <li>
              <span class="material-icons-round">
                autorenew
              </span>
              <a href="">Pronologation</a>
            </li>
            <li>
              <span class="material-icons-round">
                print
              </span>
              <a href="">Imprimer</a>
            </li>
          </ul>
        </span>
      </td>
    </tr>
    <tr>
      <td data-label="Réf contrat">C1000</td>
      <td data-label="date contrat">01/01/2022</td>
      <td data-label="date départ">01/01/022</td>
      <td data-label="date arrivée">01/01/022</td>
      <td data-label="client">User User</td>
      <td data-label="véhicule">A12336 - Dacia</td>
      <td data-label="durée">5</td>
      <td data-label="actions">
        <a href="/contrats/{contrat}/edit" class="material-icons-round edit">
          edit
        </a>
        <span class="material-icons-round delete">
          delete
        </span>
        <span class="material-icons-round more-icon">
          more_vert
          <ul class="more">
            <li>
              <span class="material-icons-round">
                autorenew
              </span>
              <a href="">Pronologation</a>
            </li>
            <li>
              <span class="material-icons-round">
                print
              </span>
              <a href="">Imprimer</a>
            </li>
          </ul>
        </span>
      </td>
    </tr>
    <tr>
      <td data-label="Réf contrat">C1000</td>
      <td data-label="date contrat">01/01/2022</td>
      <td data-label="date départ">01/01/022</td>
      <td data-label="date arrivée">01/01/022</td>
      <td data-label="client">User User</td>
      <td data-label="véhicule">A12336 - Dacia</td>
      <td data-label="durée">5</td>
      <td data-label="actions">
        <a href="/contrats/{contrat}/edit" class="material-icons-round edit">
          edit
        </a>
        <span class="material-icons-round delete">
          delete
        </span>
        <span class="material-icons-round more-icon">
          more_vert
          <ul class="more">
            <li>
              <span class="material-icons-round">
                autorenew
              </span>
              <a href="">Pronologation</a>
            </li>
            <li>
              <span class="material-icons-round">
                print
              </span>
              <a href="">Imprimer</a>
            </li>
          </ul>
        </span>
      </td>
    </tr>
    <tr>
      <td data-label="Réf contrat">C1000</td>
      <td data-label="date contrat">01/01/2022</td>
      <td data-label="date départ">01/01/022</td>
      <td data-label="date arrivée">01/01/022</td>
      <td data-label="client">User User</td>
      <td data-label="véhicule">A12336 - Dacia</td>
      <td data-label="durée">5</td>
      <td data-label="actions">
        <a href="/contrats/{contrat}/edit" class="material-icons-round edit">
          edit
        </a>
        <span class="material-icons-round delete">
          delete
        </span>
        <span class="material-icons-round more-icon">
          more_vert
          <ul class="more">
            <li>
              <span class="material-icons-round">
                autorenew
              </span>
              <a href="">Pronologation</a>
            </li>
            <li>
              <span class="material-icons-round">
                print
              </span>
              <a href="">Imprimer</a>
            </li>
          </ul>
        </span>
      </td>
    </tr>
    
  </tbody>
</table>
@stop
@section('js')
    <script src="{{ asset('js/contrats.js') }}"></script>
@endsection

