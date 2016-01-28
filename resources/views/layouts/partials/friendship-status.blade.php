@if($user->friendship_status === 'friends')
<p class="text-success">
            <span class="glyphicon glyphicon-ok-sign"></span>
            You and {{$user->user_name}} are friends.
</p>
@elseif($user->friendship_status =='request_pending')

  <span class="label label-default label-friend-request-pending">Your request is pending</span>

@elseif($user->friendship_status == 'respond_request')
    <form action="{!! route('friends.accept', $user->user_id) !!}" method="POST">
            {!! csrf_field() !!}
        <button type="submit" class="btn btn-xs btn-success">Respond friend request</button>
    </form>
@else

 <form action="{!! route('friends.send_request', $user->user_id) !!}" method="POST">
        {!! csrf_field() !!}
        <button type="submit" class="btn btn-xs btn-primary">Send Request</button>
</form>
@endif
