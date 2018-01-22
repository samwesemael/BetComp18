<!DOCTYPE html>
<html>
<!-- navigator inladen en juist actief zetten -->
<?php include 'navigator.php';
    include 'server.php';?>
<script type="text/javascript">
    document.getElementById("nav-gokken").classList.toggle('active');
    document.getElementById("nav-bonussen-indienen").classList.toggle('active');

    $(document).ready(function() {
   $('.selectpicker').selectpicker();
});
</script>

<?php
$status = "";
    if(isset($_POST['indienen'])){
        $userName = mysqli_real_escape_string($db, $_POST['username']);
        $kampioen = mysqli_real_escape_string($db, $_POST['wereldkampioen']);
        $verliezer = mysqli_real_escape_string($db, $_POST['finalist']);
        $topscorer = mysqli_real_escape_string($db, $_POST['topschutter']);
        $vuilste = mysqli_real_escape_string($db, $_POST['vuilste']);
        $posBelgie = mysqli_real_escape_string($db, $_POST['posBelgie']);
        $mail = $_SESSION['email'];
        $tstquery = "SELECT datum, status FROM bc18_games WHERE 1 ORDER BY datum ASC LIMIT 1";
        $res = mysqli_query($db, $tstquery);
        while ($data = mysqli_fetch_array($res)) {
            $dtnow = new DateTime();
            // omzetten naar juiste timezone alleen als in database ook in juiste timezone zit
            // $dtnow ->setTimeZone(new DateTimeZone('Europe/Brussels'));
            $dtdatabase = new DateTime($data['datum']);
            $datastatus = $data['status'];
            if($dtnow > $dtdatabase || $datastatus == 'FINISHED'){
                // match is al begonnen
                $status = 'error_status';
            }
            else{
                $status = 'succes_status';
                // match moet nog beginnen

                $indienquery = "INSERT INTO bc18_predictedbonusses(user_id, world_champion, finalist, topscorer, dirty_team, pos_belgium, submitted_data) VALUES ('$mail','$kampioen','$verliezer','$topscorer','$vuilste','$posBelgie','".date("Y-m-d H:i:s")."') ON DUPLICATE KEY UPDATE world_champion = '$kampioen', finalist='$verliezer', topscorer='$topscorer', dirty_team='$vuilste', pos_belgium='$posBelgie', submitted_data='".date("Y-m-d H:i:s")."'";
                mysqli_query($db, $indienquery);
            }
    }
    if (mysqli_affected_rows($db)==0){
        if($status != 'error_status'){
            $status = 'overall_error';
        }
    }
}
?>
    <section class="content">
	
       <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h4>BONUSSEN INDIENEN</h4>
                    </div>
                    <div class="body">						
                        <form id="form_validation" method="POST" action="bonussen_indienen.php">	
							<div class="row clearfix">
								<div class="col-md-4"> 
									<p> <b>Naam</b></p>
										<div class="form-group form-float">
											<div class="form-line">
												<input type="text" class="form-control" name="username" value="<?php echo $_SESSION['firstname'];?>" disabled>
												<!-- <label  class="form-label"><?php echo $_SESSION['firstname'];?></label> -->
											</div>
										</div>
								</div>		
																													
                                <div class="col-md-4"> 
									<p><b>Wereldkampioen</b></p>

									
                                    <select name="wereldkampioen" class="selectpicker">
										<option data-thumbnail="../images/flags/hi_res/flag_arg.png">Argentina</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_aus.png">Australia</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_bel.png">Belgium</option>
										<option data-thumbnail="../images/flags/hi_res/flag_bra.png">Brazil</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_col.png">Colombia</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_cos.png">Costa Rica</option>
										<option data-thumbnail="../images/flags/hi_res/flag_cro.png">Croatia</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_den.png">Denmark</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_egy.png">Egypt</option>
										<option data-thumbnail="../images/flags/hi_res/flag_eng.png">England</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_fra.png">France</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_ger.png">Germany</option>
										<option data-thumbnail="../images/flags/hi_res/flag_ice.png">Iceland</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_ira.png">Iran</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_jap.png">Japan</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_sou.png">Korea Republic</option>
										<option data-thumbnail="../images/flags/hi_res/flag_mex.png">Mexico</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_mor.png">Morrocco</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_nig.png">Nigeria</option>
										<option data-thumbnail="../images/flags/hi_res/flag_pan.png">Panama</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_per.png">Peru</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_pol.png">Poland</option>
										<option data-thumbnail="../images/flags/hi_res/flag_por.png">Portugal</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_rus.png">Russia</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_sau.png">Saudi Arabia</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_sen.png">Senegal</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_ser.png">Serbia</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_spa.png">Spain</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_swe.png">Sweden</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_swi.png">Switzerland</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_tun.png">Tunesia</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_uru.png">Urugay</option>
                                    </select>					
                                </div>  
					            <div class="col-md-4"> 
									<p><b>Verliezend finalist</b></p>								
                                    <select name = "finalist" class="selectpicker">
                                        <option data-thumbnail="../images/flags/hi_res/flag_arg.png">Argentina</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_aus.png">Australia</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_bel.png">Belgium</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_bra.png">Brazil</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_col.png">Colombia</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_cos.png">Costa Rica</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_cro.png">Croatia</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_den.png">Denmark</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_egy.png">Egypt</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_eng.png">England</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_fra.png">France</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_ger.png">Germany</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_ice.png">Iceland</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_ira.png">Iran</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_jap.png">Japan</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_sou.png">Korea Republic</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_mex.png">Mexico</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_mor.png">Morrocco</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_nig.png">Nigeria</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_pan.png">Panama</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_per.png">Peru</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_pol.png">Poland</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_por.png">Portugal</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_rus.png">Russia</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_sau.png">Saudi Arabia</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_sen.png">Senegal</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_ser.png">Serbia</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_spa.png">Spain</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_swe.png">Sweden</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_swi.png">Switzerland</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_tun.png">Tunesia</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_uru.png">Urugay</option>
                                    </select>                   
                                </div>  
							</div>
							<div class="row clearfix">
                                <div class="col-md-4">	
									<p><b>Topschutter</b> </p>
									<?php
									 $query = "SELECT player_name FROM bc18_players";
									 $results = mysqli_query($db, $query);
                                     //$i = 1;
                                     //$data = mysqli_fetch_array($results); ?>
									<select class="form-control show-tick" data-live-search="true">
									  <?php
										while($data = mysqli_fetch_array($results)){
											echo '<option>'.$data['player_name'].'</option>';
										} ?>
									</select>
									
									<!--
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="topschutter" required>
                                            <label class="form-label">Radja Nainggolan</label>
                                        </div>
                                    </div>   -->

									
                                </div>	
								
								
                                <div class="col-md-4"> 
									<p><b>Vuilste ploeg</b></p>								
                                    <select name="vuilste" class="selectpicker">
                                        <option data-thumbnail="../images/flags/hi_res/flag_arg.png">Argentina</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_aus.png">Australia</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_bel.png">Belgium</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_bra.png">Brazil</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_col.png">Colombia</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_cos.png">Costa Rica</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_cro.png">Croatia</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_den.png">Denmark</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_egy.png">Egypt</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_eng.png">England</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_fra.png">France</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_ger.png">Germany</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_ice.png">Iceland</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_ira.png">Iran</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_jap.png">Japan</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_sou.png">Korea Republic</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_mex.png">Mexico</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_mor.png">Morrocco</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_nig.png">Nigeria</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_pan.png">Panama</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_per.png">Peru</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_pol.png">Poland</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_por.png">Portugal</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_rus.png">Russia</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_sau.png">Saudi Arabia</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_sen.png">Senegal</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_ser.png">Serbia</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_spa.png">Spain</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_swe.png">Sweden</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_swi.png">Switzerland</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_tun.png">Tunesia</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_uru.png">Urugay</option>
                                    </select>                   
                                </div>  
                                <div class="col-md-4"> 
									<p><b>Positie België</b></p>								
                                    <select name="posBelgie" class="selectpicker">
                                        <option>Groepsfase</option>
                                        <option>8ste finales</option>
                                        <option>kwartfinales</option>
										<option>halve finales</option>
                                        <option>finale</option>                                      
                                    </select>					
                                </div>  	
                            </div>								
              
							<?php

                            if ($status == 'succes_status'){
                                echo '<div id='.'succes'.' class="alert alert-success " >
                                <strong>Gelukt!</strong> Je bonussen zijn goed ontvangen.
                                </div>';
                            }
                            if($status == 'error_status'){
                            echo '<div id='.'error'.' class="alert alert-danger">
                                <strong>FOUT!</strong> WK is begonnen. Bonussen kunnen niet meer gewijzigd worden.
                                </div>';  
                            }
                            if($status == 'overal_status'){
                            echo '<div id='.'error'.' class="alert alert-danger">
                                <strong>FOUT!</strong> Er ging iets mis bij het submitten. Probeer opnieuw en laat iets weten aan de system administrators.
                                </div>';  
                            }
    
                            ?>      

                            <button type="submit" name='indienen' class="btn bg-blue waves-effect">
                                <i class="material-icons">save</i>
                                <span>SAVE</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
		<!-- idd niet meer nodig, eenmaal WK bezig is is deze tab sws niemeer nodig want dan kan je bonussen niemeer wijzigen -->
