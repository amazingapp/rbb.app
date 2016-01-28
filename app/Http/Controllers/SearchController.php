<?php

namespace Banijya\Http\Controllers;

use Illuminate\Http\Request;

use Banijya\Http\Requests;
use Banijya\Http\Controllers\Controller;
use Input, Banijya\User;
use Auth;
use DB;
class SearchController extends Controller
{

    public function index()
    {
        $query = Input::get('q');
        $userId = Auth::id();
        $users = DB::table('users')
                    ->select(DB::raw("
                        images.caption AS image_caption, images.path AS image_path, images.thumbnail_path,
                        users.name AS user_name, users.designation,
                        users.employee_id,
                        users.id AS user_id,
                        users.current_branch,
                        CASE
                            WHEN (
                                users.id = friends.user_id AND {$userId} = friends.friend_id OR
                                users.id = friends.friend_id AND {$userId} = friends.user_id
                            ) AND friends.accepted = 1
                             THEN 'friends'
                        WHEN ( users.id = friends.user_id AND friends.friend_id = {$userId} AND friends.accepted = 0) THEN 'request_pending'
                        WHEN ( {$userId} = friends.user_id AND friends.friend_id = users.id AND friends.accepted = 0) THEN 'respond_request'
                        ELSE 'send_request' END AS friendship_status"))
            ->join('images','images.user_id','=','users.id')
            ->leftJoin('friends',function($join){
                $join->on('users.id','=','friends.user_id')
                    ->orOn('users.id','=','friends.friend_id');
            })
            ->where('users.id','<>', $userId)
            ->where(function($q) use ($query){
                return $q->orWhere('users.name', 'like', "%{$query}%")
                        ->orWhere('users.employee_id','like',"%{$query}%")
                        ->orWhere('users.current_branch','like',"%{$query}%");
            })
            ->groupBy('users.id')
            ->orderBy('users.name', 'asc')
            ->paginate();

        return view('search.index', compact('users'));
    }
}
