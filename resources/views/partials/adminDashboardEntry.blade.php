<tr>
    <td>
        <div class="d-flex align-items-center">
            <div class="ms-3">
                <a href =""><p class="fw-bold mb-1">{{ $event->eventname }}</p></a>
                <p class="text-muted mb-0">{{ $event->email }}</p>
            </div>
        </div>
    </td>
    <td>
        <p class="fw-normal mb-1">{{ $event->datecreated }}</p>
        <p class="text-muted mb-0">00:00</p>
    </td>
    <td>
        @if ($event->requesttype === 'Edit')
            <span class="badge bg-info">Edit</span>
        @elseif ($event->requesttype === 'Create')
            <span class="badge bg-primary">Create</span>
        @elseif ($event->requesttype === 'Archive')
            <span class="badge bg-secondary">Archive</span>
        @endif

    </td>
    <td>
        @if ($event->requeststatus === 'Accepted')
            <span class="badge bg-success">Accepted</span>
        @elseif ($event->requeststatus === 'Pending')
            <span class="badge bg-warning">Pending Review</span>
        @elseif ($event->requeststatus === 'Rejected')
            <span class="badge bg-danger">Rejected</span> 
        @endif
        
        
         

    </td>
    <td>
        @if ($event->requeststatus === 'Pending')
        <form action="{{ route('requests.status.update', ['id' => $event->eventid, 'action' => 'Accepted' ]) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-success">Accept</button>
        </form>
        
        <form action="{{ route('requests.status.update', ['id' => $event->eventid, 'action' => 'Rejected' ]) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">Reject</button>
        </form>
        
        @else
            <p class="fw-normal mb-1">Request Reviewed</p>
            <p class="text-muted mb-0">{{$event->datereviewed}} 00:00</p>
        @endif
    </td>
</tr>