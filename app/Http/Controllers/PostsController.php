<?php

namespace Banijya\Http\Controllers;

use Auth;
use Banijya\User;
use Banijya\Http\Controllers\Controller;
use Banijya\Http\Requests;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
class PostsController extends Controller
{
    public function index( Guard $auth )
    {
        $feeds = $auth->user()->posts()->latest()->simplePaginate(5);

        return view('home.index', compact('feeds'));
    }

    public function show($employeeId, $postid)
    {
        $user = User::where('employee_id', $employeeId)->firstOrFail();
        $post = $user->posts()->findOrFail($postid);
        $comments = $post->comments()->simplePaginate();

        return view('posts.single', compact('post', 'user', 'comments'));
    }
}
