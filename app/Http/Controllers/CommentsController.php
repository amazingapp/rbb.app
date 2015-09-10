<?php

namespace Banijya\Http\Controllers;

use Banijya\Http\Controllers\Controller;
use Banijya\Http\Requests;
use Banijya\Http\Requests\CommentsRequest;
use Banijya\Post, Banijya\Comment;
use Illuminate\Http\Request;
use URL, Auth;
class CommentsController extends Controller
{
    public function store(CommentsRequest $request, $postid)
    {
        $post = Post::findOrFail($postid);

        $user = Auth::user();

        $comment = Comment::create($request->all())
                        ->attachTo($post)
                        ->attachTo($user);

        return redirect(URL::previous() . "#post-{$postid}"); //
    }
}
