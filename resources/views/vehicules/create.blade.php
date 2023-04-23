@extends('layouts.master')
@section('css')
<link rel="stylesheet" href="{{ asset('css/vehicules.css') }}">
@stop
@section('title', 'Ajouter Véhicule')

@section('content')
<div class="form-container">
  <form action="" class="add-form">
    <div class="form-item">
      <label for="matricule">matricule <span class="star">*</span> </label>
      <input type="text" name="matricule" id="matricule">
      <div class="error"></div>
    </div>
    <div class="form-item">
      <label for="marque">marque <span class="star">*</span> </label>
      <input type="text" name="marque" id="marque">
      <div class="error"></div>
    </div>
    <div class="form-item">
      <label for="modele">modèle <span class="star">*</span> </label>
      <input type="text" name="modeel" id="modele">
      <div class="error"></div>
    </div>
    <div class="form-item">
      <label for="kilometrage">kilométrage <span class="star">*</span> </label>
      <input type="text" name="kilometrage" id="kilometrage">
      <div class="error"></div>
    </div>
    <div class="form-item">
      <label for="prixLocation">prix location <span class="star">*</span> </label>
      <input type="text" name="prixLocation" id="prixLocation">
      <div class="error"></div>
    </div>
    <div class="form-item">
      <label for="couleur">couleur <span class="star">*</span> </label>
      <input type="text" name="couleur" id="couleur">
      <div class="error"></div>
    </div>
    <div class="form-item">
      <label for="carburant">carburant <span class="star">*</span> </label>
      <select name="carburant" id="carburant">
        <option value="essence">Essence</option>
        <option value="diesel">Diesel</option>Diesel
      </select>
    </div>
    <div class="form-item">
      <label for="automatique">automatique <span class="star">*</span> </label>
      <select name="automatique" id="automatique">
        <option value="non">Non</option>
        <option value="oui">Oui</option>
      </select>
    </div>
    <div class="form-item">
      <label for="disponibilite">disponibilité <span class="star">*</span> </label>
      <select name="disponibilite" id="disponibilite">
        <option value="disponible">Disponible</option>
        <option value="louer">Loué</option>
        <option value="en panne">En panne</option>
      </select>
    </div>
    <div class="form-item">
      <label for="nombrePortes">nombre portes <span class="star">*</span> </label>
      <input type="text" name="nombrePortes" id="nombrePortes">
      <div class="error"></div>
    </div>
    <div class="form-item">
      <label for="nombrePlaces">nombre places <span class="star">*</span> </label>
      <input type="text" name="nombrePlaces" id="nombrePlaces">
      <div class="error"></div>
    </div>
    <div class="checkboxes">
      <div class="left-boxes">
        <div class="box-field">
          <input type="checkbox" name="extras[]" id="gps" value="gps">
          <label for="gps">GPS</label>
        </div>
        <div class="box-field">
          <input type="checkbox" name="extras[]" id="triangleDePanne" value="triangle de panne">
          <label for="triangleDePanne">Triangle de panne</label>
        </div>
        <div class="box-field">
          <input type="checkbox" name="extras[]" id="gilet" value="gilet">
          <label for="gilet">Gilet</label>
        </div>
        <div class="box-field">
          <input type="checkbox" name="extras[]" id="cameraDeRecul" value="Caméra de recul">
          <label for="cameraDeRecul">Caméra de recul</label>
        </div>
      </div>
      <div class="right-boxes">
        <div class="box-field">
          <input type="checkbox" name="extras[]" id="extincteur" value="extincteur">
          <label for="extincteur">Extincteur</label>
        </div>
        <div class="box-field">
          <input type="checkbox" name="extras[]" id="regulateurDeVitesse" value="Régulateur de vitesse">
          <label for="regulateurDeVitesse">Régulateur de vitesse</label>
        </div>
        <div class="box-field">
          <input type="checkbox" name="extras[]" id="siegeBebe" value="Siège bébé">
          <label for="siegeBebe">Siège bébé</label>
        </div>
      </div>
    </div>
    <div class="form-item input-file-holder">
      <div class="img-container">
        <div class="file-label">
          <span class="material-icons-round icon">
            add_photo_alternate
          </span>
          <span>photo véhicule</span>
        </div>
        <div class="error"></div>
        <input type="file" name="photo" id="photo">
      </div>
      <div class="imgPreview">
        <img src="{{asset('pics/rentigo-logo.png')}}" accept='image/png, image/jpeg' id="uploadedImage">
      </div>
    </div>
    <div class="form-item">
      <button type="submit">Ajouter</button>
    </div>
  </form>
</div>
@stop

@section('js')
<script src="{{ asset('js/vehicules.js') }}"></script>
@stop
