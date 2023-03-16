@extends('layouts.app')

@section('content')
<div class="p-5 m-5 bg-secondary rounded min-height">
    <div class="d-flex justify content-center link-light">
        <h3>Admin Dashboard</h3>
    </div>
<!-- Nav tabs -->
<ul class="nav nav-tabs nav-fill">
  <li class="nav-item">
    <a class="nav-link active" data-bs-toggle="tab" href="#eventRequests">Event Requests</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-bs-toggle="tab" href="#serviceRequests">Service Requests</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-bs-toggle="tab" href="#events">Events</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-bs-toggle="tab" href="#services">Services</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-bs-toggle="tab" href="#giUsers">GI Users</a>
  </li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane container active" id="eventRequests">table 1</div>
  <div class="tab-pane container fade" id="serviceRequests">table 2</div>
  <div class="tab-pane container fade" id="events">table 3</div>
  <div class="tab-pane container fade" id="services">table 4</div>
  <div class="tab-pane container fade" id="giUsers">table 5</div>
</div>
</div>



@endsection