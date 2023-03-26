<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  {{-- Font Style --}}
  <link rel="stylesheet" href="{{ asset('fonts/fonts.css') }}">
  {{-- CSS Files --}}
  <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
  @yield('css')
  <title>Rentigo | @yield('title', 'Page non trouvée')</title>
</head>
<body>

  <div class="grid-container">

    <header class="header">
      <div class="menu-icon" onclick="openSidebar()">
        <span class="material-icons-round">
          menu
        </span>
      </div>
      <div class="header-right">
        <span class="material-icons-round">
          notifications
        </span>
        <div class="profile" onclick="openDropdown()">
          <div class="profile-icons">
            <span class="material-icons-round">
              account_circle
            </span>
            <span class="user">Zaghari Younes</span>
            <span class="material-icons-round arrow-icon">
              expand_more
            </span>
          </div>
          <ul class="profile-links">
            <li>
              <a href="#">
                <span class="material-icons-round">
                  account_circle
                </span>
                Profile
              </a>
            </li>
            <li>
              <a href="#">
                <span class="material-icons-round">
                  logout
                </span>
                Déconnexion
              </a>
            </li>
          </ul>
        </div>
      </a>
    </header>

    <aside id="sidebar">
      <div class="sidebar-title">
        <div class="sidebar-brand">
          <a href="/dashboard" class="logo">Rentigo</a>
        </div>
        <span class="material-icons-round" onclick="closeSidebar()">
          close
        </span>
      </div>

      <ul class="sidebar-list">
        <li class="sidebar-list-item">
          <a href="/dashboard">
            <span class="material-icons-round">
              dashboard
            </span>Tableau de bord
          </a>
        </li>
        <li class="sidebar-list-item">
          <a href="/clients">
            <span class="material-icons-round">groups</span> Clients
          </a>
        </li>
        <li class="sidebar-list-item">
          <a href="/vehicules">
            <span class="material-icons-round">
              directions_car
            </span> Véhicules
          </a>
        </li>
        <li class="sidebar-list-item">
          <a href="/contrats">
            <span class="material-icons-round">
              description
            </span> Contrats
          </a>
        </li>
        <li class="sidebar-list-item">
          <a href="/reservation">
            <span class="material-icons-round">
              list_alt
            </span> Résevations
          </a>
        </li>
        <li class="sidebar-list-item">
          <a href="/agents">
            <span class="material-icons-round">
              badge
            </span> Agents
          </a>
        </li>
        <li class="sidebar-list-item">
          <a href="/charges">
            <span class="material-icons-round">
              paid
            </span> Charges
          </a>
        </li>
        <li class="sidebar-list-item">
          <a href="/alerts">
            <span class="material-icons-round">
              notification_important
            </span>Alerts
          </a>
        </li>
      </ul>
    </aside>

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