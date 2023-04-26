<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TagController extends Controller{


    public static function getAllTagsWithEventCount(){
        $tags = Tag::withCount(['events' => function ($query) {//TODO: Decide what to do with cancelled events
            $query->where('requeststatus', 'Accepted');
        }])->orderByDesc('events_count')->get();
        return $tags;
    }

    public static function getOrganicUnits(){
        return OrganicUnit::all();
    }

    public function getTopTagsByEventCount(){
        $tags = Tag::withCount(['events' => function ($query) {//TODO: Decide what to do with cancelled events
                                    $query->where('requeststatus', 'Accepted');
                                }])
                                ->orderByDesc('events_count')
                                ->limit(3)
                                ->get();
        return $tags;
    }

    protected function validator(array $data){ 
            return Validator::make($data, [
              'tagname' => 'required|string',
            ]);
      }

    public function createTag(Request $request){
        if (!Auth::check()) return redirect('/login');

        $this->validator($request->all())->validate();
        $user=Auth::user();
        $tag=Tag::create([
            'tagname' => $request->input('tagname'),
        ]);
        return redirect()->back()->with('success', 'Tag created sucessfully.');
    }

    public function show($id){//TODO: Decide what to do with cancelled events
        $tag = Tag::findOrFail($id);
        $events = $tag->events()
                      ->where('requeststatus', 'Accepted')
                      ->get();
        $language = app()->getLocale();
        if($language == 'pt')
            return view('pages.events', ['events' => $events,'tag' => $tag->tagnameportuguese]);
       
        return view('pages.events', ['events' => $events,'tag' => $tag->tagnameenglish]);
    }

    public static function getAllTags(){
        $tags = Tag::all();
        return $tags;
    }
}
