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
	if($matchday > 3){
		return True;
	}
	else{
		return False;
	}


}

echo 'start';

$puntenMatchCorrect = 3;
$puntenWinnaarCorrect = 1;
$teamGaatDoor = 1;
$meegerekend = 1;
$nieuweUpdate = False;
$aantalCorrect = 0;
$alleenCorrectMail = "";
$aantalFout = 0;
$alleenFoutMail ="";

$query = 'SELECT bc18_survivor AS survivor, bc18_betid as betID, bc18_userid AS userID, games.matchday AS matchday, bc18_gameid AS gameID, games.goals_home AS goals_home, games.goals_away AS goals_away, games.extra_home AS extra_home, games.extra_away AS extra_away, bc18_pred_goalshome AS pred_goals_home, bc18_pred_goalsaway AS pred_goals_away, games.penalties_home AS penalties_home, games.penalties_away AS penalties_away, bc18_pred_penaltieshome AS pred_penalties_home, bc18_pred_penaltiesaway AS pred_penalties_away, klassement.uitslag_correct AS uitslag_correct, klassement.winnaar_correct AS winnaar_correct, klassement.totaal AS totaal FROM bc18_bets AS bets INNER JOIN bc18_games AS games ON games.game_id = bets.bc18_gameid INNER JOIN bc18_klassement AS klassement on klassement.email = bets.bc18_userid WHERE games.status = "FINISHED" AND bets.bc18_meegerekend = 0 order by bets.bc18_gameid asc';

$stmtklassement = $db->prepare("UPDATE bc18_klassement INNER JOIN bc18_bets ON bc18_klassement.email = bc18_bets.bc18_userid SET bc18_klassement.uitslag_correct = ?, bc18_klassement.winnaar_correct = ?, bc18_klassement.totaal = ?, bc18_bets.bc18_meegerekend = ? WHERE bc18_klassement.email = ? AND bc18_bets.bc18_gameid = ?");

