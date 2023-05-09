
<label for="atribute1" class="form-label">{{$serviceType->question->question1}} <span><b class="text-danger">*</b></span></label>
<input id="atribute1" class="form-control" placeholder="Your answer here" type="text" name="atribute1" value="{{ $serviceType->atribute1 }}" required>
@if ($errors->has('atribute1'))
<span class="error">
    {{ $errors->first('atribute1') }}
</span>
@endif

@if($serviceType->atribute2 != null)
    <label for="atribute2" class="form-label">{{$serviceType->question->question2}}<span><b class="text-danger">*</b></span></label>
    <input id="atribute2" class="form-control" placeholder="Your answer here" type="text" name="atribute2" value="{{ $serviceType->atribute2 }}" required>
    @if ($errors->has('atribute2'))
    <span class="error">
        {{ $errors->first('atribute2') }}
    </span>
    @endif
@endif

@if($serviceType->atribute3 != null)
    <label for="atribute3" class="form-label">{{$serviceType->question->question3}}<span><b class="text-danger">*</b></span></label>
    <input id="atribute3" class="form-control" placeholder="Your answer here" type="text" name="atribute3" value="{{ $serviceType->atribute3 }}" required>
    @if ($errors->has('atribute3'))
    <span class="error">
        {{ $errors->first('atribute3') }}
    </span>
    @endif
@endif

@if($serviceType->atribute4 != null)
    <label for="atribute4" class="form-label">{{$serviceType->question->question4}}<span><b class="text-danger">*</b></span></label>
    <input id="atribute4" class="form-control" placeholder="Your answer here" type="text" name="atribute4" value="{{$serviceType->atribute4 }}"required >
    @if ($errors->has('atribute4'))
    <span class="error">
        {{ $errors->first('atribute4') }}
    </span>
    @endif
@endif

@if($serviceType->atribute5 != null)
    <label for="atribute5" class="form-label">{{$serviceType->question->question5}}<span><b class="text-danger">*</b></span></label>
    <input id="atribute5" class="form-control" placeholder="Your answer here" type="text" name="atribute5" value="{{ $serviceType->atribute5 }}" required>
    @if ($errors->has('atribute5'))
    <span class="error">
        {{ $errors->first('atribute5') }}
    </span>
    @endif
@endif

@if($serviceType->atribute6 != null)
    <label for="atribute6" class="form-label">{{$serviceType->question->question6}}<span><b class="text-danger">*</b></span></label>
    <input id="atribute6" class="form-control" placeholder="Your answer here" type="text" name="atribute6" value="{{ $serviceType->atribute6 }}" required>
    @if ($errors->has('atribute6'))
    <span class="error">
        {{ $errors->first('atribute6') }}
    </span>
    @endif
@endif

@if($serviceType->atribute7 != null)
    <label for="atribute7" class="form-label">{{$serviceType->question->question7}}<span><b class="text-danger">*</b></span></label>
    <input id="atribute7" class="form-control" placeholder="Your answer here" type="text" name="atribute7" value="{{ $serviceType->atribute7 }}" required>
    @if ($errors->has('atribute7'))
    <span class="error">
        {{ $errors->first('atribute7') }}
    </span>
    @endif
@endif

@if($serviceType->atribute8 != null)
    <label for="atribute8" class="form-label">{{$serviceType->question->question8}}<span><b class="text-danger">*</b></span></label>
    <input id="atribute8" class="form-control" placeholder="Your answer here" type="text" name="atribute8" value="{{ $serviceType->atribute8 }}" required>
    @if ($errors->has('atribute8'))
    <span class="error">
        {{ $errors->first('atribute8') }}
    </span>
    @endif
@endif

@if($serviceType->atribute9 != null)
    <label for="atribute9" class="form-label">{{$serviceType->question->question9}}<span><b class="text-danger">*</b></span></label>
    <input id="atribute9" class="form-control" placeholder="Your answer here" type="text" name="atribute9" value="{{ $serviceType->atribute9 }}" required>
    @if ($errors->has('atribute9'))
    <span class="error">
        {{ $errors->first('atribute9') }}
    </span>
    @endif
@endif

@if($serviceType->atribute10 != null)
    <label for="atribute10" class="form-label">{{$serviceType->question->question10}}<span><b class="text-danger">*</b></span></label>
    <input id="atribute10" class="form-control" placeholder="Your answer here" type="text" name="atribute10" value="{{ $serviceType->atribute10 }}" required>
    @if ($errors->has('atribute10'))
    <span class="error">
        {{ $errors->first('atribute10') }}
    </span>
    @endif
@endif
