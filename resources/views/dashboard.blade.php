@extends('layouts.master')
@section('title', 'Tableau de bord')

@section('content')
<div class="cards">

  <div class="card">
    <div class="card-inner">
      <h3>Réservations</h3>
      <span class="material-icons-round">
        list_alt
      </span>
    </div>
    <h1>33</h1>
  </div>

  <div class="card">
    <div class="card-inner">
      <h3>Véhicules loués</h3>
      <span class="material-icons-round">
        directions_car
      </span>
    </div>
    <h1>33</h1>
  </div>

  <div class="card">
    <div class="card-inner">
      <h3>Véhicules disponibles</h3>
      <span class="material-icons-round">
        directions_car
      </span>
    </div>
    <h1>33</h1>
  </div>

  <div class="card">
    <div class="card-inner">
      <h3>Alerts</h3>
      <span class="material-icons-round">
        notification_important
      </span>
    </div>
    <h1>3</h1>
  </div>

</div>
@stop

