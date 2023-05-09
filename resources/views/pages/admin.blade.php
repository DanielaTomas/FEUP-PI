@extends('layouts.app')

@section('content')

<div id="adminContainer" class="p-5 m-5 bg-secondary rounded min-height">
    <div class="d-flex justify content-center link-light">
        <h3>Admin Dashboard</h3>
    </div>

  <ul>
    <li class="mt-3">
      <a class="text-light" href="{{url('/admin/events')}}">Events</a>
    </li>
    <li class="mt-3">
      <a class="text-light" href="{{url('/admin/services')}}">Services</a>
    </li>
    <li class="mt-3">
      <a class="text-light" href="{{url('/admin/gis')}}">GI Users</a>
    </li>
  </ul>
</div>



@endsection