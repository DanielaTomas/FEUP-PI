<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Formation;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class UserControllerAdmin extends AdminController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function showSearch()
    {
        if (!$this->isAdmin()) {
            return redirect()->back()->with('error', 'You are not authorized to view this admin area.');
        }

        $organicunits = app('App\Http\Controllers\OrganicUnitController')->getOrganicUnits();
        return view('pages.adminGis', ['organicunits' => $organicunits]);
    }

    //Accepts/Rejects event
    public function assignGI(Request $request, $id)
    { //TODO: Change so only authorized users can make use of this and GI only for their respective organic units
        if (!$this->isAdmin()) {
            return redirect()->back()->with('error', 'You are not authorized to view this admin area.');
        }

        $user = User::find($id);
        $formation = new Formation();
        $formation->userid = $user->userid;
        $formation->organicunitid = $request->organicunitid;
        $formation->roletype = "GI";

        $formation->save();


        /*
        $event->tags()->attach($tagIds);
        $event->save();*/


        return redirect()->back()->with('success', 'Role assigned successfully.');
    }
}
