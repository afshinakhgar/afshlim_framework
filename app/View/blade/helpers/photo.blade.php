<?php
	$photoUrl = public_path('uploads/'.getImageDirName($photo->id,$type).getImageFileName($photo->id,$size,$type)).'.jpg';
?>

@if($photo->has_pic == 'yes')
    <img class="card-img-top" src="{{$photoUrl}}">
@else
	<img class="card-img-top" src="http://success-at-work.com/wp-content/uploads/2015/04/free-stock-photos.gif">
@endif