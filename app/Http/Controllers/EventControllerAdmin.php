<?php

namespace App\Http\Controllers;


use App\Models\Event;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class EventControllerAdmin extends Controller{

    protected $adminController;
    
    public function __construct(AdminController $adminController){
        $this->adminController = $adminController;
    }

    /**
     * Show the admin dashboard for events 
     */
    public function show(){
        if (!$this->adminController->hasRoles()) {
            return redirect()->back()->with('error', 'You are not authorized to view this admin area.');
        }

        $pendingEvents = Event::where('requeststatus', 'Pending')
                              ->limit(10)
                              ->get();
        $events = Event::whereNotIn('requeststatus', ['Pending'])
                        ->limit(10)
                        ->get();
        return view('pages.adminEvents', ['events' => $events,'pendingEvents' => $pendingEvents]);
    }

    //Accepts/Rejects event
    public function updateStatus($id, $status) {//TODO: Change so only authorized users can make use of this and GI only for their respective organic units
        $event = Event::find($id);
        $event->requeststatus = $status;
        $event->datereviewed = now()->format('Y-m-d');
        $event->save();
    
        return redirect()->back()->with('success', 'Event status updated successfully.');
    }

}
