<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class UserController extends Controller{

    public static function getUser($id){
        return User::find($id);
    }

    public static function myRequestsStatic(){
        return UserController::showRequests();
    }

    public function showRequests(){
        if(!Auth::check()) 
            return redirect('/login');

        $user =Auth::user();
        $events=$user->events()->get();
       
        $services=$user->services()->get();
        return view('pages.userRequests', ['events' => $events,'services'=>$services]);
    }
}
