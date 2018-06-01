<?php
include 'server.php';

function addAchievement($db, $id, $userid) {
        $stmt4 = $db->prepare("INSERT INTO bc18_achieved(bc18_user, bc18_achievement, bc18_created) VALUES (?,?,NOW())");
        $stmt4->bind_param('si', $userid, $id);
        $stmt4->execute();
        $stmt4->close();
        $stmt3 = $db->prepare("INSERT INTO bc18_notifications(bc18_user, bc18_link, bc18_class, bc18_message, bc18_read, bc18_created) VALUES(?, ?, ?, ?, ?, NOW())");
        $link = "profile.php";
        $class = 'achieve';
        $message = 'New achievement unlocked!';
        $read = 0;
        $stmt3->bind_param('ssssi', $userid, $link, $class, $message, $read);
        $stmt3->execute();
        $stmt3->close();
        return;
    }

   function achievedAchievement($db, $id, $userid){
   		$achieved = "SELECT bc18_achievement FROM bc18_achieved WHERE bc18_user = '$userid' AND bc18_achievement = '$id'";
        $results = mysqli_query($db, $achieved);
        $aantal = mysqli_num_rows($results);
        if ($aantal > 0)
        	return True;
        else
        	return False;
   }
   
   function isKnockoutStage($matchday){
		if($gameday > 3){
			return True;
		}
		else{
			return False;
		}
	   
	   
   }

echo 'start';

$puntenMatchCorrect = 3;
$puntenWinnaarCorrect = 1;
$meegerekend = 1;
$nieuweUpdate = False;

$query = 'SELECT bc18_betid as betID, bc18_userid AS userID, bc18_gameid AS gameID, games.goals_home AS goals_home, games.goals_away AS goals_away, bc18_pred_goalshome AS pred_goals_home, bc18_pred_goalsaway AS pred_goals_away, games.penalties_home AS penalties_home, games.penalties_away AS penalties_away, bc18_pred_penaltieshome AS pred_penalties_home, bc18_pred_penaltiesaway AS pred_penalties_away, klassement.uitslag_correct AS uitslag_correct, klassement.winnaar_correct AS winnaar_correct, klassement.totaal AS totaal FROM bc18_bets AS bets INNER JOIN bc18_games AS games ON games.game_id = bets.bc18_gameid INNER JOIN bc18_klassement AS klassement on klassement.email = bets.bc18_userid WHERE games.status = "FINISHED" AND bets.bc18_meegerekend = 0 order by bets.bc18_gameid asc ';
	
$stmtklassement = $db->prepare("UPDATE bc18_klassement INNER JOIN bc18_bets ON bc18_klassement.email = bc18_bets.bc18_userid SET bc18_klassement.uitslag_correct = ?, bc18_klassement.winnaar_correct = ?, bc18_klassement.totaal = ?, bc18_bets.bc18_meegerekend = ? WHERE bc18_klassement.email = ? AND bc18_bets.bc18_gameid = ?");

