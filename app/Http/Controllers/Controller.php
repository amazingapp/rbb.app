<?php

namespace Banijya\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use View, Auth;
abstract class Controller extends BaseController
{
    use DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $user = Auth::user();
        View::share('signedIn', $user);
        View::share('authUser', $user );

        $this->shareAavatar($user);
        $this->shareFriendRequest($user);
    }

    protected function shareAavatar($user)
    {
        if($user) View::share('authAavatar', $user->image);
    }

    public function shareFriendRequest($user)
    {
        if($user) View::share('friendRequests', $user->friendsRequests()->count());
    }
}
