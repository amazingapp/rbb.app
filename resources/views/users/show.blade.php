@extends('layouts.master')
@section('content')
    <div class="row">
         <div class="col-md-3">
            @include('layouts.partials.profile')
        </div>
        <div class="col-md-6">
            @include('posts.partials.publish-post-form')
            @include('users.partials.posts')
            @include('layouts.partials.simple-pagination', array('paginate' => $feeds))
        </div>
        <div class="col-md-3">
            @include('friends.partials.friendship-status')
        </div>
    </div>
@stop
