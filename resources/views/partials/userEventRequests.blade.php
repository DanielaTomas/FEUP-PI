<div class="card row-hover pos-relative py-3 px-3 mb-3 border-primary border-top-0 border-right-0 border-bottom-0 rounded">
    <div class="row align-items-center">
      <div class="col-md-8 mb-3 mb-sm-0">
        <h5>
          <a href="/event/{{ $event->eventid }}" class="text-primary">{{$event->eventnameenglish}}</a>
          <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="%23fff" class="bi bi-clock-history" viewBox="0 0 16 16">
            <path d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022l-.074.997zm2.004.45a7.003 7.003 0 0 0-.985-.299l.219-.976c.383.086.76.2 1.126.342l-.36.933zm1.37.71a7.01 7.01 0 0 0-.439-.27l.493-.87a8.025 8.025 0 0 1 .979.654l-.615.789a6.996 6.996 0 0 0-.418-.302zm1.834 1.79a6.99 6.99 0 0 0-.653-.796l.724-.69c.27.285.52.59.747.91l-.818.576zm.744 1.352a7.08 7.08 0 0 0-.214-.468l.893-.45a7.976 7.976 0 0 1 .45 1.088l-.95.313a7.023 7.023 0 0 0-.179-.483zm.53 2.507a6.991 6.991 0 0 0-.1-1.025l.985-.17c.067.386.106.778.116 1.17l-1 .025zm-.131 1.538c.033-.17.06-.339.081-.51l.993.123a7.957 7.957 0 0 1-.23 1.155l-.964-.267c.046-.165.086-.332.12-.501zm-.952 2.379c.184-.29.346-.594.486-.908l.914.405c-.16.36-.345.706-.555 1.038l-.845-.535zm-.964 1.205c.122-.122.239-.248.35-.378l.758.653a8.073 8.073 0 0 1-.401.432l-.707-.707z"/>
            <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0v1z"/>
            <path d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z"/>
          </svg></a>
        </h5>
        <p class="text-sm">{{$event->description}}</p>
        <div class="text-sm op-5"> 
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
            </svg>
            <a class="text-black mr-2" href="#">{{$event->contactperson}}</a>

            

            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
            <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555ZM0 4.697v7.104l5.803-3.558L0 4.697ZM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757Zm3.436-.586L16 11.801V4.697l-5.803 3.546Z"/>
            </svg>
            <a class="text-black mr-2" href="#">{{$event->email}}</a>

            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
            <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
            </svg>
            <a class="text-black mr-2" href="#">{{$event->address}}</a></div>

            @if ($event->requesttype === 'Edit')
            <span class="badge bg-info">Edit</span>
                @elseif ($event->requesttype === 'Create')
            <span class="badge bg-primary">Create</span>
                @elseif ($event->requesttype === 'Archive')
            <span class="badge bg-secondary">Archive</span>
            @endif
        </div>
        <div class="col-md-4 op-7">
            <div class="row text-center op-7">
                <div class="col-auto px-1"><i class="ion-connection-bars icon-1x"></i><span class="d-block text-sm">{{$event->startdate}}</span></div>
                <div class="col-auto px-1"><i class="ion-ios-chatboxes-outline icon-1x"></i><span class="d-block text-sm">{{$event->enddate}}</span></div>
                <div class="col px-1"><i class="ion-ios-eye-outline icon-1x"></i><a class="text-black mr-2" href="/event/{{ $event->eventid }}" title="View event request"><span class="d-block text-sm">View >></span></a></div>
                @if($event->eventcanceled===FALSE)
                    <div class="col px-1"><i class="ion-ios-eye-outline icon-1x"></i><a class="text-black mr-2" href="/edit_event/{{ $event->eventid }}" title="Edit event request"><span class="d-block text-sm">Edit >></span></a></div>
                @endif
                @if($event->datereviewed===NULL)
                    <div class="col px-1"><i class="ion-ios-eye-outline icon-1x"></i><a class="text-danger mr-2" href="/delete_event/{{ $event->eventid }}" title="Delete event request"><span class="d-block text-sm">Delete</span></a></div>
                @endif
        </div>
      </div>
    </div>
  </div>