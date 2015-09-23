@if($feeds->count())
<div class="post-container">
    @foreach($feeds as $post)
        @include('posts.partials.post')
    @endforeach
</div>
@else
<div class="panel panel-default">
      <div class="panel-body text-primary">
        {{ trans('common.no_posts') }}
      </div>
</div>
@endif
