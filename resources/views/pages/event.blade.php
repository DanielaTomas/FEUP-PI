@extends('layouts.app')

@section('content')

@push('pageJS')
<script   type="text/javascript" src={{ asset('js/event.js') }} defer> </script>
@endpush

<div id="organicUnitName" style="display:none">{{$event->organicunit->name}}</div>

<div id="eventContainer" class="p-5 m-5 bg-secondary rounded min-height">
    <div class="d-flex justify-content-center m-auto link-light">
        <h3 class="text-center text-light">{{$event->eventnameenglish}}</h3>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                        <div class="text-center m-auto">
                                <img class="rounded" src="https://picsum.photos/150/150" width="250" height="200" alt="Card image cap">
                        </div>
                    <div class="row">
                        <div class="col-md-8">
                            <p class="card-text"><b>Start Date: </b>{{$event->startdate}}</p>
                            <p class="card-text"><b>End Date: </b>{{$event->enddate}}</p>
                            <p class="card-text"><b>Address: </b>{{$event->address}}</p>
                            <p class="card-text"><b>Contact Person: </b>{{$event->contactperson}}</p>
                            <p class="card-text"><b>Email: </b>{{$event->email}}</p>
                            <p><b>Tags: </b>
                            @if($event->tags()->count() > 0)
                                @foreach($event->tags()->get() as $tag)
                                <a id="eventTag" href="/tags/{{$tag->tagid}}/events"><span class="badge bg-secondary rounded-pill">{{$tag->tagnameenglish}}</span></a>
                                @endforeach
                                <a id="eventTag" href="/organicunits/{{$event->organicunit->organicunitid}}/events"><span id="eventTag" class="badge bg-secondary rounded-pill">{{$event->organicunit->name}}</span></a>
                            @else
                                N/A
                            @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 m-auto">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Description</h5>
                    <p class="card-text">{{$event->description}}</p>
                    <p class="card-text"><b>Url English: </b>{{$event->urlenglish}}</p>
                    <p class="card-text"><b>Url Portuguese: </b>{{$event->urlportuguese}}</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


