@if($feeds->count())
<div class="post-container">
    @foreach($feeds as $post)
        @include('home.partials.single')
    @endforeach
</div>
@else
<div class="panel panel-default">
      <div class="panel-body text-primary">
        {{ trans('common.no_posts') }}
      </div>
</div>
@endif
