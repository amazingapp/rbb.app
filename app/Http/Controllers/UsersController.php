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
        $user = User::with('posts')->where('employee_id',$employeeId)->firstOrFail();

        return view('posts.profile')->with(compact('user'));
    }
}
