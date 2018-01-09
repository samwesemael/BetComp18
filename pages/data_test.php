<!DOCTYPE html>
<html>
<!-- navigator inladen en juist actief zetten -->
<?php include 'navigator.php';
include 'FootballData.php';?>
<script type="text/javascript">
    document.getElementById("nav-datatest").classList.toggle('active');
	document.getElementById("nav-extra").classList.toggle('active');
</script>

    <section class="content">
	 <div class="container-fluid">
			 <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">	
					<div class="header">
                            <h1>
                                Data Testing
                            </h1>
					</div>
					
					
	 <div class="body">
     
		        <div class="container">
               
                <?php
                // Create instance of API class
                $api = new FootballData();
                // fetch and dump summary data for premier league' season 2015/16
                $soccerseason = $api->getSoccerseasonById(467);
				
                echo "<p><hr><p>"; ?>
				
				<!--
				
                <h3>Fixtures for the 1st matchday of <?php echo $soccerseason->payload->caption; ?></h3>
                <table class="table table-striped">
                    <tr>
                    <th>HomeTeam</th>
                    <th></th>
                    <th>AwayTeam</th>
                    <th colspan="3">Result</th>
                    </tr>
                    <?php foreach ($soccerseason->getFixturesByMatchday(1) as $fixture) { ?>
                    <tr>
                        <td><?php echo $fixture->homeTeamName; ?></td>
                        <td>-</td>
                        <td><?php echo $fixture->awayTeamName; ?></td>
                        <td><?php echo $fixture->result->goalsHomeTeam; ?></td>
                        <td>:</td>
                        <td><?php echo $fixture->result->goalsAwayTeam; ?></td>
                    </tr>
                    <?php } ?>
                </table> 
				-->
		
			<!--	
            <?php
                echo "<p><hr><p>";
                // fetch all available upcoming fixtures for the next 2 days and display
                $now = new DateTime();
                $end = new DateTime(); $end->add(new DateInterval('P2D'));
                $response = $api->getFixturesForDateRange($now->format('Y-m-d'), $end->format('Y-m-d'));
            ?>
            <h3>Upcoming fixtures next 2 days</h3>
                <table class="table table-striped">
                    <tr>
                        <th>HomeTeam</th>
                        <th></th>
                        <th>AwayTeam</th>
                        <th colspan="3">Result</th>
                    </tr>
                    <?php foreach ($response->fixtures as $fixture) { ?>
                    <tr>
                        <td><?php echo $fixture->homeTeamName; ?></td>
                        <td>-</td>
                        <td><?php echo $fixture->awayTeamName; ?></td>
                        <td><?php echo $fixture->result->goalsHomeTeam; ?></td>
                        <td>:</td>
                        <td><?php echo $fixture->result->goalsAwayTeam; ?></td>
                    </tr>
                    <?php } ?>
                </table> -->
				
			<?php
				$WC_teams = 'http://api.football-data.org/v1/competitions/467/teams';
				$WC_fixtures = 'http://api.football-data.org/v1/competitions/467/fixtures';
				$reqPrefs['http']['method'] = 'GET';
				$reqPrefs['http']['header'] = 'X-Auth-Token: 46e58e3c48a747e09ccf6c9ac073c4d6';
				$stream_context = stream_context_create($reqPrefs);
				$response_wc_teams = file_get_contents($WC_teams, false, $stream_context);
				$response_wc_teams = json_decode($response_wc_teams);
				$response_wc_fixtures = file_get_contents($WC_fixtures, false, $stream_context);
				$response_wc_fixtures = json_decode($response_wc_fixtures);
			?>
			
			<h3>Worldcupteams</h3>
                <table class="table table-striped">
                    <tr>
                        <th>Team</th>          
                    </tr>
                    <?php foreach ($response_wc_teams->teams as $team) { ?>
                    <tr>
                        <td><?php echo $team->name; ?></td>                        
                    </tr>
                    <?php } ?>
                </table>
				
			 <h3>Worldcupfixtures</h3>
                <table class="table table-striped">
                    <tr>
                        <th>HomeTeam</th>
                        <th></th>
                        <th>AwayTeam</th>
                        <th colspan="3">Result</th>
                    </tr>
                    <?php foreach ($response_wc_fixtures->fixtures as $fixture) { ?>
                    <tr>
                        <td><?php echo $fixture->homeTeamName; ?></td>
                        <td>-</td>
                        <td><?php echo $fixture->awayTeamName; ?></td>
                        <td><?php echo $fixture->result->goalsHomeTeam; ?></td>
                        <td>:</td>
                        <td><?php echo $fixture->result->goalsAwayTeam; ?></td>
                    </tr>
                    <?php } ?>
                </table> -->	
<!--
            <?php
                echo "<p><hr><p>";
                // search for desired team
                $searchQuery = $api->searchTeam(urlencode("Real Madrid"));
                // var_dump searchQuery and inspect for results
                $response = $api->getTeamById($searchQuery->teams[0]->id);
                $fixtures = $response->getFixtures('home')->fixtures;
            ?>
                <h3>All home matches of Real Madrid:</h3>
                <table class="table table-striped">
                    <tr>
                        <th>HomeTeam</th>
                        <th></th>
                        <th>AwayTeam</th>
                        <th colspan="3">Result</th>
                    </tr>
                    <?php foreach ($fixtures as $fixture) { ?>
                    <tr>
                        <td><?php echo $fixture->homeTeamName; ?></td>
                        <td>-</td>
                        <td><?php echo $fixture->awayTeamName; ?></td>
                        <td><?php echo $fixture->result->goalsHomeTeam; ?></td>
                        <td>:</td>
                        <td><?php echo $fixture->result->goalsAwayTeam; ?></td>
                    </tr>
                    <?php } ?>
                </table>



            <?php
                echo "<p><hr><p>";
                // fetch players for a specific team
                $team = $api->getTeamById($searchQuery->teams[0]->id);
            ?>
            <h3>Players of <?php echo $team->_payload->name; ?></h3>
            <table class="table table-striped">
                <tr>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Jersey Number</th>
                    <th>Date of birth</th>
                </tr>
                <?php foreach ($team->getPlayers() as $player) { ?>
                <tr>
                    <td><?php echo $player->name; ?></td>
                    <td><?php echo $player->position; ?></td>
                    <td><?php echo $player->jerseyNumber; ?></td>
                    <td><?php echo $player->dateOfBirth; ?></td>
                </tr>
                <?php } ?>
            </table>
			-->
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