<?php

namespace App\Http\Controllers;

use App\Http\Controllers\TagController;

class HomeController extends Controller{

    /**
     * Show the events page //TODO: check naming conventions
     */
    public function list(){
        $tagController = new TagController();
        $tags = $tagController->getTopTagsByEventCount();
        return view('pages.home',['tags' => $tags]);
    }

}
