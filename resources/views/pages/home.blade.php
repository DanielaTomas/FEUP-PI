@extends('layouts.app')

@section('content')
<div class ="d-flex flex-row">
    <div class="flex-grow-0 p-3 bg-dark flex-direction:column min-vh-100" id="navbarSupportedContent" style="width: 280px;">
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
              <li><a href="events" class="nav-link rounded text-light">Overview</a></li>
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

    <div class="flex-column mx-auto">
      <div class="justify-content-center align-content-center my-5"  style="width: 60em;">
        <div class="container border border-dark bg-secondary rounded">
          <div class="d-flex justify content-center link-light">
            Search for an event
          </div>
          <div class="input-group py-5 px-5">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="28" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
              </svg></span>
            </div>
            <input type="text" class="form-control" placeholder="Search..." aria-label="Username" aria-describedby="basic-addon1">
            <div class="d-flex justify-content-center align-content-center">
              <button type="button" class="btn btn-primary btn btn-secondary" data-bs-toggle="modal" data-bs-target="#advancedSearch">
                  <a href="#" class="link-light">Advanced search</a>
              </button>
            </div>
          </div>
        </div>
      </div>

      <div class="d-flex flex-row bd-highlight mb-3">
          <div>
            <h3>Events</h3>
            @if(count($tags) > 0)<!--TODO: add "nothing is here if condition is false --> 
              <ul>
              @foreach($tags as $tag)
                <li class="mt-3"><a href="/tags/{{$tag->tagid}}/events" class="text-dark">{{$tag->tagname}}</a><span class="mx-2 badge bg-secondary rounded-pill">{{$tag->events_count}}</span></li>
              @endforeach
              </ul>
            @endif
          </div>
          <div class="mx-auto">
            <h3>Services</h3>
            <ul>
              <li class="mt-3"><a href="#" class="text-dark">item 1</a><span class="mx-2 badge bg-secondary rounded-pill">14</span></li>
              <li class="mt-2"><a href="#" class="text-dark">item 2</a><span class="mx-2 badge bg-secondary rounded-pill">5</span></li>
              <li class="mt-2"><a href="#" class="text-dark">item 3</a><span class="mx-2 badge bg-secondary rounded-pill">1</span></li>
            </ul>
          </div>
      </div>

    </div>
</div>
  
<!-- Modal -->
<div class="modal fade" id="advancedSearch" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Advanced Search</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <div class="d-flex">
            <label for="exampleInputEmail1" class="form-label">Start date</label>
              <input type="date" id="date" name="startDate">
            <label for="exampleInputEmail1" class="form-label">to</label>
              <input type="date" id="date" name="endDate">
            </div>
            <div class="">(Leave blank for all dates)</div>
          </div>
          <div class="d-flex mb-3">
            <label for="exampleInputPassword1" class="form-label">Event Category</label>
            <select id="textSelect" class="select" style="display: inline;">
              <option value="1">One</option>
              <option value="2">Two</option>
              <option value="3">Three</option>
              <option value="4">Four</option>
              <option value="customOption">Other</option>
            </select>
          </div>
          <div class="d-flex mb-3">
            <label for="exampleInputPassword1" class="form-label">Event Subcategory</label>
            <select id="textSelect" class="select" style="display: inline;">
              <option value="1">One</option>
              <option value="2">Two</option>
              <option value="3">Three</option>
              <option value="4">Four</option>
              <option value="customOption">Other</option>
            </select>
          </div>
          <div class="d-flex mb-3">
            <label for="exampleInputPassword1" class="form-label">Search Term</label>
            <input type="text" class="form-control" placeholder="search" aria-label="Username" aria-describedby="basic-addon1">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


  
@endsection
