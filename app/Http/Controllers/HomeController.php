<?php

namespace Banijya\Http\Controllers;

use Banijya\Http\Controllers\Controller;
use Banijya\Http\Requests;
use Banijya\Repository\UsersRepository;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Banijya\User;
use Banijya\Post;
use DB, Auth;
class HomeController extends Controller
{

      /**
     * Simple Paginate the home page
     * @param    $auth
     * @return
     */
    public function index( Guard $auth , UsersRepository $repository)
    {
      $user = $auth->user();

      $feeds = $repository->getFeedsFor($user);

      return view('home.index', compact('feeds', 'user'));
    }

    public function splash()
    {
        $title = trans('common.title') . ' | '. trans('common.appname');
        return view('home.splash')->with(compact('title'));
    }
}
