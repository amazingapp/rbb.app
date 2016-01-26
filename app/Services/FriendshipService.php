<?php

namespace Banijya\Services;
use DB;

class FriendshipService
{
    /**
     * Check to see if two users are friends with each other
     * @param   $firstUser
     * @param   $secondUser
     * @return  bool
     */
    public function areFriends($firstUser, $secondUser)
    {
        $userIds = [$firstUser, $secondUser];

        return !! DB::table('friends')
                    ->whereIn('friends.user_id',   $userIds )
                    ->whereIn('friends.friend_id', $userIds )
                    ->where('friends.accepted', '=', 1)
                    ->count();
    }
}