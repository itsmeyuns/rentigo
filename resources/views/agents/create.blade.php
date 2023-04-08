@extends('layouts.master')
@section('css')
<link rel="stylesheet" href="{{ asset('css/agents.css') }}">
@stop
@section('title', 'Ajouter Agent')

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
      <label for="dateNaissance">Né(e) Le<span class="star">*</span> </label>
      <input type="date" name="dateNaissance" id="dateNaissance">
      <div class="error"></div>
    </div>
    <div class="form-item">
      <label for="lieuNaissance">Né(e) à<span class="star">*</span> </label>
      <input type="text" name="lieuNaissance" id="lieuNaissance">
      <div class="error"></div>
    </div>
    <div class="form-item">
      <label for="adresse">Adresse<span class="star">*</span> </label>
      <input type="text" name="adresse" id="adresse">
      <div class="error"></div>
    </div>
    <div class="form-item">
      <label for="CIN">CIN <span class="star">*</span> </label>
      <input type="text" name="CIN" id="CIN">
      <div class="error"></div>
    </div>
    <div class="form-item">
      <label for="telephone">Télephone <span class="star">*</span> </label>
      <input type="text" name="telephone" id="telephone">
      <div class="error"></div>
    </div>
    <div class="form-item">
      <label for="email">Email <span class="star">*</span> </label>
      <input type="email" name="email" id="email">
      <div class="error"></div>
    </div>
    <div class="login-infos-container full-width">
      <h3>Informations de connexion</h3>
      <div class="login-infos">
        <div class="form-item">
          <label for="login">Login <span class="star">*</span> </label>
          <input type="text" name="login" id="login">
          <div class="error"></div>
        </div>
        <div class="form-item">
          <label for="motDePass">Mot de Pass <span class="star">*</span> </label>
          <input type="password" name="motDePass" id="motDePass">
          <div class="material-icons-round" id="showPassword">visibility</div>
          <div class="error"></div>
        </div>
        
      </div>
    </div>
    <div class="form-item full-width">
      <button type="submit">Ajouter</button>
    </div>
  </form>
</div>
@stop

@section('js')
<script src="{{ asset('js/agents.js') }}"></script>
@stop
