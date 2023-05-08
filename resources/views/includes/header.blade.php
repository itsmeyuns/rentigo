<header class="header">
  <div class="menu-icon toggle-sidebar">
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
        <span class="user">{{auth()->user()->login}}</span>
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
          <a href="{{ route('logout') }}"
          onclick="event.preventDefault();
          document.getElementById('logout-form').submit();"
          >
            <span class="material-icons-round">
              logout
            </span>
            Déconnexion
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
        </li>
      </ul>
    </div>
  </a>
</header>