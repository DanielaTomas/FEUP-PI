<?php

namespace App\Http\Controllers;

use App\Models\Event;
class EventController extends Controller{

    /**
     * Show the events page //TODO: check naming conventions
     */
    public function list(){
        $events = Event::all();
        return view('pages.events', ['events' => $events]);
    }

    public function listByTag($tagId){
        $tag = Tag::findOrFail($tagId);
        $events = $tag->events()->get();
        return view('pages.events', ['events' => $events,'tag' => $tag->tagname]);
    }


    // Show the event page
    public function show($eventId){   
        $event= Event::find($eventId);
        return view('pages.event',['event' => $event]);
    }

}
