@extends('layouts.master')
@section('title', 'Agence')
@section('content')
<div class="form-container">
  <form id="form-agence" action="{{route('agence.store')}}" method="POST">
    @csrf
    <input type="hidden" name="agence_id"  value="{{$agence->id ?? ''}}">
    <div class="sub-form-container full-width">
      <h3 class="form-title">Représentant légal de l'agence</h3>
      <div class="sub-form">
        <div class="form-item">
          <label for="nom">Nom <span class="star">*</span> </label>
          <input type="text" name="nom" id="nom" value="{{$agence->representantLegal->nom ?? ''}}">
          <div class="error nom_error"></div>
        </div>
        <div class="form-item">
          <label for="prenom">Prénom <span class="star">*</span> </label>
          <input type="text" name="prenom" id="prenom" value="{{$agence->representantLegal->prenom ?? ''}}">
          <div class="error prenom_error"></div>
        </div>
        <div class="form-item">
          <label for="cin">CIN <span class="star">*</span> </label>
          <input type="text" name="cin" id="cin" value="{{$agence->representantLegal->cin ?? ''}}">
          <div class="error cin_error"></div>
        </div>
      </div>
    </div>

    <div class="sub-form-container full-width">
      <h3 class="form-title">Informations de l'agence</h3>
      <div class="sub-form">
        <div class="form-item">
          <label for="raison_sociale"> raison sociale <span class="star">*</span> </label>
          <input type="text" name="raison_sociale" id="raison_sociale" value="{{$agence->raison_sociale ?? ''}}">
          <div class="error  raison_sociale_error"></div>
        </div>
        <div class="form-item">
          <label for="adresse">adresse <span class="star">*</span> </label>
          <input type="text" name="adresse" id="adresse" value="{{$agence->adresse ?? ''}}">
          <div class="error adresse_error"></div>
        </div>
        <div class="form-item">
          <label for="ville">ville <span class="star">*</span> </label>
          <input type="text" name="ville" id="ville" value="{{$agence->ville ?? ''}}">
          <div class="error ville_error"></div>
        </div>
        <div class="form-item">
          <label for="telephone">téléphone <span class="star">*</span> </label>
          <input type="text" name="telephone" id="telephone" value="{{$agence->telephone ?? ''}}">
          <div class="error telephone_error"></div>
        </div>
        <div class="form-item">
          <label for="fax">fax <span class="star">*</span> </label>
          <input type="text" name="fax" id="fax" value="{{$agence->fax ?? ''}}">
          <div class="error fax_error"></div>
        </div>
        <div class="form-item">
          <label for="email">email <span class="star">*</span> </label>
          <input type="email" name="email" id="email" value="{{$agence->email ?? ''}}">
          <div class="error email_error"></div>
        </div>
      </div>
    </div>

    <div class="sub-form-container">
      <h3 class="form-title">Informations de facturation</h3>
      <div class="sub-form">
        <div class="form-item">
          <label for="patent">patent <span class="star">*</span> </label>
          <input type="text" name="patent" id="patent" value="{{$agence->patent ?? ''}}">
          <div class="error patent_error"></div>
        </div>
        <div class="form-item">
          <label for="IF">IF <span class="star">*</span> </label>
          <input type="text" name="IF" id="IF" value="{{$agence->IF ?? ''}}">
          <div class="error IF_error"></div>
        </div>
        <div class="form-item">
          <label for="RC">RC <span class="star">*</span> </label>
          <input type="text" name="RC" id="RC" value="{{$agence->RC ?? ''}}">
          <div class="error RC_error"></div>
        </div>
        <div class="form-item">
          <label for="ICE">ICE <span class="star">*</span> </label>
          <input type="text" name="ICE" id="ICE" value="{{$agence->ICE ?? ''}}">
          <div class="error ICE_error"></div>
        </div>
        <div class="form-item">
          <label for="CNSS">CNSS <span class="star">*</span> </label>
          <input type="text" name="CNSS" id="CNSS" value="{{$agence->CNSS ?? ''}}">
          <div class="error CNSS_error"></div>
        </div>
      </div>
    </div>

    <div class="form-item full-width">
      <button id='agence-button' type="submit">Modifier</button>
    </div>
  </form>
</div>
@stop
@section('js')
<script src="{{ asset('js/agence/agence.js') }}"></script>
<script src="{{ asset('js/agence/ajax.js') }}"></script>
@stop
