<?php session_set_cookie_params($lifetime = 6 * 30 * 24 * 60 * 60 );
session_start();
include('server.php');
$status = "";
if (isset($_POST['login_user'])){
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    if (empty($email)) {
        array_push($errors, "Email is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }
    if (isset($_COOKIE['Token']) && isset($_COOKIE['lengte']) && isset($_COOKIE['id'])) {
        $token = $_COOKIE['Token'];
        $id = $_COOKIE['id'];
        $lengte = $_COOKIE['lengte'];
        $stmt = $db->prepare("SELECT dbtoken.bc18_mail, users.user_name, users.first_name, users.last_name, users.role, users.pic_path FROM bc18_logintokens AS dbtoken INNER JOIN bc18_users AS users ON users.email = dbtoken.bc18_mail WHERE bc18_token = ? AND bc18_tokenid = ? AND bc18_lengte = ? AND users.verification = 1");
        $stmt->bind_param('ssi', $token, $id, $lengte);
        $stmt->execute();
        $stmt->bind_result($email, $userName, $firstName, $lastName, $role, $picture);
        if ($stmt->fetch()) {
            $_SESSION['role'] = $role;
            $_SESSION['username'] = $userName;
            $_SESSION['firstname'] = $firstName;
            $_SESSION['lastname'] = $lastName;
            $_SESSION['email'] = $email;
            if($picture===''){
                $_SESSION['profilepicpath']='../images/users/noImage.jpg';
            }
            else{
                $_SESSION['profilepicpath'] = $picture;
            }
            $stmt->close();
            $_SESSION['success'] = "success";
            if(!empty($_POST["rememberme"])){
                $newToken = md5(uniqid(rand(), true));
                $newId = md5(uniqid(rand(), true));
                $duur = time() + 60*60*24*30; //30 dagen 
                setcookie('Token', $newToken, $duur);
                setcookie('lengte', $_COOKIE['lengte'], $duur);
                setcookie('id', $newId, $duur);
                $updateqry = $db->prepare("UPDATE bc18_logintokens SET bc18_logintokens.bc18_token = ?, bc18_logintokens.bc18_tokenid = ? WHERE bc18_logintokens.bc18_token = ? AND bc18_logintokens.bc18_tokenid = ?");
                $updateqry->bind_param('ssss', $newToken, $newId,$token, $id);
                $updateqry->execute();
            }
            else{
                setcookie('Token', '', time()-3600);
                setcookie('lengte', '', time()-3600);
                setcookie('id', '', time()-3600);
            }
        }
?>
        <script type="text/javascript">
            window.location.href = 'index.php';
        </script>
<?php

    }

    else{
        
        $passCookie = $password;
        $lengte = strlen($password);
        $password = md5($password); 
          // oude query
          // $query = "SELECT user_name, first_name, last_name, email, role, pic_path FROM bc18_users WHERE (email='$email' AND password='$password') OR (user_name='$email' AND password='$password')";
          // $results = mysqli_query($db, $query);
        $stmt = $db->prepare("SELECT user_name, first_name, last_name, email, role, pic_path FROM bc18_users WHERE ((email=? AND password=?) OR (user_name=? AND password=?)) AND verification='1'");
        $stmt->bind_param('ssss', $email, $password, $email, $password);
        $stmt->execute();
        $stmt->bind_result($userName, $firstName, $lastName, $mail, $role, $picture);
        if ($stmt->fetch()) {
            $_SESSION['role'] = $role;
            $_SESSION['username'] = $userName;
            $_SESSION['firstname'] = $firstName;
            $_SESSION['lastname'] = $lastName;
            $_SESSION['email'] = $mail;
            if($picture===''){
                $_SESSION['profilepicpath']='../images/users/noImage.jpg';
            }
            else{
                $_SESSION['profilepicpath'] = $picture;
            }
            $stmt->close();
            $_SESSION['success'] = "success";
            if(!empty($_POST["rememberme"])){
                $token = md5(uniqid(rand(), true));
                $idtoken = md5(uniqid(rand(), true));
                $duur = time() + 60*60*24*30; //30 dagen 
                setcookie('Token', $token, $duur);
                setcookie('lengte', $lengte, $duur);
                setcookie('id', $idtoken);
                //call to DB om te storen
                $created = date("Y-m-d H:i:s");
                $login = $db->prepare("INSERT INTO bc18_logintokens (bc18_mail, bc18_token, bc18_tokenid, bc18_lengte, bc18_created) VALUES (?, ?, ?, ?, ?)");
                $login->bind_param('sssis', $mail, $token, $idtoken, $lengte, $created);
                $login->execute();
                $login->close();

            }?>
            <script type="text/javascript">
                window.location.href = 'index.php';
            </script>
            <?php
        }else {
            $status = "not_success";
            array_push($errors, "Wrong username/password combination");
        }
    }
}
?>

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

<body class="login-page">
    <div class="login-box">
        <div class="logo">
            <a href="sign-in.php">Bracke<b>Mannen</b></a>
            <small>Betcompetition WK2018</small>
        </div>
        <div class="card">
            <div class="body">
                <?php
                $remembermeUsed = 'false';
                if (isset($_COOKIE['Token']) && isset($_COOKIE['lengte']) && isset($_COOKIE['id'])) {
                    $token = $_COOKIE['Token'];
                    $lengte = $_COOKIE['lengte'];
                    $id = $_COOKIE['id'];
                //     $stmt = $db->prepare("SELECT users.user_name FROM bc18_logintokens AS dbtoken INNER JOIN bc18_users AS users ON users.email = dbtoken.bc18_mail WHERE bc18_token = ? AND bc18_tokenid = ? AND bc18_lengte = ? AND users.verification = 1");
                //     $stmt->bind_param('ssi', $token, $id, $lengte);
                //     $stmt->execute();
                //     $stmt->bind_result($email);
                //     $dummypass = '';
                //     $remembermeUsed = 'true';
                //     if ($stmt->fetch()) {
                //         echo 'done!';
                //         for($i=0; $i>$lengte; $i++){
                //             $dummypass = $dummypass.'a';
                //         }
                //         $dummyMail = $email;
                        
                // }
                $dummypass = '';
                $dummyMail = '';
                $sql = "SELECT users.user_name AS username FROM bc18_logintokens AS dbtoken INNER JOIN bc18_users AS users ON users.email = dbtoken.bc18_mail WHERE bc18_token = '$token' AND bc18_tokenid = '$id' AND bc18_lengte = '$lengte' AND users.verification = 1";
                    $results = mysqli_query($db, $sql);
                    if ($data = mysqli_fetch_array($results)){
                        for($i=0; $i<$lengte; $i++){
                            $dummypass = $dummypass.'a';
                        }
                        $dummyMail = $data['username'];
                        $remembermeUsed = 'true';
                    }                
                }


                if($status === "not_success"){
                    echo '<div id='.'error'.' class="alert alert-danger">
                    <strong>NOPE!</strong> Fout username/paswoord combinatie. Of je account is nog niet geverifieerd door admin. Nog even geduld!
                    </div>';  
                }
                ?>
                <form id="sign_in" method="POST" action="sign-in.php">
                    <div class="msg"><?php if($_SESSION['success'] === 'error'){echo'Wrong username/password';}else{echo'Sign in to start your session';} ?></div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="email" value="<?php if($remembermeUsed === 'true') { echo  $dummyMail; } ?>" placeholder="Email" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" value="<?php if($remembermeUsed === 'true') { echo  $dummypass; } ?>" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-8 p-t-5">
                            <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-pink" <?php if($remembermeUsed === 'true') { ?> checked <?php } ?> />
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