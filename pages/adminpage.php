<!DOCTYPE html>
<html>
<?php 
  session_start(); 
  ?>
<?php if($_SESSION['role'] == 'speler'){
           header('Location: index.php'); 
    }
    else{
        include('navigator.php');
		include 'FootballData.php';
		
    }
?>


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
		
		foreach ($response_wc_teams->teams as $team){
			 $teamname = $team->name;		
			 //echo $teamname;
			 $query = "UPDATE bc18_teams (team_name) VALUES ('$teamname')";
			 mysqli_query($db, $query);
			}
		}
		
		if(isset($_POST['set_verification'])){
			$selectedusers = mysqli_real_escape_string($db, $_POST['users']);
			$sqlusers = "SELECT bc18_users FROM bc18_users";
			$results = mysqli_query($db, $sqlusers);
			if (!$results) {
				printf("Error: %s\n", mysqli_error($conn));
				exit();
			}
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
		
		foreach ($response_wc_fixtures->fixtures as $fixture) {
			 $datum = $fixture->date;
			 //echo $datum;
			 // TODO DATUM BEVAT tijd in UTC --> eerst omzetten naar onze tijdzone
			 $hometeam = $fixture->homeTeamName;
			 $awayteam = $fixture->awayTeamName;
			 $goalshome = $fixture->result->goalsHomeTeam;
			 $goalsaway = $fixture->result->goalsAwayTeam;
			 
			 //echo $teamname;
			 // query met datum
			 // $query = "UPDATE bc18_games SET goals_home = '$goalshome', goals_away = '$goalsaway',  datum = '$datum' WHERE team_home = '$hometeam' AND team_away = '$awayteam'";

			 // query zonder datum
			 $query = "UPDATE bc18_games SET goals_home = '$goalshome', goals_away = '$goalsaway' WHERE team_home = '$hometeam' AND team_away = '$awayteam'";
			 mysqli_query($db, $query);
			}
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
                            My Role: <b><?php echo $_SESSION['role']; ?></b> </center> <br> <br>
							
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

						<tr>							
						<td><div class="row clearfix"> 
							<select class="form-control show-tick" id="users" multiple>
							<?php
								$verquery = "SELECT email FROM bc18_users WHERE verification = '0'"; 
								$results = mysqli_query($db, $verquery);
								if (!$results) {
									printf("Error: %s\n", mysqli_error($conn));
									exit();
								}                                                
								while($data = mysqli_fetch_array($results)){
									echo '<option>'.$data['email'].'</option>';
								}										
							?>
                                    </select> <form method="post" action="adminpage.php">
							<button type="submit" class="btn bg-green waves-effect" name="set_verification">
                                    <i class="material-icons">save</i>
                                    <span>SET VERIFICATION</span>
							</button>
							</form>  </div></td>
							 </td>
							<td> 							Set verification of user </td>
							<td> / </td>
							</tr>	
						
						<td>							
							<form method="post" action="adminpage.php">
							<button type="submit" class="btn bg-orange waves-effect" name="update_teams">
                                    <i class="material-icons">save</i>
                                    <span>UPDATE TEAMS</span>
							</button>
							</form> </td>
							<td> Get new teamdata from API  </td> 
							<td> / </td> </tr>
							
							<tr>							
						<td>
							<form method="post" action="adminpage.php">
							<button type="submit" class="btn bg-cyan waves-effect" name="update_fixtures">
                                    <i class="material-icons">save</i>
                                    <span>UPDATE FIXTURES</span>
							</button> 
							</form> </td>
							<td> 							Get new matchdata from API (results) </td>
							<td> / </td>
							</tr>
											
							
							
							
							</tbody
							
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