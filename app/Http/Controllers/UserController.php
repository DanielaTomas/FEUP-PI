<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function user_switch_start($new_user)
    {
        if (!Auth::check() && !Auth::user()->isadmin)
            return redirect('/login');
        $new_user = User::find($new_user);
        Session::put('orig_user',Auth::id()); //TODO Talvez seja melhor guardar isto na database
        Auth::login($new_user);
        return redirect()->back()->with('success', 'You switched to user view successfully.');
    }
    
    public function user_switch_stop()
    {
        if (!Auth::check() && !Auth::user()->isadmin)
            return redirect('/login');
        $id = Session::pull('orig_user');
        $orig_user = User::find($id);
        Auth::login($orig_user);
        return redirect()->back()->with('success', 'You switched back to your account successfully.');
    }

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
