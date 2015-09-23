@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2">
              @include('layouts.partials.profile')
            </div>
            <div class="col-md-10">
                 @include('layouts.partials.flash')
                      @foreach ($friends->chunk(3) as $chunkFriends)
                          <div class="row">
                              @foreach ($chunkFriends as $user)
                                  <div class="col-md-4">
                                    <div class="panel panel-default">
                                       <!-- Default panel contents -->
                                       <div class="panel-body">
                                         <div class="media">
                                           <div class="media-left">
                                                <a href="{{route('user.profile', [$user->employee_id])}}" title="{!! $user->name !!}">
                                                     <img class="aavatar"
                                                         src="/{!! $user->thumbnail_path !!}"
                                                          alt="{!! $user->name !!}">
                                                   </a>
                                           </div>
                                           <div class="media-body">
                                             <h4 class="media-heading"><a style="color: #0D0D0D;" href="{{route('user.profile', [$user->employee_id])}}">{!! $user->name !!} </a></h4>
                                             <p class="text"> <a href="{{route('user.profile', [$user->employee_id])}}">{{'@'.$user->employee_id}}</a></p>
                                              <p class="text text-muted">
                                                    {!! $user->designation !!} at {!! $user->current_branch!!}
                                              </p>
                                           </div>
                                         </div>
                                         </div>
                                       </div>
                                  </div>
                              @endforeach
                          </div>
                      @endforeach

                 @if($friends->hasMorePages())
                     <div class="panel-footer">
                            {!! with(new Banijya\Paginator\FriendsPaginator($friends) )->render() !!}
                     </div>
                 @endif
            </div>
        </div>
    </div>
@stop
