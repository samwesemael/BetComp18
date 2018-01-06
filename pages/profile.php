<!DOCTYPE html>
<html>
<?php include 'navigator.php';?>
<script type="text/javascript">
    document.getElementById("nav-profile").classList.toggle('active');
</script>

<link href="../css/materializeprofile.css" type="text/css" rel="stylesheet" media="screen,projection">
<link href="../css/styleprofile.css" type="text/css" rel="stylesheet" media="screen,projection">

<section class="content">

	<!-- header -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div id="profile-page-header" class="card">
                <div class="card-image waves-effect waves-block waves-light">
                    <img class="activator" src="../images/user-profile-bg.jpg" alt="user background">                    
                </div>
                <div class="card-content">
                  <div class="row clearfix">  
                        <div class="col-sm-3 col-xs-3 col-md-3 col-lg-3">
                             <figure class="figure" position= 'absolute';>
                                <img src="<?php echo $_SESSION['profilepicpath'];?>" alt="profile image" class="img-circle img-responsive">
                            </figure>
                        </div>            
                        <div class="col-sm-3 col-xs-3 col-md-3 col-lg-3">            
                            <h4 class="card-title grey-text text-darken-4"><center><?php echo $_SESSION['firstname']; echo $_SESSION['lastname']; ?></center></h4>
                            <p class="medium-small grey-text"><center><?php echo $_SESSION['username'];?></center></p>                        
                        </div>
                        <div class="col-sm-3 col-xs-3 col-md-3 col-lg-3">
                            <h4 class="card-title grey-text text-darken-4"><center>info</center></h4>
                            <p class="medium-small grey-text"><center>info</center></p>                        
                        </div>
                        <div class="col-sm-3 col-xs-3 col-md-3 col-lg-3">
                            <h4 class="card-title grey-text text-darken-4"><center>nog iets</center></h4>
                            <p class="medium-small grey-text"><center>blabla</center></p>                        
                        </div>                    
                        <!-- <div class="col s2 center-align">
                            <h4 class="card-title grey-text text-darken-4">nog iets</h4>
                            <p class="medium-small grey-text">bla</p>                        
                        </div>   -->                  
                    
                    </div>
                </div>
            </div>     
        </div>
    </div>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="card-image waves-effect waves-block waves-light">
                    <form action="file_upload.php" method="post" enctype="multipart/form-data">
                    Select image to upload:
                    <input type="file" name="fileToUpload" id="fileToUpload">
                    <input type="submit" value="Upload Image" name="submit">
                    </form>
                    <?php if(isset($_GET['upload'])){
                        if($_GET['upload']==='success'){
                            echo'
                            <div class="alert alert-success">
                                <strong>Gelukt!</strong> De foto van u lelijk hoofd is je nieuwe profielfoto.
                            </div>';
                        }
                        else{
                            if($_GET['upload']==='error4'){
                                $errormessage = 'Sorry, alleen vierkante afbeeldingen toegestaan';
                            }
                            else{

                            if($_GET['upload']==='error3'){
                                $errormessage = 'Aah ik ziet het al. Bestand is te groot';
                            }
                            else{

                                if($_GET['upload']==='error2'){
                                    $errormessage = 'Aah!! Je kan enkel jpeg, jpg of png uploaden';
                                }
                                else{
                               $errormessage = 'Gewoon een te lelijk hoofd waarschijnlijk';
                                }

                        }
                    }
                            echo'
                                <div class="alert alert-warning">
                                    <strong>Oeps! </strong> Dat was niet de bedoeling. Eens kijken... <br>'.$errormessage.'!
                                </div>
                            ';
                }


                    } ?>
                </div>
            </div>
        </div>
    </div>



  <!-- END header -->		
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
</body>

</html>