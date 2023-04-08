@extends('layouts.app')

@section('content')
<h1>GOOD LUCK FRONTENDERS</h1>
<h1>Requests</h1>


<h3>Events</h3>
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<div class="p-5 m-5 bg-secondary rounded min-height">
    <div class="row">
        @each('partials.userEventRequests', $events, 'event')
    </div>

    
</div>  
<a class="nav-link text-dark" href="{{route('create.event')}}"> Create Event Request</a>
<h3>Services</h3>


@endsection