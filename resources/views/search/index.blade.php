@extends('layouts.master')
@section('content')
 <div class="container">
        <div class="row">
            <div class="col-md-3">
              @include('layouts.partials.profile', ['user' => $authUser])
            </div>
            <div class="col-md-6">
                 @include('layouts.partials.flash')
                <div class="panel panel-default">
                 <!-- Default panel contents -->
                 <div class="panel-body">
                   <strong>Found {{$users->total()}} {{str_plural('result' , $users->total())}}.</strong>
                 </div>
                 <!-- List group -->
                 <ul class="list-group">
                    @foreach($users as $friend)
                        <li class="list-group-item" id="friend-{!! $friend->employee_id !!}">
                        <div class="media">
                              <div class="media-left">
                                <a href="#">
                                  <img src="/{{$friend->thumbnail_path}}" style="width: 64px; height: 64px;">
                                </a>
                              </div>
                              <div class="media-body">
                                <h4 class="media-heading">
                                  <a href="{{route('user.profile', [$friend->employee_id])}}">{{$friend->user_name}}</a>
                                </h4>
                                <p class="text">
                                   <span class="glyphicon glyphicon-briefcase" arial-hidden="true"></span>
                                   {{$friend->designation}} at {{$friend->current_branch}}
                                </p>
                                <p class="text">
                                   @include('layouts.partials.friendship-status',['user'=> $friend])
                                </p>
                              </div>
                            </div>
                        </li>
                    @endforeach
                 </ul>
                 <div class="panel-footer">
                            {!! $users->appends(Input::only('q'))->render() !!}
                     </div>
               </div>
            </div>
        </div>
    </div>
@stop