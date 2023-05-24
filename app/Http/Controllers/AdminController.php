<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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

    private function isAuthenticated(): bool
    {
        return $this->user !== null;
    }



    public function isAdmin(): bool
    {
        if (!$this->isAuthenticated()) {
            return false;
        }

        if ($this->user->isAdmin()) { //Admins have every permission
            return true;
        }

        return false;
    }

    public function hasRoles(): bool
    {

        if (!$this->isAuthenticated()) {
            return false;
        }

        if ($this->isAdmin()) {
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

    public function user_switch_start() //TODO redirect to somewhere else (and in the other controllers too)
    {
        if(Session::has('orig_user')) {
            return redirect()->to('/')->withErrors('You are already in user view.');
        }

        if ($this->user === null || !$this->user->isAdmin()) //TODO mudar para !hasRoles() -> MAS problemas com html
            return redirect()->to('/')->with('error', 'You are not authorized to view this admin area.');

        $user_switch_name = $this->user->username . '_user_switch';
        $user_switch = User::where('username',$user_switch_name)->first();
        if (!$user_switch) {
            $user_switch = $this->user->replicate();
            $user_switch->username = $user_switch_name;
            $user_switch->isadmin = FALSE;
            $user_switch->save(); //TODO Guardar isto noutra tabela
        }

        $expiresAt = now()->addMinutes(30);
        Session::put('orig_user', Auth::id(), $expiresAt); //TODO Talvez seja melhor guardar isto na database para o caso de se usarem diferentes dispositivos
        
        Auth::login($user_switch);

        return redirect()->to('/')->with('success', 'You switched to user view successfully.');
    }
    
    public function user_switch_stop()
    {
        if ($this->user === null)
            return redirect()->back()->with('error', 'You are not authorized to view this area.');

        $id = Session::pull('orig_user');

        if (!$id) {
            return redirect('/')->withErrors(['user' => 'Session expired. Please login again.']);
        }

        $orig_user = User::find($id);
        if (is_null($orig_user))
            return redirect()->back()->withErrors(['user' => 'User not found']);

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
}
