@extends('layouts.master-auth')
@section('title', 'Réinitialiser le mot de passe')
@section('css')
  <link rel="stylesheet" href="{{asset('css/email.css')}}">
@stop
@section('content')
<h1 class="title">Réinitialiser le mot de passe</h1>
@if (session('status'))
    <div class="status-msg">
        {{ session('status') }}
    </div>
@endif
<form method="POST" action="{{ route('password.email') }}">
  @csrf

  <div class="form-item">
    <label for="email">{{ __('Email Address') }}</label>
    <input id="email" type="email" value="{{ old('email') }}" required autocomplete="email" name='email'>
    <div class="error">
        @error('email')
          {{ $message }}
        @enderror
    </div>
  </div>

  <div class="form-item">
    <button type="submit">
        {{ __('Send Password Reset Link') }}
    </button>
  </div>

</form>

@endsection
