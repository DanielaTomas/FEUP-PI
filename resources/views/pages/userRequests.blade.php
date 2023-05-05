@extends('layouts.app')

@section('content')
<?php $language = app()->getLocale();?>
<div class="p-5 m-5 bg-secondary rounded min-height">
    <button class="float-end btn btn-dark"><a class="nav-link text-light" href="{{route('create.event')}}"> Create Event Request</a></button>
    <div class="d-flex justify content-center link-light">
        <h2>Requests</h2>
    </div>

    <div class="my-5">
        <h3 class="my-4">Events</h3>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if(count(Auth::user()->events()->get()) > 0)
            <div class="row">
                @each('partials.userEventRequests', $events, 'event')
            </div>
        @else
            <p>You don't have any event requests yet.</p>
        @endif
        <h3>Services</h3>
        @if(count(Auth::user()->services()->get()) > 0)
            <div class="row">
                @each('partials.userServiceRequests', $services, 'service')
            </div>
        @else
            <p>You don't have any service requests yet.</p>
        @endif
    </div>
</div>
@endsection