<!DOCTYPE html>
<html>
<!-- navigator inladen en juist actief zetten -->
<?php include 'navigator.php';?>
<script type="text/javascript">
    document.getElementById("nav-gokken").classList.toggle('active');
    document.getElementById("nav-matchen-indienen").classList.toggle('active');
</script>

    <section class="content">	
           <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Matchen indienen</h2>
                        </div>
                        <div class="body">						
                            <form id="form_validation" method="POST">								
								<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12"> 
									<p> <b>Naam</b></p>
										<div class="form-group form-float">
											<div class="form-line">
												<input type="text" class="form-control" name="name" value="<?php echo $_SESSION['firstname'];?>" disabled>
												<!-- <label class="form-label"><?php echo $_SESSION['firstname'];?></label> -->
											</div>
										</div>
								</div>		
																													
                                <div class="col-md-3"> 
									<p><b>Speeldag</b></p>								
                                    <select class="form-control show-tick">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
										<option>4</option>
                                        <option>5</option>
                                        <option>6</option>
										<option>7</option>
                                        <option>8</option>
                                        <option>9</option>
										<option>10</option>
                                        <option>11</option>
                                        <option>12</option>
										<option>13</option>
                                        <option>14</option>
                                        <option>15</option>
										<option>16</option>
                                        <option>17</option>
                                        <option>18</option>
										<option>19</option>
                                        <option>20</option>
                                        <option>21</option>
										<option>22</option>
                                        <option>23</option>                                        
										<option>24</option>
										<option>25</option>
                                    </select>					
                                </div>  
					
					<div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">	
															 <p><b>Score</b> </p>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="name" required>
                                        <label class="form-label">0-0</label>
                                    </div>
                                </div>   
						</div>	
						
						<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">	
															<p><b>Extra</b>  <small>(vanaf knockout)</small> </p>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="name" required>
                                        <label class="form-label">69</label>
										
                                    </div>
                                </div>   
						</div>	
					</div>						
                                 <button type="button" class="btn bg-blue waves-effect">
                                    <i class="material-icons">save</i>
                                    <span>SAVE</span>
                                </button>
                                
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

    <!-- Waves Effect Plugin Js -->
    <script src="../plugins/node-waves/waves.js"></script>

    <!-- Custom Js -->
    <script src="../js/admin.js"></script>

    <!-- Demo Js -->
    <script src="../js/demo.js"></script>
</body>

</html>