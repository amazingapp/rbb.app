@extends('layouts.master')
@section('content')
    <div class="row">
    	 <div class="col-md-4">
            @include('layouts.partials.profile')
        </div>
        <div class="col-md-6">
            @include('layouts.partials.flash')
            @include('posts.partials.posts', ['feeds' => $user->posts])
        </div>

        <div class="col-md-2">
            <!-- if already friends display '(checkmark) Friends' -->
            <p class="text-primary">
                <span class="glyphicon glyphicon-ok-circle"></span>
            </p>
            <p class="text-primary">
                Do you want to send a friend request?
            </p>
            <button class="btn btn-xs btn-primary">
                    Send Request
                </button>
        </div>
    </div>
@stop
