<article class="comment__comment post-media">
    <div class="pull-left">
        <img src="/{{ $comment->owner->aavatar->icon_path}}" alt="Placeholder" style="height:33px;width:33px;" />
    </div>
    <div class="media-body">
        <p class="text" style="padding-left: 10px;text-align: justify;">
            <a class="text-primary" style="font-size: 14px;" href="{{route('user.profile',[$comment->owner->employee_id])}}">{!! $comment->owner->name !!}</a>
            {!! $comment->body !!}
        </p>
        <small class="time text-muted">
            <a href="javascript:" title="{{ $comment->created_at->toDayDateTimeString() }}" data-toggle="tooltip" data-placement="top" >
                {{$comment->created_at->diffForHumans()}}
            </a>
        </small>
    </div>
</article>
