@extends('layouts.app')

@section('content')

<div class="flex-column">
  <div class="p-1 mx-5 my-5 bg-secondary rounded">
    <div class="justify content-center link-light">
      <div class="justify content-center link-light mx-5 mt-5">
        Search for an event:
      </div>
      <div class="input-group pt-3 pb-5 px-5">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="28" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
          </svg></span>
        </div>
        <input type="text" class="form-control rounded" placeholder="Search..." aria-label="Username" aria-describedby="basic-addon1">
        <div class="d-flex justify-content-center align-content-center mx-1">
          <button type="button" class="btn btn-primary btn btn-secondary" data-bs-toggle="modal" data-bs-target="#advancedSearch">
            <a href="#" class="link-light">Advanced search</a>
          </button>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="container">
    <div class="row justify-content-center">
    <div class="col-auto">
      <h3>Events</h3>
      @if(count($organicUnits)>0)
      <ul>
        @foreach($organicUnits as $unit)
        @if($unit->events_count > 0)
          <li class="mt-3"><a href="/organicunits/{{$unit->organicunitid}}/events" class="text-dark">{{$unit->name}}</a><span class="mx-2 badge bg-secondary rounded-pill">{{$unit->events_count}}</span></li>
        @endif
        @endforeach
        </ul>
      @endif
      @if(count($tags) > 0)
        <ul>
        @foreach($tags as $tag)
          <li class="mt-3"><a href="/tags/{{$tag->tagid}}/events" class="text-dark">{{$tag->tagname}}</a><span class="mx-2 badge bg-secondary rounded-pill">{{$tag->events_count}}</span></li>
        @endforeach
        </ul>
        @else
        <h6 class="text-center"><i>There are no events yet</h6></i>
      @endif
      <ul>
        <li class="mt-3"><a href="/categories/events" class="text-dark">See all categories</a></li>
      </ul>
    </div>
    <div class="col-sm-4"></div>
    <div class="col-auto">
      <h3>Services</h3>
      <ul>
        <li class="mt-3"><a href="#" class="text-dark">item 1</a><span class="mx-2 badge bg-secondary rounded-pill">14</span></li>
        <li class="mt-2"><a href="#" class="text-dark">item 2</a><span class="mx-2 badge bg-secondary rounded-pill">5</span></li>
        <li class="mt-2"><a href="#" class="text-dark">item 3</a><span class="mx-2 badge bg-secondary rounded-pill">1</span></li>
      </ul>
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
            <div class="form-group">
            <div class="d-flex">
            <label for="exampleInputEmail1" class="form-label">Start date</label>
              <input type="date" id="date" class="form-label" name="startDate">
            <label for="exampleInputEmail1" class="form-label">to</label>
              <input type="date" id="date" class="form-label" name="endDate">
            </div>
            <div class="">(Leave blank for all dates)</div>
          </div>
          </div>
          <div class="form-group mb-3">
            <label for="exampleInputPassword1" class="form-label">Event Category</label>
            <select id="textSelect" class="select" class="form-label">
              <option value="1">One</option>
              <option value="2">Two</option>
              <option value="3">Three</option>
              <option value="4">Four</option>
              <option value="customOption">Other</option>
            </select>
          </div>
          <div class="form-group mb-3">
            <label for="exampleInputPassword1" class="form-label">Event Subcategory</label>
            <select id="textSelect" class="select" class="form-label">
              <option value="1">One</option>
              <option value="2">Two</option>
              <option value="3">Three</option>
              <option value="4">Four</option>
              <option value="customOption">Other</option>
            </select>
          </div>
          <div class="form-group mb-3">
            <label for="exampleInputPassword1" class="form-label">Search Term</label>
            <input type="text" class="form-control" class="form-label" placeholder="search" aria-label="Username" aria-describedby="basic-addon1">
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
