<?php

namespace Banijya\Http\Controllers;

use Banijya\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

class SessionsController extends Controller
{

    public function create()
    {
        return view('sessions.create');
    }

    /**
     * Log a user in
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Guard $auth, Request $input)
    {
        if( $auth->attempt($input->only('employee_id', 'password'), $input->get('remember', false)) )
        {
            return redirect()->intended('home');
        }
        return back()->withInput()->withErrorMessage( trans('sessions.login_incorrect') );
    }

    /**
     * Lets log a use out of the app
     * @param  Guard  $auth
     * @return  redirect
     */
    public function destroy(Guard $auth)
    {
        if ($auth->check())
        {
            $auth->logout();
            return redirect('login')->withSuccessMessage( trans('sessions.loggedout') ); // use lang
        }
        return redirect('login');
    }


}
