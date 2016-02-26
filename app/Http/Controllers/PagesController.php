<?php

namespace Banijya\Http\Controllers;

class PagesController extends Controller
{

    public function terms()
    {
        return view('pages.terms');
    }
}