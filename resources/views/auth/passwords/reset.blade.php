@extends('layouts.master-auth')
@section('title', 'Réinitialisation du mot de passe')
@section('css')
  <link rel="stylesheet" href="{{asset('css/email.css')}}">
@stop
@section('content')
<h1 class="title">Réinitialisation du mot de passe</h1>
@if (session('status'))
  <div class="status-msg">
      {{ session('status') }}
  </div>
@endif
<form method="POST" action="{{ route('password.update') }}">
  @csrf
  <input type="hidden" name="token" value="{{ $token }}">
  <div class="form-item">
    <label for="email">{{ __('Email Address') }}</label>
    <input id="email" type="email" value="{{ $email ?? old('email') }}" required autocomplete="email" name='email'>
    <div class="error">
        @error('email')
          {{ $message }}
        @enderror
    </div>
  </div>

  <div class="form-item">
    <label for="password">{{ __('Password') }}</label>
    <input id="password" type="password" required autocomplete="new-password" name='password'>
    <div class="error">
        @error('password')
          {{ $message }}
        @enderror
    </div>
  </div>

  <div class="form-item">
    <label for="password-confirm">{{ __('Confirm Password') }} </label>
    <input id="password-confirm" type="password" required autocomplete="new-password" name='password_confirmation'>
  </div>

  <div class="form-item">
    <button type="submit">
      {{ __('Reset Password') }}
    </button>
  </div>

</form>

@endsection
