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

?>
