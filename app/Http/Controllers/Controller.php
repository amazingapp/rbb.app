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
        View::share('signedIn', Auth::user());
        View::share('authUser', Auth::user() );
        if(Auth::user()) $this->shareAavatar();
    }

    protected function shareAavatar()
    {
        View::share('authAavatar', Auth::user()->aavatar()->first() );
    }
}
