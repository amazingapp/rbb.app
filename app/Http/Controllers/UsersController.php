<?php

namespace Banijya\Http\Controllers;

use Illuminate\Http\Request;

use Banijya\Http\Requests;
use Banijya\Http\Controllers\Controller;
use Banijya\User;
use Banijya\Comment;
use DB;

class UsersController extends Controller
{
    /**
     * Show a Users Profile & Posts
     * @param   $employeeId
     * @return  View
     */
    public function show($employeeId)
    {
        $user = User::findByEmployeeId($employeeId);

        $feeds = DB::table('posts')
                  ->select(DB::raw('posts.body, posts.created_at,posts.id AS post_id,
                      images.caption AS image_caption, images.path AS image_path, images.thumbnail_path,
                      COUNT( DISTINCT( comments.id ) ) AS comment_count, COUNT( DISTINCT(likes.id ) ) AS like_count,
                      users.name AS user_name, users.employee_id, users.id as user_id'))
                    ->join('users', 'users.id', '=', 'posts.user_id')
                    ->join('images', 'posts.user_id', '=', 'images.user_id')
                    ->leftJoin('comments', 'comments.post_id', '=', 'posts.id')
                    ->leftJoin('likes', function($join)
                  {
                    $join->on('likes.likeable_id', '=', 'posts.id')
                          ->where('likes.likeable_type',' = ','Banijya\Post');
                  })
                  ->where('posts.user_id', '=', $user->id)
                  ->groupBy('posts.id')
                  ->latest('posts.created_at')
                  ->simplePaginate();

        return view('users.show')->with(compact('user', 'feeds'));
    }
}
