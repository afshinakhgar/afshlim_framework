<?php
	$photoUrl = public_path('uploads/'.getImageDirName($user->id,$type).getImageFileName($user->id,$size,$type)).'.jpg';
?>

@if($user->has_pic == 'yes')
    <img class="card-img-top" src="{{$photoUrl}}">
@else 
	@if($user->email)
		    <img class="card-img-top" src="{{get_gravatar($user->email)}}">
	@else
    	<img class="card-img-top" src="http://success-at-work.com/wp-content/uploads/2015/04/free-stock-photos.gif">
    @endif
@endif