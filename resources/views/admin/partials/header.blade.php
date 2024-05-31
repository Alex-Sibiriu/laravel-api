<header class="bg-black pe-5 border-bottom border-secondary">
  <nav class="navbar navbar-expand-lg p-0">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <div class="logo text-center">
        <img src="{{ Vite::asset('resources/img/logo.png') }}" alt="">
      </div>
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-white py-3 fw-medium fs-5" aria-current="page" href="{{ route('home') }}"
            target="_blanck">Sito
            Pubblico</a>
        </li>
      </ul>

      <form class="d-flex ms-auto me-5" action="{{ route('admin.projects.index') }}" method="GET">
        <input name="search_project" class="form-control me-2" type="text" placeholder="Search">
        <button class="btn btn-outline-primary" type="submit">Search</button>
      </form>

      <ul class="navbar-nav">
        <li class="nav-item align-content-center me-3  text-white">
          Benvenuto <a class="text-decoration-none"
            href="{{ url('profile') }}"><strong>{{ Auth::user()->name }}</strong></a>
        </li>
        <li class="nav-item">
          <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger"><i class="fa-solid fa-arrow-right-from-bracket"></i></button>
          </form>
        </li>
      </ul>

    </div>
  </nav>
</header>
