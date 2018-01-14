<!DOCTYPE html>
<html>
<!-- navigator inladen en juist actief zetten -->
<?php include 'navigator.php';?>
<script type="text/javascript">
    document.getElementById("nav-gokken").classList.toggle('active');
    document.getElementById("nav-bonussen-indienen").classList.toggle('active');

    $(document).ready(function() {
   $('.selectpicker').selectpicker();
});
</script>
    <section class="content">
	
           <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h4>BONUSSEN INDIENEN</h4>
                        </div>
                        <div class="body">						
                            <form id="form_validation" method="POST">	
								 <div class="row clearfix">
								<div class="col-md-4"> 
									<p> <b>Naam</b></p>
										<div class="form-group form-float">
											<div class="form-line">
												<input type="text" class="form-control" name="name" value="<?php echo $_SESSION['firstname'];?>" disabled>
												<!-- <label  class="form-label"><?php echo $_SESSION['firstname'];?></label> -->
											</div>
										</div>
								</div>		
																													
                                <div class="col-md-4"> 
									<p><b>Wereldkampioen</b></p>								
                                    <select class="selectpicker">
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
                                    <select class="selectpicker">
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
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="name" required>
                                        <label class="form-label">Radja Nainggolan</label>
                                    </div>
                                </div>   
						</div>	
						<div class="col-md-4"> 
									<p><b>Vuilste ploeg</b></p>								
                                    <select class="selectpicker">
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
                                    <select class="selectpicker">
                                        <option>Groepsfase</option>
                                        <option>8ste finales</option>
                                        <option>kwartfinales</option>
										<option>halve finales</option>
                                        <option>finale</option>                                      
                                    </select>					
                                </div>  	
						</div>								
              
								
									 <button type="button" class="btn bg-blue waves-effect">
                                    <i class="material-icons">save</i>
                                    <span>SAVE</span>
                                </button>
								</div>
								
							
                            </form>
                        </div>
                    </div>
                </div>
            </div>
			
	 <div class="row clearfix">
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