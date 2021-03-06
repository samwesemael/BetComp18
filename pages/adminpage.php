<?php 
  session_start(); 
 if($_SESSION['role'] == 'speler'){
           header('Location: index.php'); 
    }
    else{
        include 'navigator.php';
		include 'FootballData.php';
		//include 'index.php';	
		
    }
?>

<!DOCTYPE html>
<html>
<script type="text/javascript">
    document.getElementById("nav-adminpage").classList.toggle('active');
</script>

    <section class="content">
	
	<?php	

    include 'server.php';	
	
	if(isset($_POST['update_teams'])){
		$api = new FootballData();
		$soccerseason = $api->getSoccerseasonById(467);
		$WC_teams = 'http://api.football-data.org/v1/competitions/467/teams';
		$WC_fixtures = 'http://api.football-data.org/v1/competitions/467/fixtures';
		$reqPrefs['http']['method'] = 'GET';
		$reqPrefs['http']['header'] = 'X-Auth-Token: 46e58e3c48a747e09ccf6c9ac073c4d6';
		$stream_context = stream_context_create($reqPrefs);
		$response_wc_teams = file_get_contents($WC_teams, false, $stream_context);
		$response_wc_teams = json_decode($response_wc_teams);
		$response_wc_fixtures = file_get_contents($WC_fixtures, false, $stream_context);
		$response_wc_fixtures = json_decode($response_wc_fixtures);
		
		$stmt = $db->prepare("UPDATE bc18_teams (team_name) VALUES (?)");
		foreach ($response_wc_teams->teams as $team){
			$teamname = $team->name;		
			//echo $teamname;
			// $query = "UPDATE bc18_teams (team_name) VALUES ('$teamname')";
			// mysqli_query($db, $query);
      		$stmt->bind_param('s', $teamname);
      		$stmt->execute();
      		// $stmt->bind_result($userName, $firstName, $lastName, $mail, $role, $picture);
      	}
    	$stmt->close();
  //   	$dateNu = date_format(new DateTime(),'Y-m-d H:i:s');
		// mysqli_query($db, "UPDATE bc18_overig SET last_run = '$dateNu' WHERE name='verification'");
     }

    
	if(isset($_POST['set_verification'])){
		$array = join("','",$_POST['users']);
		$sqlusers = "UPDATE `bc18_users` SET `verification`= '1' WHERE email IN ('$array')";
		mysqli_query($db, $sqlusers);
		// $dateNu = date_format(new DateTime(),'Y-m-d H:i:s');
		$query = "UPDATE bc18_overig SET last_run = NOW() WHERE name='verification'";
		mysqli_query($db, $query);


	}			/*	if(isset($_POST['set_games'])){		$array = join("','",$_POST['games']);		$sqlgames = "UPDATE `bc18_games` SET `status`= 'FINISHED' WHERE datum IN ('$array')";		mysqli_query($db, $sqlusers);		// $dateNu = date_format(new DateTime(),'Y-m-d H:i:s');		$query = "UPDATE bc18_overig SET last_run = NOW() WHERE name='games'";		mysqli_query($db, $query);	}*/	
	if(isset($_POST['set_announcement'])){
		$bericht = $_POST['mededeling'];
		
		$messagequery = "UPDATE bc18_overig SET message = '$bericht' WHERE name='homeMededeling'";
		mysqli_query($db, $messagequery);                                            			
	}	

	if(isset($_POST['update_fixtures'])){
	$api = new FootballData();
	$soccerseason = $api->getSoccerseasonById(467);
	$WC_fixtures = 'http://api.football-data.org/v1/competitions/467/fixtures';
	$reqPrefs['http']['method'] = 'GET';
	$reqPrefs['http']['header'] = 'X-Auth-Token: 46e58e3c48a747e09ccf6c9ac073c4d6';
	$stream_context = stream_context_create($reqPrefs);
	$response_wc_fixtures = file_get_contents($WC_fixtures, false, $stream_context);
	$response_wc_fixtures = json_decode($response_wc_fixtures);
	
	$stmt = $db->prepare("UPDATE bc18_games SET datum = ?, matchday = ?, goals_home = ?, goals_away = ?, status = ? WHERE href = ?");

	foreach ($response_wc_fixtures->fixtures as $fixture) {
		 $datum = $fixture->date;
		 // echo $datum;
		 $href = $fixture->_links->self->href;
		 $hometeam = $fixture->homeTeamName;
		 $awayteam = $fixture->awayTeamName;
		 $goalshome = $fixture->result->goalsHomeTeam;
		 $goalsaway = $fixture->result->goalsAwayTeam;
		 $status = $fixture->status;
		 $matchday = $fixture->matchday;
		 // if ($status != "FINISHED"){
		 // 	$goalshome = 99;
		 // 	$goalsaway = 99;
		 // }
		 //echo $teamname;
		 // query met datum
		 // $query = "UPDATE bc18_games SET goals_home = '$goalshome', goals_away = '$goalsaway',  datum = '$datum' WHERE team_home = '$hometeam' AND team_away = '$awayteam'";

		 // query zonder datum
	 	// misschien nog aanpassen naar ssss indien van API string ontvangen wordt voor goal
  		
  		$stmt->bind_param('siiiss', $datum, $matchday, $goalshome, $goalsaway, $status, $href);
  		$stmt->execute();
  		
		//$query = "UPDATE bc18_games SET goals_home = '$goalshome', goals_away = '$goalsaway' WHERE team_home = '$hometeam' AND team_away = '$awayteam'";
		//mysqli_query($db, $query);
		}
	$stmt->close();
	// $dateNu = date_format(new DateTime(),'Y-m-d H:i:s');
	// mysqli_query($db, "UPDATE bc18_overig SET last_run = '$dateNu' WHERE name='update_fixture'");
	}
		
	if(isset($_POST['update_players'])){
		
		$cl_teams = 'http://api.football-data.org/v1/competitions/467/teams';
		$reqPrefs['http']['method'] = 'GET';
		$reqPrefs['http']['header'] = 'X-Auth-Token: 46e58e3c48a747e09ccf6c9ac073c4d6';
		$stream_context = stream_context_create($reqPrefs);
		$response_cl_teams = file_get_contents($cl_teams, false, $stream_context);
		$response_cl_teams = json_decode($response_cl_teams);	
	
		foreach ($response_cl_teams->teams as $team) {	
			$teamname = $team->name;		
			foreach($team->_links->players as $team_playerlink){ 
			
				$reqPrefs['http']['method'] = 'GET';
				$reqPrefs['http']['header'] = 'X-Auth-Token: 46e58e3c48a747e09ccf6c9ac073c4d6';
				$stream_context = stream_context_create($reqPrefs);
				$response_cl_players = file_get_contents($team_playerlink, false, $stream_context);
				$response_cl_players = json_decode($response_cl_players);			
			
				foreach($response_cl_players->players as $player){
					// echo $player->name.' '.$teamname.'<br>';
					$playername = $player->name;
					$sqlqry = "INSERT INTO bc18_players (player_name) VALUES ('$player->name')";
					// $sqlqry = "UPDATE `bc18_players` SET `squad`= '$teamname' WHERE `player_name` = '$playername'";
					mysqli_query($db, $sqlqry);
					//echo $player->name; 
		}   }   }
		
	}

	if(isset($_POST['update_ranking'])){
		
		$query = "UPDATE bc18_overig SET last_run = NOW() WHERE name='klassement'";
		mysqli_query($db, $query);                                          			
	}	
	
	// tospcorer
	
	if(isset($_POST['set_topscorer'])){		
		$goals = $_POST['number_goals'];
		$player_name = $_POST['player_name'];		
		$sqltopscorer = "UPDATE bc18_players SET goals = $goals WHERE player_name = '$player_name'";
		mysqli_query($db, $sqltopscorer);
		// $dateNu = date_format(new DateTime(),'Y-m-d H:i:s');
		//$query = "UPDATE bc18_overig SET last_run = NOW() WHERE name='verification'";
		//mysqli_query($db, $query);
	}		

	// dirtiest team
	
	if(isset($_POST['set_dirtiestteam'])){		
	
		$yc = $_POST['yellow_cards'];
		$rc = $_POST['red_cards'];
		$t = $_POST['team_name'];
		$sqldirtyteam = "UPDATE bc18_teams SET yellow_cards = $yc, red_cards = $rc WHERE team_name = '$t'";
		mysqli_query($db, $sqldirtyteam);
		// $dateNu = date_format(new DateTime(),'Y-m-d H:i:s');
		//$query = "UPDATE bc18_overig SET last_run = NOW() WHERE name='verification'";
		//mysqli_query($db, $query);
	}		

	?>
     
    <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h4>
                            ADMIN PAGE
                        </h4>                      
                    </div>
                    <div class="body table-responsive">
					<center>
                        My Role: <b><font color="blue"><?php echo $_SESSION['role']; ?></font></b> </center> <br> 
						
					<h4 class="card-inside-title"><small>CHANGE ANNOUNCEMENTS</small></h4>
                        <div class="row clearfix">
                            <div class="col-sm-9">
							<form id = "mede" method="post" action="adminpage.php">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="mededeling">Vul tekst in dat op homepage moet komen (GEEN MEDEDELING --> hide field)</label>
                                        <textarea  rows="1" class="form-control no-resize" name='mededeling' placeholder="Please type what you want..."></textarea>
                                    </div>
                                </div>      
								</div>
						<button type="submit" class="btn bg-grey waves-effect" name="set_announcement">
                                <i class="material-icons">save</i>
                                <span>UPDATE</span>
						</button>
						</form>	
					</div>	
									
						
					<div style="overflow-x:auto;">	
					<table class="table">
					<thead>
					<tr>

					<th> ACTION </th>
					<th> DETAILS </th>
					
					</tr>
					</thead>
					<tbody>
					<tr>	

					<tr>							
					<td><div class="row clearfix"> 
						<form method="post" action="adminpage.php">
						<div class="col-md-9"> 
							<select class="form-control show-tick" id="users" name='users[]' multiple>
								<?php
									$verquery = "SELECT email FROM bc18_users WHERE verification = '0'"; 
									$results = mysqli_query($db, $verquery);
								// if (!$results) {
								// 	printf("Error: %s\n", mysqli_error($conn));
								// 	exit();
								// }                                                
									while($data = mysqli_fetch_array($results)){
										echo '<option>'.$data['email'].'</option>';
									}										
								?>
                            </select>
							</div>
							<button type="submit" class="btn bg-green waves-effect" name="set_verification">
                            <span>VERIFICATION</span>
							</button>
						</form>  </div></td>
						 </td>
						<td> 	Set verification of user </td>
						<td> <?php
									$verquery = "SELECT last_run FROM bc18_overig WHERE name = 'verification'"; 
									$results = mysqli_query($db, $verquery);
									$data = mysqli_fetch_array($results);
									echo $data['last_run'];
									?> </td>
						</tr>		

						<tr>							
					<td>
						<form method="post" action="calculate.php">
						<button type="submit" class="btn bg-purple waves-effect" name="update_ranking">
                             <span>TABLE</span>
						</button> 
						</form> </td>
						<td> Calculate new table </td>
						<td> <?php
									$verquery = "SELECT last_run FROM bc18_overig WHERE name = 'klassement'"; 
									$results = mysqli_query($db, $verquery);
									$data = mysqli_fetch_array($results);
									echo $data['last_run'];
									?> </td>
									</tr>	
						

						
						
						</tbody>		
						</table>
						
						<center><h4><u> BONUSSES </u></h4></center>
						
						<table class="table">
					<thead>
					<tr>

					<th> ACTION </th>
					<th> DETAILS </th>
					<th> LAST EXECUTION </th>
					</tr>
					</thead>

						<tbody>
					
						<tr>							
					<td><div class="row clearfix"> 
						<form method="post" action="adminpage.php">
							<?php
									 $query = "SELECT player_name FROM bc18_players";
									 $results = mysqli_query($db, $query);
                                     //$i = 1;
                                     //$data = mysqli_fetch_array($results); ?>
									 <div class="col-md-4"> 
									<select class="form-control show-tick" name='player_name' data-live-search="true">
									  <?php
										while($data = mysqli_fetch_array($results)){
											echo '<option>'.$data['player_name'].'</option>';
										} ?>
									</select>
									</div>
									<div class="col-md-4"> 
									<select name = "number_goals" class="selectpicker">
										<option>0</option>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                        <option>6</option>
                                        <option>7</option>                                                                      
                                    </select>
									</div> 
							<button type="submit" class="btn bg-green waves-effect" name="set_topscorer">
                            <span>TOPSCORER</span>
							</button>
						</form>  </div></td>
						 </td>
						<td> 	Set topscorers </td>
						<td> <?php
									//$verquery = "SELECT last_run FROM bc18_overig WHERE name = 'verification'"; 
									//$results = mysqli_query($db, $verquery);
									//$data = mysqli_fetch_array($results);
									//echo $data['last_run'];
									?> </td>
						</tr>		
						
						
						<tr>							
					<td><div class="row clearfix"> 
						<form method="post" action="adminpage.php">
							
									 <div class="col-md-3"> 
									 <?php
									 $query = "SELECT team_name FROM bc18_teams";
									 $results = mysqli_query($db, $query);
                                     //$i = 1;
                                     //$data = mysqli_fetch_array($results); ?>
									<select class="form-control show-tick" name='team_name' data-live-search="true">
									  <?php
										while($data = mysqli_fetch_array($results)){
											echo '<option>'.$data['team_name'].'</option>';
										} ?>
									</select>
									
									</div>
									<div class="col-md-3"> 
									<select name = "yellow_cards" class="selectpicker">
										<option>0</option>
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
                                    </select>
									</div> 
									<div class="col-md-3"> 
									<select name = "red_cards" class="selectpicker">
									    <option>0</option>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option> 								
                                    </select>
									</div> 
							<button type="submit" class="btn bg-green waves-effect" name="set_dirtiestteam">
                            <span>DIRTY TEAM</span>
							</button> </div>
						</form>  </div></td>
						 </td>
						<td> 	Set Team - Yellow - Red  </td>
						<td> <?php
									//$verquery = "SELECT last_run FROM bc18_overig WHERE name = 'verification'"; 
									//$results = mysqli_query($db, $verquery);
									//$data = mysqli_fetch_array($results);
									//echo $data['last_run'];
									?> </td>
						</tr>	

						<tr>
						<td>
						<form method="post" action="bonusscraper.php">
						<button type="submit" class="btn bg-green waves-effect" name="wikiscrape">
                                <span>WIKI</span>
						</button> 
						</form> </td>
						<td> 	Get topscorers from: https://en.wikipedia.org/wiki/2018_FIFA_World_Cup_statistics  </td>
						</tr>
					
					</tbody>		
						</table>
						
						
						
						
						<center><h4><u> API </u></h4></center>
						
						<table class="table">
					<thead>
					<tr>

					<th> ACTION </th>
					<th> DETAILS </th>
					<th> LAST EXECUTION </th>
					</tr>
					</thead>

						<tbody>
					
					
					<td>							
						<form method="post" action="adminpage.php">
						<button type="submit" class="btn bg-orange waves-effect" name="update_teams">
                              <span>TEAMS</span>
						</button>
						</form> </td>
						<td> Get new teamdata from API  </td> 
						<td> <?php
									$verquery = "SELECT last_run FROM bc18_overig WHERE name = 'update_team'"; 
									$results = mysqli_query($db, $verquery);
									$data = mysqli_fetch_array($results);
									echo $data['last_run'];
									?> </td> </tr>
						
						<tr>							
					<td>
						<form method="post" action="adminpage.php">
						<button type="submit" class="btn bg-cyan waves-effect" name="update_fixtures">
                                <span>FIXTURES</span>
						</button> 
						</form> </td>
						<td> Get new matchdata from API (results) </td>
						<td> <?php
									$verquery = "SELECT last_run FROM bc18_overig WHERE name = 'update_fixture'"; 
									$results = mysqli_query($db, $verquery);
									$data = mysqli_fetch_array($results);
									echo $data['last_run'];
									?> </td>
						</tr>
										
						<tr>							
					<td>
						<form method="post" action="adminpage.php">
						<button type="submit" class="btn bg-purple waves-effect" name="update_players">
                                <span>PLAYERS</span>
						</button> 
						</form> </td>
						<td> Get new playerdata from API </td>
						<td> <?php
									$verquery = "SELECT last_run FROM bc18_overig WHERE name = 'update_fixture'"; 
									$results = mysqli_query($db, $verquery);
									$data = mysqli_fetch_array($results);
									echo $data['last_run'];
									?> </td>
						</tr>					
						
						
						</tbody>		
						</table>
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