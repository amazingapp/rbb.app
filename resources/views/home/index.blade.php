@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="row">
          <div class="col-md-3">
            @include('layouts.partials.profile', ['user' => $authUser])
          </div>
          <div class="col-md-6">
              @include('posts.partials.publish-post-form')
              @include('home.partials.posts')
              @include('layouts.partials.simple-pagination', array('paginate' => $feeds))
          </div>
        </div>
    </div>

@stop
