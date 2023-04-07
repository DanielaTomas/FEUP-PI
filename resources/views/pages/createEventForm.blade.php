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

<form class="my-4" method="POST" action="{{route('create_event')}}" enctype="multipart/form-data">
    {{ csrf_field() }}

    <label for="eventname" class="form-label">Name<span><b class="text-danger">*</b></span></label>
    <input id="eventname" class="form-control" type="text" name="eventname" value="{{ old('eventname') }}" required autofocus>
    @if ($errors->has('eventname'))
      <span class="error">
          {{ $errors->first('eventname') }}
      </span>
    @endif

    <label for="address" class="form-label">Location<span><b class="text-danger">*</b></span></label>
    <input id="address" class="form-control" type="text" name="address" value="{{ old('address') }}" required autofocus>
    @if ($errors->has('address'))
      <span class="error">
          {{ $errors->first('address') }}
      </span>
    @endif

    <label for="url" class="my-5">Url (<i>optional</i>)</label>
    <input id="url" type="text" name="url" value="{{ old('url') }}" autofocus>
    @if ($errors->has('url'))
      <span class="error">
          {{ $errors->first('url') }}
      </span>
    @endif

    <label for="email">Email<span><b class="text-danger">*</b></span></label>
    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
    @if ($errors->has('email'))
      <span class="error">
          {{ $errors->first('email') }}
      </span>
    @endif

    <label for="contactperson">Person to Contact (idk how to put it)<span><b class="text-danger">*</b></span></label>
    <input id="contactperson" type="text" name="contactperson" value="{{ old('contactperson') }}" required autofocus>
    @if ($errors->has('contactperson'))
      <span class="error">
          {{ $errors->first('contactperson') }}
      </span>
    @endif

    <label for="description">Description<span><b class="text-danger">*</b></span></label>
    <input id="description" type="text" name="description" value="{{ old('description') }}" required autofocus>
    @if ($errors->has('description'))
      <span class="error">
          {{ $errors->first('description') }}
      </span>
    @endif

    <label for="startdate">Start Date<span><b class="text-danger">*</b></span></label>
    <input type="date" id="startdate" name="startdate"
      value="<?php echo date('Y-m-d'); ?>"
       min="<?php echo date('Y-m-d'); ?>"  required>
    @if ($errors->has('startdate'))
      <span class="error">
          {{ $errors->first('startdate') }}
      </span>
    @endif

    <label for="enddate">End Date</label>
    <input type="date" id="enddate" name="enddate"
      value="<?php echo date('Y-m-d'); ?>"
       min="<?php echo date('Y-m-d'); ?>"  required>
    @if ($errors->has('enddate'))
      <span class="error">
          {{ $errors->first('enddate') }}
      </span>
    @endif  

    <div class="form-group my-5">
        <label for="tags">Tags</label>
        <div class="overflow-auto my-2" style="height: 200px;">
            @foreach ($tags as $tag)
                <div class="form-check">
                    <label class="form-check-label" for="tags_{{ $tag->tagid }}">{{ $tag->tagname }}</label>
                    <input class="form-check-input" type="checkbox" name="tags[]" value="{{ $tag->tagid }}" 
                    @if (is_array(old('tags')) && in_array($tag->tagid, old('tags'))) 
                        checked 
                    @endif
                    >
                </div>
            @endforeach
        </div>
    </div>
    <br>

    <button type="submit" class="btn btn-dark">Create Event</button>

</form>

@else
<h1>YOU ARE NOT LOGGED IN</h1>
@endif
</div>

@endsection