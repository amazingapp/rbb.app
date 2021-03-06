@extends('layouts.master')
@section('content')
<div class="row">
    <div class='col-md-7 col-md-offset-2'>
            @include('layouts.partials.flash')
            @include('layouts.partials.errors')
            <div class="post-container">
                <article class="media post-media">
                    <div class="pull-left">
                        <img src="/{{ $user->aavatar->thumbnail_path}}" alt="Placeholder" style="width:50px;height:50px;" />
                    </div>
                    @include('posts.partials.delete-post')
                    <div class="media-body post-media-tooltip">
                       <span class="text single-post-title">
                           <strong>
                               <a href="{{route('user.profile',[$user->employee_id])}}" > {{ $user->name }}</a>
                           </strong>
                        <a href="{!! route('users.posts',[$user->employee_id, $post->id]) !!}">
                            <span class="text text-muted">{{ $post->created_at->diffForHumans() }}</span></a>
                       </a>
                    </span>
                    <p class="text single-post-body">
                        {{$post->body}}
                    </p>
                </div>
                    @if( $signedIn )
                        <form action="{{route('posts.comments', [$post->id])}}" method="POST" class="form-comment">
                        <input type="hidden" value="{{$post->id}}" name="post_id">
                        {!! csrf_field() !!}
                        <small class="text-muted comment-helper">Hit Ctrl + Enter to leave a comment</small>
                        <div class="input-group post__comment" style="padding-top: 22px;">

                            <span class="input-group-addon" style="border:none;padding:0px;position:relative;">
                              <img src="/{{$authAavatar->icon_path}}" alt="Placeholder" style="width:33px;height:33px;" />
                            </span>
                            <textarea name="body" class="form-control comment" aria-describedby="sizing-addon2" placeholder="Write a comment .." rows="1"></textarea>
                        </div>
                        </form>
                    @endif
            </article>
    @if($comments->count())
        @foreach( $comments as $comment)
            @include('posts.partials.comment')
        @endforeach
        <article class="post-media">
                <div class="media-body">
                    @include('layouts.partials.simple-pagination', array('paginate' => $comments))
                </div>
        </article>
    @endif
            </div>
        </div>
    </div>
@stop
@section('scripts')
   @include('posts.partials.comment-script')
@stop