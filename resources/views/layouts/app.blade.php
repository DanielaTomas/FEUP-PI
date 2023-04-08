<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Styles -->
    <link type="text/css" href="{{ asset('css/bootstrap.css') }}" rel="stylesheet"  >
    <!--CSS to Overide-->
    <link type="text/css" href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script   type="text/javascript" src={{ asset('js/bootstrap.bundle.js') }} defer> </script>
    <script    type="text/javascript" src={{ asset('js/app.js') }} defer> </script>
    @stack('pageJS')
</head>

<body class="d-flex flex-column min-vh-100">

  <header class="p-3 bg-dark">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
          <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="White" class="bi bi-house-door-fill" viewBox="0 0 16 16">
            <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5Z"/>
          </svg>
        </a>

        <button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample" style="background-color:transparent">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="White" class="bi bi-list" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
          </svg>
        </button>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="#" class="nav-link px-2 link-secondary">My Requests</a></li>
          <li><a href="#" class="nav-link px-2 link-secondary">Abouts US</a></li>
          <li><a href="#" class="nav-link px-2 link-secondary">Contacts</a></li>
          <li><a href="#" class="nav-link px-2 link-secondary">Products</a></li>
        </ul>

        <!--<form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
          <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
        </form>-->
        @if(Auth::check())
        <div class="dropdown text-end">
          <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://github.com/mdo.png" alt="mdo" class="rounded-circle" width="32" height="32">
          </a>
          <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1" style="">
            <li><a class="dropdown-item" href="#">My Requests</a></li>
            <li><a class="dropdown-item" href="#">My Events</a></li>
            <li><a class="dropdown-item" href="#">Settings</a></li>
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="{{ url('/logout')}}">Sign out</a></li>
          </ul>
        </div>
        @else
        <form class="form-inline my-2 my-lg-0">
          <button class="btn btn btn-secondary my-2 my-sm-0 text-light" type="submit">
            <a class="text-decoration-none text-dark" href="{{ url('/login') }}">Login </a>
          </button>
        </form>
        @endif
      </div>
    </div>
  </header>

  </button>

  

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link text-light" href="{{route('my.requests')}}">My Requests <span class="sr-only"></span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light" href="#">About Us</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled text-light" href="#">Contacts</a>
      </li>
      @if (Auth::check())
      <li class="nav-item">
        <a class="nav-link text-light" href="{{route('create.event')}}"> Create Event Request</a>
      </li>
      @endif
    </ul>
    @if (Auth::check())
    <form class="form-inline my-2 my-lg-0">
      <button class="btn btn-outline-success my-2 my-sm-0 text-light" type="submit"><a href="{{ route('logout') }}">Logout </a></button>
    </form>
    @else
    <form class="form-inline my-2 my-lg-0">
      <button class="btn btn-outline-success my-2 my-sm-0 text-light" type="submit"><a href="{{ route('login') }}">Login </a></button>
    </form>
    @endif
  </div>
</nav>

<div class="offcanvas offcanvas-start bg-dark" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
  <div class="offcanvas-header justify-content-center">
    <h5 class="offcanvas-title text-white" id="offcanvasExampleLabel">Paginas Amarelas</h5>
      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <hr id="hrSide">
  <div class="offcanvas-body text-white">
    <ul class="list-unstyled ps-0">
      <li class="mb-1">
        <button id="sideButton" class="btn btn-toggle align-items-center rounded collapsed text-light" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="true">
          Home ↓
        </button>
        <div class="collapse" id="home-collapse">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <li><a href="#" class="nav-link rounded text-light">Overview</a></li>
            <li><a href="#" class="nav-link rounded text-light">Updates</a></li>
            <li><a href="#" class="nav-link rounded text-light">Reports</a></li>
          </ul>
        </div>
      </li>
      <li class="mb-1">
        <button id="sideButton" class="btn btn-toggle align-items-center rounded collapsed text-light" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false">
          Event Categories ↓
        </button>
        <div class="collapse" id="dashboard-collapse">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <li><a href="events" class="nav-link rounded text-light">Overview</a></li>
            <li><a href="#" class="nav-link rounded text-light">Weekly</a></li>
            <li><a href="#" class="nav-link rounded text-light">Monthly</a></li>
            <li><a href="#" class="nav-link rounded text-light">Annually</a></li>
          </ul>
        </div>
      </li>
      <li class="mb-1">
        <button id="sideButton" class="btn btn-toggle align-items-center rounded collapsed text-light" data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="false">
          Category 1 ↓
        </button>
        <div class="collapse" id="orders-collapse">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <li><a href="#" class="nav-link rounded text-light">New</a></li>
            <li><a href="#" class="nav-link rounded text-light">Processed</a></li>
            <li><a href="#" class="nav-link rounded text-light">Shipped</a></li>
            <li><a href="#" class="nav-link rounded text-light">Returned</a></li>
          </ul>
        </div>
      </li>
      <li class="mb-1">
        <button id="sideButton"class="btn btn-toggle align-items-center rounded collapsed text-light" data-bs-toggle="collapse" data-bs-target="#account-collapse" aria-expanded="false">
          Category 2 ↓
        </button>
        <div class="collapse" id="account-collapse">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <li><a href="#" class="nav-link rounded text-light">New...</a></li>
            <li><a href="#" class="nav-link rounded text-light">Profile</a></li>
            <li><a href="#" class="nav-link rounded text-light">Settings</a></li>
            <li><a href="#" class="nav-link rounded text-light">Sign out</a></li>
          </ul>
        </div>
      </li>
    </ul>
  </div>
</div>

  @yield('content')

  <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 bg-dark mt-auto">
    <p class="col-md-4 mb-0 text-light p-3">© 2023 Company, Inc ඞ</p>

    <a href="/" class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
      <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
    </a>

    <ul class="nav col-md-4 justify-content-end px-3">
      <li class="nav-item bg-dark"><a href="#" class="nav-link px-2 text-light">Home</a></li>
      <li class="nav-item bg-dark"><a href="#" class="nav-link px-2 text-light">My Requests</a></li>
      <li class="nav-item bg-dark"><a href="#" class="nav-link px-2 text-light">About Us</a></li>
      <li class="nav-item bg-dark"><a href="#" class="nav-link px-2 text-light">FAQs</a></li>
      <li class="nav-item bg-dark"><a href="#" class="nav-link px-2 text-light">Contacts</a></li>
    </ul>
  </footer>
</body>
</html>
