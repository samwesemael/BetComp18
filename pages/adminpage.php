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
		
	if(isset($_POST['update_teams'])){
		$api = new FootballData();
		$soccerseason = $api->getSoccerseasonById(467);
		$WC_teams = 'http://api.football-data.org/v1/competitions/467/teams';
		$reqPrefs['http']['method'] = 'GET';
		$reqPrefs['http']['header'] = 'X-Auth-Token: 46e58e3c48a747e09ccf6c9ac073c4d6';
		$stream_context = stream_context_create($reqPrefs);
		$response_wc_teams = file_get_contents($WC_teams, false, $stream_context);
		$response_wc_teams = json_decode($response_wc_teams);
		
		foreach ($response_wc_teams->teams as $team){
			 $teamname = $team->name;		
			 $redcards = 1;
			 $yellowcards = 2;	
			 //echo $teamname;
			 $query = "UPDATE bc18_teams SET yellow_cards = '$yellowcards', red_cards = '$redcards' WHERE team_name = '$teamname'";
			 mysqli_query($db, $query);
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
			 // TODO DATUM BEVAT ZOWEL D/M/Y als Uur, maar uur wordt niet naar DB geschreven 
			 $hometeam = $fixture->homeTeamName;
			 $awayteam = $fixture->awayTeamName;
			 $goalshome = $fixture->result->goalsHomeTeam;
			 $goalsaway = $fixture->result->goalsAwayTeam;
			 
			 //echo $teamname;
			 $query = "UPDATE bc18_games SET goals_home = '$goalshome', goals_away = '$goalsaway' WHERE team_home = '$hometeam' AND team_away = '$awayteam'";
			 mysqli_query($db, $query);
			}
		}
		
		
		
		 ?>
    
    
                <!-- Basic Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h4>
                                ADMIN PAGE
                            </h4>                      
                        </div>
                        <div class="body table-responsive">
                            My Role: <b><?php echo $_SESSION['role']; ?></b> <br> <br>
							<form method="post" action="adminpage.php">
							<button type="submit" class="btn bg-orange waves-effect" name="update_teams">
                                    <i class="material-icons">save</i>
                                    <span>UPDATE TEAMS</span>
							</button>
							<br>
							<br>
							<button type="submit" class="btn bg-cyan waves-effect" name="update_fixtures">
                                    <i class="material-icons">save</i>
                                    <span>UPDATE FIXTURES</span>
							</button>
							</form>
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