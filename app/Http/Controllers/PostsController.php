<?php

namespace Banijya\Http\Controllers;

use Auth;
use Banijya\Http\Controllers\Controller;
use Banijya\Http\Requests;
use Banijya\Http\Requests\PostsRequest;
use Banijya\User, Banijya\Post;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
class PostsController extends Controller
{
    /**
     * Simple Paginate the home page
     * @param    $auth
     * @return
     */
    public function index( Guard $auth )
    {
        $feeds = $auth->user()->posts()->with('owner.aavatar')->latest()->simplePaginate();

        return view('home.index', compact('feeds'));
    }

    /**
     * Show a single post of a user with comments
     * @param  [type] $employeeId [description]
     * @param  [type] $postid     [description]
     * @return [type]             [description]
     */
    public function show($employeeId, $postid)
    {
        $user = User::where('employee_id', $employeeId)->firstOrFail();
        $post = $user->posts()->with('owner.aavatar')->findOrFail($postid);
        $comments = $post->comments()->with('owner.aavatar')->latest()->simplePaginate();

        return view('posts.single', compact('post', 'user', 'comments'));
    }


    /**
     * Create a Post
     * @param  PostsRequest $request [description]
     * @return    view
     */
    public function create(PostsRequest $request)
    {
        $post = Post::create($request->all());

        auth()->user()->posts()->save($post);

        return back()->withSuccessMessage('Your Post have been created.');
    }
}
