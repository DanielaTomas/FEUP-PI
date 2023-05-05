@extends('layouts.app')

@section('content')

@push('pageJS')
<script   type="text/javascript" src={{ asset('js/adminService.js') }} defer> </script>
@endpush

<div class="p-5 m-5 bg-secondary rounded min-height">
    <div class="d-flex justify content-center link-light">
        <h3>Admin Dashboard - Services</h3>
    </div>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
  @endif
  @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif
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
  </li>
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
        <tbody id="pendingTable">
           
        </tbody>
    </table>
    <div id="pagePend" class="pagination justify-content-center">
        <li class="previous"><a class="page-link" href="page=1">Previous</a></li>
        <li class="next"><a class="page-link" href="page=2">Next</a></li>
    </div>
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
            <tbody id="CurrServiceTable">

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