@extends('layouts.app')

@section('content')

<div class="p-5 m-5 bg-secondary rounded min-height">
    <div class="d-flex justify content-center link-light">
        <h3> {{$event->eventname}} </h3>
    </div>

    <div class="py-5">
        <div class="card" style="float:left; margin-right: 5rem; margin-bottom: 2rem;">
            <div class="card-body">
                <p class="card-text"><b>Start Date: </b>{{$event->startdate}}</p>
                <p class="card-text"><b>End Date: </b>{{$event->enddate}}</p>
                <p class="card-text"><b>Address: </b>{{$event->address}}</p>
                <p class="card-text"><b>Contact Person: </b>{{$event->contactperson}}</p>
                <p class="card-text"><b>Email: </b>{{$event->email}}</p>

                <p><b>Tags: </b>
                @if($event->tags()->count() > 0)
                    @foreach($event->tags()->get() as $tag)
                    <a href="/tags/{{$tag->tagid}}/events"><span class="badge bg-secondary rounded-pill">{{$tag->tagname}}</span></a>
                    @endforeach
                @else
                    N/A
                @endif
                </p>
            </div>
        </div>
        <h5>Description</h5>
        <p>{{$event->description}}</p>
    </div>
</div>

@endsection