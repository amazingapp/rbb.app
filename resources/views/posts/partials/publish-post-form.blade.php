@include('layouts.partials.errors')
<div class="post-post">
        <form action="{{route('posts.create')}}" method="POST">
            <div class="form-group">
                <textarea name="body" id="body" class="form-control creaet-post" placeholder="Whats happening?" cols="2" rows="3"></textarea>
            </div>
            <div class="form-group post-post-submit">
                <small class="text-muted pull-left" style="padding-top:5px;">Your posts are visible to your friends.</small>
                <input type="submit" class="btn btn-default btn-xs" value="Post">
            </div>
    </form>
</div>
