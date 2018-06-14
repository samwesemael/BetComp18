<?php session_start();?>
<!DOCTYPE html>
<html>
<link href='../css/dropzone.css' type='text/css' rel='stylesheet'>
<script src='../js/dropzone.js' type='text/javascript'></script>
<section class="content">
    <?php
    include 'server.php';
    if(isset($_POST['reset_username'])){
        $username = mysqli_real_escape_string($db,$_POST['username']);
        $check = "SELECT user_name FROM `bc18_users` WHERE user_name = '$username'";
        $result = mysqli_query($db, $check);
        if(mysqli_num_rows($result) > 0){
            echo "<script>alert('This username is already in use. Take another one.');</script>";
        }
        else{
            $mail = $_SESSION['email'];
            $query = "UPDATE bc18_users SET user_name = '$username', modified = NOW() WHERE email = '$mail'";
            $_SESSION['username'] = $username;
            mysqli_query($db, $query);
            // echo 'new username = '.$_POST['username'];
        }
        
    }
    if(isset($_POST['reset_pass'])){
        $password = mysqli_real_escape_string($db, $_POST['password']);
        $password = md5($password);
        $modified = date("Y-m-d H:i:s");
        $mail = $_SESSION['email'];
        $query = "UPDATE bc18_users SET password = '$password', modified = '$modified' WHERE email = '$mail'";
        mysqli_query($db, $query);
        // echo 'new password ='.$password;
    }
                            
    include 'navigator.php';
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
                    <img class="mainImage" alt="" src="<?php echo $_SESSION["profilepicpath"]; ?>">
                    <?php
                    if($numberofAchievements<10 && $numberofAchievements>=5)
                        echo '<img class="secondImage" alt="star" src="../images/1star.png">';
                    if($numberofAchievements<15 && $numberofAchievements>=10)
                        echo '<img class="secondImage" alt="star" src="../images/2star.png">';
                    if($numberofAchievements>=15)
                        echo '<img class="secondImage" alt="star" src="../images/3star.png">';
                    ?>
                    
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
                        <div class="hidden-xs">Notifications</div>
                    </button>
                </center>
            </div>
            <div class="btn-group" role="group">
                <center>
                    <button onclick="myFunction(this)" type="button" id="favorites" class="profilebtn profilebtn-default col-lg-12 col-md-12 col-sm-12 col-xs-12" href="#tab2" data-toggle="tab"><span class="glyphicon glyphicon-heart" aria-hidden="true"></span>
                        <div class="hidden-xs">Achievements</div>
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
                    <h3>Notifications</h3>
                    <div>
                        <?php 
                        $mail = $_SESSION['email'];
                        $sql = "SELECT * from bc18_notifications where bc18_user = '$mail' ORDER BY bc18_created DESC";
                        // echo $sql;
                        $result = mysqli_query($db,$sql);
                        $rowcount = mysqli_num_rows($result);
                    ?>
                    <ol class="menu" style="list-style-type: none;">
                                    <?php
                                        while ($data = mysqli_fetch_array($result)){
                                            // color are classes from style.css
                                            //options: 
                                            switch ($data['bc18_class']) {
                                                case "chat":
                                                    $icon = 'chat';
                                                    $color = 'bg-light-green';
                                                    break;
                                                case "mededeling":
                                                    $icon = 'add_shopping_cart';
                                                    $color = 'bg-blue-grey';
                                                    break;
                                                case "klassement":
                                                    $icon = 'format_list_numbered';
                                                    $color = 'bg-orange';
                                                    break;
                                                case "newUser":
                                                    $icon = 'person_add';
                                                    $color = 'bg-indigo';
                                                    break;
                                                case "achieve":
                                                    $icon = 'whatshot';
                                                    $color = 'bg-cyan';
                                                    break;
                                            }
                                            $datum = $data['bc18_created'];
                                            $date = new DateTime($datum);
                                            $date->setTimezone(new DateTimeZone('Europe/Brussels'));
                                            $dateNu = $date->format('Y-m-d H:i:s');
                                            echo '<li>    
                                                <a href="'.$data['bc18_link'].'">
                                                    <div style="width:"30px" " class="icon-circle '.$color.'">
                                                        <i class="material-icons">'.$icon.'</i>
                                                    </div>
                                                    <div class="menu-info">
                                                        <h4>'.$data['bc18_message'].'</h4>
                                                        <p>
                                                            <i class="material-icons">access_time</i>'.$dateNu.'
                                                        </p>
                                                    </div>
                                                </a>
                                            </li>';

                                        
                                        }
                                    ?>
                                </ol>
                    </div>
                </div>
                <div class="tab-pane fade in" id="tab2">
                    <h3>ACHIEVEMENTS</h3>
                    <?php
                    $adres = $_SESSION['email'];
                    $rank = "SELECT * from bc18_achieved where bc18_user = '$adres' ";
                    $result = mysqli_query($db,$rank);
                    $numberofAchievements = mysqli_num_rows($result);
                    $progress = $numberofAchievements*5;

                    if($numberofAchievements<5){
                        $rank = 'Tom Soetaers';
                        $style = 'progress-bar-danger';
                    }
                    if($numberofAchievements>= 5 && $numberofAchievements<10){
                        $rank = 'Frank Raes';
                        $style = 'progress-bar-warning';
                    }                    
                    if($numberofAchievements>= 10 && $numberofAchievements<15){
                        $rank = 'Marc Degryse';
                        $style = 'progress-bar-warning';
                    }
                    if($numberofAchievements>=15){
                        $rank = 'Peter Vandenbempt';
                        $style = 'progress-bar-success';
                    }
                    $style = 'progress-bar-info';
                    ?>
                    <div class="row clearfix">
                        <div class="progress" style="margin: 15px;">
                          <div class="progress-bar <?php echo $style; ?>" role="progressbar" aria-valuenow="40"
                          aria-valuemin="0" aria-valuemax="100" <?php echo 'style="width:'.$progress.'%"';?>>
                            <?php echo $numberofAchievements; ?>/20 (<?php echo $rank; ?>)
                          </div>
                        </div>
                        <div style="margin-left: 15px; margin-right: 15px;">
                            <div class="column">   
                                <img class="img-responsive" alt="star" style="float:right; margin-right:18%; max-width: 40px;" src="../images/1star.png">   
                            </div>
                            <div class="column">
                                <center><img class="img-responsive" alt="star" style="max-width: 40px;" src="../images/2star.png"></center>
                            </div>                    
                            <div class="column">
                                <img class="img-responsive" alt="star" style="float:left; margin-left:18%; max-width: 40px; " src="../images/3star.png">
                            </div>


                            <!-- <span style="float: left; width: 23%"></span> -->
                        </div>
                    </div>
                    <br>
                    <div class="row clearfix">
                    <?php
                        $sql = "SELECT bc18_achievement FROM bc18_achieved WHERE bc18_user='$mail' ";
                        // echo $sql;
                        $result = mysqli_query($db,$sql);
                        $achieved = array();
                        while ($data = mysqli_fetch_array($result)){
                            array_push($achieved,$data['bc18_achievement']);
                        }
                        $achievsql = "SELECT * FROM bc18_achievements LEFT JOIN `bc18_achieved`ON bc18_achievements.bc18_id = bc18_achieved.bc18_achievement AND bc18_achieved.bc18_user = '$mail' ORDER BY bc18_id ";
                        $achieves = mysqli_query($db,$achievsql);
                        while ($data = mysqli_fetch_array($achieves)){
                            if(in_array($data['bc18_id'], $achieved) ){
                                $datum = $data['bc18_created'];
                                $date = new DateTime($datum);
                                $date->setTimezone(new DateTimeZone('Europe/Brussels'));
                                $dateNu = $date->format('Y-m-d H:i:s');
                                echo '
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="card">
                                        <div class="row clearfix">
                                            <div class="col-xs-2 col-sm-2 col-lg-2 col-md-2">
                                              
                                                <img style="max-height:100px;" src="'.$data['bc18_picpath'].'">
                                            </div>
                                            <div class="col-xs-10 col-sm-10 col-lg-10 col-md-10">
                                                <h5><center>'.$data['bc18_title'].'</center></h5>
                                                <p><center>
                                                    '.$data['bc18_message'].'
                                                </center></p>
                                                <p>
                                                <center><small>'.$dateNu.'</small></center>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                ';
                            }
                            else{
                                echo '
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 achievement">
                                    <div class="card">
                                        <div class="row clearfix">
                                            <div class="col-xs-2 col-sm-2 col-lg-2 col-md-2">
                                                <img style="max-height:100px;" src="https://static1.squarespace.com/static/58c7f1771b10e32dd8e9cd24/t/59f1f7dc7131a528acd76eb4/1509030009589/Locked+Achievement?format=300w"" alt="" class="img-circle">
                                            </div>
                                            <div class="col-xs-10 col-sm-10 col-lg-10 col-md-10">
                                                <h5><center>Achievement Locked</center></h5>
                                                <p><center>
                                                    Achievement Locked
                                                </center></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                ';
                            }
                        }

                    ?>
                    </div>
                </div>
                <div class="tab-pane fade in" id="tab3">
                    <h3>INSTELLINGEN</h3>
                    
                    <!-- profielfoto -->
                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <h4>Change Profile picture</h4>
                            <div class="card">
                                <div class="card-image waves-effect waves-block waves-light">
                                    <div>										
                                        <form action="file_upload.php" class="dropzone" id="dropzonewidget">
												<div class="drag-icon-cph">
													<center><i class="material-icons">touch_app</i></center>
												</div>
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
                            <div id="error"></div>
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
                                                    <input type="password" class="form-control" name="password" id='password' minlength="6" placeholder="Password" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" >
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">lock</i>
                                                </span>
                                                <div class="form-line">
                                                    <input type="password" class="form-control" name="confirm" id='confirm' minlength="6" placeholder="Confirm Password" required>
                                                    <span id="confirmMessage" class="confirmMessage"></span>
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


                <script>
                var password = document.getElementById("password"), confirm_password = document.getElementById("confirm");

                function validatePassword(){
                  if(password.value != confirm_password.value) {
                    confirm_password.setCustomValidity("Passwords Don't Match");
                  } else {
                    confirm_password.setCustomValidity('');
                  }
                }

                password.onchange = validatePassword;
                confirm_password.onkeyup = validatePassword;
                </script>
	
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
        <!-- <script src="../js/pages/examples/sign-up.js"></script> -->
        <!-- Demo Js -->
   <!--      <script src="../js/demo.js"></script> -->
        <!-- Dropzone JS -->
 <!--        <script src="../plugins/dropzone/min/dropzone.min.js"></script> -->
    </body>
    </html>