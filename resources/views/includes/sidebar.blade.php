<aside id="sidebar">
  <span class="material-icons-round close" onclick="closeSidebar()">
    close
  </span>
  <a href="/dashboard" class="logo">
    <span class="material-icons-round icon">
      directions_car
    </span>
    Rentigo
  </a>

  <ul class="side-menu">
    <li class="side-menu-item">
      <a href="/dashboard">
        <span class="material-icons-round icon">
          dashboard
        </span>Tableau de bord
      </a>
    </li>
    <li class="side-menu-item">
      <a href="{{route('clients.index')}}">
        <span class="material-icons-round icon">groups</span> Clients
      </a>
    </li>
    <li class="side-menu-item">
      <a href="{{route('vehicules.index')}}">
        <span class="material-icons-round icon">
          directions_car
        </span> Véhicules
      </a>
    </li>
    <li class="side-menu-item">
      <a href="{{route('reservations.index')}}">
        <span class="material-icons-round icon">
          list_alt
        </span> Résevations
      </a>
    </li>
    <li class="side-menu-item">
      <a href="{{route('contrats.index')}}">
        <span class="material-icons-round icon">
          description
        </span> Contrats
      </a>
    </li>
    @if(auth()->user()->role === 'admin')
      <li class="side-menu-item">
        <a href="{{route('users.index')}}">
          <span class="material-icons-round icon">
            badge
          </span> Utilisateurs
        </a>
      </li>
      <li class="side-menu-item">
        <a href="{{route('agence.index')}}">
          <span class="material-icons-round icon">
            home_work
          </span> Agence
        </a>
      </li>
      
    @endif
    <li class="side-menu-item">
      <a href="{{route('charges.index')}}">
        <span class="material-icons-round icon">
          paid
        </span> Charges
      </a>
    </li>
    <li class="side-menu-item">
      <a href="{{route('alertes.index')}}">
        <span class="material-icons-round icon">
          notification_important
        </span>Alertes
      </a>
    </li>
  </ul>
</aside>