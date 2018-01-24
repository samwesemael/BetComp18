<?php include 'navigator.php';
        include 'server.php'; 
        $status = '';?>
<!DOCTYPE html>
<html>
<!-- navigator inladen en juist actief zetten -->


<script type="text/javascript">
    document.getElementById("nav-gokken").classList.toggle('active');
    document.getElementById("nav-matchen-indienen").classList.toggle('active');
</script>

<?php
    if(isset($_POST['bet-btn'])){
        $matchid = mysqli_real_escape_string($db, $_POST['match']);
        $score = mysqli_real_escape_string($db, $_POST['score']);
        $tempscore = explode('-', $score);
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

                $indienquery = "INSERT INTO bc18_bets (bc18_userid, bc18_gameid, bc18_pred_goalshome, bc18_pred_goalsaway, created) VALUES('$mail', (SELECT game_id FROM bc18_games WHERE team_home ='$hometeam' AND team_away = '$awayteam'), '$tempscore[0]', '$tempscore[1]', '".date("Y-m-d H:i:s")."') ON DUPLICATE KEY UPDATE bc18_pred_goalshome='$tempscore[0]', bc18_pred_goalsaway='$tempscore[1]', created = '".date("Y-m-d H:i:s")."'";
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
                            <h4>MATCHEN INDIENEN</h4>
                        </div>
                        <div class="body">						
                            <form id="form_validation" method="POST" action="matchen_indienen.php">								
								<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12"> 
									<p> <b>Naam</b></p>
										<div class="form-group form-float">
											<div class="form-line">
												<input type="text" class="form-control" name="username" value="<?php echo $_SESSION['firstname'];?>" disabled>
											</div>
										</div>
								</div>		
																													
                                <div class="col-md-3"> 
									<p><b>Speeldag</b></p>								
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
															<p><b>Extra</b>  <small>(vanaf knockout)</small> </p>
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
                                <strong>Gelukt!</strong> Je bet is goed ontvangen.
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
	
                            ?>				
                                 <button type="submit" name='bet-btn' class="btn bg-blue waves-effect">
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

    <script src="../js/pages/examples/sign-up.js"></script>
</body>

</html>