<?php

namespace Banijya\Http\Controllers;

use Illuminate\Http\Request;

use Banijya\Http\Requests;
use Banijya\Http\Controllers\Controller;
use Banijya\User;

class UsersController extends Controller
{
    public function show($employeeId)
    {
        $user = User::where('employee_id',$employeeId)->firstOrFail();

        $posts = $user->posts()->simplePaginate(4);

        return view('posts.profile')->with(compact('user', 'posts'));
    }
}
