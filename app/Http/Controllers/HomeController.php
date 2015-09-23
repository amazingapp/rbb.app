<?php

namespace Banijya\Http\Controllers;

use Banijya\Http\Controllers\Controller;
use Banijya\Http\Requests;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Banijya\User;
class HomeController extends Controller
{

      /**
     * Simple Paginate the home page
     * @param    $auth
     * @return
     */
    public function index( Guard $auth )
    {
        $feeds = $auth->user()
                            ->posts()
                            ->with(['comments' => function($query){
                                $query->latest()->limit(2);
                            }])
                            ->with('owner.aavatar')
                            ->latest()
                            ->simplePaginate();

        $user = $auth->user();

        return view('home.index', compact('feeds', 'user'));
    }

    public function splash()
    {
        $title = trans('common.title') . ' | '. trans('common.appname');
        return view('home.splash')->with(compact('title'));
    }
}
