@extends('layouts.app')

@section('content')


<p id="serviceNamesList" hidden>@foreach($serviceNames as $service) {{$service->servicenameenglish}},@endforeach</p>

@push('pageJS')
<script   type="text/javascript" src={{ asset('js/adminService.js') }} defer> </script>
@endpush



<div id="adminContainer" class="p-5 m-5 bg-secondary rounded min-height">
    <button id="backButton" type="button" class="btn btn-secondary"><a href=""><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="White" class="bi bi-arrow-left" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
      </svg></a>
      </button>
    <div class="d-flex justify-content-center link-light">

        <h3>Admin Dashboard - Services</h3>
    </div>

    {{-- @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
  @endif --}}
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
    <div class="tab-pane container active table-responsive" id="serviceRequests">
            <div class="table-responsive">
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
        </div>
        <div class="tab-pane container table-responsive" id="services">
            <div class="table-responsive">
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
        </div>

        <div class="tab-pane container" id="createservices">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form class="my-4" method="POST" action="{{route('new.service')}}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="servicenameportuguese" class="form-label">Nome Português<span><b class="text-danger">*</b></span></label>
                            <div class="input-group mb-3">
                                <input id="servicenameportuguese" class="form-control" placeholder="Enter service name" type="text" name="servicenameportuguese" value="{{ old('servicenameportuguese') }}" required autofocus>
                                @if ($errors->has('servicenameportuguese'))
                                <span class="error">
                                    {{ $errors->first('servicenameportuguese') }}
                                </span>
                                @endif
                            </div>

                            <label for="servicenameenglish" class="form-label">English Name<span><b class="text-danger">*</b></span></label>
                            <div class="input-group mb-3">
                                <input id="servicenameenglish" class="form-control" placeholder="Enter service name" type="text" name="servicenameenglish" value="{{ old('servicenameenglish') }}" required autofocus>
                                @if ($errors->has('servicenameenglish'))
                                <span class="error">
                                    {{ $errors->first('servicenameenglish') }}
                                </span>
                                @endif
                            </div>
                            <p>Organic Units that offer that service <span><b class="text-danger">*</b></span></p>
                            <select class="form-select" id="organicunitid" name="organicunitid[]" multiple required>
                                @foreach ($organicunits as $unit)
                                <option value="{{$unit->organicunitid}}">{{$unit->name}}</option>
                                @endforeach 
                            </select>


                            <label for="description" class="form-label" >Description (optional)</label>
                            <div class="input-group mb-3">
                                <textarea id="purpose" rows="4" class="form-control" name="description"  placeholder="Enter the description">@if( old('description')!==null){{ old('description')}}@else @endIf</textarea>
                                    @if ($errors->has('description'))
                                        <span class="error">
                                        {{ $errors->first('description') }}
                                        </span>
                                    @endif
                            </div>

                            <label for="question1" class="form-label">Question 1<span><b class="text-danger">*</b></span></label>
                            <div>
                                <input id="question1" class="form-control" placeholder="Enter question 1" type="text" name="question1" value="{{ old('question1') }}" required autofocus>
                                @if ($errors->has('question1'))
                                <span class="error">
                                    {{ $errors->first('question1') }}
                                </span>
                                @endif
                            </div>

                            <label for="question2" class="form-label">Question 2 (optional)</label>
                            <div>
                                <input id="question2" class="form-control" placeholder="Enter question 2" type="text" name="question2" value="{{ old('question2') }}"  autofocus>
                                @if ($errors->has('question2'))
                                <span class="error">
                                    {{ $errors->first('question2') }}
                                </span>
                                @endif
                            </div>
                            
                            <label for="question3" class="form-label">Question 3 (optional)</label>
                            <div>
                                <input id="question3" class="form-control" placeholder="Enter question 3" type="text" name="question3" value="{{ old('question3') }}"  autofocus>
                                @if ($errors->has('question3'))
                                <span class="error">
                                    {{ $errors->first('question3') }}
                                </span>
                                @endif
                            </div>

                            <label for="question4" class="form-label">Question 4 (optional)</label>
                            <div>
                                <input id="question4" class="form-control" placeholder="Enter question 4" type="text" name="question4" value="{{ old('question4') }}"  autofocus>
                                @if ($errors->has('question4'))
                                <span class="error">
                                    {{ $errors->first('question4') }}
                                </span>
                                @endif
                            </div>

                            <label for="question5" class="form-label">Question 5 (optional)</label>
                            <div>
                                <input id="question5" class="form-control" placeholder="Enter question 5" type="text" name="question5" value="{{ old('question5') }}"  autofocus>
                                @if ($errors->has('question5'))
                                <span class="error">
                                    {{ $errors->first('question5') }}
                                </span>
                                @endif
                            </div>

                            <label for="question6" class="form-label">Question 6 (optional)</label>
                            <div>
                                <input id="question6" class="form-control" placeholder="Enter question 6" type="text" name="question6" value="{{ old('question6') }}"  autofocus>
                                @if ($errors->has('question6'))
                                <span class="error">
                                    {{ $errors->first('question6') }}
                                </span>
                                @endif
                            </div>

                            <label for="question7" class="form-label">Question 7 (optional)</label>
                            <div>
                                <input id="question7" class="form-control" placeholder="Enter question 7" type="text" name="question7" value="{{ old('question7') }}"  autofocus>
                                @if ($errors->has('question7'))
                                <span class="error">
                                    {{ $errors->first('question7') }}
                                </span>
                                @endif
                            </div>

                            <label for="question8" class="form-label">Question 8 (optional)</label>
                            <div>
                                <input id="question8" class="form-control" placeholder="Enter question 8" type="text" name="question8" value="{{ old('question8') }}"  autofocus>
                                @if ($errors->has('question8'))
                                <span class="error">
                                    {{ $errors->first('question8') }}
                                </span>
                                @endif
                            </div>

                            <label for="question9" class="form-label">Question 9 (optional)</label>
                            <div>
                                <input id="question9" class="form-control" placeholder="Enter question 9" type="text" name="question9" value="{{ old('question9') }}"  autofocus>
                                @if ($errors->has('question9'))
                                <span class="error">
                                    {{ $errors->first('question9') }}
                                </span>
                                @endif
                            </div>

                            <label for="question10" class="form-label">Question 10 (optional)</label>
                            <div>
                                <input id="question10" class="form-control" placeholder="Enter question 10" type="text" name="question10" value="{{ old('question10') }}"  autofocus>
                                @if ($errors->has('question10'))
                                <span class="error">
                                    {{ $errors->first('question10') }}
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