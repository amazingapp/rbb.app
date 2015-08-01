<a href="{{route('profile', $user->username)}}">
    <img class="media-object img-circle avatar" src="{{$user->present()->gravatar(isset($size)?$size:30)}}" alt="{{$user->name}}" />
</a>