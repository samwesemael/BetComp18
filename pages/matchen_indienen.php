<?php include 'navigator.php';
        include 'server.php'; 
        $status = '';?>
<!DOCTYPE html>
<html>
<!-- navigator inladen en juist actief zetten -->
<script type="text/javascript">
    document.getElementById("nav-gokken").classList.toggle('active');
   // document.getElementById("nav-matchen-indienen").classList.toggle('active');
</script>


<?php
    if(isset($_POST['bet-btn'])){
        $matchid = mysqli_real_escape_string($db, $_POST['match']);
        $score = mysqli_real_escape_string($db, $_POST['score']);
        $tempscore = explode('-', $score);
        if($tempscore[0] == '' || $tempscore[1] == ''){
            $status = 'invalid';
        }
        if($status != 'invalid'){
            $tempmatchid = explode('-', $matchid);
            $hometeam = trim($tempmatchid[0]);
            $awayteam = trim($tempmatchid[1]);
            $mail = $_SESSION['email'];
            $tstquery = "SELECT datum, status FROM bc18_games WHERE team_home ='$hometeam' AND team_away = '$awayteam'";
            $res = mysqli_query($db, $tstquery);
            while ($data = mysqli_fetch_array($res)) {
                $dtnow = new DateTime();
                // omzetten naar juiste timezone alleen als in database ook in juiste timezone zit
                // $dtnow ->setTimeZone(new DateTimeZone('Europe/Brussels'));
                $dtdatabase = new DateTime($data['datum']);
                $datastatus = $data['status'];
                if($dtnow > $dtdatabase || $datastatus == 'FINISHED' ||$datastatus == 'IN_PLAY'){
                    // match is al begonnen
                    $status = 'error_status';
                }
                else{
                    $status = 'succes_status';
                    // match moet nog beginnen

                    $indienquery = "INSERT INTO bc18_bets (bc18_userid, bc18_gameid, bc18_pred_goalshome, bc18_pred_goalsaway, created) VALUES('$mail', (SELECT game_id FROM bc18_games WHERE team_home ='$hometeam' AND team_away = '$awayteam'), '$tempscore[0]', '$tempscore[1]', NOW()) ON DUPLICATE KEY UPDATE bc18_pred_goalshome='$tempscore[0]', bc18_pred_goalsaway='$tempscore[1]', created = NOW()";
                    mysqli_query($db, $indienquery);
                }
            }
            if (mysqli_affected_rows($db)==0){
                if($status != 'error_status'){
                    $status = 'overall_error';
                }
            }

            $achievsql = "SELECT * FROM bc18_bets WHERE bc18_userid = '$mail'";
            $res = mysqli_query($db, $achievsql);
            $aantal = mysqli_num_rows($res);
            if($aantal == 1){


                //1st bet achievement
                //achievement toevoegen

                addAchievement($db, 2, $mail);
            }
            elseif($aantal == 15){
                //eerste 5 bets
                //achievement toevoegen
                addAchievement($db, 3, $mail);            
            }
        }
    }
	
	if(isset($_POST['indienen'])){
        $valquery = "SELECT status FROM `bc18_games` WHERE team_home = 'Russia' AND team_away = 'Saudi Arabia'";
        $val = mysqli_query($db, $valquery);
        $indienenToegestaan = true;
        while ($valdata = mysqli_fetch_array($val)) {
            if ($valdata['status'] != 'TIMED'){
                $indienenToegestaan = false;
            }
        }
        if($indienenToegestaan){
            $kampioen = mysqli_real_escape_string($db, $_POST['wereldkampioen']);
            $verliezer = mysqli_real_escape_string($db, $_POST['finalist']);
            $topscorer = mysqli_real_escape_string($db, $_POST['topschutter']);
            $vuilste = mysqli_real_escape_string($db, $_POST['vuilste']);
            $posBelgie = mysqli_real_escape_string($db, $_POST['posBelgie']);
            $mail = $_SESSION['email'];		
            
                    $status = 'succes_status';
                    // match moet nog beginnen 
                    $indienquery = "INSERT INTO bc18_predictedbonusses(user_id, world_champion, finalist, topscorer, dirty_team, pos_belgium, submitted_data) VALUES ('$mail','$kampioen','$verliezer','$topscorer','$vuilste','$posBelgie',NOW()) ON DUPLICATE KEY UPDATE world_champion = '$kampioen', finalist='$verliezer', topscorer='$topscorer', dirty_team='$vuilste', pos_belgium='$posBelgie', submitted_data=NOW()";
                    mysqli_query($db, $indienquery);
            if (mysqli_affected_rows($db)==0){
                if($status != 'error_status'){
                    $status = 'overall_error';
                }
            }
        }
        else{
            $status = 'error_status';
        }
    }
