@inject('friendship', 'Banijya\Services\FriendshipService')

<?php $areFriends = $friendship->areFriends($authUser->id, $user->id); ?>

@if($feeds->count())
<div class="post-container">
    @foreach($feeds as $post)
        @include('users.partials.post')
    @endforeach
</div>
@else
<div class="panel panel-default">
      <div class="panel-body text-primary">
        {{ trans('common.no_posts') }}
      </div>
</div>
@endif
@section('scripts')
   @include('layouts.partials.comment-script')
@stop

