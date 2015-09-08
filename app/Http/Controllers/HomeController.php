<?php

namespace Banijya\Http\Controllers;

use Banijya\Http\Controllers\Controller;
use Banijya\Http\Requests;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Banijya\User;

class HomeController extends Controller
{
    public function splash()
    {
        $title = trans('common.title') . ' | '. trans('common.appname');
        return view('home.splash')->with(compact('title'));
    }
}
