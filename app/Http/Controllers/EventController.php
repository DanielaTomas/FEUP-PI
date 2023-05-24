<?php

namespace App\Http\Controllers;


use App\Models\Event;
use App\Models\Tag;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;

class EventController extends Controller
{
        
    public static function getFeedItems(){
      return $events = Event::where('requeststatus', 'Accepted')->get();
    }

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
        $organicUnits=OrganicUnitController::getOrganicUnits();
        return view('pages.createEventForm', ['tags' => $tags,'organicunits'=>$organicUnits]);
    }


    protected function validator(array $data)
    {
        $regex = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';
        return Validator::make($data, [
            'eventnamept' => 'required|string',
            'eventnameen' => 'required|string',
            'address' => 'nullable|string',
            'urlportuguese' => 'nullable|regex:' . $regex,
            'urlenglish' =>'nullable|regex:' . $regex,
            'emailtechnical' => 'required|string|email|max:255',
            'contactperson' => 'nullable|string',
            'emailcontact' => 'nullable|string|email|max:255',
            'description' => 'required|string',
            'startdate' => 'required|date|date_format:Y-m-d',
            'enddate' => 'required|date|after_or_equal:startdate|date_format:Y-m-d',
            'tags' => 'required|string',
        ]);
    }


    public function createEvent(Request $request){

        if (!Auth::check()) return redirect('/login');

        if(Session::has('orig_user')) {
            return redirect()->to('/')->withErrors('You are not authorized to create an event in user view.');
        }

        $this->validator($request->all())->validate();
        $user = Auth::user();
        $event = Event::create([
            'requeststatus' => 'Pending',
            'requesttype' => 'Create',
            'eventnameportuguese' => $request->input('eventnamept'),
            'eventnameenglish' => $request->input('eventnameen'),
            'address' => $request->input('address'),
            'urlportuguese' => $request->input('urlportuguese'),
            'urlenglish' => $request->input('urlenglish'),
            'emailtechnical' => $request->input('emailtechnical'),
            'emailcontact' =>$request->input('emailcontact'),
            'datecreated' => date('Y-m-d'),
            'contactperson' => $request->input('contactperson'),
            'description' => $request->input('description'),
            'startdate' => $request->input('startdate'),
            'enddate' => $request->input('enddate'),
            'userid'=> $user->userid,
            'organicunitid' => $request->input('organicunitid')
        ]);

        $tags = $request->input('tags');
        $tagNames = explode(',', $tags);

        foreach ($tagNames as $tagName) {
            $tagId = Tag::where('tagnameportuguese',$tagName)->orWhere('tagnameenglish',$tagName)->value('tagid');
            if ($tagId) {
                $tagIds[] = (int) $tagId;
            }
            else {
                return redirect()->back()->withErrors(['tag' => 'Tag not found, id: ' . $tagId]);
            }
        }

        $event->tags()->attach($tagIds);
        $event->save();
        $user->events()->save($event);
        // TODO: CHANGE WHEN USER CAN SEE EVENTS IN PROFILE
        return redirect('/my_requests')->with('success', 'Event creation request sent successfully.');
    }

    public function editEventForm($id)
    {
        $event = Event::find($id);
        $tags = TagController::getAllTags();
        $organicUnits=OrganicUnitController::getOrganicUnits();
        return view('pages.editEventForm', ['event' => $event, 'tags' => $tags,'organicunits'=>$organicUnits]);
    }

    public function editEvent(Request $request)
    {
        if (!Auth::check()) return redirect('/login');
        if(Session::has('orig_user')) {
            return redirect()->to('/')->withErrors('You are not authorized to edit an event in user view.');
        }
        $this->validator($request->all())->validate();
        $user = Auth::user();
        $event = Event::create([
            'requeststatus' => 'Pending',
            'requesttype' => 'Edit',
            'eventnameportuguese' => $request->input('eventnamept'),
            'eventnameenglish' => $request->input('eventnameen'),
            'address' => $request->input('address'),
            'urlportuguese' => $request->input('urlportuguese'),
            'urlenglish' => $request->input('urlenglish'),
            'emailtechnical' => $request->input('emailtechnical'),
            'emailcontact' =>$request->input('emailcontact'),
            'datecreated' => date('Y-m-d'),
            'contactperson' => $request->input('contactperson'),
            'description' => $request->input('description'),
            'startdate' => $request->input('startdate'),
            'enddate' => $request->input('enddate'),
            'userid'=> $user->userid,
            'organicunitid' => $request->input('organicunitid')
        ]);
        $tags = $request->input('tags');
        $tagNames = explode(',', $tags);

        foreach ($tagNames as $tagName) {
            $tagId = Tag::where('tagnameportuguese',$tagName)->orWhere('tagnameenglish',$tagName)->value('tagid');
            if ($tagId) {
                $tagIds[] = (int) $tagId;
            }
            else {
                return redirect()->back()->withErrors(['tag' => 'Tag not found, id: ' . $tagId]);
            }
        }
        $event->tags()->attach($tagIds);
        $event->save();
        $user->events()->save($event);

        $events = $user->events()->get();
        $services = $user->services()->get();
        return redirect()->route('my.requests', ['events' => $events, 'services' => $services])->with('success', 'Event edit request sent successfully.');
    }

    public function deleteEvent($id)
    {
        if (!Auth::check()) return redirect('/login');
        if(Session::has('orig_user')) {
            return redirect()->to('/')->withErrors('You are not authorized to delete an event in user view.');
        }
        $event = Event::find($id);
       // $event->user()->detach();
        $event->tags()->detach();
        $event->delete();

        return redirect()->back()->with('success', 'Event deleted successfully.');
    }
}
