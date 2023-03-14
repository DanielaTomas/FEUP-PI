@extends('layouts.app')

@section('content')
<div class="flex-grow-0 p-3 bg-dark flex-direction:column" style="width: 280px;">
    <a href="/" class="d-flex align-items-center pb-3 mb-3 nav-link text-decoration-none border-bottom">
      <svg class="bi me-2" width="30" height="24"><use xlink:href="#bootstrap"></use></svg>
      <span class="fs-5 fw-semibold text-light">Yellow Pages</span>
    </a>
    <ul class="list-unstyled ps-0">
      <li class="mb-1">
        <button class="btn btn-toggle align-items-center rounded collapsed text-light" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="true">
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
        <button class="btn btn-toggle align-items-center rounded collapsed text-light" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false">
          Event Categories ↓
        </button>
        <div class="collapse" id="dashboard-collapse">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <li><a href="#" class="nav-link rounded text-light">Overview</a></li>
            <li><a href="#" class="nav-link rounded text-light">Weekly</a></li>
            <li><a href="#" class="nav-link rounded text-light">Monthly</a></li>
            <li><a href="#" class="nav-link rounded text-light">Annually</a></li>
          </ul>
        </div>
      </li>
      <li class="mb-1">
        <button class="btn btn-toggle align-items-center rounded collapsed text-light" data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="false">
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
        <button class="btn btn-toggle align-items-center rounded collapsed text-light" data-bs-toggle="collapse" data-bs-target="#account-collapse" aria-expanded="false">
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
@endsection
