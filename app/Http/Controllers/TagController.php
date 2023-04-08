<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller{

    public function getTopTagsByEventCount(){
        $tags = Tag::withCount(['events' => function ($query) {//TODO: Decide what to do with cancelled events
                                    $query->where('requeststatus', 'Accepted');
                                }])
                                ->orderByDesc('events_count')
                                ->limit(3)
                                ->get();
        return $tags;
    }

    public function show($id){//TODO: Decide what to do with cancelled events
        $tag = Tag::findOrFail($id);
        $events = $tag->events()
                      ->where('requeststatus', 'Accepted')
                      ->get();
        return view('pages.events', ['events' => $events,'tag' => $tag->tagname]);
    }

    public static function getAllTags(){
        $tags = Tag::all();
        return $tags;
    }
}
