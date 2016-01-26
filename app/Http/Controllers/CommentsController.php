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
    /**
     * Store a comment in a posts
     * @param   $request
     * @param            $postid
     * @return
     */
    public function store(CommentsRequest $request, $postid)
    {
        $post = Post::with('owner')->findOrFail($request->post_id);

        $user = Auth::user();

        $comment = new Comment($request->all());

        $comment->attachTo($user)->attachTo($post)->save();

        return redirect()
                    ->route('users.posts',[$post->owner->employee_id,$post->id] )
                    ->with('success_message', 'Your comment has been posted.');
    }
}
