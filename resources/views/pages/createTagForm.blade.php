@extends('layouts.app')

@section('content') 

@if (Auth::check())

<div class="p-5 m-5 bg-secondary rounded min-height">
    <div class="d-flex justify content-center link-light">
        <h3>Tag Information:</h3>
    </div>
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form class="my-4" method="POST" action="{{route('create.tag')}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="tagname" class="form-label">Name<span><b class="text-danger">*</b></span></label>
                <input id="tagname" class="form-control" placeholder="Enter tag name" type="text" name="tagname" value="{{ old('tagname') }}" required autofocus>
                @if ($errors->has('tagname'))
                <span class="error">
                    {{ $errors->first('tagname') }}
                </span>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-12 text-center mt-5">
        <button type="submit" class="btn btn-dark">Create Tag</button>
    </div>
</form>

@else
<h1>YOU ARE NOT LOGGED IN</h1>
@endif
</div>

@endsection