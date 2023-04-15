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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  @yield('css')
  <title>Rentigo | @yield('title', 'Page non trouvée')</title>
</head>
<body>

  <div class="grid-container">

    @include('includes.header')

    @include('includes.sidebar')

    <main class="main-container">
      <div class="main-title">
        <h1>@yield('title', 'Page non trouvée')</h1>
      </div>
      @yield('content')
    </main>

  </div>

  {{-- JavaScript --}}
  <script src="{{ asset('jquery/jquery-3.6.0.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script>
    $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
  </script>
  @yield('js')
  <script src="{{ asset('js/main.js') }}"></script>
</body>
</html>