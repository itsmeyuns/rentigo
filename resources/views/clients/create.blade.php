@extends('layouts.master')
@section('css')
<link rel="stylesheet" href="{{ asset('css/clients.css') }}">
@stop
@section('title', 'Ajouter Client')

@section('content')
<div class="form-container">
  <form action=""class="add-form">
    <div class="form-item">
      <label for="nom">Nom <span class="star">*</span> </label>
      <input type="text" name="nom" id="nom">
      <div class="error"></div>
    </div>
    <div class="form-item">
      <label for="prenom">Prénom <span class="star">*</span> </label>
      <input type="text" name="prenom" id="prenom">
      <div class="error"></div>
    </div>
    <div class="form-item">
      <label for="sexe">Sexe <span class="star">*</span></label>
      <select name="sexe" id="sexe">
        <option value="M">M</option>
        <option value="F">F</option>
      </select>
      <div class="error"></div>
    </div>
    <div class="form-item">
      <label for="dateNaissance">Né(e) le<span class="star">*</span> </label>
      <input type="date" name="dateNaissance" id="dateNaissance">
      <div class="error"></div>
    </div>
    <div class="form-item">
      <label for="lieuNaissance">Né(e) à<span class="star">*</span> </label>
      <input type="text" name="lieuNaissance" id="lieuNaissance">
      <div class="error"></div>
    </div>
    <div class="form-item">
      <label for="adresse">Adresse <span class="star">*</span> </label>
      <input type="text" name="adresse" id="adresse">
      <div class="error"></div>
    </div>
    <div class="form-item">
      <label for="cin">CIN <span class="star">*</span> </label>
      <input type="text" name="cin" id="cin">
      <div class="error"></div>
    </div>
    <div class="form-item">
      <label for="permis">N° Permis <span class="star">*</span> </label>
      <input type="text" name="permis" id="permis">
      <div class="error"></div>
    </div>
    <div class="form-item">
      <label for="telephone">Télephone <span class="star">*</span> </label>
      <input type="text" name="telephone" id="telephone">
      <div class="error"></div>
    </div>
    <div class="form-item">
      <label for="email">Email</label>
      <input type="email" name="email" id="email">
      <div class="error"></div>
    </div>
    <div class="form-item full-width">
      <label for="observation">Observation</label>
      <textarea name="observation" id="observation"></textarea>
    </div>
    <div class="form-item full-width">
      <button type="submit">Ajouter</button>
    </div>
  </form>
</div>
@stop

@section('js')
<script src="{{ asset('js/clients.js') }}"></script>
@stop
