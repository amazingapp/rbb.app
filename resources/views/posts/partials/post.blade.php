<article class="media post-media" id="post-{{$post->id}}">
    <div class="pull-left">
        <img src="/images/avatar_small.jpg" alt="Placeholder" style="width:50px;height:50px;" />
    </div>
    <div class="media-body post-media-tooltip">
                   <span class="text">
                           <strong>
                               <a href="{{route('user.profile',[$post->owner->employee_id])}}" > {{ $post->owner->name }}</a>
                           </strong>
                        <span class="text text-muted">{{ $post->created_at->diffForHumans() }}</span>
                       </a>
                    </span>
        <p class="text">
            {{$post->body}}
        </p>
    </div>

    @if( $signedIn)
        <form action="{{route('posts.comments', $post->id)}}" class="form-comment" >
        <input type="hidden" name="post_id" value="{{$post->id}}">
        @if( $post->commentsCount )
            <p class="text-primary" style="padding: 7px 0px 0px 0px;margin: 0;">
                <a href="{{route('user.post',[$post->owner->employee_id, $post->id])}}" > View All Comments </a>
            </p>
        @endif
        <div class="input-group post__comment" style="padding-top: 10px;">
            <span class="input-group-addon" style="border:none;padding:0px;position:relative;">
              <img src="/images/avatar_small.jpg" alt="Placeholder" style="height:33px;width:33px" />
            </span>
            <div class="form-group">
                <textarea placeholder='Write a comment..'
                    class="form-control comment" arial-describedby="sizing-addon2"
                    name="body" id="id" cols="2" rows="1"></textarea>
            </div>
        </div>
        </form>
    @endif
</article>

@section('scripts')
   @include('posts.partials.comment-script')
@stop

