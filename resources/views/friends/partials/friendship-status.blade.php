@if($authUser)
        @if($user->id === $authUser->id)

        @elseif( $authUser->isFriendsWith($user) )
        <p class="text-success">
            <span class="glyphicon glyphicon-ok-sign"></span>
            You and {{$user->name}} are friends.
        </p>
        @elseif($authUser->hasFriendRequestReceived($user))
        <form action="{!! route('friends.accept', $user->id) !!}" method="POST">
                {!! csrf_field() !!}
            <button type="submit" class="btn btn-xs btn-success">Respond to request</button>
        </form>
        @elseif($authUser->hasFriendRequestPending($user))
                    <span class="label label-default label-friend-request-pending">Your request is pending</span>
        @else
            <form action="{!! route('friends.send_request', $user->id) !!}" method="POST">
                {!! csrf_field() !!}
                <button type="submit" class="btn btn-xs btn-primary">Send Request</button>
            </form>
        @endif
@endif
