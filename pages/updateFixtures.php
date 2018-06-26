<?php

	include 'FootballData.php';
	include 'server.php';
	$api = new FootballData();
	$soccerseason = $api->getSoccerseasonById(467);
	$WC_fixtures = 'http://api.football-data.org/v1/competitions/467/fixtures';
	$reqPrefs['http']['method'] = 'GET';
	$reqPrefs['http']['header'] = 'X-Auth-Token: 46e58e3c48a747e09ccf6c9ac073c4d6';
	$stream_context = stream_context_create($reqPrefs);
	$response_wc_fixtures = file_get_contents($WC_fixtures, false, $stream_context);
	$response_wc_fixtures = json_decode($response_wc_fixtures);
	
	$stmt = $db->prepare("UPDATE bc18_games SET datum = ?, team_home = ?, team_away = ?, matchday = ?, goals_home = ?, goals_away = ?, status = ? WHERE href = ?");

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
  		
  		$stmt->bind_param('sssiiiss', $datum, $hometeam, $awayteam, $matchday, $goalshome, $goalsaway, $status, $href);
  		$stmt->execute();
  		
		//$query = "UPDATE bc18_games SET goals_home = '$goalshome', goals_away = '$goalsaway' WHERE team_home = '$hometeam' AND team_away = '$awayteam'";
		//mysqli_query($db, $query);
		}
	$stmt->close();

	
	?>