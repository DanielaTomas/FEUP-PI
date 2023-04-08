@extends('layouts.app')

@section('content')
<h1>GOOD LUCK FRONTENDERS</h1>
<h1>Requests</h1>


<h3>Events</h3>

<div class="p-5 m-5 bg-secondary rounded min-height">
    <div class="row">
        @each('partials.userEventRequests', $events, 'event')
    </div>
</div>  
<h3>Services</h3>


@endsection