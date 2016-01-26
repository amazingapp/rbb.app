<?php

namespace Banijya\Services;
use DB;

class PostComments
{
    protected $query;


    /**
     * fetching comments for a particular post
     * @param   $post
     * @return  QueryBuilder
     */
    public function for($post)
    {
        return DB::table('comments')
                        ->select(
                            DB::raw('comments.body, comments.created_at,
                            images.caption AS image_caption,
                            images.path AS image_path, images.thumbnail_path,
                            images.icon_path,
                            users.name AS user_name, users.employee_id, users.id as user_id')
                        )
                        ->join('users', 'users.id', '=', 'comments.user_id')
                        ->join('images','images.user_id','=','users.id')
                        ->where('comments.post_id', '=', $post->id)
                        ->latest('comments.created_at');
    }
}