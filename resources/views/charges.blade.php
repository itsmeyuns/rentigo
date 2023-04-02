@extends('layouts.master')
@section('css')
  <link rel="stylesheet" href="{{ asset('css/charges.css') }}">
@endsection
@section('title', 'Charges')

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
    <a href="/charges/create" class="ajouter">
      <span class="material-icons-round plus">
        add
      </span>
      <span class="material-icons-round">
        paid
      </span>
    </a>
  </form>
  <form action="" class="filter">
    <div class="select-box-container">
      <div class="select-box">
        <div class="select-field">
          <div class="select-text">Type</div>
          <span class="material-icons-round arrow-down">
            expand_more
          </span>
        </div>
        <div class="select-options">
          <div class="select-option">
            <input type="checkbox" name="" id="">
            <label for="">WIFI</label>
          </div>
          <div class="select-option">
            <input type="checkbox" name="" id="">
            <label for="">Vidange</label>
          </div>
          <div class="select-option">
            <input type="checkbox" name="" id="">
            <label for="">Autre</label>
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
      <th>Type Charge</th>
      <th>Date</th>
      <th>Coût</th>
      <th>Observation</th>
      <th>Véhicule</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td data-label="Type Charge">Vidange</td>
      <td data-label="Date">10/02/2023</td>
      <td data-label="Coût">500 MAD</td>
      <td data-label="Observation">Vidange véhicule N° 13-14-2</td>
      <td data-label="Véhicule">13-14-2</td>
      <td data-label="Actions">
        <a href="/charges/{charge}/edit" class="material-icons-round edit">edit</a>
        <span class="material-icons-round delete">delete</span>
      </td>
    </tr>
    <tr>
      <td data-label="Type Charge">Wifi</td>
      <td data-label="Date">10/02/2023</td>
      <td data-label="Coût">250 MAD</td>
      <td data-label="Observation"></td>
      <td data-label="Véhicule">###</td>
      <td data-label="Actions">
        <a href="/charges/{charge}/edit" class="material-icons-round edit">edit</a>
        <span class="material-icons-round delete">delete</span>
      </td>
    </tr>
  </tbody>
</table>
@stop
@section('js')
    <script src="{{ asset('js/contrats.js') }}"></script>
@endsection
