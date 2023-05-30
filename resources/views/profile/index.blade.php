@extends('layouts.master')
@section('css')
  <link rel="stylesheet" href="{{asset('css/profile.css')}}">
@stop
@section('title', 'Profile')
@section('content')
<div class="form-container">
  <div class="section">
    <button class="toggle btn">
      Informations de compte
      <i class="material-icons-round icon">expand_more</i>
    </button>
    <div class="content opened">
      <form id="update-infos-form" action="{{ route('profile.update.infos') }}" method="POST">
        @csrf
        <div class="form-item">
          <label for="nom">Nom <span class="star">*</span> </label>
          <input type="text" name="nom" id="nom" value="{{auth()->user()->nom}}">
          <div class="error nom_error"></div>
        </div>
        <div class="form-item">
          <label for="prenom">Prénom <span class="star">*</span> </label>
          <input type="text" name="prenom" id="prenom" value="{{auth()->user()->prenom}}">
          <div class="error prenom_error"></div>
        </div>
        <div class="form-item">
          <label for="sexe">Sexe <span class="star">*</span></label>
          <select name="sexe" id="sexe">
            <option value="" selected disabled>Choisir le sexe</option>
            <option value="H" {{(auth()->user()->sexe === 'H') ? 'selected' : '' }}>Homme</option>
            <option value="F" {{(auth()->user()->sexe === 'F') ? 'selected' : '' }}>Femme</option>
          </select>
          <div class="error sexe_error"></div>
        </div>
        <div class="form-item">
          <label for="date_naissance">Né(e) Le<span class="star">*</span> </label>
          <input type="date" name="date_naissance" id="date_naissance" value="{{auth()->user()->date_naissance}}">
          <div class="error date_naissance_error" ></div>
        </div>
        <div class="form-item">
          <label for="lieu_naissance">Né(e) à<span class="star">*</span> </label>
          <input type="text" name="lieu_naissance" id="lieu_naissance" value="{{auth()->user()->lieu_naissance}}">
          <div class="error lieu_naissance_error"></div>
        </div>
        <div class="form-item">
          <label for="adresse">Adresse<span class="star">*</span> </label>
          <input type="text" name="adresse" id="adresse" value="{{auth()->user()->adresse}}">
          <div class="error adresse_error" ></div>
        </div>
        <div class="form-item">
          <label for="cin">CIN <span class="star">*</span> </label>
          <input type="text" name="cin" id="cin" value="{{auth()->user()->cin}}">
          <div class="error cin_error" ></div>
        </div>
        <div class="form-item">
          <label for="telephone">Télephone <span class="star">*</span> </label>
          <input type="text" name="telephone" id="telephone" value="{{auth()->user()->telephone}}">
          <div class="error telephone_error"></div>
        </div>
        <div class="form-item">
          <label for="email">Email <span class="star">*</span> </label>
          <input type="email" name="email" id="email" value="{{auth()->user()->email}}">
          <div class="error email_error"></div>
        </div>
        <div class="form-item">
          <label for="login">Login <span class="star">*</span> </label>
          <input type="text" name="login" id="login" value="{{auth()->user()->login}}">
          <div class="error login_error"></div>
        </div>
        <div class="form-item full-width">
          <button type="submit" id="update-infos-button">Modifier</button>
        </div>
      </form>
    </div>
  </div>

  <div class="section">
    <button class="toggle btn">
      Changer le mot de passe
      <i class="material-icons-round icon">expand_more</i>
    </button>
    <div class="content closed">
      <form id="update-password-form" action="{{ route('profile.update.password') }}" method="POST">
        @csrf
        <div class="sub-form-container full-width">
          <div class="sub-form">
            <div class="full-width">
              <div class="form-item">
                <label for="password">mot de passe actuel</label>
                <input type="password" name="password" id="password">
                <div class="error password_error"></div>
              </div>
            </div>
            <div class="form-item">
              <label for="new_password">Nouveau mot de passe </label>
              <input type="password" name="new_password" id="new_password">
              <div class="error new_password_error"></div>
            </div>
            <div class="form-item">
              <label for="password_confirmation">Retapez le Nouveau mot de passe </label>
              <input type="password" name="new_password_confirmation" id="password_confirmation">
              <div class="error new_password_confirmation_error"></div>
            </div>
          </div>
        </div>
        <div class="form-item full-width">
          <button type="submit" id="update-password-button">Modifier</button>
        </div>
      </form>
    </div>
  </div>
  
</div>
@endsection
@section('js')
    <script src="{{asset('js/profile/profile.js')}}"></script>
    <script src="{{asset('js/profile/ajax.js')}}"></script>
@endsection