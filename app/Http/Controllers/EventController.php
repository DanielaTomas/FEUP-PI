<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class EventController extends Controller{

    /**
     * Show the events page //TODO: check naming conventions
     */
    public function list(){
        $events = Event::where('requeststatus', 'Accepted')
                       ->get();//TODO:Decide what to to with cancelled events
        return view('pages.events', ['events' => $events]);
    }

    // Show the event page
    public function show($eventId){   
        $event= Event::find($eventId);
        return view('pages.event',['event' => $event]);
    }


    public function adminDashboardEvents(){
        $pendingEvents = Event::where('requeststatus', 'Pending')
                              ->limit(10)
                              ->get();
        $events = Event::whereNotIn('requeststatus', ['Pending'])
                        ->limit(10)
                        ->get();
        return view('pages.admin', ['events' => $events,'pendingEvents' => $pendingEvents]);
    }

    //Accepts/Rejects event
    public function updateStatus($id, $status) {//TODO: Change so only authorized users can make use of this
        $event = Event::find($id);
        $event->requeststatus = $status;
        $event->datereviewed = now()->format('Y-m-d');
        $event->save();
    
        return redirect()->back()->with('success', 'Event status updated successfully.');
    }


    public function createEventForm(){
        $tags=TagController::getAllTags();
        return view('pages.createEventForm',['tags'=>$tags]);
    }

    protected function validator(array $data)
      { 
            $regex = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';
            return Validator::make($data, [
              'eventname' => 'required|string',
              'address' => 'required|string',
              'url' => 'nullable|regex:'.$regex,
              'email' => 'required|string|email|max:255',
              'contactperson'=>'required|string',
              'description'=>'required|string',
              'startdate' => 'required|date|date_format:Y-m-d',
              'enddate' => 'required|date|after_or_equal:startdate|date_format:Y-m-d',
              'tags' => 'required|array',
              'tags.*' => 'exists:tag,tagid',
            ]);
      }

    public function createEvent(Request $request){

        
        if (!Auth::check()) return redirect('/login');

        $this->validator($request->all())->validate();
        $user=Auth::user();
        $event=Event::create([
            'requeststatus' => 'Pending',
            'requesttype' => 'Create',
            'eventname' => $request->input('eventname'),
            'address' => $request->input('address'),
            'url' => $request->input('url'),
            'email' => $request->input('email'),
            'datecreated' => date('Y-m-d'),
            'contactperson' => $request->input('contactperson'),
            'description' => $request->input('description'),
            'startdate' => $request->input('startdate'),
            'enddate' => $request->input('enddate'),
        ]);

        $tags = $request->input('tags');
        $event->tags()->attach($tags);
        $event->save();
        $user->events()->save($event);
        // TODO: CHANGE WHEN USER CAN SEE EVENTS IN PROFILE
        return redirect('/');      
    }  

    public function editEventForm($id){
        $event=Event::find($id);
        $tags=TagController::getAllTags();
        return view('pages.editEventForm',['event'=>$event,'tags'=>$tags]);
    }

    public function editEvent(Request $request){
        if (!Auth::check()) return redirect('/login');
        $this->validator($request->all())->validate();
        $user=Auth::user();
        $event=Event::create([
            'requeststatus' => 'Pending',
            'requesttype' => 'Edit',
            'eventname' => $request->input('eventname'),
            'address' => $request->input('address'),
            'url' => $request->input('url'),
            'email' => $request->input('email'),
            'datecreated' => date('Y-m-d'),
            'contactperson' => $request->input('contactperson'),
            'description' => $request->input('description'),
            'startdate' => $request->input('startdate'),
            'enddate' => $request->input('enddate'),
        ]);
        $tags = $request->input('tags');
        $event->tags()->attach($tags);
        $event->save();
        $user->events()->save($event);

        $events=$user->events()->get();
        $services=$user->services()->get();
        return redirect()->route('my.requests', ['events' => $events,'services'=>$services])->with('success', 'Event edit request sent successfully.');
    }   

}
