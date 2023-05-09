@extends('layouts.app')

@section('content')

<div class="p-5 m-5 bg-secondary rounded min-height">
    <div class="d-flex justify content-center link-light">
        <h3>Admin Dashboard - GIs</h3>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="GET" action="{{ route('users.search') }}">
        <input type="search" class="form-control my-5" name="q" placeholder="Search for a user..." aria-label="Search">
        <button type="submit">Search</button>
    </form>
    
    @isset($users)
        <ul>
            @foreach($users as $user)
            
                <form method="GET" action="{{ route('users.assignRole', $user->userid) }}">
                    <p> {{  $user->name }} </p>
                    <select name="organicunitid">
                        @foreach ($organicunits as $organicunit)
                            <option value="{{ $organicunit->organicunitid }}">{{ $organicunit->name }}</option>
                        @endforeach
                    </select>
                    <input type="submit" value ="Assign GI to selected unit">
                </form>

            @endforeach
        </ul>
    @endisset
    
</div>
@endsection