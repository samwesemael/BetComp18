<!DOCTYPE html>
<html>

<?php
if(!isset($_SESSION)) 
{ 
  session_start(); 
}

$ds = DIRECTORY_SEPARATOR; 
$storeFolder = 'images/users';
 
if (!empty($_FILES)) {
    // Store file to temp variable
    $fileType = $_FILES["image"]["type"];
	$tempFile = $_FILES['file']['tmp_name'];  
	$target_file = $target_dir . basename($_FILES["file"]["name"]);
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	$imageFileTypePunt = '.'.$imageFileType;
	$newName = $_SESSION["username"].$imageFileTypePunt;                 
    // absolute path of destination folder
    $targetPath = '..'. $ds. $storeFolder . $ds; 
    //targetPath + filenaam 
    $targetFile =  $targetPath.'/'. $newName;

  
     



// // Check if image file is a actual image or fake image
// 	// list($width, $height, $type, $attr) = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	$img_width = $check[0];
	$img_height = $check[1];
//     if($check !== false) {
//         echo "File is an image - " . $check["mime"] . ".";
//         $uploadOk = 1;
//     } else {
//         echo "File is not an image.";
//         $uploadOk = 0;
//     }

// // Check if file already exists
// // if (file_exists($target_file)) {
// //     echo "Sorry, file already exists.";
// //     $uploadOk = 0;
// // }
// // echo $width;
// if($width != $height){
// 	header('location: profile.php?upload=error4');
// }
// // Check file size
// else {
// 	if ($_FILES["fileToUpload"]["size"] > 500000) {
//     // echo "Sorry, your file is too large.";
//     header('location: profile.php?upload=error3');
//     $uploadOk = 0;
// }

// // Allow certain file formats
// else {
// 	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
//     // echo "Sorry, only JPG, JPEG, PNG files are allowed.";
//     header('location: profile.php?upload=error2');
//     $uploadOk = 0;
// }
// // Check if $uploadOk is set to 0 by an error
// else {
// 	if ($uploadOk == 0) {
//     // echo "Sorry, your file was not uploaded.";
//     header('location: profile.php?upload=error1');
// // if everything is ok, try to upload file
// } else {
    if (move_uploaded_file($tempFile,$targetFile)) {

    	// $targ_w = $targ_h = 270;
     //    $jpeg_quality = 90;
     //    $src = '../images/users/test.jpg';
     //    $img_r = imagecreatefromjpeg($src);
     //    $dst_r = ImageCreateTrueColor( $targ_w, $targ_h );

     //    imagecopyresampled($dst_r,$img_r,0,0,0,0, $targ_w,$targ_h,1920,924);
     //    imagejpeg($dst_r,$src,$jpeg_quality);

    	// switch($fileType) {
        switch ("image/jpg") {
            case "image/gif":
                $source = imagecreatefromgif('../images/users/test.jpg'); 
                break;
            case "image/pjpeg":
            case "image/jpeg":
            case "image/jpg":
                $source = imagecreatefromjpeg('../images/users/test.jpg'); 
                break;
            case "image/png":
            case "image/x-png":
                $source = imagecreatefrompng('../images/users/test.jpg'); 
                break;
        }
        $size = min($img_width, $img_height);
        $im2 = imagecrop($source, ['x' => 0, 'y' => 0, 'width' => $size, 'height' => $size]);
        if ($im2 !== FALSE) {
    		imagepng($im2, 'example-cropped.png');
		}
        $dst_r = imagecreatetruecolor( $targ_w, $targ_h );
        imagecopyresampled($dst_r, $source, 0, 0, 0, 0, $targ_w, $targ_h, $img_width, $img_height);
    	switch("image/jpg") {
            case "image/gif":
                imagegif($dst_r,"../images/test.gif"); 
                break;
            case "image/pjpeg":
            case "image/jpeg":
            case "image/jpg":
                imagejpeg($dst_r,"../images/test.jpg",90); 
                break;
            case "image/png":
            case "image/x-png":
                imagepng($dst_r,"../images/test.png");  
                break;
        }
        imagedestroy($dst_r);
        imagedestroy($source);
        //@ unlink($targetFile);



    	include('server.php');
    	$mail = $_SESSION['email'];
    	$query = "UPDATE users SET pic_path = '$targetFile' WHERE email = '$mail'";

        mysqli_query($db, $query);
        $_SESSION['profilepicpath'] = $targetFile;

        // echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        header("Refresh:0; url=profile.php");
        header('location: profile.php?upload=success');
    } else {
        // echo "Sorry, there was an error uploading your file.";
        header('location: profile.php?upload=error1');
    }
}
else{
	echo 'kapot';	
}

// }
// }
// }
// }
?>

</html>

