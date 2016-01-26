@include('layouts.partials.errors')
@include('layouts.partials.flash')
@if(Auth::id() === $user->id)
<div class="post-post">
        <form action="{{route('posts.create')}}" method="POST">
            <input type="hidden" name="user_id" value="{{Auth::id()}}">
            {!! csrf_field() !!}
            <div class="form-group">
                <textarea name="body" id="body" class="form-control creaet-post" placeholder="Whats happening?" cols="2" rows="3">{{Input::old('body')}}</textarea>
            </div>
            <div class="form-group post-post-submit">
                <small class="text-muted pull-left" style="padding-top:5px;">Your posts are visible to your friends.</small>
                <input type="submit" class="btn btn-default btn-xs" value="Post">
            </div>
    </form>
</div>
@endif