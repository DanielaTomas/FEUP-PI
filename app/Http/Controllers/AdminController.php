<?php

namespace App\Http\Controllers;


class AdminController extends Controller
{

    /**
     * Show the admin dashboard //TODO: check naming conventions
     */
    public function show()
    {
        return view('pages.admin');
    }

}
