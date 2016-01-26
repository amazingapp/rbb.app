@if($signedIn && ( $post->employee_id === $authUser->employee_id) )
   <div class="pull-right post-delete">
          <form method="POST" action="/posts/{{$post->post_id}}">
             {!! method_field('delete') !!}
             {!! csrf_field() !!}
                <button type="submit" value="DELETE" class="glyphicon glyphicon-remove" onclick="return confirm('Are you sure you want to delete this post?');"></button>
          </form>
    </div>
@endif
