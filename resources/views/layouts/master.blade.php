<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  {{-- Font Style --}}
  <link rel="stylesheet" href="{{ asset('fonts/fonts.css') }}">
  {{-- CSS Files --}}
  <link rel="stylesheet" href="{{ asset('css/normalize.css') }}">
  <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
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
  @yield('js')
  <script src="{{ asset('js/main.js') }}"></script>
</body>
</html>