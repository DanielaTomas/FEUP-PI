
<label for="atribute1" class="form-label">{{$question->question1}} <span><b class="text-danger">*</b></span></label>
<input id="atribute1" class="form-control" placeholder="Your answer here" type="text" name="atribute1" value="{{ old('atribute1') }}" required>
@if ($errors->has('atribute1'))
<span class="error">
    {{ $errors->first('atribute1') }}
</span>
@endif

@if($question->question2 != null)
    <label for="atribute2" class="form-label">{{$question->question2}}</label>
    <input id="atribute2" class="form-control" placeholder="Your answer here" type="text" name="atribute2" value="{{ old('atribute2') }}" required>
    @if ($errors->has('atribute2'))
    <span class="error">
        {{ $errors->first('atribute2') }}
    </span>
    @endif
@endif

@if($question->question3 != null)
    <label for="atribute3" class="form-label">{{$question->question3}}</label>
    <input id="atribute3" class="form-control" placeholder="Your answer here" type="text" name="atribute3" value="{{ old('atribute3') }}" required>
    @if ($errors->has('atribute3'))
    <span class="error">
        {{ $errors->first('atribute3') }}
    </span>
    @endif
@endif

@if($question->question4 != null)
    <label for="atribute4" class="form-label">{{$question->question4}}</label>
    <input id="atribute4" class="form-control" placeholder="Your answer here" type="text" name="atribute4" value="{{ old('atribute4') }}"required >
    @if ($errors->has('atribute4'))
    <span class="error">
        {{ $errors->first('atribute4') }}
    </span>
    @endif
@endif

@if($question->question5 != null)
    <label for="atribute5" class="form-label">{{$question->question5}}</label>
    <input id="atribute5" class="form-control" placeholder="Your answer here" type="text" name="atribute5" value="{{ old('atribute5') }}" required>
    @if ($errors->has('atribute5'))
    <span class="error">
        {{ $errors->first('atribute5') }}
    </span>
    @endif
@endif

@if($question->question6 != null)
    <label for="atribute6" class="form-label">{{$question->question6}}</label>
    <input id="atribute6" class="form-control" placeholder="Your answer here" type="text" name="atribute6" value="{{ old('atribute6') }}" required>
    @if ($errors->has('atribute6'))
    <span class="error">
        {{ $errors->first('atribute6') }}
    </span>
    @endif
@endif

@if($question->question7 != null)
    <label for="atribute7" class="form-label">{{$question->question7}}</label>
    <input id="atribute7" class="form-control" placeholder="Your answer here" type="text" name="atribute7" value="{{ old('atribute7') }}" required>
    @if ($errors->has('atribute7'))
    <span class="error">
        {{ $errors->first('atribute7') }}
    </span>
    @endif
@endif

@if($question->question8 != null)
    <label for="atribute8" class="form-label">{{$question->question8}}</label>
    <input id="atribute8" class="form-control" placeholder="Your answer here" type="text" name="atribute8" value="{{ old('atribute8') }}" required>
    @if ($errors->has('atribute8'))
    <span class="error">
        {{ $errors->first('atribute8') }}
    </span>
    @endif
@endif

@if($question->question9 != null)
    <label for="atribute9" class="form-label">{{$question->question9}}</label>
    <input id="atribute9" class="form-control" placeholder="Your answer here" type="text" name="atribute9" value="{{ old('atribute9') }}" required>
    @if ($errors->has('atribute9'))
    <span class="error">
        {{ $errors->first('atribute9') }}
    </span>
    @endif
@endif

@if($question->question10 != null)
    <label for="atribute10" class="form-label">{{$question->question10}}</label>
    <input id="atribute10" class="form-control" placeholder="Your answer here" type="text" name="atribute10" value="{{ old('atribute10') }}" required>
    @if ($errors->has('atribute10'))
    <span class="error">
        {{ $errors->first('atribute10') }}
    </span>
    @endif
@endif
