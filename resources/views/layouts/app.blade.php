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
    <link type="text/css" href="{{ asset('css/app.css') }}" rel="stylesheet"  >

    <script   type="text/javascript" src={{ asset('js/bootstrap.bundle.js') }} defer> </script>
    <script    type="text/javascript" src={{ asset('js/app.js') }} defer> </script>
    @stack('pageJS')
</head>

<body class="d-flex flex-column min-vh-100">
<nav id="header" class="navbar navbar-expand-lg navbar-light bg-dark">
  <a class="navbar-brand text-light" href="/">UPdigital</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link text-light" href="#">My Requests <span class="sr-only"></span></a>
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
    </ul>
    @if (Auth::check())
    <form class="form-inline my-2 my-lg-0">
      <button class="btn btn-outline-success my-2 my-sm-0 text-light" type="submit"><a href="{{ url('/logout') }}">Logout </a></button>
    </form>
    @else
    <form class="form-inline my-2 my-lg-0">
      <button class="btn btn-outline-success my-2 my-sm-0 text-light" type="submit"><a href="{{ url('/login') }}">Login </a></button>
    </form>
    @endif
  </div>
</nav>

  @yield('content')

  <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 border-top bg-dark mt-auto">
    <p class="col-md-4 mb-0 text-light">© 2023 Company, Inc</p>

    <a href="/" class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
      <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
    </a>

    <ul class="nav col-md-4 justify-content-end">
      <li class="nav-item bg-dark"><a href="#" class="nav-link px-2 text-light">Home</a></li>
      <li class="nav-item bg-dark"><a href="#" class="nav-link px-2 text-light">My Requests</a></li>
      <li class="nav-item bg-dark"><a href="#" class="nav-link px-2 text-light">About Us</a></li>
      <li class="nav-item bg-dark"><a href="#" class="nav-link px-2 text-light">FAQs</a></li>
      <li class="nav-item bg-dark"><a href="#" class="nav-link px-2 text-light">Contacts</a></li>
    </ul>
  </footer>
</body>
</html>