$results = mysqli_query($db, $query);
while ($data = mysqli_fetch_array($results)){
	$correcteScore = False;
	$correcteWinnaar = False;
	echo 'berekenen...';
	$nieuweUpdate = True;
	$email = $data['userID'];
	$oldUitslag = $newUitslag = $data['uitslag_correct'];
	$oldWinnaar = $newWinnaar = $data['winnaar_correct'];
	$oldTotaal = $newTotaal = $data['totaal'];
	echo $data['userID'].' wedt op de match met matchid = '.$data['gameID'].' met volgedende predicitie: '.$data['pred_goals_home'].'-'.$data['pred_goals_away'].'<br>';
	echo 'De echte uitslag van deze wedstrijd was: '.$data['goals_home'].'-'.$data['goals_away'].'<br>';
	if ($data['goals_home'] == $data['pred_goals_home'] && $data['goals_away'] == $data['pred_goals_away']){
		echo 'user '.$data['userID'].' gokte juist ';
		$newTotaal = $oldTotaal+$puntenMatchCorrect;
		$newUitslag++;
		echo ' --> zijn totaalscore gaat nu van '.$data['totaal'].' naar '.$newTotaal.'<br>';
		$correcteScore = True;
	}
	elseif ($data['pred_goals_home']>$data['pred_goals_away']){
			// home wint
			if($data['goals_home']>$data['goals_away']){
				// Juiste winnaar
				$newTotaal = $oldTotaal+$puntenWinnaarCorrect;
				$newWinnaar++;
				echo 'Juiste Winnaar (home) dus totaalscore +1 <br>';
				$correcteWinnaar = True;
			}
			else{
				echo 'fout gegokt! <br>';
			}
		}
	elseif ($data['pred_goals_home']<$data['pred_goals_away']) {
			// away wint
			if($data['goals_home']<$data['goals_away']){
				// Juiste winnaar
				$newTotaal = $oldTotaal+$puntenWinnaarCorrect;
				$newWinnaar++;
				echo 'Juiste Winnaar (away) dus totaalscore +1 <br>';
				$correcteWinnaar = True;
			}
			else{
				echo 'fout gegokt! <br>';
			}
		}
	elseif ($data['pred_goals_home']==$data['pred_goals_away']) {
			// gelijkspel
			if($data['goals_home']==$data['goals_away']){
				// Juiste gok gelijkspel (fout aantal goals)
				$newTotaal = $oldTotaal+$puntenWinnaarCorrect;
				$newWinnaar++;
				echo 'Juiste gok gelijkspel dus totaalscore +1 <br>';
			}
			else{
				echo 'fout gegokt! <br>';
			}
		}
	echo '<br><br>';
	$gameid = $data['gameID'];
	$stmtklassement->bind_param('iiiisi', $newUitslag, $newWinnaar, $newTotaal, $meegerekend, $email, $gameid);
  	$stmtklassement->execute();

  	if($correcteWinnaar || $correcteScore){
  		//guess the right winner
  		if(!achievedAchievement($db,5,$email))
  			addAchievement($db, 5,$email);
  	}
  	if($correcteScore){
  		//guess the right score
  		if(!achievedAchievement($db,7,$email))
  			addAchievement($db, 7,$email);
  	}
  	if($newWinnaar+$newUitslag == 10){
  		//guess the right winner of a game 10 times
  		if(!achievedAchievement($db,6,$email))
  			addAchievement($db, 6,$email);
  	}
  	if($newUitslag == 3){
  		//guess the right score of a game 3 times
  		if(!achievedAchievement($db,8,$email))
  			addAchievement($db, 8,$email);
  	}
}

 	$stmtklassement->close();
 	
 	if ($nieuweUpdate){
 		echo 'er waren nieuwe updates <br>';
 		$link = "klassement.php";
	    $class = "klassement";
	    $message = "Nieuw klassement staat online";
	    $read = 0;
	   	$stmt3 = $db->prepare("INSERT INTO bc18_notifications(bc18_user, bc18_link, bc18_class, bc18_message, bc18_read, bc18_created) VALUES(?, ?, ?, ?, ?, NOW())");
 		$queryUser = 'SELECT email FROM bc18_users WHERE 1';
 		$resultsUser = mysqli_query($db, $queryUser);
		while ($dataUser = mysqli_fetch_array($resultsUser)){
			echo 'insert notification <br>';
			$email = $dataUser['email'];
	        $stmt3->bind_param('ssssi', $email, $link, $class, $message, $read);
	        $stmt3->execute();
	 	}

	 	//voor achievement zien of er iemand alleen aan de leiding staat
	 	$klassement = 'SELECT totaal, email FROM bc18_klassement order BY totaal DESC LIMIT 2';
 		$resultsKlassement = mysqli_query($db, $klassement);
 		$mail='';
		$totaal='';
		$totaalTweede='';
		$teller=0;
		while($dataKlassement = mysqli_fetch_array($resultsKlassement)){
			if($teller == 0){
				$mail = $dataKlassement['email'];
				$totaal = $dataKlassement['totaal'];
			}
			if($teller == 1){
				$totaalTweede = $dataKlassement['totaal'];
			}
			$teller++;
		}
		// echo $totaal .'   '. $totaalTweede;
		if($totaal>$totaalTweede){
			if(!achievedAchievement($db, 18, $mail))
				addAchievement($db, 18,$mail);
	 }
	}
	
?>
<html>
	 <div>
	<form action="adminpage.php">
		<input type="submit" class="btn bg-grey waves-effect" value="to adminpage" />
	</form>
	<form action="klassement.php">
		<input type="submit" class="btn bg-grey waves-effect" value="to klassement" />
	</form>
	<form action="index.php">
		<input type="submit" class="btn bg-grey waves-effect" value="to homepage"  />
	</form>
	 </div>
</html>