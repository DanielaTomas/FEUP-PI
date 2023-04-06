@extends('layouts.app')

@section('content')

<div class="p-5 m-5 bg-secondary rounded min-height">
    <div class="d-flex justify content-center link-light">
        <h3>Admin Dashboard</h3>
    </div>

<!-- Nav tabs -->
<ul class="nav m-3 nav-tabs nav-fill">
  <li class="nav-item text-light bg-dark rounded-top">
    <a class="nav-link active" data-bs-toggle="tab" href="#eventRequests">Event Requests</a>
  </li>
  <li class="nav-item text-light bg-dark rounded-top">
    <a class="nav-link" data-bs-toggle="tab" href="#serviceRequests">Service Requests</a>
  </li>
  <li class="nav-item text-light bg-dark rounded-top">
    <a class="nav-link" data-bs-toggle="tab" href="#events">Events</a>
  </li>
  <li class="nav-item text-light bg-dark rounded-top">
    <a class="nav-link" data-bs-toggle="tab" href="#services">Services</a>
  </li>
  <li class="nav-item text-light bg-dark rounded-top">
    <a class="nav-link" data-bs-toggle="tab" href="#giUsers">GI Users</a>
  </li>
</ul>

<!-- Tab panes -->
<div class="tab-content mt-5">
  <div class="tab-pane container active" id="eventRequests">
    <table class="table rounded rounded-3 overflow-hidden align-middle bg-white">
        <thead class="bg-light">
            <tr>
            <th>Event</th>
            <th>Request Date</th>
            <th>Type</th>
            <th>Status</th>
            <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @if(count($pendingEvents) > 0)<!--TODO: add "nothing is here if condition is false --> 
                @each('partials.adminDashboardEntry', $pendingEvents, 'event')
            @endif
        </tbody>
    </table>
  </div>
  <div class="tab-pane container" id="serviceRequests">
  <table class="table rounded rounded-3 overflow-hidden align-middle bg-white">
        <thead class="bg-light">
            <tr>
            <th>Service</th>
            <th>Request Date</th>
            <th>Type</th>
            <th>Status</th>
            <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <div class="d-flex align-items-center">
                        <div class="ms-3">
                            <a href =""><p class="fw-bold mb-1">Service 1</p></a>
                            <p class="text-muted mb-0">service1@up.pt</p>
                        </div>
                    </div>
                </td>
                <td>
                    <p class="fw-normal mb-1">xxxx-xx-xx</p>
                    <p class="text-muted mb-0">00:00</p>
                </td>
                <td>
                    <span class="badge bg-info">Edit</span>
                </td>
                <td>
                    <span class="badge bg-warning">Pending Review</span>

                </td>
                <td>
                    <button type="button" class="btn btn-success">Accept</button>
                    <button type="button" class="btn btn-danger">Reject</button>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="d-flex align-items-center">
                        <div class="ms-3">
                            <a href =""><p class="fw-bold mb-1">Service 2</p></a>
                            <p class="text-muted mb-0">service2@up.pt</p>
                        </div>
                    </div>
                </td>
                <td>
                    <p class="fw-normal mb-1">xxxx-xx-xx</p>
                    <p class="text-muted mb-0">00:00</p>
                </td>
                <td>
                    <span class="badge bg-primary">Create</span>
                </td>
                <td>
                    <span class="badge bg-success">Accepted</span>
                </td>
                <td>
                    <p class="fw-normal mb-1">Request Reviewd</p>
                    <p class="text-muted mb-0">xxxx-xx-xx 00:00</p>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="d-flex align-items-center">
                        <div class="ms-3">
                            <a href =""><p class="fw-bold mb-1">Service 3</p></a>
                            <p class="text-muted mb-0">service3@up.pt</p>
                        </div>
                    </div>
                </td>
                <td>
                <p class="fw-normal mb-1">xxxx-xx-xx</p>
                    <p class="text-muted mb-0">00:00</p>
                </td>
                <td>
                    <span class="badge bg-secondary">Archive</span>
                </td>
                <td>
                    <span class="badge bg-danger">Rejected</span>          
                </td>
                <td>
                    <p class="fw-normal mb-1">Request Reviewd</p>
                    <p class="text-muted mb-0">xxxx-xx-xx 00:00</p>
                </td>
            </tr>
        </tbody>
    </table>
  </div>
  <div class="tab-pane container" id="events">
    <table class="table rounded rounded-3 overflow-hidden align-middle bg-white">
        <thead class="bg-light">
            <tr>
            <th>Event</th>
            <th>Request Date</th>
            <th>Type</th>
            <th>Status</th>
            <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @if(count($pendingEvents) > 0)<!--TODO: add "nothing is here if condition is false --> 
                @each('partials.adminDashboardEntry', $events, 'event')
            @endif
        </tbody>
    </table>
  </div>
  <div class="tab-pane container" id="services">services table</div>
  <div class="tab-pane container" id="giUsers">gi users table</div>
</div>
</div>



@endsection