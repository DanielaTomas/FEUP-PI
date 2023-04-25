<?php

namespace App\Http\Controllers;

use App\Http\Controllers\TagController;
use App\Http\Controllers\OrganicUnitController;
class CategoryController extends Controller{

    /**
     * Show the events page //TODO: check naming conventions
     */
    public function showEventCategories(){
        $tagController = new TagController();
        $tags = $tagController->getAllTagsWithEventCount();

        $organicUnitController= new OrganicUnitController();
        $organicUnits = $organicUnitController->getAllOrganicUnitsEvents();
        return view('pages.eventCategories',['tags' => $tags,'organicunits' => $organicUnits]);
    }

}
