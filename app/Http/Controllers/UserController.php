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
    public function user_switch_start() //TODO Colocar isto no AdminController??
    {
        if (!Auth::check() || !Auth::user()->isadmin)
            return redirect('/');

        $user_switch_name = Auth::user()->username . '_user_switch';
        $user_switch = User::where('username',$user_switch_name)->first();
        if (!$user_switch) {
            $user_switch = Auth::user()->replicate();
            $user_switch->username = $user_switch_name;
            $user_switch->isadmin = FALSE;
            $user_switch->save(); //TODO Guardar isto noutra tabela
        }

        $expiresAt = now()->addMinutes(30);
        Session::put('orig_user', Auth::id(), $expiresAt); //TODO Talvez seja melhor guardar isto na database para o caso de se usarem diferentes dispositivos
        
        Auth::login($user_switch);

        return redirect()->back()->with('success', 'You switched to user view successfully.');
    }
    
    public function user_switch_stop()
    {
        if (!Auth::check())
            return redirect('/');

        $id = Session::pull('orig_user');

        if (!$id) {
            return redirect('/')->withErrors(['user' => 'Session expired. Please login again.']);
        }

        $orig_user = User::find($id);
        if (is_null($orig_user))
            return redirect()->back()->withErrors(['user' => 'User not found']);
        
        //TODO impedir que se coloquem dados na database quando se está no user switch view
        // ou apaga-los depois DB::table('posts')->where('userid', Auth::user()->userid)->delete();

        Auth::logout();
        Auth::login($orig_user);
        Session::forget('orig_user');
        
        return redirect()->back()->with('success', 'You switched back to your account successfully.');
    }

    /*TODO
    public function handle()
    {   // php artisan make:command CleanUpUserSwitches -> CleanUpUserSwitches.php (app/Console/Commands)
        // Delete all user accounts whose username ends with '_user_switch' and have not been used in the last 7 days
        $usersToDelete = User::where('username', 'like', '%_user_switch')
            ->where('updated_at', '<', now()->subDays(7))
            ->get();
        
        foreach ($usersToDelete as $user) {
            $user->delete();
        }
    }
    */

    /*
    Register the command in the app/Console/Kernel.php file. Add the following code to the schedule method:
    $schedule->command('user-switch:cleanup')->daily(); //weekly, monthly,...
    This will run the CleanUpUserSwitches command every day.
    */

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
