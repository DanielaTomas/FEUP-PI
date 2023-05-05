<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{


    public static function myRequestsStatic()
    {
        return UserController::showRequests();
    }

    public function showRequests()
    {
        if (!Auth::check())
            return redirect('/login');

        $user = Auth::user();
        $events = $user->events()->get();

        $services = $user->services()->get();
        return view('pages.userRequests', ['events' => $events, 'services' => $services]);
    }

    public function search(Request $request)
    {
        $q = $request->input('q');
        $users = User::where('name', 'LIKE', "%$q%")->get();
        $organicunits = app('App\Http\Controllers\OrganicUnitController')->getOrganicUnits();

        return view('pages.adminGis', ['users' => $users, 'organicunits' => $organicunits]);
    }
}
