<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller{

    public function getTopTagsByEventCount(){
        $tags = Tag::withCount('events')
                    ->orderByDesc('events_count')
                    ->limit(3)
                    ->get();
        return $tags;
    }
}
