@extends('layouts.app')

@section('content')

<h1 class="text-center mt-auto">Frequently Asked Questions</h1>

<div class="faqcontainer mb-auto">
<div class="accordion w-75 mx-auto" id="accordionExample">
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingOne">
        <button id="FAQbutton" class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Question 1?
        </button>
      </h2>
      <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
        <div class="accordion-body">
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin eu mauris sollicitudin orci molestie commodo. Aliquam et iaculis metus. Etiam ornare nulla at egestas eleifend. Proin fermentum sem non nisl dapibus, ut laoreet erat ultrices. Etiam eget eros sollicitudin, fringilla odio eu, tempus felis. Suspendisse in tempus mi.</p>
        </div>
      </div>
    </div>
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingTwo">
        <button id="FAQbutton" class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Question 2? 
        </button>
      </h2>
      <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
        <div class="accordion-body">
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin eu mauris sollicitudin orci molestie commodo. Aliquam et iaculis metus. Etiam ornare nulla at egestas eleifend. Proin fermentum sem non nisl dapibus, ut laoreet erat ultrices. Etiam eget eros sollicitudin, fringilla odio eu, tempus felis. Suspendisse in tempus mi.</p>
        </div>
      </div>
    </div>
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingThree">
        <button id="FAQbutton" class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Question 3?
        </button>
      </h2>
      <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
        <div class="accordion-body">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin eu mauris sollicitudin orci molestie commodo. Aliquam et iaculis metus. Etiam ornare nulla at egestas eleifend. Proin fermentum sem non nisl dapibus, ut laoreet erat ultrices. Etiam eget eros sollicitudin, fringilla odio eu, tempus felis. Suspendisse in tempus mi.</p>
        </div>
      </div>
    </div>
    <p class="text-center pt-3"><strong>Didn't find what you were looking for? <a href="{{url('/contacts')}}">Contact Us</a> </strong></p>
  </div>
</div>
  @endsection