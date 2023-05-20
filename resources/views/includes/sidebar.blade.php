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
      <a href="/clients">
        <span class="material-icons-round icon">groups</span> Clients
      </a>
    </li>
    <li class="side-menu-item">
      <a href="/vehicules">
        <span class="material-icons-round icon">
          directions_car
        </span> Véhicules
      </a>
    </li>
    <li class="side-menu-item">
      <a href="/reservations">
        <span class="material-icons-round icon">
          list_alt
        </span> Résevations
      </a>
    </li>
    <li class="side-menu-item">
      <a href="/contrats">
        <span class="material-icons-round icon">
          description
        </span> Contrats
      </a>
    </li>
    @if(auth()->user()->role === 'admin')
      <li class="side-menu-item">
        <a href="/users">
          <span class="material-icons-round icon">
            badge
          </span> Utilisateurs
        </a>
      </li>
    @endif
    <li class="side-menu-item">
      <a href="/charges">
        <span class="material-icons-round icon">
          paid
        </span> Charges
      </a>
    </li>
    <li class="side-menu-item">
      <a href="/alerts">
        <span class="material-icons-round icon">
          notification_important
        </span>Alerts
      </a>
    </li>
  </ul>
</aside>