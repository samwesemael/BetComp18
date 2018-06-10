<?php include 'navigator.php';
    include 'server.php';

    $matchenPerDag = array(1, 3, 4, 3, 3, 3, 3, 3, 3, 3, 3, 4, 4, 4, 4, 2, 2, 2, 2, 2, 2, 1, 1, 1, 1);
    $speeldagen = array("2018-06-14", "2018-06-15", "2018-06-16", "2018-06-17", "2018-06-18", "2018-06-19", "2018-06-20", "2018-06-21", "2018-06-22", "2018-06-23", "2018-06-24", "2018-06-25", "2018-06-26", "2018-06-27", "2018-06-28", "2018-06-30", "2018-07-01", "2018-07-02", "2018-07-03", "2018-07-06", "2018-07-07", "2018-07-10", "2018-07-11", "2018-07-14", "2018-07-15");
    $speeldagnummers = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25);
	$eerste = true; 
    ?>

<!DOCTYPE html>
<html>
<script type="text/javascript">
    document.getElementById("nav-matches").classList.toggle('active');
</script>
    <section class="content">
	
	 	    <!-- Basic Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h4>
                                SUMMARY
							</h4>
                                <small>All results</small>                                                
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
												$sqlmatches = "SELECT game_id FROM bc18_games WHERE bettable = 1 AND datum < NOW() ORDER BY datum LIMIT 0,25" ;
											    $resultsgameids = mysqli_query($db,$sqlmatches);
												while($ids = mysqli_fetch_array($resultsgameids)){
                                                    array_push($matchIDs, $ids['game_id']);
                                                }										
                                                $sqlusers = "SELECT bc18_users.user_name FROM bc18_users WHERE verification = 1 ORDER BY user_name";					
                                                $resultsusers = mysqli_query($db, $sqlusers);                                                
                                                while ($users = mysqli_fetch_array($resultsusers)){
													$user = $users['user_name'];
											?>
                                                <tr>                                   
                                                    <td><?php echo $user; ?></td>
													<?php
                                                    $sqlbets = "SELECT bc18_games.status AS status, bc18_bets.bc18_userid AS userID, bc18_users.user_name AS Username, bc18_users.email AS email, bc18_pred_goalshome AS goalshome, bc18_pred_goalsaway AS goalsaway, bc18_gameid AS gameid, bc18_games.goals_home AS correctHome, bc18_games.goals_away AS correctAway FROM bc18_bets INNER JOIN bc18_users on bc18_bets.bc18_userid = bc18_users.email INNER JOIN bc18_games on bc18_bets.bc18_gameid = bc18_games.game_id WHERE bc18_users.user_name = '$user' AND bc18_games.datum < NOW() ORDER BY bc18_users.user_name, bc18_games.datum ";
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
        			</div>
                </div>
            </div>	
	
	
	
	
	
	
	
	
	
	
	
	
        <div class="panel-group" id="accordion">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                    Groepsfase</a>
                    </h4>
                </div>
                <div id="collapse1" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs tab-nav-right" role="tablist">
                            <!-- <li role="presentation" class=""><a href="#16" data-toggle="tab">16</a></li> -->
                            <?php
                                for($i=1; $i<16;$i++){
                                    if ($i==1){
                                        echo '
                                        <li class = "active" role="presentation"><a href="#'.$i.'" data-toggle="tab" class="active" aria-expanded = "true">'.$i.'</a></li>
                                    ';
                                    }
                                    else{
                                        echo '
                                        <li role="presentation"><a href="#'.$i.'" data-toggle="tab">'.$i.'</a></li>
                                    ';
                                    }
                                }
                            ?>
                        </ul>
                        <div class="tab-content">
                            <?php
                                $matchquery = "SELECT bc18_games.status AS status, bc18_games.datum as datum, bc18_games.team_home as hometeam, bc18_games.team_away as awayteam, bc18_games.goals_home as goals_home, bc18_games.goals_away as goals_away, home.team_crest as homeflag, away.team_crest as awayflag FROM bc18_games INNER JOIN bc18_teams AS home ON bc18_games.team_home = home.team_name INNER JOIN bc18_teams AS away ON bc18_games.team_away = away.team_name WHERE bc18_games.datum between '2018-06-14' and '2018-06-28 23:59:59' ORDER BY bc18_games.datum ASC ";
                                $results = mysqli_query($db, $matchquery);
                                $i = 1;
                                $data = mysqli_fetch_array($results);
                                while ($data){
                                    echo 
                                        '<div role="tabpanel" class="tab-pane fade';
                                        if ($eerste == true){
                                            echo " active in";
                                            $eerste = false;
                                        }
                                        echo '" id="'.$i.'">';                                      
                                        echo '<div id="myCarousel'.$i.'" class="carousel slide" data-ride="carousel" data-interval="false">
                                        <!-- Indicators -->
                                        <ol class="carousel-indicators">';
                                        $temp = $i-1;
                                        for($x=1;$x<=$matchenPerDag[$temp];$x++){
                                            $tempx = $x-1;
                                            if($x==1){
                                                echo '<li data-target="#myCarousel'.$i.'" data-slide-to="'.$tempx.'" class="active"></li>';
                                                }    
                                            else{
                                                echo '<li data-target="#myCarousel'.$i.'" data-slide-to="'.$tempx.'"></li>';
                                                }
                                            }
                                        echo '</ol><div class="carousel-inner">';
                                        for($x=1;$x<=$matchenPerDag[$temp];$x++){
                                            $datum = $data['datum'];
                                            $date = new DateTime($datum);
                                            $date->setTimezone(new DateTimeZone('Europe/Brussels'));
                                            $date = $date->format('Y-m-d H:i:s');
                                            if($data['status'] == 'FINISHED'){
                                                $goalsHome = $data['goals_home'];
                                                $goalsAway = $data['goals_away']; 
                                            }
                                            else{
                                                $goalsHome = $goalsAway = '?';
                                            }
                                            if($x==1){
                                                echo '
                                                    <div class="item active">
                                                        <div class="row clearfix">
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                <div class="media">
                                                                    <div class="media-left media-middle media-right">
                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                                            <center><a href="#">
                                                                                <img class="media-object" src="'.$data['homeflag'].'" width="80%">
                                                                            </a></center>
                                                                        </div>
                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                                            <div class="media-body media-middle centered-content">
                                                                                <center>
                                                                                    <h3>'.$data['hometeam'].' - '.$data['awayteam'].'</h3> <br>
                                                                                    <h4>'.$goalsHome.'-'.$goalsAway.'</h4>
                                                                                    <h6>'.$date.'</h6>
                                                                                </center>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                                            <center>
                                                                                <a href="#">
                                                                                    <img class="media-object" src="'.$data['awayflag'].'" width="80%">
                                                                                </a>
                                                                            </center>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>';
                                            }
                                            else{
                                                echo'
                                                    <div class="item">
                                                        <div class="row clearfix">
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                <div class="media">
                                                                    <div class="media-left media-middle media-right">
                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                                            <center><a href="#">
                                                                                <img class="media-object" src="'.$data['homeflag'].'" width="80%">
                                                                            </a></center>
                                                                        </div>
                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                                            <div class="media-body media-middle centered-content">
                                                                                <center>
                                                                                    <h3>'.$data['hometeam'].' - '.$data['awayteam'].'</h3> <br>
                                                                                    <h4>'.$goalsHome.'-'.$goalsAway.'</h4>
                                                                                    <h6>'.$date.'</h6>
                                                                                </center>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                                            <center>
                                                                                <a href="#">
                                                                                    <img class="media-object" src="'.$data['awayflag'].'" width="80%">
                                                                                </a>
                                                                            </center>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>';
                                            }
                                            $data = mysqli_fetch_array($results);
                                        }
                                        if($matchenPerDag[$i-1] != 1){
                                            echo '
                                              <!-- Left and right controls -->
                                              <a class="left carousel-control" href="#myCarousel'.$i.'" data-slide="prev">
                                                <span class="glyphicon glyphicon-chevron-left"></span>
                                                <span class="sr-only">Previous</span>
                                              </a>
                                              <a class="right carousel-control" href="#myCarousel'.$i.'" data-slide="next">
                                                <span class="glyphicon glyphicon-chevron-right"></span>
                                                <span class="sr-only">Next</span>
                                              </a>';
                                            }
                                        $i++;

                                        echo '</div></div></div>';
                                    }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                    8ste Finales</a>
                    </h4>
                </div>
                <div id="collapse2" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ul class="nav nav-tabs tab-nav-right" role="tablist">
                            <!-- <li role="presentation" class=""><a href="#16" data-toggle="tab">16</a></li> -->
                            <?php
                                for($i=16; $i<20;$i++){
                                    echo '
                                        <li role="presentation"><a href="#'.$i.'" data-toggle="tab">'.$i.'</a></li>
                                    ';
                                }
                            ?>
                        </ul>
                        <div class="tab-content">
                            <?php
                                $matchquery = "SELECT bc18_games.status AS status, bc18_games.datum as datum, bc18_games.team_home as hometeam, bc18_games.team_away as awayteam, bc18_games.goals_home as goals_home, bc18_games.goals_away as goals_away, home.team_crest as homeflag, away.team_crest as awayflag FROM bc18_games INNER JOIN bc18_teams AS home ON bc18_games.team_home = home.team_name INNER JOIN bc18_teams AS away ON bc18_games.team_away = away.team_name WHERE bc18_games.datum between '2018-06-30' and '2018-07-03 23:59:59' ORDER BY bc18_games.datum ASC LIMIT 15";
                                $results = mysqli_query($db, $matchquery);
                                $i = 16;
                                $data = mysqli_fetch_array($results);
                                $eerste = true;
                                while ($data){
                               
                                    echo 
                                        '<div role="tabpanel" class="tab-pane fade';
                                        if ($eerste == true){
                                            echo " active in";
                                            $eerste = false;
                                        }
                                        echo '" id="'.$i.'">
                                        <div id="myCarousel'.$i.'" class="carousel slide" data-ride="carousel" data-interval="false">
                                        <!-- Indicators -->
                                        <ol class="carousel-indicators">';
                                        $temp = $i-1;
                                        for($x=1;$x<=$matchenPerDag[$temp];$x++){
                                            $datum = $data['datum'];
                                            $date = new DateTime($datum);
                                            $date->setTimezone(new DateTimeZone('Europe/Brussels'));
                                            $date = $date->format('Y-m-d H:i:s');
                                            $tempx = $x-1;
                                            if($x==1){
                                                echo '<li data-target="#myCarousel'.$i.'" data-slide-to="'.$tempx.'" class="active"></li>';
                                                }    
                                            else{
                                                echo '<li data-target="#myCarousel'.$i.'" data-slide-to="'.$tempx.'"></li>';
                                                }
                                            }
                                        echo '</ol><div class="carousel-inner">';
                                        for($x=1;$x<=$matchenPerDag[$temp];$x++){
                                            if($data['status'] == 'FINISHED'){
                                                $goalsHome = $data['goals_home'];
                                                $goalsAway = $data['goals_away']; 
                                            }
                                            else{
                                                $goalsHome = $goalsAway = '?';
                                            }
                                            if($x==1){
                                                echo '
                                                    <div class="item active">
                                                        <div class="row clearfix">
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                <div class="media">
                                                                    <div class="media-left media-middle media-right">
                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                                            <center><a href="#">
                                                                                <img class="media-object" src="'.$data['homeflag'].'" width="80%">
                                                                            </a></center>
                                                                        </div>
                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                                            <div class="media-body media-middle centered-content">
                                                                                <center>
                                                                                    <h3>'.$data['hometeam'].' - '.$data['awayteam'].'</h3> <br>
                                                                                    <h4>'.$goalsHome.'-'.$goalsAway.'</h4>
                                                                                    <h6>'.$date.'</h6>
                                                                                </center>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                                            <center>
                                                                                <a href="#">
                                                                                    <img class="media-object" src="'.$data['awayflag'].'" width="80%">
                                                                                </a>
                                                                            </center>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>';
                                            }
                                            else{
                                                echo'
                                                    <div class="item">
                                                        <div class="row clearfix">
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                <div class="media">
                                                                    <div class="media-left media-middle media-right">
                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                                            <center><a href="#">
                                                                                <img class="media-object" src="'.$data['homeflag'].'" width="80%">
                                                                            </a></center>
                                                                        </div>
                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                                            <div class="media-body media-middle centered-content">
                                                                                <center>
                                                                                    <h3>'.$data['hometeam'].' - '.$data['awayteam'].'</h3> <br>
                                                                                    <h4>'.$goalsHome.'-'.$goalsAway.'</h4>
                                                                                    <h6>'.$date.'</h6>
                                                                                </center>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                                            <center>
                                                                                <a href="#">
                                                                                    <img class="media-object" src="'.$data['awayflag'].'" width="80%">
                                                                                </a>
                                                                            </center>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>';
                                            }
                                            $data = mysqli_fetch_array($results);
                                        }
                                        echo '
                                          <!-- Left and right controls -->
                                          <a class="left carousel-control" href="#myCarousel'.$i.'" data-slide="prev">
                                            <span class="glyphicon glyphicon-chevron-left"></span>
                                            <span class="sr-only">Previous</span>
                                          </a>
                                          <a class="right carousel-control" href="#myCarousel'.$i.'" data-slide="next">
                                            <span class="glyphicon glyphicon-chevron-right"></span>
                                            <span class="sr-only">Next</span>
                                          </a>';
                                        $i++;

                                        echo '</div></div></div>';
                                    }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                    Kwart Finales</a>
                    </h4>
                </div>
                <div id="collapse3" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ul class="nav nav-tabs tab-nav-right" role="tablist">
                            <!-- <li role="presentation" class=""><a href="#16" data-toggle="tab">16</a></li> -->
                            <?php
                                for($i=20; $i<22;$i++){
                                    echo '
                                        <li role="presentation"><a href="#'.$i.'" data-toggle="tab">'.$i.'</a></li>
                                    ';
                                }
                            ?>
                        </ul>
                        <div class="tab-content">
                            <?php
                                $matchquery = "SELECT bc18_games.status AS status, bc18_games.datum as datum, bc18_games.team_home as hometeam, bc18_games.team_away as awayteam, bc18_games.goals_home as goals_home, bc18_games.goals_away as goals_away, home.team_crest as homeflag, away.team_crest as awayflag FROM bc18_games INNER JOIN bc18_teams AS home ON bc18_games.team_home = home.team_name INNER JOIN bc18_teams AS away ON bc18_games.team_away = away.team_name WHERE bc18_games.datum between '2018-07-06' and '2018-07-07 23:59:59' ORDER BY bc18_games.datum ASC LIMIT 15";
                                $results = mysqli_query($db, $matchquery);
                                $i = 20;
                                $data = mysqli_fetch_array($results);
                                $eerste = true;
                                while ($data){
                                    echo 
                                        '<div role="tabpanel" class="tab-pane fade';
                                        if ($eerste == true){
                                            echo " active in";
                                            $eerste = false;
                                        }
                                        echo '" id="'.$i.'">
                                        <div id="myCarousel'.$i.'" class="carousel slide" data-ride="carousel" data-interval="false">
                                        <div class="carousel-inner">';
                                        for($x=1;$x<=$matchenPerDag[$temp];$x++){
                                            $datum = $data['datum'];
                                            $date = new DateTime($datum);
                                            $date->setTimezone(new DateTimeZone('Europe/Brussels'));
                                            $date = $date->format('Y-m-d H:i:s');
                                            if($data['status'] == 'FINISHED'){
                                                $goalsHome = $data['goals_home'];
                                                $goalsAway = $data['goals_away']; 
                                            }
                                            else{
                                                $goalsHome = $goalsAway = '?';
                                            }
                                            if($x==1){
                                                echo '
                                                    <div class="item active">
                                                        <div class="row clearfix">
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                <div class="media">
                                                                    <div class="media-left media-middle media-right">
                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                                            <center><a href="#">
                                                                                <img class="media-object" src="'.$data['homeflag'].'" width="80%">
                                                                            </a></center>
                                                                        </div>
                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                                            <div class="media-body media-middle centered-content">
                                                                                <center>
                                                                                    <h3>'.$data['hometeam'].' - '.$data['awayteam'].'</h3> <br>
                                                                                    <h4>'.$goalsHome.'-'.$goalsAway.'</h4>
                                                                                    <h6>'.$date.'</h6>
                                                                                </center>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                                            <center>
                                                                                <a href="#">
                                                                                    <img class="media-object" src="'.$data['awayflag'].'" width="80%">
                                                                                </a>
                                                                            </center>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>';
                                            }
                                            else{
                                                echo'
                                                    <div class="item">
                                                        <div class="row clearfix">
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                <div class="media">
                                                                    <div class="media-left media-middle media-right">
                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                                            <center><a href="#">
                                                                                <img class="media-object" src="'.$data['homeflag'].'" width="80%">
                                                                            </a></center>
                                                                        </div>
                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                                            <div class="media-body media-middle centered-content">
                                                                                <center>
                                                                                    <h3>'.$data['hometeam'].' - '.$data['awayteam'].'</h3> <br>
                                                                                    <h4>'.$goalsHome.'-'.$goalsAway.'</h4>
                                                                                    <h6>'.$date.'</h6>
                                                                                </center>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                                            <center>
                                                                                <a href="#">
                                                                                    <img class="media-object" src="'.$data['awayflag'].'" width="80%">
                                                                                </a>
                                                                            </center>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>';
                                            }
                                            $data = mysqli_fetch_array($results);
                                        }
                                        echo '<!-- Indicators -->
                                        <ol class="carousel-indicators">';
                                        $temp = $i-1;
                                        for($x=1;$x<=$matchenPerDag[$temp];$x++){
                                            $tempx = $x-1;
                                            if($x==1){
                                                echo '<li data-target="#myCarousel'.$i.'" data-slide-to="'.$tempx.'" class="active"></li>';
                                                }    
                                            else{
                                                echo '<li data-target="#myCarousel'.$i.'" data-slide-to="'.$tempx.'"></li>';
                                                }
                                            }
                                        echo '</ol>';
                                        echo '
                                          <!-- Left and right controls -->
                                          <a class="left carousel-control" href="#myCarousel'.$i.'" data-slide="prev">
                                            <span class="glyphicon glyphicon-chevron-left"></span>
                                            <span class="sr-only">Previous</span>
                                          </a>
                                          <a class="right carousel-control" href="#myCarousel'.$i.'" data-slide="next">
                                            <span class="glyphicon glyphicon-chevron-right"></span>
                                            <span class="sr-only">Next</span>
                                          </a>';
                                        $i++;

                                        echo '</div></div></div>';
                                    }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">
                    Halve Finales</a>
                    </h4>
                </div>
                <div id="collapse4" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ul class="nav nav-tabs tab-nav-right" role="tablist">
                            <!-- <li role="presentation" class=""><a href="#16" data-toggle="tab">16</a></li> -->
                            <?php
                                for($i=22; $i<24;$i++){
                                    echo '
                                        <li role="presentation"><a href="#'.$i.'" data-toggle="tab">'.$i.'</a></li>
                                    ';
                                }
                            ?>
                        </ul>
                        <div class="tab-content">
                            <?php
                                $matchquery = "SELECT bc18_games.status AS status, bc18_games.datum as datum, bc18_games.team_home as hometeam, bc18_games.team_away as awayteam, bc18_games.goals_home as goals_home, bc18_games.goals_away as goals_away, home.team_crest as homeflag, away.team_crest as awayflag FROM bc18_games INNER JOIN bc18_teams AS home ON bc18_games.team_home = home.team_name INNER JOIN bc18_teams AS away ON bc18_games.team_away = away.team_name WHERE bc18_games.datum between '2018-07-10' and '2018-07-11 23:59:59' ORDER BY bc18_games.datum ASC LIMIT 15";
                                $results = mysqli_query($db, $matchquery);
                                $i = 22;
                                $data = mysqli_fetch_array($results);
                                $eerste = true;
                                while ($data){
                                    echo 
                                        '<div role="tabpanel" class="tab-pane fade';
                                        if ($eerste == true){
                                            echo " active in";
                                            $eerste = false;
                                        }
                                        echo '" id="'.$i.'">
                                        <div id="myCarousel'.$i.'" class="carousel slide" data-ride="carousel" data-interval="false">
                                        <!-- Indicators -->
                                        <ol class="carousel-indicators">';
                                        $temp = $i-1;
                                        for($x=1;$x<=$matchenPerDag[$temp];$x++){
                                            $datum = $data['datum'];
                                            $date = new DateTime($datum);
                                            $date->setTimezone(new DateTimeZone('Europe/Brussels'));
                                            $date = $date->format('Y-m-d H:i:s');
                                            $tempx = $x-1;
                                            if($x==1){
                                                echo '<li data-target="#myCarousel'.$i.'" data-slide-to="'.$tempx.'" class="active"></li>';
                                                }    
                                            else{
                                                echo '<li data-target="#myCarousel'.$i.'" data-slide-to="'.$tempx.'"></li>';
                                                }
                                            }
                                        echo '</ol><div class="carousel-inner">';
                                        for($x=1;$x<=$matchenPerDag[$temp];$x++){
                                            if($data['status'] == 'FINISHED'){
                                                $goalsHome = $data['goals_home'];
                                                $goalsAway = $data['goals_away']; 
                                            }
                                            else{
                                                $goalsHome = $goalsAway = '?';
                                            }
                                            if($x==1){
                                                echo '
                                                    <div class="item active">
                                                        <div class="row clearfix">
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                <div class="media">
                                                                    <div class="media-left media-middle media-right">
                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                                            <center><a href="#">
                                                                                <img class="media-object" src="'.$data['homeflag'].'" width="80%">
                                                                            </a></center>
                                                                        </div>
                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                                            <div class="media-body media-middle centered-content">
                                                                                <center>
                                                                                    <h3>'.$data['hometeam'].' - '.$data['awayteam'].'</h3> <br>
                                                                                    <h4>'.$goalsHome.'-'.$goalsAway.'</h4>
                                                                                    <h6>'.$date.'</h6>
                                                                                </center>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                                            <center>
                                                                                <a href="#">
                                                                                    <img class="media-object" src="'.$data['awayflag'].'" width="80%">
                                                                                </a>
                                                                            </center>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>';
                                            }
                                            else{
                                                echo'
                                                    <div class="item">
                                                        <div class="row clearfix">
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                <div class="media">
                                                                    <div class="media-left media-middle media-right">
                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                                            <center><a href="#">
                                                                                <img class="media-object" src="'.$data['homeflag'].'" width="80%">
                                                                            </a></center>
                                                                        </div>
                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                                            <div class="media-body media-middle centered-content">
                                                                                <center>
                                                                                    <h3>'.$data['hometeam'].' - '.$data['awayteam'].'</h3> <br>
                                                                                    <h4>'.$goalsHome.'-'.$goalsAway.'</h4>
                                                                                    <h6>'.$date.'</h6>
                                                                                </center>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                                            <center>
                                                                                <a href="#">
                                                                                    <img class="media-object" src="'.$data['awayflag'].'" width="80%">
                                                                                </a>
                                                                            </center>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>';
                                            }
                                            $data = mysqli_fetch_array($results);
                                        }
                                        echo '
                                          <!-- Left and right controls -->
                                          <a class="left carousel-control" href="#myCarousel'.$i.'" data-slide="prev">
                                            <span class="glyphicon glyphicon-chevron-left"></span>
                                            <span class="sr-only">Previous</span>
                                          </a>
                                          <a class="right carousel-control" href="#myCarousel'.$i.'" data-slide="next">
                                            <span class="glyphicon glyphicon-chevron-right"></span>
                                            <span class="sr-only">Next</span>
                                          </a>';
                                        $i++;

                                        echo '</div></div></div>';
                                    }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse5">
                    Finales</a>
                    </h4>
                </div>
                <div id="collapse5" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ul class="nav nav-tabs tab-nav-right" role="tablist">
                            <!-- <li role="presentation" class=""><a href="#16" data-toggle="tab">16</a></li> -->
                            <?php
                                for($i=24; $i<26;$i++){
                                    echo '
                                        <li role="presentation"><a href="#'.$i.'" data-toggle="tab">'.$i.'</a></li>
                                    ';
                                }
                            ?>
                        </ul>
                        <div class="tab-content">
                            <?php
                                $matchquery = "SELECT bc18_games.status AS status, bc18_games.datum as datum, bc18_games.team_home as hometeam, bc18_games.team_away as awayteam, bc18_games.goals_home as goals_home, bc18_games.goals_away as goals_away, home.team_crest as homeflag, away.team_crest as awayflag FROM bc18_games INNER JOIN bc18_teams AS home ON bc18_games.team_home = home.team_name INNER JOIN bc18_teams AS away ON bc18_games.team_away = away.team_name WHERE bc18_games.datum between '2018-07-14' and '2018-07-1 5 23:59:59' ORDER BY bc18_games.datum ASC LIMIT 15";
                                $results = mysqli_query($db, $matchquery);
                                $i = 24;
                                $data = mysqli_fetch_array($results);
                                $eerste = true;
                                while ($data){
                                    echo 
                                        '<div role="tabpanel" class="tab-pane fade';
                                        if ($eerste == true){
                                            echo " active in";
                                            $eerste = false;
                                        }
                                        echo '" id="'.$i.'">
                                        <div id="myCarousel'.$i.'" class="carousel slide" data-ride="carousel" data-interval="false">
                                        <!-- Indicators -->
                                        <ol class="carousel-indicators">';
                                        $temp = $i-1;
                                        for($x=1;$x<=$matchenPerDag[$temp];$x++){
                                            $datum = $data['datum'];
                                            $date = new DateTime($datum);
                                            $date->setTimezone(new DateTimeZone('Europe/Brussels'));
                                            $date = $date->format('Y-m-d H:i:s');
                                            $tempx = $x-1;
                                            if($x==1){
                                                echo '<li data-target="#myCarousel'.$i.'" data-slide-to="'.$tempx.'" class="active"></li>';
                                                }    
                                            else{
                                                echo '<li data-target="#myCarousel'.$i.'" data-slide-to="'.$tempx.'"></li>';
                                                }
                                            }
                                        echo '</ol><div class="carousel-inner">';
                                        for($x=1;$x<=$matchenPerDag[$temp];$x++){
                                            if($data['status'] == 'FINISHED'){
                                                $goalsHome = $data['goals_home'];
                                                $goalsAway = $data['goals_away']; 
                                            }
                                            else{
                                                $goalsHome = $goalsAway = '?';
                                            }
                                            if($x==1){
                                                echo '
                                                    <div class="item active">
                                                        <div class="row clearfix">
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                <div class="media">
                                                                    <div class="media-left media-middle media-right">
                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                                            <center><a href="#">
                                                                                <img class="media-object" src="'.$data['homeflag'].'" width="80%">
                                                                            </a></center>
                                                                        </div>
                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                                            <div class="media-body media-middle centered-content">
                                                                                <center>
                                                                                    <h3>'.$data['hometeam'].' - '.$data['awayteam'].'</h3> <br>
                                                                                    <h4>'.$goalsHome.'-'.$goalsAway.'</h4>
                                                                                    <h6>'.$date.'</h6>
                                                                                </center>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                                            <center>
                                                                                <a href="#">
                                                                                    <img class="media-object" src="'.$data['awayflag'].'" width="80%">
                                                                                </a>
                                                                            </center>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>';
                                            }
                                            else{
                                                echo'
                                                    <div class="item">
                                                        <div class="row clearfix">
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                <div class="media">
                                                                    <div class="media-left media-middle media-right">
                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                                            <center><a href="#">
                                                                                <img class="media-object" src="'.$data['homeflag'].'" width="80%">
                                                                            </a></center>
                                                                        </div>
                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                                            <div class="media-body media-middle centered-content">
                                                                                <center>
                                                                                    <h3>'.$data['hometeam'].' - '.$data['awayteam'].'</h3> <br>
                                                                                    <h4>'.$goalsHome.'-'.$goalsAway.'</h4>
                                                                                    <h6>'.$date.'</h6>
                                                                                </center>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                                            <center>
                                                                                <a href="#">
                                                                                    <img class="media-object" src="'.$data['awayflag'].'" width="80%">
                                                                                </a>
                                                                            </center>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>';
                                            }
                                            $data = mysqli_fetch_array($results);
                                        }
                                        echo '
                                          <!-- Left and right controls -->
                                          <a class="left carousel-control" href="#myCarousel'.$i.'" data-slide="prev">
                                            <span class="glyphicon glyphicon-chevron-left"></span>
                                            <span class="sr-only">Previous</span>
                                          </a>
                                          <a class="right carousel-control" href="#myCarousel'.$i.'" data-slide="next">
                                            <span class="glyphicon glyphicon-chevron-right"></span>
                                            <span class="sr-only">Next</span>
                                          </a>';
                                        $i++;

                                        echo '</div></div></div>';
                                    }
                            ?>
                        </div>
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

</body>

</html>