<?php

namespace Banijya\Http\Controllers;

use Illuminate\Http\Request;
use Banijya\Http\Requests;
use Banijya\Http\Controllers\Controller;

class MessagesController extends Controller
{

    public function index()
    {
        return view('messages.index');
    }
}
