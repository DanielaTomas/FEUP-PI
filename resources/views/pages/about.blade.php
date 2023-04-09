@extends('layouts.app')

@section('content') 

<h2 class="mt-auto text-center">About US</h2>

<div class="mb-auto mx-auto row row-cols-1 row-cols-md-4">
    <div class="col mb-4 d-flex justify-content-center">
      <div class="card h-100" style="max-width: 18rem;">
        <img src="{{URL::asset('/images/amogus.webp')}}" class="card-img-top" alt="daniela">
        <div class="card-body">
          <h5 class="card-title text-center">Daniela Tomás</h5>
          <p class="card-text text-center">Frontender</p>
        </div>
      </div>
    </div>
    <div class="col mb-4 d-flex justify-content-center">
      <div class="card h-100" style="max-width: 18rem;">
        <img src="{{URL::asset('/images/amogus2.webp')}}" class="card-img-top" alt="diogo">
        <div class="card-body">
          <h5 class="card-title text-center">Diogo Nunes</h5>
          <p class="card-text text-center">Backender</p>
        </div>
      </div>
    </div>
    <div class="col mb-4 d-flex justify-content-center">
      <div class="card h-100" style="max-width: 18rem;">
        <img src="{{URL::asset('/images/amogus3.webp')}}" class="card-img-top" alt="miguel">
        <div class="card-body">
          <h5 class="card-title text-center">Miguel Tavares</h5>
          <p class="card-text text-center">Frontender</p>
        </div>
      </div>
    </div>
    <div class="col mb-4 d-flex justify-content-center">
      <div class="card h-100" style="max-width: 18rem;">
        <img src="{{URL::asset('/images/amogus4.webp')}}" class="card-img-top" alt="pedro">
        <div class="card-body">
          <h5 class="card-title text-center">Pedro Correia</h5>
          <p class="card-text text-center">Backender</p>
        </div>
      </div>
    </div>
  </div>
  <div class="container text-center">
    <p>We are group of LEIC students, and this website is our integration project done for UPDigital.</p>
  </div>
@endsection  