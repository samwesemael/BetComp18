
<?php
if(!isset($_SESSION)) 
{ 
  session_start(); 
}
$target_dir = "../images/users/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$imageFileTypePunt = '.'.$imageFileType;
$newName = $_SESSION["username"].$imageFileTypePunt;
$target_file = $target_dir . $newName;
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
	// list($width, $height, $type, $attr) = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    $width = $check[0];
    $height = $check[1];
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
echo $width;
if($width != $height){
	header('location: profile.php?upload=error4');
}
// Check file size
else {
	if ($_FILES["fileToUpload"]["size"] > 500000) {
    // echo "Sorry, your file is too large.";
    header('location: profile.php?upload=error3');
    $uploadOk = 0;
}

// Allow certain file formats
else {
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
    // echo "Sorry, only JPG, JPEG, PNG files are allowed.";
    header('location: profile.php?upload=error2');
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
else {
	if ($uploadOk == 0) {
    // echo "Sorry, your file was not uploaded.";
    header('location: profile.php?upload=error1');
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

    	include('server.php');
    	$mail = $_SESSION['email'];
    	$query = "UPDATE users SET pic_path = '$target_file' WHERE email = '$mail'";

        mysqli_query($db, $query);
        $_SESSION['profilepicpath'] = $target_file;

        // echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        header('location: profile.php?upload=success');
    } else {
        // echo "Sorry, there was an error uploading your file.";
        header('location: profile.php?upload=error1');
    }
}
}
}

}
?>