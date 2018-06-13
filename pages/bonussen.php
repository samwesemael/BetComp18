<?php include 'navigator.php';
        include 'server.php';?>
<!DOCTYPE html>
<html>
<script type="text/javascript">
    document.getElementById("nav-bonussen").classList.toggle('active');
</script>

    <section class="content">
	         
	            <!-- Basic Table -->
            <div class="row clearfix">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h4>
                                TOPSCORERS
							</h4>
							
							<?php
							$sqltopscorers = "SELECT player_name,goals from bc18_players ORDER BY goals, player_name LIMIT 0,5";
							$topsco = mysqli_query($db, $sqltopscorers);							
							$ranking_topsco = 1;							
							?>
                                                          
                            
                        </div>
                        <div class="body table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
										<th>Goals</th>

                                    </tr>
                                </thead>
                                <tbody>
								<?php 
								while($data_topsco = mysqli_fetch_array($topsco)){
								echo'                                               
                                                <tr>
                                                    <th scope="row">'.$ranking_topsco.'</th>
													<td>'.$data_topsco['player_name'].'</td>
													<td>'.$data_topsco['goals'].'</td>
                                    </tr>';
							    $ranking_topsco++;
								}
								?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
				
				                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h4>
                                DIRTIEST TEAM
							</h4>
                              
						    <?php							
							
							?>
                            
                        </div>
                        <div class="body table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Team</th>
										<th>R</th>
										<th>Y</th>
										<th>Pts</th>

                                    </tr>
                                </thead>
                                <tbody>
								<?php 
								$sqldirtyteam = "SELECT team_crest, team_name,yellow_cards,red_cards from bc18_teams ORDER BY red_cards, yellow_cards, team_name LIMIT 0,5";
							    $dirty = mysqli_query($db, $sqldirtyteam);
								$ranking_dirty = 1;
								while($data_dirty = mysqli_fetch_array($dirty)){
									$yc = $data_dirty['yellow_cards'];
									$rc = $data_dirty['red_cards'];
									$dirtypoints = (3 * $rc) + $yc;
									
								echo'                                               
                                                <tr>
                                                    <th scope="row">'.$ranking_dirty.'</th>
													<td><div class="media-left media-middle">
															<a href="javascript:void(0);"> <img class="media-object" src="'.$data_dirty['team_crest'].'" width="23" height="15"> </a> </div>
															<div class="media-body">
															'.$data_dirty['team_name'].'   </div>	</td>   
													<td>'.$rc.'</td>
													<td>'.$yc.'</td>
													<td>'.$dirtypoints.'</td>
                                    </tr>';
							    $ranking_dirty++;
								}
								?>                               
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Table -->
			
				            <!-- Basic Table -->
            <div class="row clearfix">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h4>
                                FINAL
							</h4>
							<div class="media">
										<center>
										<div class="media-left media-middle">								
											<a href="#">
												<img class="media-object" src="../images/flags/low_res/flag_unk.png" width="23" height="15">
											</a>
										</div>										
										<div class="media-body">
											<h5>? - ?</h5> 
												 15/6/2018 - 20:00 
										</div>
										<div class="media-right media-middle">
										<a href="#">
											<img class="media-object" src="../images/flags/low_res/flag_unk.png" width="23" height="15">
										</a>
										</div>   
										</center>
									</div>							
							</div>
							</div>
							</div>
							
				
				                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h4>
                                POSITION BELGIUM
							</h4>
                             				
							<div class="body">
                            <div class="progress">
							
							    <div class="progress-bar progress-bar-success" role="progressbar" style="width:20%">
								GROUP
								</div>
								 <div class="progress-bar progress-bar-warning" role="progressbar" style="width:20%">
								1/8
								</div>							
                                <div class="progress-bar progress-bar-warning" role="progressbar" style="width:20%;">
								1/4
                                </div>
								<div class="progress-bar progress-bar-warning" role="progressbar" style="width:20%">
								1/2
								</div>
								<div class="progress-bar progress-bar-warning" role="progressbar" style="width:20%">
								Final
								</div>
                            </div>
                        </div>
                                
                            </div>	
						</div>	
                            
                        </div>
                        
                    </div>
                </div>
            </div>
            <!-- #END# Basic Table -->
            <?php
            $wkStarted = false;
            $valquery = "SELECT status FROM `bc18_games` WHERE team_home = 'Russia' AND team_away = 'Saudi Arabia'";
            $val = mysqli_query($db, $valquery);
            while ($valdata = mysqli_fetch_array($val)) {
                if ($valdata['status'] != 'TIMED'){
                    $wkStarted = true;
                }
            }
            ?>
	    <!-- Basic Table -->

        <?php
        // de boodschap die getoond wordt wanneer het wk nog niet begonnen is
        $boodschap = 'De bonussen van de andere spelers wordt na de start van het WK bekend gemaakt'
        ?>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h4>
                                SUMMARY
							</h4>
                                                  
                        </div>
						<div class="body">
    						<center>
    						 <ul class="nav nav-tabs tab-nav-right nav-justified" role="tablist">
    							<!-- TODO: text vervangen door icoontjes, is te groot voor op 1 lijn op mobiel nu -->
                                    <li role="presentation" class="active"><a href="#1" data-toggle="tab"><center><img src="../images/wordchamp.png" class="img-responsive" style="height:30px"></center></a></li>
                                    <li role="presentation"><a href="#2" data-toggle="tab"><center><img src="../images/finalist.png" class="img-responsive" style="height:30px"></center></a></li>
                                    <li role="presentation"><a href="#3" data-toggle="tab"><center><img src="../images/topschutter.png" class="img-responsive" style="height:30px"></center></a></li>
                                    <li role="presentation"><a href="#4" data-toggle="tab"><center><img src="../images/dirtyteam.png" class="img-responsive" style="height:30px"></center></a></li>
                                    <li role="presentation"><a href="#5" data-toggle="tab"><center><img src="../images/duivels.png" class="img-responsive" style="height:30px"></center></a></li>
    						</ul>
                             </center>      

    						<div class="tab-content nav-justified">							
                                <div role="tabpanel" class="tab-pane fade in active" id="1">   

                                <?php
                                if(!$wkStarted){
                                    echo "<br>";
                                    echo $boodschap;
                                }
                                else{
                                    ?>
                                    <div class="body table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>                                
                                                    <th>Name</th>
                                                    <th><span class="pull-right">Champion</span></th>                             
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $sql = "SELECT bc18_predictedbonusses.user_id, bc18_predictedbonusses.world_champion, bc18_users.email, bc18_users.user_name FROM bc18_predictedbonusses INNER JOIN bc18_users on bc18_predictedbonusses.user_id = bc18_users.email ORDER BY user_name";
                                                $results = mysqli_query($db, $sql);
                                                
                                                while ($data = mysqli_fetch_array($results)){
                                            ?>
                                                <tr>                                   
                                                    <td><?php echo $data['user_name']; ?></td>
                                                    <td><span class="pull-right"><?php echo $data['world_champion']; ?></span></td>                 
                                                </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <?php
                                }

                                ?>     								
                                </div>      
        						
        						
        						<div role="tabpanel" class="tab-pane fade in" id="2">

                                <?php
                                if(!$wkStarted){
                                    echo "<br>";
                                    echo $boodschap;
                                }
                                else{
                                    ?>
        								
                                    <div class="body table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>                                
                                                    <th>Name</th>
                                                    <th><span class="pull-right">Second</span></th>                             
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $sql = "SELECT bc18_predictedbonusses.user_id, bc18_predictedbonusses.finalist, bc18_users.email, bc18_users.user_name FROM bc18_predictedbonusses INNER JOIN bc18_users on bc18_predictedbonusses.user_id = bc18_users.email ORDER BY user_name";
                                                $results = mysqli_query($db, $sql);
                                                
                                                while ($data = mysqli_fetch_array($results)){
                                            ?>
                                                <tr>                                   
                                                    <td><?php echo $data['user_name']; ?></td>
                                                    <td><span class="pull-right"><?php echo $data['finalist']; ?></span></td>                 
                                                </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
        				            <?php 
                                }
                                ?>
        						</div>		
        						
        						
        					   <div role="tabpanel" class="tab-pane fade in" id="3">

                                <?php
                                if(!$wkStarted){
                                    echo "<br>";
                                    echo $boodschap;
                                }
                                else{
                                    ?>
        								
                                    <div class="body table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>                                
                                                    <th>Name</th>
                                                    <th><span class="pull-right">Topscorer</span></th>                             
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $sql = "SELECT bc18_predictedbonusses.user_id, bc18_predictedbonusses.topscorer, bc18_users.email, bc18_users.user_name FROM bc18_predictedbonusses INNER JOIN bc18_users on bc18_predictedbonusses.user_id = bc18_users.email ORDER BY user_name";
                                                $results = mysqli_query($db, $sql);
                                                
                                                while ($data = mysqli_fetch_array($results)){
                                            ?>
                                                <tr>                                   
                                                    <td><?php echo $data['user_name']; ?></td>
                                                    <td><span class="pull-right"><?php echo $data['topscorer']; ?></span></td>                 
                                                </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <?php
                                }
                                ?>
        				
        						</div>	

        						
        				        <div role="tabpanel" class="tab-pane fade in" id="4">

                                <?php
                                if(!$wkStarted){
                                    echo "<br>";
                                    echo $boodschap;
                                }
                                else{
                                    ?>
        								
                                    <div class="body table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>                                
                                                    <th>Name</th>
                                                    <th><span class="pull-right">Dirtiest team</span></th>                             
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $sql = "SELECT bc18_predictedbonusses.user_id, bc18_predictedbonusses.dirty_team, bc18_users.email, bc18_users.user_name FROM bc18_predictedbonusses INNER JOIN bc18_users on bc18_predictedbonusses.user_id = bc18_users.email ORDER BY user_name";
                                            $results = mysqli_query($db, $sql);
                                            while ($data = mysqli_fetch_array($results)){
                                                ?>
                                                <tr>                                   
                                                    <td><?php echo $data['user_name']; ?></td>
                                                    <td><span class="pull-right"><?php echo $data['dirty_team']; ?></span></td>                 
                                                </tr>
                                                <?php
                                            } 
                                            ?> 
                                        </table>
                                    </div>
                                    <?php

                                }
                                ?>
        						</div>		
        						
        						
        					   <div role="tabpanel" class="tab-pane fade in" id="5">

                                <?php
                                if(!$wkStarted){
                                    echo "<br>";
                                    echo $boodschap;
                                }
                                else{
                                    ?>
        								
                                    <div class="body table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>                                
                                                    <th>Name</th>
                                                    <th><span class="pull-right">Position Belgium</span></th>                             
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $sql = "SELECT bc18_predictedbonusses.user_id, bc18_predictedbonusses.pos_belgium, bc18_users.email, bc18_users.user_name FROM bc18_predictedbonusses INNER JOIN bc18_users on bc18_predictedbonusses.user_id = bc18_users.email ORDER BY user_name";
                                                $results = mysqli_query($db, $sql);
                                                
                                                while ($data = mysqli_fetch_array($results)){
                                            ?>
                                                <tr>                                   
                                                    <td><?php echo $data['user_name']; ?></td>
                                                    <td><span class="pull-right"><?php echo $data['pos_belgium']; ?></span></td>                 
                                                </tr>
                                                <?php
                                                }
                                                ?>
                                        </table>
                                    </div>
                                    <?php
                                }
                                ?>
                                </div>								
                            </div>         
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