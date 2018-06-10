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
<!-- Jquery Core Js -->
<script src="../plugins/jquery/jquery.min.js"></script>


<?php
    if(isset($_POST['bet-btn'])){
        $matchid = mysqli_real_escape_string($db, $_POST['match']);
        $score = mysqli_real_escape_string($db, $_POST['score']);
        $survivor = mysqli_real_escape_string($db, $_POST['survivor']);
        $tempscore = explode('-', $score);
        if($tempscore[0] == '' || $tempscore[1] == ''){
            $status = 'invalid';
        }
        if($status != 'invalid'){
            $tempmatchid = explode('-', $matchid);
            $hometeam = trim($tempmatchid[0]);
            $awayteam = trim($tempmatchid[1]);
            $mail = $_SESSION['email'];
            $tstquery = "SELECT datum, status, game_id FROM bc18_games WHERE team_home ='$hometeam' AND team_away = '$awayteam'";
            $res = mysqli_query($db, $tstquery);
            while ($data = mysqli_fetch_array($res)) {
                $gameid = $data['game_id'];
                $dtnow = new DateTime();
                $dtnow->setTimezone(new DateTimeZone('UTC'));
                $dtdatabase = new DateTime($data['datum']);
                // echo '$dtdatabase: '.$dtdatabase->format('Y-m-d H:i:s').'<br>';
                $datastatus = $data['status'];
                // echo $dtnow->format('Y-m-d H:i:s');
                // echo $dtdatabase->format('Y-m-d H:i:s');
                if($dtnow > $dtdatabase || $datastatus == 'FINISHED' || $datastatus == 'IN_PLAY'){
                    // match is al begonnen
                    $status = 'error_status';
                }
                else{
                    $verschil = $dtdatabase->getTimestamp()-$dtnow->getTimestamp();
                    if($verschil<=60){
                        //laatste minuut nog bet geplaatst
                        if(!achievedAchievement($db, 11, $mail)){
                            addAchievement($db, 11, $mail);
                        }
                    }
                    if($verschil>=604800){
                        if(!achievedAchievement($db, 12, $mail)){
                            addAchievement($db, 12, $mail);
                        }
                    }

                    $status = 'succes_status';
                    // match moet nog beginnen
                    if(!achievedAchievement($db, 13, $mail)){
                        $checkquery = "SELECT * FROM bc18_bets WHERE bc18_gameid = '$gameid' AND bc18_userid = '$mail'";
                        $results = mysqli_query($db, $checkquery);
                        $aantal = mysqli_num_rows($results);
                        if($aantal >= 1){
                            addAchievement($db, 13, $mail);
                        }
                    }
                    $indienquery = "INSERT INTO bc18_bets (bc18_userid, bc18_gameid, bc18_pred_goalshome, bc18_pred_goalsaway, bc18_survivor, created) VALUES('$mail', (SELECT game_id FROM bc18_games WHERE team_home ='$hometeam' AND team_away = '$awayteam'), '$tempscore[0]', '$tempscore[1]', '$survivor', NOW()) ON DUPLICATE KEY UPDATE bc18_pred_goalshome='$tempscore[0]', bc18_pred_goalsaway='$tempscore[1]', bc18_survivor = '$survivor', created = NOW()";
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
                if(!achievedAchievement($db, 2, $mail))
                    addAchievement($db, 2, $mail);
            }
            elseif($aantal == 15){
                //eerste 5 bets
                if(!achievedAchievement($db, 3, $mail))
                    addAchievement($db, 3, $mail);            
            }
        }
    }
	
	if(isset($_POST['indienen'])){
        $valquery = "SELECT status, datum FROM `bc18_games` WHERE team_home = 'Russia' AND team_away = 'Saudi Arabia'";
        $val = mysqli_query($db, $valquery);
        $indienenToegestaan = true;
        while ($valdata = mysqli_fetch_array($val)) {
            $dtnow = new DateTime();
            $dtnow->setTimezone(new DateTimeZone('UTC'));
            // echo 'now: '.$dtnow->format('Y-m-d H:i:s');
            $dtdatabase = new DateTime($valdata['datum']);
            $dtdatabase->setTimezone(new DateTimeZone('UTC'));
                        // echo 'db: '.$dtdatabase->format('Y-m-d H:i:s');
            $datastatus = $data['status'];
            if($dtnow > $dtdatabase || $datastatus == 'FINISHED' || $datastatus == 'IN_PLAY'){
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
            
                    $status = 'succes_status-bonus';
                    // match moet nog beginnen 
                    $indienquery = "INSERT INTO bc18_predictedbonusses(user_id, world_champion, finalist, topscorer, dirty_team, pos_belgium, submitted_data) VALUES ('$mail','$kampioen','$verliezer','$topscorer','$vuilste','$posBelgie',NOW()) ON DUPLICATE KEY UPDATE world_champion = '$kampioen', finalist='$verliezer', topscorer='$topscorer', dirty_team='$vuilste', pos_belgium='$posBelgie', submitted_data=NOW()";
                    mysqli_query($db, $indienquery);
            if (mysqli_affected_rows($db)==0){
                if($status != 'error_status-bonus'){
                    $status = 'overall_error-bonus';
                }
            }
        }
        else{
            $status = 'error_status-bonus';
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
                        <div class = "col-lg-12 col-md-12 col-sm-12 col-xs-12">						
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
                                    $date = new DateTime();
                                    $date->setTimezone(new DateTimeZone('UTC'));
                                    $dateNu = $date->format('Y-m-d H:i:sP');


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

                            <script>
                                $(document).ready(function(){
                                    var groepsfase = ["Russia - Saudi Arabia", "Portugal - Spain", "Argentina - Iceland", "Brazil - Switzerland", "Belgium - Panama", "Colombia - Japan", "Uruguay - Saudi Arabia", "Argentina - Croatia", "Brazil - Costa Rica", "Belgium - Tunisia", "Poland - Colombia", "Spain - Morocco", "Denmark - France", "Korea Republic - Germany", "England - Belgium"];
                                    $('#match').on('change', function(){
                                        var selectedMatch = $("#match").val();
                                        if(groepsfase.indexOf(selectedMatch)!=-1){
                                            var x = document.getElementById("knockoutfase");
                                            x.style.display = "none";
                                        }
                                        else{                                               
                                            var x = document.getElementById("knockoutfase");
                                            x.style.display = "block";
                                        }
                                    });
                                    var selectedMatch = $("#match").val();
                                    if(groepsfase.indexOf(selectedMatch)!=-1){
                                        var x = document.getElementById("knockoutfase");
                                        x.style.display = "none";
                                    }
                                    else{                                               
                                        var x = document.getElementById("knockoutfase");
                                        x.style.display = "block";
                                    }

                                });

                            </script> 
				
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <p><b>Score</b></p>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" id="score" name="score" required>
                                        <label class="form-label">0-0</label>
                                    </div>
                                </div>   
    						</div>	
				
    						<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" id='knockoutfase' name='knockoutfase' style="display:none;">	
    															<p><b>Extra when draw</b>  <small>(from knockout)</small> </p>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <select name="survivor" id="survivor" class="show-tick">
                                            <option>Home</option>
                                            <option>Away</option>
                                        </select>
                                    </div>
                                </div>   
    						</div>
                        </div>	

                        <?php

                        if ($status == 'succes_status'){
                            echo '<div id='.'succes'.' class="alert alert-success col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                            <strong>Done!</strong> Your bet ('. $tempscore[0] . '-'. $tempscore[1] .') is well received.
                            </div>';
                        }
                        if($status == 'error_status'){
                        echo '<div id='.'error'.' class="alert alert-danger col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <strong>ERROR!</strong> Not allowed to bet on this game anymore.
                            </div>';  
                        }
                        if($status == 'overal_status'){
                        echo '<div id='.'error'.' class="alert alert-danger col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <strong>ERROR!</strong> Something went wrong. Please try again later and notify the system administrators.
                            </div>';  
                        }
                        if($status == 'invalid'){
                        echo '<div id='.'error'.' class="alert alert-danger col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <strong>ERROR!</strong> Use the right format (ex. 0-0)
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
                                    <select name="wereldkampioen" class="selectpicker" data-live-search="true">
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
                                        <option data-thumbnail="../images/flags/hi_res/flag_mor.png">Morocco</option>
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
                                        <option data-thumbnail="../images/flags/hi_res/flag_tun.png">Tunisia</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_uru.png">Uruguay</option>
                                    </select>					
                                </div>  
    				            <div class="col-md-4"> 
    								<p><b>Second Place</b></p>								
                                    <select name = "finalist" class="selectpicker" data-live-search="true">
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
                                        <option data-thumbnail="../images/flags/hi_res/flag_mor.png">Morocco</option>
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
                                        <option data-thumbnail="../images/flags/hi_res/flag_tun.png">Tunisia</option>
                                        <option data-thumbnail="../images/flags/hi_res/flag_uru.png">Uruguay</option>
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
                                        <option data-thumbnail="../images/flags/hi_res/flag_tun.png">Tunisia</option>
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
                                        <option>Semi Finals</option>
                                        <option>Final</option>                                      
                                    </select>					
                                </div>  	
                            </div>								
          
    						<?php

                            if ($status == 'succes_status-bonus'){
                                echo '<div id='.'succes'.' class="alert alert-success " >
                                <strong>Done!</strong> Bonussen received. 
                                </div>';
                            }
                            if($status == 'error_status-bonus'){
                            echo '<div id='.'error'.' class="alert alert-danger">
                                <strong>ERROR!</strong> WC is started. Not allowed to bet on the bonuses anymore.
                                </div>';  
                            }
                            if($status == 'overal_status-bonus'){
                            echo '<div id='.'error'.' class="alert alert-danger">
                                <strong>ERROR!</strong> Something went wrong. Please try again later and notify the system administrators.
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

                <?php 
                $matchenPerDag = array(1, 3, 4, 3, 3, 3, 3, 3, 3, 3, 3, 4, 4, 4, 4, 2, 2, 2, 2, 2, 2, 1, 1, 1, 1);
                $speeldagen = array("2018-06-14", "2018-06-15", "2018-06-16", "2018-06-17", "2018-06-18", "2018-06-19", "2018-06-20", "2018-06-21", "2018-06-22", "2018-06-23", "2018-06-24", "2018-06-25", "2018-06-26", "2018-06-27", "2018-06-28", "2018-06-30", "2018-07-01", "2018-07-02", "2018-07-03", "2018-07-06", "2018-07-07", "2018-07-10", "2018-07-11", "2018-07-14", "2018-07-15");
                $speeldagnummers = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25);
                $eerste = true; 
    ?>
                <div class="card">
                    <div class="header">
                        <h4>MY MATCHES</h4>
                    </div>
                    <div class="body">          
                        <div class="body table-responsive">
                            <table class="table table-bordered ">
                                <thead>    
                                    <tr>                                
                                        <th>Name</th>
                                        <?php 
                                        foreach ($speeldagnummers as $nr){
                                        ?>
                                            <th>
                                            <?php echo $nr; ?>
                                            </th>  
                                        <?php
                                        }
                                        ?>
                                    </tr>
                                </thead>
                                <tbody>
                                            <?php
                                            
                                                // link gameid met speeldagnummer --> dynamisch behalve die 25

                                                // lijst met alle matchIDs waarop gewed kan worden
                                                $matchIDs = array();
                                                $sqlmatches = "SELECT game_id FROM bc18_games WHERE bettable = 1 ORDER BY datum LIMIT 0,25" ;
                                                $resultsgameids = mysqli_query($db,$sqlmatches);
                                                while($ids = mysqli_fetch_array($resultsgameids)){
                                                    array_push($matchIDs, $ids['game_id']);
                                                }   
                                                $mail = $_SESSION['email'];                                    
                                                $sqlusers = "SELECT bc18_users.user_name FROM bc18_users WHERE verification = 1 AND bc18_users.email = '$mail' ORDER BY user_name";                    
                                                $resultsusers = mysqli_query($db, $sqlusers);                                                
                                                while ($users = mysqli_fetch_array($resultsusers)){
                                                    $user = $users['user_name'];
                                            ?>
                                                <tr>                                   
                                                    <td><?php echo $user; ?></td>
                                                    <?php
                                                    $sqlbets = "SELECT bc18_games.status AS status, bc18_bets.bc18_userid AS userID, bc18_users.user_name AS Username, bc18_users.email AS email, bc18_pred_goalshome AS goalshome, bc18_pred_goalsaway AS goalsaway, bc18_gameid AS gameid, bc18_games.goals_home AS correctHome, bc18_games.goals_away AS correctAway FROM bc18_bets INNER JOIN bc18_users on bc18_bets.bc18_userid = bc18_users.email INNER JOIN bc18_games on bc18_bets.bc18_gameid = bc18_games.game_id WHERE bc18_users.user_name = '$user' ORDER BY bc18_users.user_name, bc18_games.datum ";
                                                        $resultsbets = mysqli_query($db,$sqlbets);
                                                        $teller = 0;
                                                        while($bets = mysqli_fetch_array($resultsbets)){
                                                            $res = "{$bets['goalshome']}-{$bets['goalsaway']}";
                                                            if($teller<=sizeof($matchIDs) && $bets['gameid'] != $matchIDs[$teller]  ){
                                                                ?>
                                                                <td></td>
                                                                <?php
                                                                $teller++;
                                                                while($teller<=sizeof($matchIDs) && $bets['gameid'] != $matchIDs[$teller]){
                                                                    ?>
                                                                    <td></td>
                                                                <?php
                                                                $teller++;
                                                                }
                                                                if($teller>sizeof($matchIDs)){
                                                                    ?>
                                                                        <td></td>
                                                                    <?php
                                                                }
                                                                else{
                                                                    if($bets['status']=='FINISHED'){
                                                                        $color = '#ffffff';

                                                                        if ($bets['correctHome'] == $bets['goalshome'] && $bets['correctAway'] == $bets['goalsaway']){
                                                                            $color = '#00ff00';
                                                                        }
                                                                        elseif ($bets['goalshome']>$bets['goalsaway']){
                                                                                // home wint
                                                                                if($bets['correctHome']>$bets['correctAway']){
                                                                                    // Juiste winnaar
                                                                                    $color = '#ff6600';
                                                                                }
                                                                            }
                                                                        elseif ($bets['goalshome']<$bets['goalsaway']) {
                                                                                // away wint
                                                                                if($bets['correctHome']<$bets['correctAway']){
                                                                                    // Juiste winnaar
                                                                                    $color = '#ff6600';
                                                                                }
                                                                            }
                                                                        elseif ($bets['goalshome']==$bets['goalsaway']) {
                                                                                // gelijkspel
                                                                                if($bets['correctHome']==$bets['correctAway']){
                                                                                    // Juiste gok gelijkspel (fout aantal goals)
                                                                                    $color = '#ff6600';
                                                                                }
                                                                            }
                                                                    ?>
                                                                        <td style="width:1px;white-space:nowrap;" bgcolor=<?php echo $color; ?>><?php echo $res; ?></td>
                                                                    <?php
                                                                    }
                                                                    else{
                                                                        $color = '#ffffff';
                                                                         ?>
                                                                        <td style="width:1px;white-space:nowrap;" bgcolor=<?php echo $color; ?>><?php echo $res; ?></td>
                                                                    <?php
                                                                    }
                                                                }
         
                                                            }
                                                            else{
                                                                if($teller<=sizeof($matchIDs)){
                                                                    if($bets['status']=='FINISHED'){
                                                                        $color = '#ffffff';
                                                                        if ($bets['correctHome'] == $bets['goalshome'] && $bets['correctAway'] == $bets['goalsaway']){
                                                                            $color = '#00ff00';
                                                                        }
                                                                        elseif ($bets['goalshome']>$bets['goalsaway']){
                                                                                // home wint
                                                                                if($bets['correctHome']>$bets['correctAway']){
                                                                                    // Juiste winnaar
                                                                                    $color = '#ff6600';
                                                                                }
                                                                            }
                                                                        elseif ($bets['goalshome']<$bets['goalsaway']) {
                                                                                // away wint
                                                                                if($bets['correctHome']<$bets['correctAway']){
                                                                                    // Juiste winnaar
                                                                                    $color = '#ff6600';
                                                                                }
                                                                            }
                                                                        elseif ($bets['goalshome']==$bets['goalsaway']) {
                                                                                // gelijkspel
                                                                                if($bets['correctHome']==$bets['correctAway']){
                                                                                    // Juiste gok gelijkspel (fout aantal goals)
                                                                                    $color = '#ff6600';
                                                                                }
                                                                            }
                                                                        ?>
                                                                            <td style="width:1px;white-space:nowrap;" bgcolor=<?php echo $color; ?>><?php echo $res; ?></td>
                                                                        <?php 
                                                                    }
                                                                    else{
                                                                        $color = '#ffffff';
                                                                         ?>
                                                                        <td style="width:1px;white-space:nowrap;" bgcolor=<?php echo $color; ?>><?php echo $res; ?></td>
                                                                    <?php
                                                                    }

                                                                }

                                                            }
                                                            $teller++;
                                                }
                                                ?> 

                                                </tr>
                                                <?php
                                               // }
                                                }
                                                ?> 

                                </tbody>
                            </table>
                        </div>            
                    </div>
                </div>
            </div>
        </div>	   
    </section>

    <!-- Validation Plugin Js -->
    <script src="../plugins/jquery-validation/jquery.validate.js"></script>

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