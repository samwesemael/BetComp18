<!DOCTYPE html>
<html>
<!-- navigator inladen en juist actief zetten -->
<?php include 'navigator.php';?>
<script type="text/javascript">
    document.getElementById("nav-datatest").classList.toggle('active');
</script>

    <section class="content">
	 <div class="container-fluid">
			 <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">	
					<div class="header">
                            <h1>
                                Data Testing
                            </h1>
					</div>
					
					
	 <div class="body">
			<?php
			$uri = 'http://api.football-data.org/v1/competitions/354/fixtures/?matchday=22';
			$reqPrefs['http']['method'] = 'GET';
			$reqPrefs['http']['header'] = 'X-Auth-Token: YOUR_API_TOKEN';
			$stream_context = stream_context_create($reqPrefs);
			$response = file_get_contents($uri, false, $stream_context);
			$fixtures = json_decode($response);
?>
	 </div>
	   
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