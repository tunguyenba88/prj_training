<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Navbar</a>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/profile">Profile</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/list">List User</a>
          </li>
        </ul>
      </div>
      <form action="{{route('logout')}}" method="GET">
        @csrf
        <button type="submit" class="btn btn-danger btn-rounded">Logout</button>
      </form>
    </div>
  </nav>

  @yield('navbar')
  