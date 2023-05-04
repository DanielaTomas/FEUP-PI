@extends('layouts.app')

@section('content')
<?php $language = app()->getLocale();?>
<div class="p-5 m-5 bg-secondary rounded min-height">
    <div class="d-flex justify-content-center m-auto link-light">
        <h3 class="text-center text-light">@if($language=="pt"){{$service->servicenameportuguese}} @else {{$service->servicenameenglish}} @endif</h3>
    </div>
    <div class="row justify-content-center ">
        {{-- <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                        <div class="text-center m-auto">
                                <img class="rounded" src="https://picsum.photos/150/150" width="250" height="200" alt="Card image cap">
                        </div>
                    <div class="row">
                        <div class="col-md-8">
                            <p class="card-text"><b>CENAS </b></p>
                            <p class="card-text"><b>CENAS </b></p>
                            <p class="card-text"><b>CENAS </b></p>
                            <p class="card-text"><b>CENAS </b></p>
                            <p class="card-text"><b>CENAS </b></p>
                            <p><b>Tags: </b>
{{--                             @if($event->tags()->count() > 0)
                                @foreach($event->tags()->get() as $tag)
                                <a href="/tags/{{$tag->tagid}}/events"><span class="badge bg-secondary rounded-pill">{{$tag->tagnameenglish}}</span></a>
                                @endforeach
                                <a href="/organicunits/{{$event->organicunit->organicunitid}}/events"><span class="badge bg-secondary rounded-pill">{{$event->organicunit->name}}</span></a>
                            @else
                                N/A
                            @endif 
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="col-md-6 m-auto">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Description</h5>
                    <p class="card-text">{{$service->description}}</p>
                </div>
            </div>
        </div>
        
    </div>
    <div class="text-center">
    <button type="button" class="btn btn-secondary mt-5 border" data-bs-toggle="modal" data-bs-target="#advancedSearch">
        <a class="text-decoration-none text-white" href="{{ url('/service/'.$service->servicenameid.'/create') }}">Create Request</a>
        </button>
    </div>
</div>

@endsection
