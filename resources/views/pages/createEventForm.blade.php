@extends('layouts.app')

@section('content') 

<h1>GOOD LUCK FRONT ENDERS</h1>
@if (Auth::check())


<h3>Event Information:</h3>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{route('create_event')}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <label for="eventname">Name*</label>
    <input id="eventname" type="text" name="eventname" value="{{ old('eventname') }}" required autofocus>
    @if ($errors->has('eventname'))
      <span class="error">
          {{ $errors->first('eventname') }}
      </span>
    @endif
    <br>
    <br>
    <label for="address">Location*</label>
    <input id="address" type="text" name="address" value="{{ old('address') }}" required autofocus>
    @if ($errors->has('address'))
      <span class="error">
          {{ $errors->first('address') }}
      </span>
    @endif

    <label for="url">Url(optional)</label>
    <input id="url" type="text" name="url" value="{{ old('url') }}" autofocus>
    @if ($errors->has('url'))
      <span class="error">
          {{ $errors->first('url') }}
      </span>
    @endif

    <label for="email">Email*</label>
    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
    @if ($errors->has('email'))
      <span class="error">
          {{ $errors->first('email') }}
      </span>
    @endif

    <label for="contactperson">Person to Contact (idk how to put it)*</label>
    <input id="contactperson" type="text" name="contactperson" value="{{ old('contactperson') }}" required autofocus>
    @if ($errors->has('contactperson'))
      <span class="error">
          {{ $errors->first('contactperson') }}
      </span>
    @endif

    <label for="description">Description*</label>
    <input id="description" type="text" name="description" value="{{ old('description') }}" required autofocus>
    @if ($errors->has('description'))
      <span class="error">
          {{ $errors->first('description') }}
      </span>
    @endif

    <label for="startdate">Start Date*</label>
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


    <div class="form-group">
        <label for="tags">Tags</label>
        <div class="overflow-auto" style="height: 200px;">
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

    <button type="submit" class="btn btn-primary">Create Event</button>

</form>


@else
<h1>YOU ARE NOT LOGGED IN</h1>
@endif
@endsection