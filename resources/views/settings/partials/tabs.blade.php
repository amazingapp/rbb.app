<?php $tab = Input::get('tab', 'profile'); ?>
<ul>
   <li class="{!! $tab == 'profile' ?'active':'' !!}"><a href="/settings/account?tab=profile">Profile</a></li>
   <li class="{!! $tab == 'password' ?'active':'' !!}"><a href="/settings/account?tab=password" >Password</a></li>
   <li class="{!! $tab == 'image' ?'active':'' !!}"><a href="/settings/account?tab=image" >Image</a></li>
 </ul>