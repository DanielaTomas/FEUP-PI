@extends('layouts.app')

@section('content') 

@if (Auth::check())

<div class="p-5 m-5 bg-secondary rounded min-height">
    <div class="d-flex justify content-center link-light">
        <h3>Event Information:</h3>
    </div>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form class="my-4" method="POST" action="{{route('edit.event', ['id' => $event->eventid])}}" enctype="multipart/form-data" id="editeventform">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="eventname" class="form-label">Name<span><b class="text-danger">*</b></span></label>
                <input id="eventname" class="form-control" placeholder="Enter event name" type="text" name="eventname" value="{{$event->eventname}}" required autofocus>
                @if ($errors->has('eventname'))
                <span class="error">
                    {{ $errors->first('eventname') }}
                </span>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="address" class="form-label">Location<span><b class="text-danger">*</b></span></label>
                <input id="address" class="form-control" placeholder="Enter event location" type="text" name="address" value="{{ $event->address }}" required>
                @if ($errors->has('address'))
                <span class="error">
                    {{ $errors->first('address') }}
                </span>
                @endif
            </div>
        </div>
    </div>

    <div class="form-group my-3">
        <label for="description" class="form-label">Description<span><b class="text-danger">*</b></span></label>
        <!-- <input id="description" class="form-control" placeholder="Enter event description" type="text" name="description" value="{{ old('description') }}" required> -->
        <textarea id="description" rows="4" class="form-control" name="description"  placeholder="Enter event description" value="{{$event->description}}" required>{{$event->description}}</textarea>

        @if ($errors->has('description'))
        <span class="error">
            {{ $errors->first('description') }}
        </span>
        @endif
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="contactperson" class="form-label">Person to Contact (idk how to put it)<span><b class="text-danger">*</b></span></label>
                <input id="contactperson" placeholder="Enter event contact person" class="form-control" type="text" name="contactperson" value="{{ $event->contactperson }}" required>
                @if ($errors->has('contactperson'))
                <span class="error">
                    {{ $errors->first('contactperson') }}
                </span>
                @endif
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="form-group">
                <label for="email" class="form-label">Email<span><b class="text-danger">*</b></span></label>
                <input id="email" class="form-control" placeholder="Enter an email" type="email" name="email" value="{{$event->email}}" required>
                @if ($errors->has('email'))
                <span class="error">
                    {{ $errors->first('email') }}
                </span>
                @endif
            </div>
        </div>
    </div>

    <div class="row my-3">
        <div class="col-md-6">
            <div class="form-group">
                <label for="startdate" class="form-label">Start Date<span><b class="text-danger">*</b></span></label>
                <input type="date" class="form-control" id="startdate" name="startdate"
                value="{{ $event->startdate }}"
                min="<?php echo date('Y-m-d'); ?>"  required>
                @if ($errors->has('startdate'))
                <span class="error">
                    {{ $errors->first('startdate') }}
                </span>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="enddate" class="form-label">End Date</label>
                <input type="date" class="form-control" id="enddate" name="enddate"
                value="{{ $event->enddate }}"
                min="<?php echo date('Y-m-d'); ?>"  required>
                @if ($errors->has('enddate'))
                <span class="error">
                    {{ $errors->first('enddate') }}
                </span>
                @endif 
            </div>
        </div>
    </div> 

    <div class="form-group my-3">
        <label for="url" class="form-label">Url (<i>optional</i>)</label>
        <input id="url" class="form-control" placeholder="Enter event url" type="text" name="url" 
        @if ($event->url != null)
            value="{{ $event->url }}"
        @else
            value="{{ old('url')}}"
        @endif>
        @if ($errors->has('url'))
        <span class="error">
            {{ $errors->first('url') }}
        </span>
        @endif
    </div>

    <div class="form-group my-3">
        <label for="tags">Tags</label>
        <div class="overflow-auto my-2 bg-light rounded" style="height: 200px;">
            @foreach ($tags as $tag)
                <div class="form-check mx-2">
                    <label class="form-check-label" for="tags_{{ $tag->tagid }}">{{ $tag->tagname }}</label>
                    <input class="form-check-input" type="checkbox" name="tags[]" value="{{ $tag->tagid }}" 
                    @if (is_array(old('tags')) && in_array($tag->tagid, old('tags')) || $event->tags->contains($tag->tagid)) 
                        checked 
                    @endif
                    >
                </div>
            @endforeach
        </div>
    </div>

    <div class="col-md-12 text-center mt-5">
        <button type="submit" class="btn btn-dark"  id="editeventbutton" disabled>Edit Event</button>
    </div>
</form>

@else
<h1>YOU ARE NOT LOGGED IN</h1>
@endif
</div>

@endsection