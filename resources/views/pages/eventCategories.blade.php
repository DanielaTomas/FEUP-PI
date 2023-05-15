@extends('layouts.app')

@section('content')
<?php $language = app()->getLocale();?>

<div class="p-5 m-5 bg-secondary rounded min-height">
  <button id="backButton" type="button" class="btn btn-secondary"><a href=""><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="White" class="bi bi-arrow-left" viewBox="0 0 16 16">
    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
  </svg></a>
  </button>
    <div class="d-flex justify-content-center link-light">
       <h3> Event Categories 
      </h3>
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
    <div class="container">
    <div class="row">
    <div class="col">
        <ul>
            @foreach($tags as $tag)
            @if($language=="pt")
            <li class="mt-3"><a href="/tags/{{$tag->tagid}}/events" class="text-white">{{$tag->tagnameportuguese}}</a><span class="mx-2 badge bg-dark rounded-pill">{{$tag->events_count}}</span></li>
            @else
            <li class="mt-3"><a href="/tags/{{$tag->tagid}}/events" class="text-white">{{$tag->tagnameenglish}}</a><span class="mx-2 badge bg-dark rounded-pill">{{$tag->events_count}}</span></li>
            @endif
            @endforeach
        </ul>
    </div>
    
    <div class="col">
        <ul>
            @foreach($organicunits as $unit)
            <li class="mt-3"><a href="/organicunits/{{$unit->organicunitid}}/events" class="text-white">{{$unit->name}}</a><span class="mx-2 badge bg-dark rounded-pill">{{$unit->events_count}}</span></li>
            @endforeach
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
</div>
@endsection

