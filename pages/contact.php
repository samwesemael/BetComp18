<?php include 'navigator.php';
        include 'server.php'; 
        $status = '';?>
<!DOCTYPE html>
<html>
<!-- navigator inladen en juist actief zetten -->
<script type="text/javascript">
    document.getElementById("nav-extra").classList.toggle('active');
    document.getElementById("nav-contact").classList.toggle('active');
</script>

<?php
    if(isset($_POST['sub-btn'])){
        $uname = $_SESSION['username'];
        $mail = $_SESSION['email'];
        $dtnow = new DateTime();
        // omzetten naar juiste timezone alleen als in database ook in juiste timezone zit        
        $dtnow ->setTimeZone(new DateTimeZone('Europe/Brussels'));
        $status = 'succes_status';
        $msg = mysqli_real_escape_string($db, $_POST['message']);
        mysqli_query($db, "INSERT INTO bc18_chat(bc18_username, bc18_msg, bc18_created) VALUES ('$uname','$msg', NOW()) ");
    if (mysqli_affected_rows($db)==0){
        if($status != 'error_status'){
            $status = 'overall_error';
        }
    }
    else{
        $stmt3 = $db->prepare("INSERT INTO bc18_notifications(bc18_user, bc18_link, bc18_class, bc18_message, bc18_read, bc18_created) VALUES(?, ?, ?, ?, ?, NOW())");
        $link = "contact.php";
        $class = "chat";
        $message = "Bericht van " . $uname ;
        $read = 0;
        $queryUser = 'SELECT * FROM bc18_users WHERE role = "bc_18_admin" ';
        $resultsUser = mysqli_query($db, $queryUser);
        while ($dataUser = mysqli_fetch_array($resultsUser)){
            $email = $dataUser['email'];
            $stmt3->bind_param('ssssi', $email, $link, $class, $message, $read);
            $stmt3->execute();

        }
        if(!achievedAchievement($db,15,$mail))
            addAchievement($db, 15, $mail);
    }
}
?>
    <section class="content">	
       <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h4>Contact</h4>
                    </div>
                    <div class="body">
                        <div class="row clearfix">	
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <p>
                                    Found a bug? Want to piss us off?
                                    Let us know! 
                                </p>    
                            </div>	
                        </div>
                        <div class="row clearfix">  
                            <div class="col-lg-6 col-md-6">
                                <center><img src="https://upload.wikimedia.org/wikipedia/en/6/67/2018_FIFA_World_Cup.svg" class="img-responsive" alt="WC Logo"></center>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <form id="form_validation" method="POST" action="contact.php">
                                    <div class="row clearfix"> 
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"> 
                                            <p> <b>Naam</b></p>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" name="username" value="<?php echo $_SESSION['username'];?>" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix"> 
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
                                            <p> <b>Message</b></p>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" name="message">
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                <?php

                                if ($status == 'succes_status'){
                                    echo '<div id='.'succes'.' class="alert alert-success " >
                                    <strong>Gelukt!</strong> Bedankt voor je bericht!.
                                    </div>';
                                }
                                if($status == 'error_status'){
                                echo '<div id='.'error'.' class="alert alert-danger">
                                    <strong>FOUT!</strong> Je kan niet meer gokken op deze wedstrijd.
                                    </div>';  
                                }
                                if($status == 'overal_status'){
                                echo '<div id='.'error'.' class="alert alert-danger">
                                    <strong>FOUT!</strong> Er ging iets mis bij het submitten. Probeer opnieuw en laat iets weten aan de system administrators.
                                    </div>';  
                                }
                                ?>				
                                     <button type="submit" name='sub-btn' class="btn bg-blue waves-effect">
                                        <i class="material-icons">save</i>
                                        <span>SUBMIT</span>
                                    </button>
                                </form>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        if($_SESSION['role'] == 'bc_18_admin'){
            ?>

            <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h4>Messages</h4>
                    </div>
                    <div class="body">
                        <?php
                            $msgs = "SELECT * FROM `bc18_chat` ORDER BY bc18_created DESC";
                            $results = mysqli_query($db, $msgs);
                            if (!$results) {
                                printf("Error: %s\n", mysqli_error($conn));
                                exit();
                              }
                            while($data = mysqli_fetch_array($results)){
                                ?>

                                <div>
                                    <h4><?php echo $data['bc18_username'];  ?></h4>
                                    <p><?php echo $data['bc18_msg']; ?></p>
                                </div>
                                <hr>
                                <?php
                            }
                        ?>

                    </div>
                </div>
            </div>
        </div>



            <?php
        }
        ?>


	   
    </section>

    <!-- Jquery Core Js -->
    <script src="../plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="../plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="../plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="../plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="../plugins/node-waves/waves.js"></script>

    <!-- Custom Js -->
    <script src="../js/admin.js"></script>

    <!-- Demo Js -->
    <script src="../js/demo.js"></script>

    <!-- <script src="../js/pages/examples/sign-up.js"></script> -->
</body>

</html>