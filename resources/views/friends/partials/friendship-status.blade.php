<!-- if already friends display '(checkmark) Friends' -->
@if( $authUser->isFriendsWith($user) )
<p class="text">
    <span class="glyphicon glyphicon-ok-sign"></span>
    You and {{$user->name}} are friends.
</p>

@elseif($authUser->hasFriendRequestReceived($user))
    <button class="btn btn-xs btn-success">Respond to request</button>
@elseif($authUser->hasFriendRequestPending($user))
    <button class="btn btn-xs btn-default">Your request is pending</button>
@else
    <button class="btn btn-xs btn-primary">Send Request ?</button>
@endif