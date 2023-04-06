@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('login') }}">
    <h1>FRONT-ENDERS MUDEM O QUE FOR PRECISO</h1>
    {{ csrf_field() }}
   <fieldset>
    <legend>Login information</legend>
    <label for="username">Username</label>
    <input id="username" type="text" name="username" value="{{ old('username') }}" required autofocus>
    @if ($errors->has('username'))
        <span class="error">
          {{ $errors->first('username') }}
        </span>
    @endif


    <label for="password" >Password</label>
    <input id="password" type="password" name="password" required>
    @if ($errors->has('password'))
        <span class="error">
            {{ $errors->first('password') }}
        </span>
    @endif

    <label>
        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
    </label>

    @if (session('error'))
   <div class="alert alert-danger">
        {{ session('error') }}
   </div>
    @endif
                            
    <button type="submit">
        Sign in
    </button>
    </fieldset>
</form>
@endsection

