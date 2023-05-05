@extends('layouts.app')

@section('content') 
@if (Auth::check())

<div class="p-5 m-5 bg-secondary rounded min-height">
    <div class="d-flex justify-content-center m-auto link-light">
        <h3>{{$service->servicename->servicenameenglish}} Request</h3>
    </div>
    
    @include('partials.filledServiceQuestions',['serviceType' => $service->servicetype])

    <div class="form-group my-3">
        <label for="purpose" class="form-label">Purpose</label>
        @if($service->purpose == null)
        <p class="form-control"> </i>No purpose</i></p>
        @else
        <textarea id="purpose" rows="4" class="form-control" name="purpose" required placeholder="Enter the purpose the request">@if($service->purpose != null){{$service->purpose}} @endIf</textarea>
        @endIf
    </div>


    <div class="form-group">
        <label for="organicunitid">Organic Unit</label> 
        <br>
        <p class="form-control"> {{$service->organicunit->name}}</p>
    </div>

    <div class="form-group">
        <label for="contactperson" class="form-label">Person to Contact</label>
        @if($service->contactperson == null)
        <p class="form-control"> <i>No contact person</i></p>
        @else
        <p class="form-control"> {{$service->contactperson}}</p>
        @endIf
    </div>


    <div class="form-group">
        <label for="contactemail" class="form-label">Contact Email</label>
        @if($service->email == null)
        <p class="form-control"> <i>No contact email</i></p>
        @else
        <p class="form-control"> {{$service->email}}</p>
        @endIf
    </div>

    <div class="row my-3">
        <div class="col-md-6">
            <div class="form-group">
                <label for="startdate" class="form-label">Start Date</label>
                <p class="form-control"> {{$service->startdate}}</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="enddate" class="form-label">End Date</label>
                <p class="form-control"> {{$service->enddate}}</p>
            </div>
        </div>
    </div> 
</div>
@else
    <script>window.location = "/login";</script>
@endif
@endsection