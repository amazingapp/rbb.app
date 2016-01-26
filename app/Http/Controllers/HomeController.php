<?php

namespace Banijya\Http\Controllers;

use Banijya\Http\Controllers\Controller;
use Banijya\Http\Requests;
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
    public function index( Guard $auth )
    {
      #optimize the home query
       $friendsIds = DB::table('users')->select(['users.id'])
                      ->join('friends',function($join){
                      $join->on('users.id','=','friends.user_id')
                            ->orOn('users.id','=', 'friends.friend_id');
                    })
                    ->where('friends.accepted', 1)
                    ->where('users.id','<>', Auth::id())
                    ->lists('id');
      $friendsIds = array_merge($friendsIds, [Auth::id()]);

      $feeds = DB::table('posts')
                ->select(DB::raw('posts.body, posts.created_at,posts.id AS post_id,
                    images.caption AS image_caption, images.path AS image_path, images.thumbnail_path,
                    COUNT( DISTINCT( comments.id ) ) AS comment_count, COUNT( DISTINCT(likes.id ) ) AS like_count,
                    users.name AS user_name, users.employee_id'))
                  ->join('users', 'users.id', '=', 'posts.user_id')
                  ->join('images', 'posts.user_id', '=', 'images.user_id')
                  ->leftJoin('comments', 'comments.post_id', '=', 'posts.id')
                  ->leftJoin('likes', function($join)
                {
                  $join->on('likes.likeable_id', '=', 'posts.id')
                        ->where('likes.likeable_type',' = ','Banijya\Post');
                })
                ->whereIn('posts.user_id', $friendsIds)
                ->groupBy('posts.id')
                ->latest('posts.created_at')
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
