<?php

namespace Banijya\Http\Controllers;

use Auth, User;
use Banijya\Http\Controllers\Controller;
use Banijya\Http\Requests;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
class PostsController extends Controller
{
    public function index( Guard $auth )
    {
        $feeds = $auth->user()->posts()->latest()->simplePaginate(5);
        // dd($feeds);
        return view('home.index', compact('feeds'));
    }
}
