<?php

namespace Banijya\Http\Controllers;

use Auth;
use Banijya\Http\Controllers\Controller;
use Banijya\Http\Requests;
use Banijya\Http\Requests\PostsRequest;
use Banijya\User, Banijya\Post;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Banijya\Services\PostComments;


class PostsController extends Controller
{

    /**
     * Show a single post of a user with comments
     * @param  [type] $employeeId [description]
     * @param  [type] $postid     [description]
     * @return [type]             [description]
     */
    public function show($employeeId, $postid , PostComments $postComments)
    {
        $user = User::with('aavatar')->findByEmployeeId($employeeId);

        $post = $user->posts()->findOrFail($postid);

        $comments = $postComments->commentFor($post)->simplePaginate();

        return view('posts.show', compact('post', 'user', 'comments'));
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

    /**
     * Delete a post
     * @param  Post   $post
     * @return  redirect
     */
    public function delete(Post $post)
    {
        $post->delete();
        return back()->withSuccessMessage('Post deleted successfully.');
    }

    /**
     * User liked a post
     * @param  Post   $post
     * @return Redirect
     */
    public function like(Post $post)
    {
        $alreadyLiked = $post->likesFor($this->auth->user());
        $message = '';

        if( !! $alreadyLiked->count() )
        {
            $message = 'You unliked a post.';
            $alreadyLiked->delete();
        }
        else
        {
            $message = 'You liked a post.';
            $post->likes()->create(['user_id' => $this->auth->user()->id]);
        }

        return back()->withSuccessMessage($message);
    }
}
