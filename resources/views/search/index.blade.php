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
                   <strong>We Found {{$users->total()}} results.</strong>
                 </div>
                 <!-- List group -->
                 <ul class="list-group">
                    @foreach($users as $friend)
                        <li class="list-group-item">
                        <div class="media">
                              <div class="media-left">
                                <a href="#">
                                  <img class="media-object" data-src="holder.js/64x64" alt="64x64" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PGRlZnMvPjxyZWN0IHdpZHRoPSI2NCIgaGVpZ2h0PSI2NCIgZmlsbD0iI0VFRUVFRSIvPjxnPjx0ZXh0IHg9IjE0LjUiIHk9IjMyIiBzdHlsZT0iZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQ7ZG9taW5hbnQtYmFzZWxpbmU6Y2VudHJhbCI+NjR4NjQ8L3RleHQ+PC9nPjwvc3ZnPg==" data-holder-rendered="true" style="width: 64px; height: 64px;">
                                </a>
                              </div>
                              <div class="media-body">
                                <h4 class="media-heading">{{$friend->name}}</h4>
                                <p class="text">
                                   <span class="glyphicon glyphicon-briefcase" arial-hidden="true"></span>
                                   {{$friend->designation}} at {{$friend->current_branch}}
                                </p>
                                <p class="text">
                                    <form class="friends_requests" action="{{route('friends.send_request', [$friend->id])}}" method="POST">
                                        {{csrf_field()}}
                                        <button type="submit" class="btn btn-primary btn-sm">Send Request</button>
                                    </form>
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