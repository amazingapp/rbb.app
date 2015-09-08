<div class="media">
  <div class="media-left">
       <a href="{{route('user.profile', [$user->employee_id])}}" title="{!! $user->name !!}" tabindex="-1" aria-hidden="true">
            <img class="aavatar"
                src="https://pbs.twimg.com/profile_images/3038487941/c88a127241c6b5107417c153a15bdc25_bigger.jpeg"
                 alt="{!! $user->name !!}">
          </a>
  </div>
  <div class="media-body">
    <h4 class="media-heading"> {!! $user->name !!} </h4>
    <span class="text text-mute"> <a href="{{route('user.profile', [$user->employee_id])}}">{{'@'.$user->employee_id}}</a></span>
  </div>
</div>