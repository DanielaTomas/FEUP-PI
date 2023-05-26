@extends('layouts.app')

@section('content')
<?php $language = app()->getLocale();?>
<div class="m-auto">
<div class="p-5 m-5 bg-secondary rounded min-height">
    <button id="backButton" type="button" class="btn btn-secondary">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="White" class="bi bi-arrow-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
        </svg>
    </button>
    <div class="d-flex justify-content-center m-auto link-light">
        <h3 class="text-center text-light">@if($language=="pt"){{$service->servicenameportuguese}} @else {{$service->servicenameenglish}} @endif</h3>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6 my-5">
            <div class="card">
                <div class="card-body" >
                    <h5 class="card-title">Description</h5>
                    <p class="card-text">{{$service->description}}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center">
    <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#advancedSearch">
        <a class="nav-link text-light" href="{{ url('/service/'.$service->servicenameid.'/create') }}">Create Request</a>
        </button>
    </div>
</div>
</div>

@endsection
