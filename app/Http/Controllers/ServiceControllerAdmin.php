<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Service;
use App\Models\Formation;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class ServiceControllerAdmin extends AdminController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function show()
    {
        if (!$this->hasRoles()) {
            return redirect()->back()->with('error', 'You are not authorized to view this admin area.');
        }

        return view("pages.adminServices");
    }


    /**
     * Show the admin dashboard for services 
     */
    public function showCurrent(Request $request)
    {
        /*if (!$this->hasRoles()) {
            return redirect()->back()->with('error', 'You are not authorized to view this admin area.');
        }

        if ($this->user->isAdmin()) {
            $services = Service::whereNotIn('requeststatus', ['Pending'])
                ->paginate(5);
        } else {
            $formations = Formation::where('userid', $this->user->userid)->get();
            if ($formations->isNotEmpty()) {
                // Retrieve an array of organic unit IDs for the user's formation roles
                $organicUnitIds = $formations->pluck('organicunitid')->toArray();
            }

            $services = Service::whereNotIn('requeststatus', ['Pending'])
                ->whereIn('organicunitid', $organicUnitIds)
                ->paginate(5);
        }*/
        $services = Service::whereNotIn('requeststatus', ['Pending'])
            ->paginate(5);
        return response()->json($services);
    }

    public function showPending()
    {
        /*
        if (!$this->hasRoles()) {
            return redirect()->back()->with('error', 'You are not authorized to view this admin area.');
        }

        if ($this->user->isAdmin()) {
            $pendingServices = Event::where('requeststatus', 'Pending')
                ->paginate(5);
        } else {
            $formations = Formation::where('userid', $this->user->userid)->get();
            if ($formations->isNotEmpty()) {
                // Retrieve an array of organic unit IDs for the user's formation roles
                $organicUnitIds = $formations->pluck('organicunitid')->toArray();
            }

            $pendingServices = Event::where('requeststatus', 'Pending')
                ->whereIn('organicunitid', $organicUnitIds)
                ->paginate(5);
        }*/
        $pendingServices = Service::where('requeststatus', 'Pending')
            ->paginate(5);

        return response()->json($pendingServices);
    }

    //Accepts/Rejects event
    public function updateStatus($id, $status)
    { //TODO: Change so only authorized users can make use of this and GI only for their respective organic units
        if (!$this->hasRoles()) {
            return redirect()->back()->with('error', 'You are not authorized to view this admin area.');
        }

        $formations = Formation::where('userid', $this->user->userid)->get();
        $service = Service::find($id);

        /**
         * TODO: Ver pq isto falha
         */
        /*if ($formations->isEmpty()) {
            return redirect()->back()->with('error', 'You are not authorized to update the status of this service.');
        }

        if (!$formations->pluck('organicunitid')->contains($service->organicunitid)) {
            return redirect()->back()->with('error', 'You are not authorized to update the status of this service.');
        }*/

        $service->requeststatus = $status;
        $service->datereviewed = now()->format('Y-m-d');
        $service->save();

        return response()->json($service);
    }
}
