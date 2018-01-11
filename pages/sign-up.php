<?php include('server.php') ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Sign Up | Bootstrap Based Admin Template - Material Design</title>
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
// REGISTER USER
if (isset($_POST['reg_user'])) {
    // receive all input values from the form
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password_1 = mysqli_real_escape_string($db, $_POST['password']);
    $password_2 = mysqli_real_escape_string($db, $_POST['confirm']);
    $firstname = mysqli_real_escape_string($db, $_POST['FirstName']);
    $lastname = mysqli_real_escape_string($db, $_POST['LastName']);

    // form validation: ensure that the form is correctly filled
    if (empty($username)) { array_push($errors, "Full Name is required"); }
    if (empty($email)) { array_push($errors, "Email is required"); }
    if (empty($password_1)) { array_push($errors, "Password is required"); }
    if ($password_1 != $password_2) { array_push($errors, "The two passwords do not match");}

    $stmt = $db->prepare("SELECT user_name, email FROM bc18_users WHERE user_name=? OR email=?");
    $stmt->bind_param('ss', $username, $email);
    $stmt->execute();
    $stmt->bind_result($userName, $mail);
    // OLD query
    // $query = "SELECT user_name FROM bc18_users WHERE user_name='$username'";
    // $results = mysqli_query($db, $query);
    if ($stmt->fetch()) {
        //username or email already exist
        if(strtolower($username) == strtolower($userName)){
            $error = '1';
            header('location: sign-up.php?username_exists=$wrong');
        }
        else{
            $error = '1';
            header('location: sign-up.php?email_exists=$wrong');
        }
        $stmt->close();
}

else{
    if((count($errors) == 0) ){
        $password = md5($password_1); //encrypt the password before saving in the database
        $created = date("Y-m-d H:i:s");
        $modified = $created;


        // OLD QUERIES
        // $query = "INSERT INTO bc18_users (user_name, first_name, last_name, email, password, role, verification, payed, oauth_provider, created, modified) 
        // VALUES('$username', '$firstname', '$lastname', '$email', '$password', 'speler', '0', false, 'manual', '".date("Y-m-d H:i:s")."', '".date("Y-m-d H:i:s")."'    )";
        // mysqli_query($db, $query);

        $stmt = $db->prepare("INSERT INTO bc18_users (user_name, first_name, last_name, email, password, role, verification, payed, oauth_provider, created, modified) 
        VALUES( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $ver = 0;
        $speler = 'speler';
        $manual = 'manual';
        $false = 'false';
        $stmt->bind_param('ssssssissss', $username, $firstname, $lastname, $email, $password, $speler, $ver, $false, $manual, $created, $modified);
        $stmt->execute();
        $stmt->close();


        // WERKT NIET MEER!! NAKIJKEN!!
        // $stmt2 = $db->prepare("INSERT INTO bc18_klassement (email, uitslag_correct, winnaar_correct, bonus, totaal) VALUES(?, ?, ?, ?, ?)");
        // // $ver gebruikt omdat variabele moet zijn met waarde 0, gewoon 0 werkt niet 
        // $stmt2->bind_param('siii', $email, $ver, $ver, $ver, $ver);
        // $stmt2->execute();
        // $stmt2->close();

        $queryKlassement = "INSERT INTO bc18_klassement (email, matchenCorrect, winnaarCorrect, totaal) VALUES('$email', '0', '0', '0')";
        mysqli_query($db, $queryKlassement);

        
        $_SESSION['username'] = $username;
        $_SESSION['firstname'] = $firstname;
        $_SESSION['lastname'] = $lastname;
        $_SESSION['email'] = $email;
        $_SESSION['role'] = 'speler';
        $_SESSION['profilepicpath']='../images/users/noImage.jpg';
        $_SESSION['success'] = "success";
        header('location: index.php');
      }
    }
}

?>

<body class="signup-page">
    <div class="signup-box">
        <div class="logo">
            <a href="sign-up.php">Bracke<b>Mannen</b></a>
            <small>Betcompetition WK2018</small>
        </div>
        <div class="card">
            <div class="body">
                <form id="sign_up" method="POST" action="sign-up.php">
                    <div class="msg">Register a new membership</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">account_circle</i>
                        </span>
                        <?php
                        if(isset($_GET['username_exists'])) {
                            echo'<div class="form-group has-error has-feedback">
                                <input type="text" class="form-control" id="inputError" name="username" placeholder="Username" aria-describedby="inputError2Status" required autofocus>
                                <label class="control-label" for="inputError">Username already exist. Try another one.</label>
                                </div>';
                        }
                        else{
                            echo'
                                <div class="form-line">
                                <input type="text" class="form-control" name="username" placeholder="Username" required autofocus>
                                </div>';
                        }
                        ?>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="FirstName" placeholder="First Name" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="LastName" placeholder="Last Name" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">email</i>
                        </span>
                        <?php
                        if(isset($_GET['email_exists'])) {
                            echo'<div class="form-group has-error has-feedback">
                                <input type="text" class="form-control" id="inputErrormail" name="email" placeholder="Email Address" aria-describedby="inputError2Status" required autofocus>
                                <label class="control-label" for="inputErrormail">Email Address already used. Use another one.</label>
                                </div>';
                        }
                        else{
                            echo'
                                <div class="form-line">
                                <input type="text" class="form-control" name="email" placeholder="Email Address" required autofocus>
                                </div>';
                        }
                        ?>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" minlength="6" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="confirm" minlength="6" placeholder="Confirm Password" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="terms" id="terms" class="filled-in chk-col-pink">
                        <label for="terms">I read and agree to the <a href="javascript:void(0);">terms of usage</a>.</label>
                    </div>

                    <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit" name="reg_user">SIGN UP</button>

                    <div class="m-t-25 m-b--5 align-center">
                        <a href="sign-in.php">You already have a membership?</a>
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
    <script src="../js/pages/examples/sign-up.js"></script>
</body>

</html>