@extends('layouts.app')

@section('content') 
<?php $language = app()->getLocale();?>
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

<form class="my-4" method="POST" action="{{route('create.event')}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <h4>Name</h4>
                <label for="eventnamept" class="form-label">Portugues<span><b class="text-danger">*</b></span></label>
                <input id="eventnamept" class="form-control" placeholder="Enter event name" type="text" name="eventnamept" value="{{ old('eventnamept') }}" required autofocus>
                @if ($errors->has('eventnamept'))
                <span class="error">
                    {{ $errors->first('eventnamept') }}
                </span>
                @endif
                <label for="eventnameen" class="form-label">English<span><b class="text-danger">*</b></span></label>
                <input id="eventnameen" class="form-control" placeholder="Enter event name" type="text" name="eventnameen" value="{{ old('eventnameen') }}" required autofocus>
                @if ($errors->has('eventnameen'))
                <span class="error">
                    {{ $errors->first('eventnameen') }}
                </span>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="address" class="form-label">Location<span><b class="text-danger">*</b></span></label>
                <input id="address" class="form-control" placeholder="Enter event location" type="text" name="address" value="{{ old('address') }}" required>
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
        <textarea id="description" rows="4" class="form-control" name="description" required placeholder="Enter event description" value="{{ old('description') }}"></textarea>

        @if ($errors->has('description'))
        <span class="error">
            {{ $errors->first('description') }}
        </span>
        @endif
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="contactperson" class="form-label">Person to Contact (optional)</label>
                <input id="contactperson" placeholder="Enter event contact person" class="form-control" type="text" name="contactperson" value="{{ old('contactperson') }}" >
                @if ($errors->has('contactperson'))
                <span class="error">
                    {{ $errors->first('contactperson') }}
                </span>
                @endif
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="form-group">
                <label for="emailcontact" class="form-label">Contact Email (optional)</label>
                <input id="emailcontact" class="form-control" placeholder="Enter an email" type="email" name="emailcontact" value="{{ old('emailcontact') }}" required>
                @if ($errors->has('emailcontact'))
                <span class="error">
                    {{ $errors->first('emailcontact') }}
                </span>
                @endif
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="emailtechnical" class="form-label">Technical Email<span><b class="text-danger">*</b></span></label>
                <input id="emailtechnical" class="form-control" placeholder="Enter an email" type="email" name="emailtechnical" value="{{old('emailtechnical', auth()->user()->email)}}" required>
                @if ($errors->has('emailtechnical'))
                <span class="error">
                    {{ $errors->first('emailtechnical') }}
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
                value="<?php echo date('Y-m-d'); ?>"
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
                value="<?php echo date('Y-m-d'); ?>"
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
        <h5>URL  (MUDEM ISTO DEPOIS)</h5>

        <label for="urlportuguese" class="form-label">Portugues </label>
        <input id="urlportuguese" class="form-control" placeholder="Url do evento para Portugues(???)" type="text" name="urlportuguese" value="{{ old('urlportuguese') }}">
        @if ($errors->has('urlportuguese'))
        <span class="error">
            {{ $errors->first('urlportuguese') }}
        </span>
        @endif

        <label for="urlenglish" class="form-label">English </label>
        <input id="urlenglish" class="form-control" placeholder="English URL" type="text" name="urlenglish" value="{{ old('urlenglish') }}">
        @if ($errors->has('urlenglish'))
        <span class="error">
            {{ $errors->first('urlenglish') }}
        </span>
        @endif
    </div>
    
    
   
    
    @if($language=="pt")
    <div class="form-group my-3">
        <label for="tags">Tags</label>
        <div class="overflow-auto my-2 bg-light rounded" style="height: 200px;">
            @foreach ($tags as $tag)
                <div class="form-check mx-2">
                    <label class="form-check-label" for="tags_{{ $tag->tagid }}">{{ $tag->tagnameportuguese }}</label>
                    <input class="form-check-input" type="checkbox" name="tags[]" value="{{ $tag->tagid }}" 
                    @if (is_array(old('tags')) && in_array($tag->tagid, old('tags'))) 
                        checked 
                    @endif
                    >
                </div>
            @endforeach
        </div>
    </div>
    @else
    <div class="form-group my-3">
        <label for="tags">Tags</label>
        <div class="overflow-auto my-2 bg-light rounded" style="height: 200px;">
            @foreach ($tags as $tag)
                <div class="form-check mx-2">
                    <label class="form-check-label" for="tags_{{ $tag->tagid }}">{{ $tag->tagnameenglish }}</label>
                    <input class="form-check-input" type="checkbox" name="tags[]" value="{{ $tag->tagid }}" 
                    @if (is_array(old('tags')) && in_array($tag->tagid, old('tags'))) 
                        checked 
                    @endif
                    >
                </div>
            @endforeach
        </div>
    </div>
    @endif

    <div class="form-group">
        <label for="event_id">Select Event:</label>
        <select class="form-control" id="event_id" name="event_id">
            @foreach ($events as $event)
                <option value="{{ $event->id }}">{{ $event->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-12 text-center mt-5">
        <button type="submit" class="btn btn-dark">Create Event</button>
    </div>
</form>

@else
<h1>YOU ARE NOT LOGGED IN</h1>
@endif
</div>

@endsection
