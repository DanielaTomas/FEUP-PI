@extends('layouts.app')

@section('content')
<?php $language = app()->getLocale();?>
<div class="m-auto">
<div class="p-5 m-5 bg-secondary rounded min-height">
    <div class="d-flex justify-content-center m-auto link-light">
        <h3 class="text-center text-light">@if($language=="pt"){{$service->servicenameportuguese}} @else {{$service->servicenameenglish}} @endif</h3>
    </div>
    <div class="row justify-content-center ">
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
</div>

@endsection
