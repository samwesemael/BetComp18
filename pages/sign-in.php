﻿<?php include('server.php') ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Sign In | Betcompetition WK2018</title>
    <!-- Favicon-->
    <link rel="icon" href="../favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="../plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="../plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="../plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="../css/style.css" rel="stylesheet">
</head>
<?php
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
      $query = "SELECT user_name, first_name, last_name, email, role, pic_path FROM users WHERE (email='$email' AND password='$password') OR (user_name='$email' AND password='$password')";
      $results = mysqli_query($db, $query);
      if (mysqli_num_rows($results) == 1) {
        if($data = mysqli_fetch_array($results)){
            $_SESSION['role'] = $data['role'];
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
        $_SESSION['success'] = "not_success";
        array_push($errors, "Wrong username/password combination");
      }
    }
  }

?>

<body class="login-page">
    <div class="login-box">
        <div class="logo">
            <a href="sign-in.php">Bracke<b>Mannen</b></a>
            <small>Betcompetition WK2018</small>
        </div>
        <div class="card">
            <div class="body">
                <form id="sign_in" method="POST" action="sign-in.php">
                    <div class="msg"><?php if($_SESSION['success'] === 'error'){echo'Wrong username/password';}else{echo'Sign in to start your session';} ?></div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="email" value="<?php if(isset($_COOKIE["email"])) { echo $_COOKIE["email"]; } ?>" placeholder="Email" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" value="<?php if(isset($_COOKIE["password"])) { echo $_COOKIE["password"]; } ?>" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-8 p-t-5">
                            <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-pink" <?php if(isset($_COOKIE["email"])) { ?> checked <?php } ?> />
                            <label for="rememberme">Remember Me</label>
                        </div>
                        <div class="col-xs-4">
                            <button name="login_user" class="btn btn-block bg-pink waves-effect" type="submit">SIGN IN</button>
                        </div>
                    </div>
                    <div class="row m-t-15 m-b--20">
                        <div class="col-xs-6">
                            <a href="sign-up.php">Register Now!</a>
                        </div>
                        <div class="col-xs-6 align-right">
                            <a href="forgot-password.html">Forgot Password?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="../plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="../plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="../plugins/node-waves/waves.js"></script>

    <!-- Validation Plugin Js -->
    <script src="../plugins/jquery-validation/jquery.validate.js"></script>

    <!-- Custom Js -->
    <script src="../js/admin.js"></script>
    <script src="../js/pages/examples/sign-in.js"></script>
</body>

</html>