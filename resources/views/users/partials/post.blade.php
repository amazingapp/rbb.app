<article class="media post-media" id="post-{{$post->post_id}}">
    <div class="pull-left">
        <img src="/{{$post->thumbnail_path}}" alt="{{ $post->user_name }}" style="width:43px;height:43px;" />
    </div>
@include('posts.partials.delete-post')
<div class="media-body post-media-tooltip">
   <span class="text">
           <strong>
               <a href="{{route('user.profile',[$post->employee_id])}}" > {{ $post->user_name}}</a>
           </strong>
        <a href="{!! route('users.posts', [$post->employee_id, $post->post_id]) !!}"><span class="text text-muted">{{ Carbon\Carbon::parse($post->created_at)->diffForHumans() }}</span></a>
       </a>
    </span>
    <p class="text">
        {!! $post->body !!}
    </p>
  </div>
<p class="text-primary" style="padding: 7px 0px 2px 0px;margin: 0;">
@if( $post->like_count )
<a href="#" >{!! $post->like_count . ' '. str_plural('Like', $post->like_count) !!}</a>
@endif
@if( $post->comment_count )
<a href="{{route('users.posts',[$post->employee_id, $post->post_id])}}" >{!! $post->comment_count . ' '. str_plural('Comment', $post->comment_count) !!}</a>
@endif
</p>
  @if( $areFriends or ( $authUser && $authUser->id == $post->user_id) )
    @include('users.partials.comment')
  @endif
</article>