<!--         <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Mijn bonussen</h2> <big>NIET ZEKER OF DIT HIER NOG NODIG IS, STAAT OOK OP HOME, EN BIJ TABBLAD BONUSSEN KUNT GE VAN IEDEREEN ZIEN</big>
                    </div>                        
    				<div class="body table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Naam</th>
                                    <th>Wereldkampioen</th>
                                    <th>Verliezend finalist</th>
    								<th>Topschutter</th>
    								<th>Vuilste ploeg</th>
    								<th>Positie België</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>                                       
                                    <td>Sam</td>
    								<td>Costa Rica</td>   
    								 <td>Panama</td>
    								 <td>Courtois</td>
    								 <td>België</td>
    							     <td>groepsfase</td>                                 
                                </tr>
                            </tbody>
                        </table>
                    </div>
    			</div>
    		</div>
    	</div>
	    -->
    </section>

    <!-- Jquery Core Js -->
    <script src="../plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="../plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="../plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="../plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
	
	  <!-- Bootstrap Notify Plugin Js -->
    <script src="../plugins/bootstrap-notify/bootstrap-notify.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="../plugins/node-waves/waves.js"></script>
	
	 <!-- SweetAlert Plugin Js -->
    <script src="../../plugins/sweetalert/sweetalert.min.js"></script>

    <!-- Custom Js -->
    <script src="../js/admin.js"></script>
	<script src="../js/pages/ui/dialogs.js"></script>
	<script src="../js/pages/forms/advanced-form-elements.js"></script>
	
	    <!-- Dropzone Plugin Js -->
    <script src="../plugins/dropzone/dropzone.js"></script>

    <!-- Input Mask Plugin Js -->
    <script src="../plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script>
	
    <!-- Demo Js -->
    <script src="../js/demo.js"></script>

    <script src="../plugins/bootstrap-select/js/modified/bootstrap-select.js"></script>

</body>

</html>