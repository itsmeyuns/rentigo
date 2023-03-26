@extends('layouts.master')
@section('css')
<link rel="stylesheet" href="{{ asset('css/vehicules.css') }}">
@stop
@section('title', 'Véhicules')

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
    <a href="/vehicules/create" class="ajouter">Ajouter véhicule</a>
  </form>
  <div class="filter">
    <div class="option">
      <input type="checkbox"  name="status" id="">
      <span>En panne</span>
    </div>
    <div class="option">
      <input type="checkbox"  name="status" id="">
      <span>Loué</span>
    </div>
    <div class="option">
      <input type="checkbox"  name="status" id="">
      <span>Disponible</span> 
    </div>
  </div>
</div>
<div class="box-container">
  <div class="box">
    <div class="box-header">
      <div class="box-inner">
        <h3>Fiat</h3>
        <p>2021</p>
      </div>
      <p>250$<span>/Jour</span></p>
    </div>
    <div class="box-body">
      <img src="pics/v3.png" alt="">
    </div>
    <div class="box-footer">
      <a href="/vehicules/{vehicule}/edit" class="material-icons-round edit">
        edit
      </a>
      <span class="material-icons-round delete">
        delete
      </span>
    </div>
  </div>
  <div class="box">
    <div class="box-header">
      <div class="box-inner">
        <h3>Megan</h3>
        <p>2020</p>
      </div>
      <p>250$<span>/Jour</span></p>
    </div>
    <div class="box-body">
      <img src="pics/v2.png" alt="">
    </div>
    <div class="box-footer">
      <a href="/vehicules/{vehicule}/edit" class="material-icons-round edit">
          edit
      </a>
      <span class="material-icons-round delete">
        delete
      </span>
    </div>
  </div>
  <div class="box">
    <div class="box-header">
      <div class="box-inner">
        <h3>land roverr</h3>
        <p>2021</p>
      </div>
      <p>250$<span>/Jour</span></p>
    </div>
    <div class="box-body">
      <img src="pics/v1.png" alt="">
    </div>
    <div class="box-footer">
      <a href="/vehicules/{vehicule}/edit" class="material-icons-round edit">
          edit
      </a>
      <span class="material-icons-round delete">
        delete
      </span>
    </div>
  </div>
  <div class="box">
    <div class="box-header">
      <div class="box-inner">
        <h3>Dacia</h3>
        <p>2021</p>
      </div>
      <p>250$<span>/Jour</span></p>
    </div>
    <div class="box-body">
      <img src="pics/v2.png" alt="">
    </div>
    <div class="box-footer">
      <a href="/vehicules/{vehicule}/edit" class="material-icons-round edit">
          edit
      </a>
      <span class="material-icons-round delete">
        delete
      </span>
    </div>
  </div>
  <div class="box">
    <div class="box-header">
      <div class="box-inner">
        <h3>Dacia</h3>
        <p>2021</p>
      </div>
      <p>250$<span>/Jour</span></p>
    </div>
    <div class="box-body">
      <img src="pics/v1.png" alt="">
    </div>
    <div class="box-footer">
      <a href="/vehicules/{vehicule}/edit" class="material-icons-round edit">
        edit
      </a>
      <span class="material-icons-round delete">
        delete
      </span>
    </div>
  </div>
  <div class="box">
    <div class="box-header">
      <div class="box-inner">
        <h3>Dacia</h3>
        <p>2021</p>
      </div>
      <p>250$<span>/Jour</span></p>
    </div>
    <div class="box-body">
      <img src="pics/v3.png" alt="">
    </div>
    <div class="box-footer">
      <a href="/vehicules/{vehicule}/edit" class="material-icons-round edit">
        edit
      </a>
      <span class="material-icons-round delete">
        delete
      </span>
    </div>
  </div>
</div>
@stop

@section('js')
<script src="{{ asset('js/vehicules.js') }}"></script>
@stop
