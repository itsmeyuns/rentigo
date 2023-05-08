<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  {{-- Font Style --}}
  <link rel="stylesheet" href="{{ asset('fonts/fonts.css') }}">
  {{-- CSS Files --}}
  <link rel="stylesheet" href="{{ asset('css/normalize.css') }}">
  <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
  <link rel="stylesheet" href="{{asset('css/jquery.modal.min.css')}}">
  {{-- <link rel="stylesheet" href="{{asset('css/toastr.min.css')}}"> --}}
  <link rel="stylesheet" href="{{asset('css/notyf.min.css')}}">
  @yield('css')  
  <title>Rentigo | @yield('title', 'Page non trouvée')</title>
</head>
<body>
  <div id="main-loader-container">
    <div class="main-loader"></div>
  </div>

  <div class="grid-container">

    @include('includes.header')

    @include('includes.sidebar')

    <main class="main-container">
      <div class="main-title">
        <h1>@yield('title', 'Page non trouvée')</h1>
      </div>
      @yield('content')
    </main>

    <div id="scroll-to-top">
      <span class="material-icons-round">
        arrow_upward
      </span>
    </div>

  </div>

  {{-- JavaScript --}}
  <script src="{{ asset('jquery/jquery-3.6.0.js') }}"></script>
  <script src="{{asset('js/jquery.modal.min.js')}}"></script>
  {{-- <script src="{{asset('js/toastr.min.js')}}"></script> --}}
  <script src="{{asset('js/notyf.min.js')}}"></script>
  <script src="{{ asset('js/main.js') }}"></script>
  <script src="{{ asset('js/ajaxSetup.js') }}"></script>
  @yield('js')
</body>
</html>