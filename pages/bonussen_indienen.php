<!DOCTYPE html>
<html>
<!-- navigator inladen en juist actief zetten -->
<?php include 'navigator.php';?>
<script type="text/javascript">
    document.getElementById("nav-gokken").classList.toggle('active');
    document.getElementById("nav-bonussen-indienen").classList.toggle('active');
</script>
    <section class="content">
	
           <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Bonussen indienen</h2>
                        </div>
                        <div class="body">						
                            <form id="form_validation" method="POST">	
								 <div class="row clearfix">
								<div class="col-md-4"> 
									<p> <b>Naam</b></p>
										<div class="form-group form-float">
											<div class="form-line">
												<input type="text" class="form-control" name="name" required>
												<label class="form-label">Name</label>
											</div>
										</div>
								</div>		
																													
                                <div class="col-md-4"> 
									<p><b>Wereldkampioen</b></p>								
                                    <select class="form-control show-tick">
										<option>Argentinië</option>
                                        <option>Australië</option>
                                        <option>België</option>
										<option>Brazilië</option>
                                        <option>Colombia</option>
                                        <option>Costa Rica</option>
										<option>Denemarken</option>
                                        <option>Duitsland</option>
                                        <option>Egypte</option>
										<option>Engeland</option>
                                        <option>Frankrijk</option>
                                        <option>Ijsland</option>
										<option>Iran</option>
                                        <option>Japan</option>
                                        <option>Kroatië</option>
										<option>Marokko</option>
                                        <option>Mexico</option>
                                        <option>Nigeria</option>
										<option>Panama</option>
                                        <option>Peru</option>
                                        <option>Polen</option>
										<option>Portugal</option>
                                        <option>Rusland</option>                                        
										<option>Saoedi-Arabië</option>
										<option>Senegal</option>
										<option>Servië</option>
                                        <option>Spanje</option>
                                        <option>Tunesië</option>
										<option>Uruguay</option>
                                        <option>Zuid-Korea</option>
                                        <option>Zweden</option>
										<option>Zwitserland</option>
                                    </select>					
                                </div>  
					            <div class="col-md-4"> 
									<p><b>Verliezend finalist</b></p>								
                                    <select class="form-control show-tick">
										<option>Argentinië</option>
                                        <option>Australië</option>
                                        <option>België</option>
										<option>Brazilië</option>
                                        <option>Colombia</option>
                                        <option>Costa Rica</option>
										<option>Denemarken</option>
                                        <option>Duitsland</option>
                                        <option>Egypte</option>
										<option>Engeland</option>
                                        <option>Frankrijk</option>
                                        <option>Ijsland</option>
										<option>Iran</option>
                                        <option>Japan</option>
                                        <option>Kroatië</option>
										<option>Marokko</option>
                                        <option>Mexico</option>
                                        <option>Nigeria</option>
										<option>Panama</option>
                                        <option>Peru</option>
                                        <option>Polen</option>
										<option>Portugal</option>
                                        <option>Rusland</option>                                        
										<option>Saoedi-Arabië</option>
										<option>Senegal</option>
										<option>Servië</option>
                                        <option>Spanje</option>
                                        <option>Tunesië</option>
										<option>Uruguay</option>
                                        <option>Zuid-Korea</option>
                                        <option>Zweden</option>
										<option>Zwitserland</option>
                                    </select>					
                                </div>  
								</div>
								 <div class="row clearfix">
                                <div class="col-md-4">	
															 <p><b>Topschutter</b> </p>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="name" required>
                                        <label class="form-label">topschutter</label>
                                    </div>
                                </div>   
						</div>	
						<div class="col-md-4"> 
									<p><b>Vuilste ploeg</b></p>								
                                    <select class="form-control show-tick">
										<option>Argentinië</option>
                                        <option>Australië</option>
                                        <option>België</option>
										<option>Brazilië</option>
                                        <option>Colombia</option>
                                        <option>Costa Rica</option>
										<option>Denemarken</option>
                                        <option>Duitsland</option>
                                        <option>Egypte</option>
										<option>Engeland</option>
                                        <option>Frankrijk</option>
                                        <option>Ijsland</option>
										<option>Iran</option>
                                        <option>Japan</option>
                                        <option>Kroatië</option>
										<option>Marokko</option>
                                        <option>Mexico</option>
                                        <option>Nigeria</option>
										<option>Panama</option>
                                        <option>Peru</option>
                                        <option>Polen</option>
										<option>Portugal</option>
                                        <option>Rusland</option>                                        
										<option>Saoedi-Arabië</option>
										<option>Senegal</option>
										<option>Servië</option>
                                        <option>Spanje</option>
                                        <option>Tunesië</option>
										<option>Uruguay</option>
                                        <option>Zuid-Korea</option>
                                        <option>Zweden</option>
										<option>Zwitserland</option>
                                    </select>					
                                </div>  
					<div class="col-md-4"> 
									<p><b>Positie België</b></p>								
                                    <select class="form-control show-tick">
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
</body>

</html>