<?php

namespace App\Http\Controllers;

use App\Http\Controllers\TagController;
use App\Http\Controllers\OrganicUnitController;
class HomeController extends Controller{

    /**
     * Show the events page //TODO: check naming conventions
     */
    public function list(){
        $tagController = new TagController();
        $tags = $tagController->getTopTagsByEventCount();

        $organicUnitController= new OrganicUnitController();
        $organicUnits = $organicUnitController->getTopOrganicUnitsByEventCount();
        return view('pages.home',['tags' => $tags,'organicUnits' => $organicUnits]);
    }

}
