@extends('layouts.master')
@section('content')
    <div class="row">
    	 <div class="col-md-3">
            @include('layouts.partials.profile')
        </div>
        <div class="col-md-6">
            @include('layouts.partials.flash')
            @include('posts.partials.publish-post-form')
            @include('posts.partials.posts', ['feeds' => $posts])
            @include('layouts.partials.simple-pagination', array('paginate' => $posts))
        </div>

        <div class="col-md-3">
            @include('friends.partials.friendship-status')
        </div>
    </div>
@stop
