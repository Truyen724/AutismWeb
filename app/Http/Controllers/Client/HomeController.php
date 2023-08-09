<?php

namespace App\Http\Controllers\Client;

class HomeController extends BaseClientController
{

    public function __construct()
    {

        // parent::__construct();
    }

    public function index()
    {
        return view('pages.index');

    }
}
