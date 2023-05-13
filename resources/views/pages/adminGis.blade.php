@extends('layouts.app')

@section('content')

@push('pageJS')
<script   type="text/javascript" src={{ asset('js/adminEvent.js') }} defer> </script>
@endpush

<div id="adminContainer" class="p-5 m-5 bg-secondary rounded min-height">
    <button id="backButton" type="button" class="btn btn-secondary"><a href=""><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="White" class="bi bi-arrow-left" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
      </svg></a>
      </button>
    <div class="d-flex justify-content-center link-light">
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