?>
    <section class="content">	
           <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h4>SUBMIT MATCHES</h4>
                        </div>
                        <div class="body">						
                            <form id="form_validation" method="POST" action="matchen_indienen.php">								
								<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12"> 
									<p> <b>Naam</b></p>
										<div class="form-group form-float">
											<div class="form-line">
												<input type="text" class="form-control" name="username" value="<?php echo $_SESSION['username'];?>" disabled>
											</div>
										</div>
								</div>		
																													
                                <div class="col-md-3"> 
									<p><b>Fixture</b></p>								
                                    <select name="match" id="match" class="form-control show-tick">
                                        <?php 
                                        $dateNu = date_format(new DateTime(),'Y-m-d H:i:s');
                                        $matchenquery = "SELECT team_home, team_away FROM bc18_games WHERE bettable ='1' and datum >= '$dateNu' ORDER BY datum"; 
                                        $results = mysqli_query($db, $matchenquery);
                                                if (!$results) {
                                                    printf("Error: %s\n", mysqli_error($conn));
                                                    exit();
                                                  }                                                
                                                while($data = mysqli_fetch_array($results)){
                                                    echo '
                                                            <option>'.$data['team_home'].' - '.$data['team_away'].'</option>';
                                                }
                                        ?>
                                    </select>					
                                </div>  
					
					<div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">	
															 <p><b>Score</b> </p>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" id="score" name="score" required>
                                        <label class="form-label">0-0</label>
                                    </div>
                                </div>   
						</div>	
						
						<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">	
															<p><b>Extra</b>  <small>(from knockout)</small> </p>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="extra">
                                        <label class="form-label">69</label>
										
                                    </div>
                                </div>   
						</div>	

					</div>	
                            <?php

                            if ($status == 'succes_status'){
                                echo '<div id='.'succes'.' class="alert alert-success " >
                                <strong>Gelukt!</strong> Je bet ('. $tempscore[0] . '-'. $tempscore[1] .') is goed ontvangen.
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
                            if($status == 'invalid'){
                            echo '<div id='.'error'.' class="alert alert-danger">
                                <strong>FOUT!</strong> Vul de score correct in (bv: 0-0)
                                </div>';  
                            }
	
                            ?>				
                                 <button type="submit" name='bet-btn' class="btn bg-blue waves-effect">
                                    <i class="material-icons">save</i>
                                    <span>SAVE</span>
                                </button>
                            </form>
                        </div>
                    </div>
					
					                <div class="card">
                    <div class="header">
                        <h4>SUBMIT BONUSSES</h4>
                    </div>
                    <div class="body">						
                        <form id="form_validation" method="POST" action="matchen_indienen.php">	
							<div class="row clearfix">
								<div class="col-md-4"> 
									<p> <b>Naam</b></p>
										<div class="form-group form-float">
											<div class="form-line">
												<input type="text" class="form-control" name="username" value="<?php echo $_SESSION['username'];?>" disabled>
												<!-- <label  class="form-label"><?php echo $_SESSION['firstname'];?></label> -->
											</div>
										</div>
								</div>		
																													
                                <div class="col-md-4"> 
									<p><b>Worldchampion</b></p>

									
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
									<p><b>Second Place</b></p>								
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
									<p><b>Topscorer</b> </p>
									<?php
									 $query = "SELECT player_name FROM bc18_players";
									 $results = mysqli_query($db, $query);
                                     //$i = 1;
                                     //$data = mysqli_fetch_array($results); ?>
									<select class="form-control show-tick" name='topschutter' data-live-search="true">
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
									<p><b>Dirtiest Team</b></p>								
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
									<p><b>Position Belgium</b></p>								
                                    <select name="posBelgie" class="selectpicker">
                                        <option>Groupstage</option>
                                        <option>Round of 16</option>
                                        <option>Round of 8</option>
										<option>Quarter Finals</option>
                                        <option>Final</option>                                      
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
	   
    </section>

        <!-- Validation Plugin Js -->
    <script src="../plugins/jquery-validation/jquery.validate.js"></script>

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