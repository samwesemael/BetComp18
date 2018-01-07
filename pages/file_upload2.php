<?php 

$targ_w = $targ_h = 150;
$jpeg_quality = 90;
 
$src = '../images/users/test.jpg';

$img_r = imagecreatefromjpeg($src);
$dst_r = ImageCreateTrueColor( $targ_w, $targ_h );
 
imagecopyresampled($dst_r,$img_r,0,0,$_POST['x'],$_POST['y'],
$targ_w,$targ_h,$_POST['w'],$_POST['h']);
 
header('Content-type: image/jpeg');
chmod("../images/users/res.jpg", 755);
imagejpeg($dst_r,'../images/users/res.jpg',$jpeg_quality);
?>