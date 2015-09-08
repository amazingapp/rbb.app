<?php

namespace Banijya\Http\Controllers;

use Illuminate\Http\Request;

use Banijya\Http\Requests;
use Banijya\Http\Controllers\Controller;
use Input, Banijya\User;
use Auth;
class SearchController extends Controller
{
    public function index()
    {
        $query = Input::get('q');
        $users = User::where('id','!=', Auth::id())
                        ->where(function($q) use ($query){
                            return $q->orWhere('name', 'like', "%{$query}%")
                                    ->orWhere('email','like', "%{$query}%")
                                    ->orWhere('employee_id','=',$query)
                                    ->orWhere('current_branch','like',$query);
                        })
                        ->paginate();

        return view('search.index', compact('users'));
    }
}
