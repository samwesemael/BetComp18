<?php
session_start();


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
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database
  	$query = "INSERT INTO users (user_name, email, password, verification, payed) 
  			  VALUES('$username', '$email', '$password', '0', false)";
  	mysqli_query($db, $query);
    $queryKlassement = "INSERT INTO klassement (username, matchenCorrect, winnaarCorrect, totaal) VALUES('$username', '0', '0', '0')";
      mysqli_query($db, $queryKlassement);
    	$_SESSION['username'] = $username;
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
    $password = md5($password);
    $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    echo $query;
    $results = mysqli_query($db, $query);
    if (mysqli_num_rows($results) == 1) {
      //$_SESSION['username'] = $username;
      $_SESSION['email'] = $email;
      $_SESSION['success'] = "You are now logged in";
      header('location: index.php');
    }else {
      
      array_push($errors, "Wrong username/password combination");
    }
  }
}

?>