$results = mysqli_query($db, $query);
while ($data = mysqli_fetch_array($results)){
	if(!isKnockoutStage($data['matchday'])){
		//groepsfase
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
			$aantalCorrect++;
			$alleenCorrectMail = $email;
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
				$aantalFout++;
				$alleenFoutMail = $email;
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
				$aantalFout++;
				$alleenFoutMail = $email;
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
				$aantalFout++;
				$alleenFoutMail = $email;
				echo 'fout gegokt! <br>';
			}
		}
		echo '<br><br>';
		$gameid = $data['gameID'];
		$stmtklassement->bind_param('iiiisi', $newUitslag, $newWinnaar, $newTotaal, $meegerekend, $email, $gameid);
		$stmtklassement->execute();

		if($correcteWinnaar || $correcteScore){
	  		//first points
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
	else{
		//berekening van de scores voor na de groepsfase
		//groepsfase
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

		// resultaat is winnaar home na 90 of 120 min
		if($data['goals_home']>$data['goals_away'] || $data['extra_home']>$data['extra_away']){
			echo 'na 90 of 120 min was home de winnaar <br>';
		//juiste winnaar gegokt
			if ($data['pred_goals_home']>$data['pred_goals_away']){
				echo 'de user gokte dit correct <br>';
			//juiste score gegokt na 90 of 120 min
				if($data['goals_home'] == $data['pred_goals_home'] && $data['goals_away'] == $data['pred_goals_away'] || $data['extra_home'] == $data['pred_goals_home'] && $data['extra_away'] == $data['pred_goals_away']){
					echo 'De user gokte ook de correcte eindstand <br>';
					$newTotaal = $oldTotaal+$puntenMatchCorrect+$teamGaatDoor;
					$newUitslag++;
					echo ' --> zijn totaalscore gaat nu van '.$data['totaal'].' naar '.$newTotaal.'<br>';
					$correcteScore = True;
					$aantalCorrect++;
					$alleenCorrectMail = $email;
				}
			//foute score 
				else{
					echo 'de eindstand van de user was echter niet correct <br>';
					$newTotaal = $oldTotaal+$puntenWinnaarCorrect+$teamGaatDoor;
					$newWinnaar++;
					echo 'Juiste Winnaar (home) dus totaalscore +1 <br>';
					$correcteWinnaar = True;
				}
			}
			else{
				echo 'de user had dit fout voorspeld <br>';
				$aantalFout++;
				$alleenFoutMail = $email;
			}
		}
		// resulaat is winnaar away na 90 of 120 min
		elseif($data['goals_home']<$data['goals_away'] || $data['extra_home']<$data['extra_away']){
			echo 'na 90 of 120 min was away de winnaar <br>';
			//juiste winnaar gegokt
			if ($data['pred_goals_home']<$data['pred_goals_away']){
				echo 'de user gokte dit correct <br>';
				//juiste score gegokt na 90 of 120 min
				if($data['goals_home'] == $data['pred_goals_home'] && $data['goals_away'] == $data['pred_goals_away'] || $data['extra_home'] == $data['pred_goals_home'] && $data['extra_away'] == $data['pred_goals_away']){
					echo 'De user gokte ook de correcte eindstand';
					$newTotaal = $oldTotaal+$puntenMatchCorrect+$teamGaatDoor;
					$newUitslag++;
					echo ' --> zijn totaalscore gaat nu van '.$data['totaal'].' naar '.$newTotaal.'<br>';
					$correcteScore = True;
					$aantalCorrect++;
					$alleenCorrectMail = $email;
				}
				//foute score 
				else{
					echo 'de eindstand van de user was echter niet correct <br>';
					$newTotaal = $oldTotaal+$puntenWinnaarCorrect+$teamGaatDoor;
					$newWinnaar++;
					echo 'Juiste Winnaar (away) dus totaalscore +1 <br>';
					$correcteWinnaar = True;
				}
			}
			else{
				echo 'de user had dit fout voorspeld <br>';
				$aantalFout++;
				$alleenFoutMail = $email;
			}
		}
		//resultaat is gelijk na 120 min
		elseif($data['goals_home']==$data['goals_away'] && $data['extra_home']==$data['extra_away']){
			$survivor = "";
			if($data['penalties_home']>$data['penalties_away']){
				$survivor = 'Home';
			}
			else{
				$survivor = 'Away';
			}
			//user gokte op gelijkspel
			if($data['pred_goals_home'] == $data['pred_goals_away']){
				echo 'user gokte correct op gelijkspel <br>';
				//correcte gelijkspel
				if($data['pred_goals_home']==$data['goals_home']){
					echo 'De user gokte ook de correcte eindstand<br>';
					$newTotaal = $oldTotaal+$puntenMatchCorrect;
					$newUitslag++;
					echo ' --> zijn totaalscore gaat nu van '.$data['totaal'].' naar '.$newTotaal.'<br>';
					$correcteScore = True;
					$aantalCorrect++;
					$alleenCorrectMail = $email;
					// check if survivor is correct
					if($survivor == $data['survivor'])
					{
						$newTotaal = $newTotaal + $teamGaatDoor;
						echo 'ook de juiste ploeg die doorgaat werd geraden dus newtotaal = '.$newTotaal;
					}
				}
			// ander gelijkspel gegokt
				else{
					echo 'de eindstand van de user was echter niet correct <br>';
					$newTotaal = $oldTotaal+$puntenWinnaarCorrect;
					$newWinnaar++;
					echo 'Juiste voorspelling (draw) dus totaalscore +1 <br>';
					$correcteWinnaar = True;
					if($survivor == $data['survivor'])
					{
						$newTotaal = $newTotaal + $teamGaatDoor;
						echo 'ook de juiste ploeg die doorgaat werd geraden dus newtotaal = '.$newtotaal;
					}
					else{
						$aantalFout++;
						$alleenFoutMail = $email;
					}
				}
			}
			elseif($data['pred_goals_home'] > $data['pred_goals_away']){
				echo 'user fout gegokt want uitslag is draw<br>';
				if($data['survivor'] == 'Home'){
					$newTotaal = $oldTotaal + $teamGaatDoor;
					echo 'wel de juiste survivor aangeduid dus nieuwe totaal = '.$newtotaal;
				}
				else{
					$aantalFout++;
					$alleenFoutMail = $email;
				}
			}
			elseif($data['pred_goals_home'] < $data['pred_goals_away']){
				echo 'user fout gegokt want uitslag is draw<br>';
				if($data['survivor'] == 'Away'){
					$newTotaal = $oldTotaal + $teamGaatDoor;
					echo 'wel de juiste survivor aangeduid dus nieuwe totaal = '.$newtotaal;
				}
				else{
					$aantalFout++;
					$alleenFoutMail = $email;
				}
			}
		}

		echo '<br><br>';
		$gameid = $data['gameID'];
		$stmtklassement->bind_param('iiiisi', $newUitslag, $newWinnaar, $newTotaal, $meegerekend, $email, $gameid);
		$stmtklassement->execute();

		if($correcteWinnaar || $correcteScore){
			//first points
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
}
if($aantalCorrect==1){
	if(!achievedAchievement($db,9,$alleenCorrectMail))
		addAchievement($db, 9,$alleenCorrectMail);
}
if($aantalFout == 1){
	if(!achievedAchievement($db,10, $alleenFoutMail))
		addAchievement($db, 10, $alleenFoutMail);
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