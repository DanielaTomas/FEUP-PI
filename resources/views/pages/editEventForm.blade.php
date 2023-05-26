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

<form class="my-4" method="POST" action="{{route('edit.event', ['id' => $event->eventid])}}" enctype="multipart/form-data" id="editeventform">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="eventname" class="form-label">Name<span><b class="text-danger">*</b></span></label>

                <label for="eventnamept" class="form-label">Portugues<span><b class="text-danger">*</b></span></label>
                <div class="input-group">
                    <input id="eventnamept" class="form-control" placeholder="Enter event name" type="text" name="eventnamept" value="{{ $event->eventnameportuguese }}" required autofocus>
                    {{-- <button class="btn btn-outline-primary translate-btn" data-target="eventnamept" data-lang-from="pt" data-lang-to="en" type="button">Translate to English</button> --}}
                </div>
                @if ($errors->has('eventnamept'))
                <span class="error">
                    {{ $errors->first('eventnamept') }}
                </span>
                @endif
                <label for="eventnameen" class="form-label">English<span><b class="text-danger">*</b></span></label>
                <div class="input-group">
                    <input id="eventnameen" class="form-control" placeholder="Enter event name" type="text" name="eventnameen" value="{{ $event->eventnameenglish }}" required autofocus>
                    {{-- <button class="btn btn-outline-primary translate-btn" data-target="eventnameen" data-lang-from="en" data-lang-to="pt" type="button">Traduzir para Português</button> --}}
                </div>
                @if ($errors->has('eventnameen'))
                <span class="error">
                    {{ $errors->first('eventnameen') }}
                </span>
                @endif
                
            </div>

            <div class="col-md-6">
                    <div class="form-group">
                        <p>Current Image:</p>
                        <div class="text-center m-auto">
                            <img class="rounded" src="{{URL::asset('/images/events/'.$event->imageurl)}}" width="250" height="200" alt="Card image cap">
                        </div>

                        <label for="image" class="form-label">New Event Image </label>
                        <input type="file" class="form-control" name="image"> 
                    </div>
                </div>
            <label for="organicunitid">Select Organic Unit:</label> 
            <select class="form-control" id="organicunitid" name="organicunitid" required>
                @foreach ($organicunits as $unit)
                    <option value="{{$unit->organicunitid}}" @if ($unit->organicunitid == $event->organicunitid) selected @endif>{{ $unit->name }}</option>
                @endforeach
            </select>
            

            <div class="col-md-6">
                <div class="form-group">
                    <label for="address" class="form-label">Location</label>
                    <input id="address" class="form-control" placeholder="Enter event location" type="text" name="address" value="{{ $event->address }}">
                    @if ($errors->has('address'))
                    <span class="error">
                        {{ $errors->first('address') }}
                    </span>
                    @endif
                </div>
            </div>
        </div>
        
    </div>

    <div class="form-group my-3">
        <label for="description" class="form-label">Description<span><b class="text-danger">*</b></span></label>
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
                <label for="contactperson" class="form-label">Person to Contact (<i>optional</i>)<span><b class="text-danger">*</b></span></label>
                <input id="contactperson" placeholder="Enter event contact person" class="form-control" type="text" name="contactperson" value="{{ $event->contactperson }}" >
                @if ($errors->has('contactperson'))
                <span class="error">
                    {{ $errors->first('contactperson') }}
                </span>
                @endif
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="form-group">
                <label for="emailcontact" class="form-label">Contact Email (<i>optional</i>)</label>
                <input id="emailcontact" class="form-control" placeholder="Enter an email" type="email" name="emailcontact" value="{{$event->emailcontact}}" >
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
                <input id="emailtechnical" class="form-control" placeholder="Enter an email" type="email" name="emailtechnical" value="{{$event->emailtechnical}}" required>
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
    
        <h5>URL  (MUDEM ISTO DEPOIS)</h5>

        <label for="urlportuguese" class="form-label">Portugues </label>
        <input id="urlportuguese" class="form-control" placeholder="Url do evento para Portugues(???)" type="text" name="urlportuguese" 
        @if($event->urlportuguese != null)
            value="{{ $event->urlportuguese }}"
        @else
            value="{{ old('urlportuguese')}}"
        @endif>
        @if ($errors->has('urlportuguese'))
        <span class="error">
            {{ $errors->first('urlportuguese') }}
        </span>
        @endif
        
        <label for="urlenglish" class="form-label">English </label>
        <input id="urlenglish" class="form-control" placeholder="English URL" type="text" name="urlenglish" 
        @if($event->urlportuguese != null)
            value="{{ $event->urlenglish }}"
        @else
            value="{{ old('urlenglish')}}"
        @endif>
        @if ($errors->has('urlenglish'))
        <span class="error">
            {{ $errors->first('urlenglish') }}
        </span>
        @endif
    
    </div>
    @if($language=="pt")
    <div class="form-group my-3">
        <label for="tags" class="my-2">Tags</label>
        <input type="text" placeholder="Tag name" class="flexdatalist form-control" data-min-length="1" multiple="" data-selection-required="1" list="tags" name="tags" value="{{ implode(',',($event->tags()->pluck('tagnameportuguese')->toArray())) }}">
        <datalist id="tags">
            @foreach ($tags as $tag)
                {{-- <div class="form-check mx-2">
                    <label class="form-check-label" for="tags_{{ $tag->tagid }}">{{ $tag->tagnameportuguese }}</label>
                    <input class="form-check-input" type="checkbox" name="tags[]" value="{{ $tag->tagid }}" 
                    @if (is_array(old('tags')) && in_array($tag->tagid, old('tags')) || $event->tags->contains($tag->tagid)) 
                        checked 
                    @endif
                    >
                </div> --}}
                <option value="{{ $tag->tagid }}">{{ $tag->tagname }}</option>
            @endforeach
        </datalist>
    </div>
    @else
    <div class="form-group my-3">
        <label for="tags">Tags<span><b class="text-danger">*</b></span></label>
        <input type="text" placeholder="Tag name" class="flexdatalist form-control" data-min-length="1" multiple="" data-selection-required="1" list="tags" name="tags" value="{{ implode(',',($event->tags()->pluck('tagnameenglish')->toArray())) }}">
        <datalist id="tags">
            @foreach ($tags as $tag)
                {{-- <div class="form-check mx-2">
                    <label class="form-check-label" for="tags_{{ $tag->tagid }}">{{ $tag->tagnameportuguese }}</label>
                    <input class="form-check-input" type="checkbox" name="tags[]" value="{{ $tag->tagid }}" 
                    @if (is_array(old('tags')) && in_array($tag->tagid, old('tags'))) 
                        checked 
                    @endif
                    >
                </div> --}}
                <option value="{{ $tag->tagid }}">{{ $tag->tagnameenglish}}</option>
            @endforeach
        </div>
    </div>
    @endif

    <div class="col-md-12 text-center mt-5">
        <button type="submit" class="btn btn-dark"  id="editeventbutton" disabled>Edit Event</button>
    </div>
</form>

@else
<h1>YOU ARE NOT LOGGED IN</h1>
@endif
</div>

@endsection