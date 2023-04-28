<?php

namespace App\Http\Controllers;

use App\Http\Controllers\TagController;
use App\Http\Controllers\OrganicUnitController;
use App\Http\Controllers\ServiceController;
class HomeController extends Controller{

    /**
     * Show the events page //TODO: check naming conventions
     */
    public function list(){
        $tagController = new TagController();
        $tags = $tagController->getTopTagsByEventCount();

        $organicUnitController= new OrganicUnitController();
        $organicUnits = $organicUnitController->getTopOrganicUnitsByEventCount();

        $serviceTypes=ServiceController::getServiceTypes();

        return view('pages.home',['tags' => $tags,'organicUnits' => $organicUnits,'servicetypes'=>$serviceTypes]);
    }

}
