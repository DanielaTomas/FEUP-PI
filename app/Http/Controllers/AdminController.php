<?php

namespace App\Http\Controllers;



use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{ //Controller responsible for authorization checking for admin features

    protected $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }

    public function isAdmin()
    {
        if ($this->user->isAdmin()) { //Admins have every permission
            return true;
        }

        return false;
    }

    public function hasRoles()
    {
        if ($this->user === null) {
            return false;
        }

        if ($this->user->isAdmin()) { //Admins have every permission
            return true;
        }

        $roles = $this->user->organicUnits;


        return $roles->isNotEmpty();
    }

    protected function hasPermission($role = null, $organicunitid = null) //unfished, and unused for now
    {
        if ($this->user === null) {
            return false;
        }

        if ($this->user->isAdmin()) { //Admins have every permission
            return true;
        }

        $roles = config('constants.roles');

        if ($role || $organicunitid) {
            return null;
        }

        $exists = Formation::where('userid', $this->user->userid)
            ->where('organicunitid', $organicunitid)
            ->where('roletype', $role)
            ->exists();

        return $exists;
    }

    /**
     * Show the admin dashboard
     */
    public function show()
    {
        if (!$this->hasRoles()) {
            return redirect()->back()->with('error', 'You are not authorized to view this admin area.'); //TODO: redirect somewhere else instead of back? also display error message
        }
        return view('pages.admin');
    }
}
