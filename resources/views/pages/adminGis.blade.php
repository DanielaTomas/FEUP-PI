@extends('layouts.app')

@section('content')

<div class="p-5 m-5 bg-secondary rounded min-height">
    <div class="d-flex justify content-center link-light">
        <h3>Admin Dashboard - GIs</h3>
    </div>

<!-- Nav tabs -->
<ul class="nav m-3 nav-tabs nav-fill">
  <li class="nav-item text-light bg-dark rounded-top">
    <a class="nav-link active" data-bs-toggle="tab" href="#giRequests">GI Requests</a>
  </li>
  <li class="nav-item text-light bg-dark rounded-top">
    <a class="nav-link" data-bs-toggle="tab" href="#users">Users</a>
  </li>
</ul>


<!-- Tab panes -->
<div class="tab-content mt-5">
  <div class="tab-pane container active" id="giRequests">
    <table class="table rounded rounded-3 overflow-hidden align-middle bg-white">
        <thead class="bg-light">
            <tr>
            <th>GI Requests</th>
            <th>Organizational Units</th>
            <th>Request Date</th>
            <th>Status</th>
            <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <div class="d-flex align-items-center">
                        <div class="ms-3">
                            <a href =""><p class="fw-bold mb-1">GI</p></a>
                            <p class="text-muted mb-0">gi1@up.pt</p>
                        </div>
                    </div>
                </td>
                <td>
                    <span class="badge bg-dark">Organizational Unit</span>
                </td>
                <td>
                    <p class="fw-normal mb-1">xxxx-xx-xx</p>
                    <p class="text-muted mb-0">00:00</p>
                </td>
                <td>
                    <span class="badge bg-warning">Pending Review</span>
                </td>
                <td>
                    <button type="button" class="btn btn-success">Accept</button>
                    <button type="button" class="btn btn-danger">Reject</button>
                </td>
            </tr>
        </tbody>
    </table>
  </div>
  <div class="tab-pane container" id="users">
  <input type="search" class="form-control my-5" placeholder="Search user" aria-label="Search">
  <table class="table rounded rounded-3 overflow-hidden align-middle bg-white">
        <thead class="bg-light">
            <tr>
            <th>Users</th>
            <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <div class="d-flex align-items-center">
                        <div class="ms-3">
                            <a href =""><p class="fw-bold mb-1">User</p></a>
                            <p class="text-muted mb-0">user@up.pt</p>
                        </div>
                    </div>
                </td>
                <td>
                    <button type="button" class="btn btn-success">Add GI</button>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="d-flex align-items-center">
                        <div class="ms-3">
                            <a href =""><p class="fw-bold mb-1">GI</p></a>
                            <p class="text-muted mb-0">gi@up.pt</p>
                        </div>
                    </div>
                </td>
                <td>
                    <button type="button" class="btn btn-danger">Remove GI</button>
                </td>
            </tr>
        </tbody>
    </table>
  </div>
</div>
</div>


@endsection