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
    <h1><a href="{{route('reservations.index')}}">{{$reservations}}</a></h1>
  </div>

  <div class="card">
    <div class="card-inner">
      <h3>Véhicules loués</h3>
      <span class="material-icons-round">
        directions_car
      </span>
    </div>
    <h1>
      <a href="{{route('vehicules.index')}}">{{$vehiculesLoués}}</a>
    </h1>
  </div>

  <div class="card">
    <div class="card-inner">
      <h3>Véhicules disponibles</h3>
      <span class="material-icons-round">
        directions_car
      </span>
    </div>
    <h1>
      <a href="{{route('vehicules.index')}}">{{$vehiculesDispo}}</a>
    </h1>
  </div>

  <div class="card">
    <div class="card-inner">
      <h3>Alerts</h3>
      <span class="material-icons-round">
        notification_important
      </span>
    </div>
    <h1>
      <a href="{{route('alertes.index')}}">{{$alertes}}</a>
    </h1>
  </div>

</div>

@include('dashboard.charts')

{{-- Gains et Dépenses --}}
@if (auth()->user()->role == 'admin')
<div class="cards">
  <div class="card">
    <div class="card-inner">
      <h2>Gains</h2>
      <img src="{{asset('pics/gains.png')}}" width="65px">
    </div>
    <h1>{{$gains}} DHs</h1>
  </div>

  <div class="card">
    <div class="card-inner">
      <h2>Dépenses</h2>
      <img src="{{asset('pics/depenses.png')}}" width="65px">
    </div>
    <h1>{{$depenses}} DHs</h1>
  </div>
</div>
@endif
{{-- Gains et Dépenses --}}





@stop
@section('js')
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.0/dist/chart.umd.min.js"></script>
  <script src="{{asset('js/dashboard/charts/user.js')}}"></script>
  @if (auth()->user()->role == 'admin')
    <script src="{{asset('js/dashboard/charts/admin.js')}}"></script>
  @endif
@endsection

