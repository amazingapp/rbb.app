<article class="comment__comment post-media">
    <div class="pull-left">
        <img src="/images/avatar_small.jpg" alt="Placeholder" style="height:33px;width:33px;" />
    </div>
    <div class="media-body">
        <p class="text" style="padding-left: 10px;text-align: justify;">
            <a class="text-primary" style="font-size: 14px;" href="{{route('user.profile',[$comment->owner->employee_id])}}">{!! $comment->owner->name !!}</a>
            {!! $comment->body !!}
        </p>
        <small class="time text-muted">
            {{$comment->created_at->diffForHumans()}}
        </small>
    </div>
</article>
