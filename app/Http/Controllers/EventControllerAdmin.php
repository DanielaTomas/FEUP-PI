<?php

namespace App\Http\Controllers;


use App\Models\Event;
use App\Models\Formation;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class EventControllerAdmin extends AdminController
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Show the admin dashboard for events 
     */
    public function showCurrent(Request $request)
    {
        if (!$this->hasRoles()) {
            return redirect()->back()->with('error', 'You are not authorized to view this admin area.');
        }

        if ($this->user->isAdmin()) {
            $events = Event::whereNotIn('requeststatus', ['Pending'])
                ->paginate(5);
            
        } else {
            $formations = Formation::where('userid', $this->user->userid)->get();
            if ($formations->isNotEmpty()) {
                // Retrieve an array of organic unit IDs for the user's formation roles
                $organicUnitIds = $formations->pluck('organicunitid')->toArray();
            }

            $events = Event::whereNotIn('requeststatus', ['Pending'])
                ->whereIn('organicunitid', $organicUnitIds)
                ->paginate(5);
            
        }
        return response()->json($events);
    }

    public function showPending(){
        if (!$this->hasRoles()) {
            return redirect()->back()->with('error', 'You are not authorized to view this admin area.');
        }

        if ($this->user->isAdmin()) {
            $pendingEvents = Event::where('requeststatus', 'Pending')
                ->paginate(5);
        } else {
            $formations = Formation::where('userid', $this->user->userid)->get();
            if ($formations->isNotEmpty()) {
                // Retrieve an array of organic unit IDs for the user's formation roles
                $organicUnitIds = $formations->pluck('organicunitid')->toArray();
            }

            $pendingEvents = Event::where('requeststatus', 'Pending')
                ->whereIn('organicunitid', $organicUnitIds)
                ->paginate(5);
        }
        
        return response()->json($pendingEvents);
    } 

    //Accepts/Rejects event
    public function updateStatus($id, $status)
    { //TODO: Change so only authorized users can make use of this and GI only for their respective organic units
        if (!$this->hasRoles()) {
            return redirect()->back()->with('error', 'You are not authorized to view this admin area.');
        }

        $formations = Formation::where('userid', $this->user->userid)->get();
        $event = Event::find($id);

        /**
         * TODO: Ver pq isto falha
         */
        /*if ($formations->isEmpty()) {
            return redirect()->back()->with('error', 'You are not authorized to update the status of this event.');
        }

        if (!$formations->pluck('organicunitid')->contains($event->organicunitid)) {
            return redirect()->back()->with('error', 'You are not authorized to update the status of this event.');
        }*/

        $event->requeststatus = $status;
        $event->datereviewed = now()->format('Y-m-d');
        $event->save();

        return response()->json($event);
    }
}
