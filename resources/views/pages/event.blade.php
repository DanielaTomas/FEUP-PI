@extends('layouts.app')

@section('content')

<div class="p-5 m-5 bg-secondary rounded min-height">
    <div class="d-flex justify content-center link-light">
        <h3> {{$event->eventname}} </h3>
    </div>

    <div class="py-5">
        <div class="card" style="width: 30rem; float:left; margin-right: 5rem;">
            <div class="card-body">
                <p class="card-text"><b>Start Date: </b>{{$event->startdate}}</p>
                <p class="card-text"><b>End Date: </b>{{$event->enddate}}</p>
                <p class="card-text"><b>Address: </b>{{$event->address}}</p>
                <p class="card-text"><b>Contact Person: </b>{{$event->contactperson}}</p>
                <p class="card-text"><b>Email: </b>{{$event->email}}</p>
            </div>
        </div>

        <div class="mx-5">
            <h5>Description</h5>
            <p>{{$event->description}}</p>
        </div>
    </div>
</div>

@endsection