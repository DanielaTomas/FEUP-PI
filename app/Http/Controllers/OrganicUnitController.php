<?php

namespace App\Http\Controllers;

use App\Models\OrganicUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OrganicUnitController extends Controller{

    public function getTopOrganicUnitsByEventCount(){
        $organicUnits = OrganicUnit::withCount(['events' => function ($query) {//TODO: Decide what to do with cancelled events
                                    $query->where('requeststatus', 'Accepted');
                                }])
                                ->orderByDesc('events_count')
                                ->limit(3)
                                ->get();
        return $organicUnits;
    }

    protected function validator(array $data){ 
            return Validator::make($data, [
              'name' => 'required|string|unique:organicunit',
            ]);
      }

    public function createOrganicUnit(Request $request){
        if (!Auth::check()) return redirect('/login');

        $this->validator($request->all())->validate();
        $user=Auth::user();
        $organicUnit=OrganicUnit::create([
            'name' => $request->input('name'),
        ]);
        return redirect()->back()->with('success', 'Organic Unit created sucessfully.');
    }

    public function show($id){//TODO: Decide what to do with cancelled events
        $organicUnit = OrganicUnit::findOrFail($id);
        $events = $organicUnit->events()
                      ->where('requeststatus', 'Accepted')
                      ->get();
        return view('pages.events', ['events' => $events,'organicunit' => $organicUnit->name]);
    }

    public static function getAllOrganicUnitsEvents(){
        $organicUnits = OrganicUnit::withCount(['events' => function ($query) {//TODO: Decide what to do with cancelled events
            $query->where('requeststatus', 'Accepted');
        }])->orderByDesc('events_count')->get();
        return $organicUnits;
    }

    public static function getOrganicUnits(){
        return OrganicUnit::all();
    }
}
