@extends('layouts.app')

@section('content')

<div class="p-5 m-5 bg-secondary rounded min-height">
    <div class="d-flex justify content-center link-light">
        <h3>Admin Dashboard - Services</h3>
    </div>

<!-- Nav tabs -->
<ul class="nav m-3 nav-tabs nav-fill">
  <li class="nav-item text-light bg-dark rounded-top">
    <a class="nav-link active" data-bs-toggle="tab" href="#serviceRequests">Service Requests</a>
  </li>
  <li class="nav-item text-light bg-dark rounded-top">
    <a class="nav-link" data-bs-toggle="tab" href="#services">Services</a>
  </li>
  <li class="nav-item text-light bg-dark rounded-top">
    <a class="nav-link" data-bs-toggle="tab" href="#createservices">Create Service</a>
</ul>


<!-- Tab panes -->
<div class="tab-content mt-5">
  <div class="tab-pane container active" id="serviceRequests">
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
        </tbody>
    </table>
  </div>
  <div class="tab-pane container" id="services">
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

            </tbody>
        </table>
    </div>
    <div class="tab-pane container" id="createservices">
        <form class="my-4" method="POST" action="{{route('create.service')}}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="servicename" class="form-label">Name<span><b class="text-danger">*</b></span></label>
                        <div class="input-group mb-3">
                            <input id="servicename" class="form-control" placeholder="Enter service name" type="text" name="servicename" value="{{ old('servicename') }}" required autofocus>
                            @if ($errors->has('servicename'))
                            <span class="error">
                                {{ $errors->first('servicename') }}
                            </span>
                            @endif
                        </div>

                        <label for="description" class="form-label" >Description (optional)</label>
                        <div class="input-group mb-3">
                            <textarea id="purpose" rows="4" class="form-control" name="description" required placeholder="Enter the description">@if( old('description')!==null){{ old('description')}}@else @endIf</textarea>
                                @if ($errors->has('description'))
                                    <span class="error">
                                     {{ $errors->first('description') }}
                                    </span>
                                @endif
                            
                        </div>
                        <button type="submit" class="btn btn-dark">Create Service</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</div>




@endsection