<div class="media">
  <div class="media-left">
       <a href="{{route('user.profile', [$user->employee_id])}}" title="{!! $user->name !!}">
            <img class="aavatar"
                src="/{!! $user->aavatar->thumbnail_path !!}"
                 alt="{!! $user->name !!}">
          </a>
  </div>
  <div class="media-body">
    <h4 class="media-heading"> {!! $user->name !!} </h4>
    <span class="text text-mute"> <a href="{{route('user.profile', [$user->employee_id])}}">{{'@'.$user->employee_id}}</a></span>
  </div>
</div>