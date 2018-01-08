<!DOCTYPE html>
<html>
<?php 
  session_start(); 
  ?>
<?php if($_SESSION['role'] == 'speler'){
           header('Location: index.php'); 
    }
    else{
        include('navigator.php');
    }
?>


<script type="text/javascript">
    document.getElementById("nav-adminpage").classList.toggle('active');
</script>

    <section class="content">
    
    
                <!-- Basic Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h1>
                                Admin Page
                            </h1>                      
                        </div>
                        <div class="body table-responsive">
                            <?php echo $_SESSION['role']; ?>
                            Bla Bla Bla
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Table -->
    
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