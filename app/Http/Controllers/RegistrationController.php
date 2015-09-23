<?php

namespace Banijya\Http\Controllers;

use Illuminate\Http\Request;

use Banijya\Http\Requests;
use Banijya\Http\Controllers\Controller;
use Banijya\Http\Requests\RegisterRequest;
use Auth;
use Banijya\User;

class RegistrationController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('registration.create')->withTitle(trans('common.title') ." | Register");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(RegisterRequest $request)
    {
        $user = User::create($request->all());

        $user->aavatar()->create([]); //just create a empty images so that all the default images are there

        Auth::login($user);

        return redirect('home')->withSuccessMessage('Thank you for signing up!');

        // when creating a user we also need to add a dummy aavatar by default
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
