<!-- comments section -->
<form action="{{route('posts.comments', $post->post_id)}}" method="POST" class="form-comment" >
        <input type="hidden" name="post_id" value="{{$post->post_id}}">
        {!! csrf_field() !!}
        <div class="input-group post__comment" style="padding-top: 10px;">
            <span class="input-group-addon" style="border:none;padding:0px;position:relative;">
              <img src="/{{ $authAavatar->icon_path }}" alt="Placeholder" style="height:33px;width:33px" />
            </span>
            <div class="form-group">
                <textarea placeholder='Write a comment..'
                    class="form-control comment" arial-describedby="sizing-addon2"
                    name="body" id="body-{{$post->post_id}}" cols="2" rows="1">{{ Input::old('body') }}</textarea>
            </div>
        </div>
        <button class="form-comment__post-btn btn btn-primary btn-sm">Leave comment</button>
</form>