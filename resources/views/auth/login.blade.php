@extends('layouts.master-auth')
@section('title', 'Login')
@section('content')
<div class="left-side">
  <img src="pics/rentigo-logo.png" alt="rentigo logo">
</div>
<div class="right-side">
  <h1 class="title">Connexion</h1>
  <form method="POST" action="{{ route('login') }}">
    @csrf
    <div class="form-item">
      <label for="login">Login</label>
      <input type="text" name="login" id="login" placeholder="Login" value="{{old('login')}}">
      <div class="error">
        @error('login')
          {{ $message }}
        @enderror
      </div>
    </div>
    <div class="form-item">
      <label for="password">Mot de pass</label>
      <input type="password" name="password" id="password" placeholder="Mot de passe">
      <div class="material-icons-round" id="showPassword">visibility</div>
      <div class="error">
        @error('password')
          {{ $message }}
        @enderror
      </div>
    </div>
    <div class="form-check">
      <div class="rememberMe">
        <input  type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
        <label for="remember">Se souvenir de moi ? </label>
      </div>
      <div class="forgotPassword">
        <a href="{{ route('password.request') }}">
          {{ __('Mot de passe oublié?') }}
      </a>
      </div>
    </div>
    <div class="form-item">
    <input type="submit" value="Se connecter" class="button">
    </div>
  </form>
</div>
@stop