<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }

// variable declaration
$username = "";
$email    = "";
$errors = array(); 
$_SESSION['success'] = "";
$_SESSION['facebook'] = "";

// connect to database 
// opbouw: mysqli_connect('hostname', 'gebruikersnaam', 'password', 'database');
$dbhostname='brackemannen.be.mysql';
$dbpassword='k74TVAhNhD4UK5EBpoLgHePn';
$dbuser = 'brackemannen_be';  
$dbname= 'brackemannen_be';
// real database query 
// $db = mysqli_connect($dbhostname, $dbuser, $dbpassword, $dbname);

// for local use
$db = mysqli_connect('localhost', 'root', '', 'users');

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
} 
//echo "Connected successfully";

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['fullname']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password']);
  $password_2 = mysqli_real_escape_string($db, $_POST['confirm']);
  $firstname = mysqli_real_escape_string($db, $_POST['FirstName']);
  $lastname = mysqli_real_escape_string($db, $_POST['LastName']);

  // form validation: ensure that the form is correctly filled
  if (empty($username)) { array_push($errors, "Full Name is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // TODO: checken of username al in gebruik is

  // $query = "SELECT user_name, first_name, last_name, email, pic_path FROM users WHERE (email='$email' AND password='$password') OR (user_name='$email' AND password='$password')";
  //   $results = mysqli_query($db, $query);
  //   if (mysqli_num_rows($results) == 1) {
  // register user if there are no errors in the form
  
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database
    $created = date("Y-m-d H:i:s");
    $modified = $created;
  	$query = "INSERT INTO users (user_name, email, password, verification, payed, oauth_provider, created, modified) 
  			  VALUES('$username', '$email', '$password', '0', false, 'manual', '".date("Y-m-d H:i:s")."', '".date("Y-m-d H:i:s")."'    )";
  	mysqli_query($db, $query);
    $queryKlassement = "INSERT INTO klassement (email, matchenCorrect, winnaarCorrect, totaal) VALUES('$email', '0', '0', '0')";
    mysqli_query($db, $queryKlassement);
    $_SESSION['email'] = $email;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: index.php');
  }

}

// LOGIN USER
if (isset($_POST['login_user'])) {

  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password = mysqli_real_escape_string($db, $_POST['password']);



  if (empty($email)) {
    array_push($errors, "Email is required");
  }
  if (empty($password)) {
    array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
    $passCookie = $password;
    $password = md5($password); 
    $query = "SELECT user_name, first_name, last_name, email, pic_path FROM users WHERE (email='$email' AND password='$password') OR (user_name='$email' AND password='$password')";
    $results = mysqli_query($db, $query);
    if (mysqli_num_rows($results) == 1) {
      if($data = mysqli_fetch_array($results)){
        $_SESSION['username'] = $data['user_name'];
        $_SESSION['firstname'] = $data['first_name'];
        $_SESSION['lastname'] = $data['last_name'];
        $_SESSION['email'] = $data['email'];
        if($data['pic_path']===''){
          $_SESSION['profilepicpath']='../images/users/noImage.jpg';
        }
        else{
          $_SESSION['profilepicpath'] = $data['pic_path'];          
        }

      }

      $_SESSION['success'] = "success";
      header('location: index.php');
      if(!empty($_POST["rememberme"])){
          setcookie ("email",$email,time()+ (10 * 365 * 24 * 60 * 60));  
          setcookie ("password",$passCookie,time()+ (10 * 365 * 24 * 60 * 60));
      }
    }else {
      $_SESSION['success'] = "success";
      array_push($errors, "Wrong username/password combination");
    }
  }
}

?>
