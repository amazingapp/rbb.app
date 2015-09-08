<?php

namespace Banijya\Http\Controllers;

use Illuminate\Http\Request;

use Banijya\Http\Requests;
use Banijya\Http\Controllers\Controller;
use Banijya\Post, Banijya\Comment, Input;
use URL, Auth;
class CommentsController extends Controller
{
    public function store($postid)
    {
        $post = Post::findOrFail($postid);
        $user = Auth::user();
        $comment = Comment::create(Input::all())
                        ->attachTo($post)
                        ->attachTo($user);

        return redirect(URL::previous() . "#post-{$postid}"); //
    }
}
