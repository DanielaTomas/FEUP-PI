<?php

namespace App\Http\Controllers;


class EventController extends Controller
{

    /**
     * Show the events page //TODO: check naming conventions
     */
    public function show()
    {
        return view('pages.events');
    }

}
