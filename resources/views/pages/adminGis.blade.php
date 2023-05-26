@extends('layouts.app')

@section('content')



<div id="adminContainer" class="p-5 m-5 bg-secondary rounded min-height">
    <button id="backButton" type="button" class="btn btn-secondary"><a href=""><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="White" class="bi bi-arrow-left" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
      </svg></a>
      </button>
    <div class="d-flex justify-content-center link-light">
        <h3>Admin Dashboard - GIs</h3>
    </div>

   
    <div class="text-center">
        <form method="POST" action="{{ route('users.search') }}">
            {{ csrf_field() }}
            <input type="search" class="form-control my-2" name="q" placeholder="Search for a user..." aria-label="Search">
            <button class="rounded my-2" type="submit">Search</button>
        </form>
    </div>
    
    @isset($users)
        <ul>
            <table class="table rounded rounded-3 overflow-hidden align-middle bg-white">
                <thead class="bg-light">
                    <tr>
                    <th class="text-center">User</th>
                    <th class="text-center">Organic Unit</th>
                    <th class="text-center">Submit</th>
                    </tr>
                </thead>
                <tbody id="CurrEventTable">
                    @foreach($users as $user)
                    <tr>
                    <form method="GET" action="{{ route('users.assignRole', $user->userid) }}">
                        <td class="text-center"> {{  $user->name }} </td>
                        <td class="text-center"><select name="organicunitid">
                                @foreach ($organicunits as $organicunit)
                                    <option value="{{ $organicunit->organicunitid }}">{{ $organicunit->name }}</option>
                                @endforeach
                        </select></td>
                        <td class="text-center"><input type="submit" value ="Assign GI to selected unit"></td>
                    </form>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </ul>
    @endisset
    
</div>
@endsection