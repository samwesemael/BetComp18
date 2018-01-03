<?php 
  session_start(); 

  if (!isset($_SESSION['email'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: sign-in.php');
  }
  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['email']);
    header('location: sign-in.php');
  }
?>

<!DOCTYPE html>
<html>

<!-- navigator inladen -->
<?php include '../navigator.php' ?>

<script type="text/javascript">
    document.getElementById("nav-matches").classList.toggle('active');
</script>

    <section class="content">
	
	            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Matches
						     </h2>
							 <br>
                               <!-- <small>Add quick, dynamic tab functionality to transition through panes of local content</small> -->
							   <small>Speeldag 1-15: groepsfase</small> <br>
							   <small>Speeldag 16-19: 8ste finales</small> <br>
							   <small>Speeldag 20-21: kwartfinales</small> <br>
							   <small>Speeldag 22-23: halve finales</small> <br>
							   <small>Speeldag 24: 3de plaats</small> <br>
							   <small>Speeldag 25: finale</small> <br>
                     
                 
                        </div>
                        <div class="body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs tab-nav-right" role="tablist">
							<!-- TODO: active de speeldag van die dag laten zijn -->
                                <li role="presentation" class="active"><a href="#1" data-toggle="tab">1</a></li>
                                <li role="presentation"><a href="#2" data-toggle="tab">2</a></li>
                                <li role="presentation"><a href="#3" data-toggle="tab">3</a></li>
                                <li role="presentation"><a href="#4" data-toggle="tab">4</a></li>
                                <li role="presentation"><a href="#5" data-toggle="tab">5</a></li>
                                <li role="presentation"><a href="#6" data-toggle="tab">6</a></li>
                                <li role="presentation"><a href="#7" data-toggle="tab">7</a></li>
                                <li role="presentation"><a href="#8" data-toggle="tab">8</a></li>
                                <li role="presentation"><a href="#9" data-toggle="tab">9</a></li>
                                <li role="presentation"><a href="#10" data-toggle="tab">10</a></li>
                                <li role="presentation"><a href="#11" data-toggle="tab">11</a></li>
                                <li role="presentation"><a href="#12" data-toggle="tab">12</a></li>
                                <li role="presentation"><a href="#13" data-toggle="tab">13</a></li>
                                <li role="presentation"><a href="#14" data-toggle="tab">14</a></li>
                                <li role="presentation"><a href="#15" data-toggle="tab">15</a></li>
                                <li role="presentation"><a href="#16" data-toggle="tab">16</a></li>
                                <li role="presentation"><a href="#17" data-toggle="tab">17</a></li>
                                <li role="presentation"><a href="#18" data-toggle="tab">18</a></li>
                                <li role="presentation"><a href="#19" data-toggle="tab">19</a></li>
                                <li role="presentation"><a href="#20" data-toggle="tab">20</a></li>
                                <li role="presentation"><a href="#21" data-toggle="tab">21</a></li>
                                <li role="presentation"><a href="#22" data-toggle="tab">22</a></li>
                                <li role="presentation"><a href="#23" data-toggle="tab">23</a></li>
                                <li role="presentation"><a href="#24" data-toggle="tab">24</a></li>
                                <li role="presentation"><a href="#25" data-toggle="tab">25</a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
							
							
                                <div role="tabpanel" class="tab-pane fade in active" id="1">
								<div class="media">
                                <div class="media-left media-middle">
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <a href="#">
                                        <img class="media-object" src="../images/flags/flag_rus.png" width="64" height="64">
                                    </a>
                                </div>
								
                                <div class="media-body media-middle centered-content">
                                     <h6>RUSLAND - SAUDI-ARABIA</h6> <br>
									  <h5>2-2</h5>
                                </div>
                                <div class="media-right media-middle">
                                    <a href="#">
                                        <img class="media-object" src="../images/flags/flag_sau.png" width="64" height="64">
                                    </a>
                                
                            </div>
                                  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    </div>
                        <div class="header">
                            <h3>
                                Scores
							</h3>                                                   
                            
                       
                        <div class="body table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>                                
                                        <th>Naam</th>
										<th>Score</th>
										<th>Punten</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                   
                                        <td>Mark</td>
										<td>2-2</td>
										<td>3</td>

                                    </tr>
                                    <tr>
                              
                                        <td>Jacob</td>
										<td>2-2</td>
										<td>3</td>
                                    </tr>
                                    <tr>
                         
                                        <td>Larry</td>
										<td>2-2</td>
										<td>3</td>
                                    </tr>
                                    <tr>
                              
                                        <td>Larry</td>
											<td>2-2</td>
											<td>3</td>
                                    </tr>
                                    <tr>
                          
                                        <td>Larry</td>
										<td>2-2</td>
										<td>3</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
				
                  </div>
            
				</div>
				</div>				
				</div>				
                                <div role="tabpanel" class="tab-pane fade" id="2">
                                   
								<div class="media">
                                <div class="media-left media-middle">
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <a href="#">
                                        <img class="media-object" src="../images/flags/flag_por.png" width="64" height="64">
                                    </a>
                                </div>
                                <div class="media-body media-middle centered-content">
                                     <h5>PORTUGAL - SPAIN</h5> <br>
									  <h4>2-2</h4>
                                </div>
                                <div class="media-right media-middle">
                                    <a href="#">
                                        <img class="media-object" src="../images/flags/flag_spa.png" width="64" height="64">
                                    </a>
                                
                            </div>
                                 
                        <div class="header">
                            <h3>
                                Scores
							</h3>                                                   
                            
                       
                        <div class="body table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>                                
                                        <th>Naam</th>
										<th>Score</th>
										<th>Punten</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                   
                                        <td>Mark</td>
										<td>2-2</td>
										<td>3</td>

                                    </tr>
                                    <tr>
                              
                                        <td>Jacob</td>
										<td>2-2</td>
										<td>3</td>
                                    </tr>
                                    <tr>
                         
                                        <td>Larry</td>
										<td>2-2</td>
										<td>3</td>
                                    </tr>
                                    <tr>
                              
                                        <td>Larry</td>
											<td>2-2</td>
											<td>3</td>
                                    </tr>
                                    <tr>
                          
                                        <td>Larry</td>
										<td>2-2</td>
										<td>3</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
				
                  </div>
            
				</div>
				</div>	
								   
								   
								   
								   
								   
								   
                                </div>
								
								
								
								
                                <div role="tabpanel" class="tab-pane fade" id="3">
                                    <b>Message Content</b>
                                    <p>
                                        Lorem ipsum dolor sit amet, ut duo atqui exerci dicunt, ius impedit mediocritatem an. Pri ut tation electram moderatius.
                                        Per te suavitate democritum. Duis nemore probatus ne quo, ad liber essent aliquid
                                        pro. Et eos nusquam accumsan, vide mentitum fabellas ne est, eu munere gubergren
                                        sadipscing mel.
                                    </p>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="4">
                                    <b>Settings Content</b>
                                    <p>
                                        Lorem ipsum dolor sit amet, ut duo atqui exerci dicunt, ius impedit mediocritatem an. Pri ut tation electram moderatius.
                                        Per te suavitate democritum. Duis nemore probatus ne quo, ad liber essent aliquid
                                        pro. Et eos nusquam accumsan, vide mentitum fabellas ne est, eu munere gubergren
                                        sadipscing mel.
                                    </p>
                                </div>
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