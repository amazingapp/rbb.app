<article class="comment__comment post-media">
    <div class="pull-left">
        <img src="/{{ $comment->icon_path}}" alt="Placeholder" style="height:33px;width:33px;" />
    </div>
    <div class="media-body">
        <p class="text" style="padding-left: 10px;text-align: justify;">
            <a class="text-primary" style="font-size: 14px;" href="{{route('user.profile',[$comment->employee_id])}}">{!! $comment->user_name !!}</a>
            {!! $comment->body !!}
        </p>
        <small class="time text-muted">
            <a href="javascript:" title="{{ Carbon\Carbon::parse($comment->created_at)->toDayDateTimeString() }}" data-toggle="tooltip" data-placement="top" >
                {{Carbon\Carbon::parse($comment->created_at)->diffForHumans()}}
            </a>
        </small>
    </div>
</article>