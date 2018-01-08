<!DOCTYPE html>
<html>
<?php include 'navigator.php';?>
<script type="text/javascript">
    document.getElementById("nav-profile").classList.toggle('active');
</script>

<link href='../css/dropzone.css' type='text/css' rel='stylesheet'>
<script src='../js/dropzone.js' type='text/javascript'></script>

<section class="content">

    <?php

    include 'server.php';

    if(isset($_POST['reset_username'])){
        $username = mysqli_real_escape_string($db,$_POST['username']);
        $modified = date("Y-m-d H:i:s");
        $mail = $_SESSION['email'];
        $query = "UPDATE users SET user_name = '$username', modified = '$modified' WHERE email = '$mail'";
        $_SESSION['username'] = $username;
        mysqli_query($db, $query);
        // echo 'new username = '.$_POST['username'];

    }
    if(isset($_POST['reset_pass'])){
        $password = mysqli_real_escape_string($db, $_POST['password']);
        $password = md5($password);
        $modified = date("Y-m-d H:i:s");
        $mail = $_SESSION['email'];
        $query = "UPDATE users SET password = '$password', modified = '$modified' WHERE email = '$mail'";
        mysqli_query($db, $query);
        // echo 'new password ='.$password;

    }
                            
    
    ?>

	<!-- header -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="profilecard hovercard">
                <div class="profilecard-background">
                    <img class="card-bkimg" alt="" src="<?php echo $_SESSION["profilepicpath"]; ?>">
                    <!-- http://lorempixel.com/850/280/people/9/ -->
                </div>
                <div class="useravatar">
                    <img alt="" src="<?php echo $_SESSION["profilepicpath"]; ?>">
                </div>
                <div class="card-info"> <span class="card-title"><?php echo $_SESSION["firstname"].' '.$_SESSION["lastname"]; ?></span>

                </div>
            </div>
            <div class="profilebtn-pref btn-group btn-group-justified btn-group-lg" role="group" aria-label="...">
                <script>

                    function myFunction(elmnt) {
                        document.getElementById("stars").classList.remove('profilebtn-primary');
                        document.getElementById("following").classList.remove('profilebtn-primary');
                        document.getElementById("favorites").classList.remove('profilebtn-primary');
                        elmnt.classList.toggle('profilebtn-primary');
                    }
                </script>
                <div class="btn-group" role="group">
                    <center><button onclick="myFunction(this)" type="button" id="stars" class="profilebtn profilebtn-default profilebtn-primary col-lg-12 col-md-12 col-sm-12 col-xs-12" href="#tab1" data-toggle="tab"><span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                        <div class="hidden-xs">Stars</div>
                    </button>
                </center>
            </div>
            <div class="btn-group" role="group">
                <center>
                    <button onclick="myFunction(this)" type="button" id="favorites" class="profilebtn profilebtn-default col-lg-12 col-md-12 col-sm-12 col-xs-12" href="#tab2" data-toggle="tab"><span class="glyphicon glyphicon-heart" aria-hidden="true"></span>
                        <div class="hidden-xs">Favorites</div>
                    </button>
                </center>
            </div>
            <div class="btn-group" role="group">
                <center>
                    <button onclick="myFunction(this)" type="button" id="following" class="profilebtn profilebtn-default col-lg-12 col-md-12 col-sm-12 col-xs-12" href="#tab3" data-toggle="tab"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                        <div class="hidden-xs">Settings</div>
                    </button>
                </center>
            </div>
        </div>

        <div class="well">
            <div class="tab-content">
                <div class="tab-pane fade in active" id="tab1">
                    <h3>This is tab 1</h3>
                </div>
                <div class="tab-pane fade in" id="tab2">
                    <h3>This is tab 2</h3>
                </div>
                <div class="tab-pane fade in" id="tab3">
                    <h3>Instellingen pagina</h3>
                    
                    <!-- profielfoto -->
                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <h4>Change Profile picture</h4>
                            <div class="card">
                                <div class="card-image waves-effect waves-block waves-light">
                                    <div>
                                        <form action="file_upload.php" class="dropzone" id="dropzonewidget">
 
                                        </form> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END profielfoto -->

                    <!-- username -->
                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <h4>Change Username</h4>
                            <div class="card">
                                <div class="card-image waves-effect waves-block waves-light">
                                    <!-- id van form moet sign_up zijn. Hierdor wordt juist JS code opgeroepen om checks te doen -->
                                    <form id="userNameCheck" method="POST" action="profile.php">
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">person</i>
                                                </span>
                                                <div class="form-line">
                                                    <input type="text" class="form-control" name="username" placeholder="New Username" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" >
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">person</i>
                                                </span>
                                                <div class="form-line">
                                                    <input type="text" class="form-control" name="confirm" placeholder="Confirm New Username" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class=" col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                            <button type="submit" class="btn bg-blue waves-effect" name="reset_username">
                                                <i class="material-icons">save</i>
                                                <span>SAVE</span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END username -->
                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <h4>Change Password</h4>
                            <div class="card">
                                <div class="card-image waves-effect waves-block waves-light">
                                    <!-- id van form moet sign_up zijn. Hierdor wordt juist JS code opgeroepen om checks te doen -->
                                    <form id="sign_up" method="POST" action="profile.php">
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">lock</i>
                                                </span>
                                                <div class="form-line">
                                                    <input type="password" class="form-control" name="password" minlength="6" placeholder="Password" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" >
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">lock</i>
                                                </span>
                                                <div class="form-line">
                                                    <input type="password" class="form-control" name="confirm" minlength="6" placeholder="Confirm Password" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class=" col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                            <button type="submit" class="btn bg-blue waves-effect" name="reset_pass">
                                                <i class="material-icons">save</i>
                                                <span>SAVE</span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
	
        </section>



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

        <!-- deze is nodig om te checken of de ingevulde passwoorden matchen en of ze lang genoeg zijn en dergelijk -->
        <script src="../js/pages/examples/sign-up.js"></script>

        <!-- Demo Js -->
   <!--      <script src="../js/demo.js"></script> -->

        <!-- Dropzone JS -->
 <!--        <script src="../plugins/dropzone/min/dropzone.min.js"></script> -->
    </body>

    </html>