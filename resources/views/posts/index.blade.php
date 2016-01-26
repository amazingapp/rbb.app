@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            @include('layouts.partials.flash')
            @include ('posts.partials.publish-status-form')
            @include('posts.partials.posts')
        </div>
    </div>
@stop
