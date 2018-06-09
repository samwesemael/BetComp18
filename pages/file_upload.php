<?php
session_start();
include ('server.php');
$target_dir = "../images/users/";
chmod ($_FILES["file"]["tmp_name"], 0666);
$fileExtension = explode(".", basename($_FILES["file"]["name"]));
$fullFileExtension = strtolower('.'.$fileExtension[1]);

$target_file = $target_dir . $_SESSION['username'].'_temp'.$fullFileExtension;

?>
<script>
	console.info('started');
</script>
<?php

if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
	chmod ($target_file , 0666);
	$MIME = mime_content_type($target_file);
	switch ($MIME) {
		case "image/gif":
		  $image = imagecreatefromgif($target_file); 
		  break;
		case "image/pjpeg":
		case "image/jpeg":
		case "image/jpg":
		  $image = imagecreatefromjpeg($target_file); 
		  break;
		case "image/png":
		case "image/x-png":
		  $image = imagecreatefrompng($target_file); 
		  break;
      }

	$filename = $target_dir.$_SESSION['username'].'.jpg'; // alles omgezet naar jpg

	$thumb_width = 270;
	$thumb_height = 270;

	$width = imagesx($image);
	$height = imagesy($image);

	$original_aspect = $width / $height;
	$thumb_aspect = $thumb_width / $thumb_height;

	if ( $original_aspect >= $thumb_aspect )
	{
	   // If image is wider than thumbnail (in aspect ratio sense)
	   $new_height = $thumb_height;
	   $new_width = $width / ($height / $thumb_height);
	}
	else
	{
	   // If the thumbnail is wider than the image
	   $new_width = $thumb_width;
	   $new_height = $height / ($width / $thumb_width);
	}

	$thumb = imagecreatetruecolor( $thumb_width, $thumb_height );

	// Resize and crop
	imagecopyresampled($thumb,
	                   $image,
	                   0 - ($new_width - $thumb_width) / 2, // Center the image horizontally
	                   0 - ($new_height - $thumb_height) / 2, // Center the image vertically
	                   0, 0,
	                   $new_width, $new_height,
	                   $width, $height);
	imagejpeg($thumb, $filename, 80);
	chmod($filename,0666);
	//free up memory
	imagedestroy($image);
	imagedestroy($thumb);
	imagedestroy($target_file);
	@ unlink($target_file); // delete the original upload
		
	
	$status = 1;
	$email = $_SESSION['email'];
	$query = "UPDATE bc18_users SET pic_path = '$filename' WHERE email = '$email'";
	$_SESSION['profilepicpath'] = $filename;
	mysqli_query($db, $query);
	$achieved = "SELECT bc18_achievement FROM bc18_achieved WHERE bc18_user = '$email' AND bc18_achievement = 14";
    $results = mysqli_query($db, $achieved);
    $aantal = mysqli_num_rows($results);
    if ($aantal == 0){
       	$query = "INSERT INTO bc18_achieved(bc18_user, bc18_achievement, bc18_created) VALUES ('$email', 14,NOW())";
		mysqli_query($db, $query);
		$query = "INSERT INTO bc18_notifications(bc18_user, bc18_link, bc18_class, bc18_message, bc18_read, bc18_created) VALUES('$email', 'profile.php', 'achieve', 'New achievement unlocked', 0, NOW())";
		mysqli_query($db, $query);
        }
	}
?>