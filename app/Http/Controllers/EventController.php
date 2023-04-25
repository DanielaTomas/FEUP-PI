<?php

namespace App\Http\Controllers;


use App\Models\Event;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{

    /**
     * Show the events page //TODO: check naming conventions
     */
    public function list()
    {
        $events = Event::where('requeststatus', 'Accepted')
            ->get(); //TODO:Decide what to to with cancelled events
        return view('pages.events', ['events' => $events]);
    }

    // Show the event page
    public function show($eventId)
    {
        $event = Event::find($eventId);
        return view('pages.event', ['event' => $event]);
    }


    public function createEventForm()
    {
        $tags = TagController::getAllTags();
        $organicUnits=OrganicUnit
        return view('pages.createEventForm', ['tags' => $tags]);
    }

    protected function validator(array $data)
    {
        $regex = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';
        return Validator::make($data, [
            'eventnamept' => 'required|string',
            'eventnameen' => 'required|string',
            'address' => 'required|string',
            'urlportuguese' => 'nullable|regex:' . $regex,
            'urlenglish' =>'nullable|regex:' . $regex,
            'emailtechnical' => 'required|string|email|max:255',
            'contactperson' => 'nullable|string',
            'emailcontact' => 'nullable|string|email|max:255',
            'description' => 'required|string',
            'startdate' => 'required|date|date_format:Y-m-d',
            'enddate' => 'required|date|after_or_equal:startdate|date_format:Y-m-d',
            'tags' => 'required|array',
            'tags.*' => 'exists:tag,tagid',
        ]);
    }

    public function createEvent(Request $request)
    {


        if (!Auth::check()) return redirect('/login');

        $this->validator($request->all())->validate();
        $user = Auth::user();
        $event = Event::create([
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

    public function editEventForm($id)
    {
        $event = Event::find($id);
        $tags = TagController::getAllTags();
        return view('pages.editEventForm', ['event' => $event, 'tags' => $tags]);
    }

    public function editEvent(Request $request)
    {
        if (!Auth::check()) return redirect('/login');
        $this->validator($request->all())->validate();
        $user = Auth::user();
        $event = Event::create([
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

        $events = $user->events()->get();
        $services = $user->services()->get();
        return redirect()->route('my.requests', ['events' => $events, 'services' => $services])->with('success', 'Event edit request sent successfully.');
    }

    public function deleteEvent($id)
    {
        if (!Auth::check()) return redirect('/login');

        $event = Event::find($id);
        $event->user()->detach();
        $event->tags()->detach();
        $event->delete();

        return redirect()->back()->with('success', 'Event deleted successfully.');
    }
}
