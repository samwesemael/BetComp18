<?php include 'navigator.php';
      include 'server.php';?>
<script type="text/javascript">
    document.getElementById("nav-home").classList.toggle('active');
</script>

<!DOCTYPE html>
<html>
    <section class="content">
    
        <!--
            <div class="block-header">
                <h2>DASHBOARD</h2>
            </div> -->
            
            <!-- MEDEDELINGEN -->
            <div class="row clearfix">
                <?php
                    $sqlmededeling = "SELECT message FROM bc18_overig WHERE name='homeMededeling'";
                    $messages = mysqli_query($db, $sqlmededeling);
                    if (!$messages) {
                        printf("Error: %s\n", mysqli_error($db));
                        exit();
                      }
                    
                    if($data = mysqli_fetch_array($messages)){
                        $mededeling = $data['message'];
                    }
                if($mededeling!='GEEN MEDEDELING'){
                ?>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="info-box-4 hover-zoom-effect">
                                <div class="icon">
                                    <i class="material-icons col-green">announcement</i>
                                </div>
                                <div class="content">
                                    <div class="text"><b>MEDEDELINGEN</b></div>
                                    <div class="text" id="mededelingen"><?php echo $mededeling ?></div>
                                </div>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
            </div>

        	<!-- CountDown Timer -->
            <!-- CountDown Timer -->
          
			 <?php
                 // lijst van alle deadlines voor te gokken
                    $sql = "SELECT datum FROM bc18_games WHERE bettable = 1 order by datum asc";
                    $results = mysqli_query($db, $sql);
                    $deadlines = array();
                    while ($data = mysqli_fetch_array($results)){
                        array_push($deadlines, strval($data['datum']));
                    }
                    $deadlines = implode (", ", $deadlines);

                ?>
					 <div class="row d-flex">
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 d-flex">					
							<div class="card">
							<div class="header">
                                <div class="row clearfix">
                                    <div class="col-xs-12 col-sm-12">
                                        <div class="font-bold m-b--35">COUNTDOWN</div>
                                        <br>
                                    </div>
                                </div>                                
                            </div>
								<div class="body">
								<br><br>
									<div class="row clearfix">
										<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
											<center><input id="daysclock" data-min="0" data-max="356" type="text" class="knob days" data-width="90%" data-thickness="0.25" data-fgColor="#F44336" data-rotation=anticlockwise data-readOnly=true>
												<br><br>DAGEN</center>
										</div>
										<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
											<center><input id="hoursclock" data-min="0" data-max="24" type="text" class="knob hours" data-width="90%" data-thickness="0.25" data-fgColor="#E91E63" data-rotation=anticlockwise
											data-readOnly = "true">
											<br><br>UREN</center>
										</div>
										<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
											<center><input id="minutesclock" data-min="0" data-max="60" ype="text" class="knob minutes" data-width="90%" data-thickness="0.25" data-fgColor="#00BCD4" data-rotation=anticlockwise data-readOnly="true">
											<br><br>MINUTEN</center>
										</div>
										<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
											<center><input id="secondsclock" data-min="0" data-max="60" type="text" class="knob seconds" data-width="90%" data-thickness="0.25" data-fgColor="#009688" data-rotation=anticlockwise data-readOnly="true">
											<br><br>SECONDEN</center>
										</div>
									</div>
									<br>
                                <center><b> TILL WORLD CUP 2018</b></center> 
                            </div>
                        </div>
                    </div>
                        <!-- END CountDown Timer -->

                        <!-- Top4 Klassement -->
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 d-flex">
                        <div class="card">
                            <div class="header">
                                <div class="row clearfix">
                                    <div class="col-xs-12 col-sm-12">
                                        <div class="font-bold m-b--35">KLASSEMENT TOP 4</div>
                                        <br>
                                    </div>
                                </div>
                                <ul class="header-dropdown m-r--5">
                                    <li class="dropdown">
                                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                            <i class="material-icons">more_vert</i>
                                        </a>
                                        <ul class="dropdown-menu pull-right">
                                            <li><a href="klassement.php">Volledig Klassement</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
							
                            <div class="body">
                                <div class="row clearfix">
                                    <div class="col-xs-12 col-sm-12">                                        
                                            <?php  

                                                $sqlklassement = "SELECT bc18_users.user_name, bc18_users.first_name, bc18_klassement.totaal, bc18_users.pic_path FROM bc18_klassement inner join bc18_users on bc18_klassement.email = bc18_users.email WHERE bc18_users.verification = 1 ORDER BY totaal DESC, uitslag_correct DESC, winnaar_correct DESC LIMIT 4";
                                                $results = mysqli_query($db, $sqlklassement);
                                                if (!$results) {
                                                    printf("Error: %s\n", mysqli_error($db));
                                                    exit();
                                                  }
                                                $loop = 1;
                                                
                                                while($data = mysqli_fetch_array($results)){
                                                    if($data['pic_path']===''){
                                                        $afbeelding = '../images/users/noImage.jpg';
                                                    }
                                                    else{
                                                        $afbeelding = $data['pic_path'];
                                                    }
                                                    echo '
                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                                              <div>
                                                                <h6><center>'.$loop.'e plaats</center></h6>
                                                                <img src=" '.$afbeelding.'" alt="" class="img-circle img-responsive">
                                                                <div>
                                                                <br>
                                                                  <h4><center>'.$data['first_name'].'</center></h4>
                                                                  <h6 class="hidden-sm hidden-xs"><center>('.$data['user_name'].')</center></h5>                                                                  
                                                                  <div class="col-blue"><p><b><center>'.$data['totaal'].' ptn</center></b></p></div>
                                                                </div>
                                                              </div>
                                                            </div>';
                                                    $loop++;
                                                }
                                            ?>
                                    </div>
                                </div>
								</div>
                            </div>
                
                    </div>
                </div>
<!--             </div> -->
            <!-- #END# Top 4 Klassement -->


               <!-- NEXT GAME -->
                <?php
                    $sqlnext = "SELECT datum, game_id, team_home, team_away, home.team_crest AS homeflag, away.team_crest AS awayflag FROM bc18_games INNER JOIN bc18_teams AS home ON bc18_games.team_home = home.team_name INNER JOIN bc18_teams AS away ON bc18_games.team_away = away.team_name WHERE bettable = 1 AND status != 'FINISHED' ORDER BY datum ASC LIMIT 1 ";
                    $next = mysqli_query($db, $sqlnext);
                    if (!$next) {
                        printf("Error: %s\n", mysqli_error($db));
                        exit();
                      }
                    if($data = mysqli_fetch_array($next)){
                        $date = $data['datum'];
                        $nextGame = $data['game_id'];
                        $hometeam = $data['team_home'];
                        $awayteam = $data['team_away'];
                        $flagHome = $data['homeflag'];
                        $flagAway = $data['awayflag'];
                        }
                    ?>					
					
	
                <div class="row d-flex">
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 d-flex">
                        <div class="card">
                            <div class="body bg">
                                <div class="m-b--35 font-bold"> <center>VOLGENDE WEDSTRIJD</center></div>
                                <ul class="dashboard-stat-list">
                                    <li>                                           
                                            <div class="media">
                                            <center>
                                                <div class="media-left media-middle">                               
                                                    <a href="#">
                                                        <img class="media-object" src=<?php echo $flagHome; ?> width="23" height="15">
                                                    </a>
                                                </div>                                      
                                                <div class="media-body">
                                                    <h5> <?php echo $hometeam.' - '.$awayteam; ?></h5> 
                                                        <h7> <?php echo $date; ?> </h7>
                                                </div>
                                                <div class="media-right media-middle">
                                                <a href="#">
                                                    <img class="media-object" src=<?php echo $flagAway; ?> width="23" height="15">
                                                </a>
                                                </div>   
                                            </center>
                                            </div>                         
                                    </li>
                                        
                                </ul>
                                <?php
                                    $mail = $_SESSION['email'];
                                    $sqlnextbet = "SELECT bc18_pred_goalshome AS goalHome, bc18_pred_goalsaway AS goalAway, bc18_pred_penaltieshome AS penHome, bc18_pred_penaltiesaway AS penAway FROM bc18_bets WHERE bc18_userid = '$mail' AND bc18_gameid = '$nextGame'";
                                    $nextbet = mysqli_query($db, $sqlnextbet);
                                    if (!$nextbet) {
                                        printf("Error: %s\n", mysqli_error($db));
                                        exit();
                                      }
                                    if($data = mysqli_fetch_array($nextbet)){
                                        $goalHome = $data['goalHome'];
                                        $goalAway = $data['goalAway'];
                                        $penHome = $data['penHome'];
                                        $penAway = $data['penAway'];
                                        ?>

                                        <div class="media-middle col-blue">
                                          <center>      <big><b><?php echo $goalHome.' - '. $goalAway; ?></b></big> </center> <center> <small>MIJN GOK</small> </center>
                                        </div>
                                        <?php
                                        }
                                        else{
                                        ?>
                                        <div class="media-middle col-blue">
                                          <center>      <big><b>Nog geen bet voor deze wedstrijd</b></big> </center>
                                        </div>
                                        <?php    
                                        }

                                ?>   
                          
                            </div>
                        </div>
                    </div>

            <!-- #END# Latest Social Trends -->
            <!-- Answered Tickets -->
                <?php
                    $sqlbonus = "SELECT * FROM `bc18_predictedbonusses` WHERE user_id='$mail'";
                    $bonussen = mysqli_query($db, $sqlbonus);
                    if (!$bonussen) {
                        printf("Error: %s\n", mysqli_error($db));
                        exit();
                      }
                    if($data = mysqli_fetch_array($bonussen)){
                        $winnaar = $data['world_champion'];
                        $verliezer = $data['finalist'];
                        $topscorer = $data['topscorer'];
                        $vuilste = $data['dirty_team'];
                        $belgie = $data['pos_belgium'];
                    
                ?>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 d-flex">
                    <div class="card">
                        <div class="body bg">
                            <div class="font-bold m-b--35">MIJN BONUSSEN </div>
                            <ul class="dashboard-stat-list">
                                <li>
                                    WERELDKAMPIOEN
                                    <span class="pull-right col-blue"><b><?php echo strtoupper($winnaar); ?></b></span>
                                </li>
                                <li>
                                    VERLIEZEND FINALIST
                                    <span class="pull-right col-blue"><b><?php echo strtoupper($verliezer); ?></b></span>
                                </li>
                                <li>
                                    TOPSCHUTTER
                                    <span class="pull-right col-blue"><b><?php echo strtoupper($topscorer); ?></b></span>
                                </li>
                                <li>
                                    VUILSTE PLOEG
                                    <span class="pull-right col-blue"><b><?php echo strtoupper($vuilste); ?></b></span>
                                </li>
                                <li>
                                    POSITIE BELGIE
                                    <span class="pull-right col-blue"><b><?php echo strtoupper($belgie); ?></b></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php         
            }  
            else{ ?>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 d-flex">
                    <div class="card">
                        <div class="body bg">
                            <div class="font-bold m-b--35">MIJN BONUSSEN</div>
                            <div class="dashboard-stat-list"> 
                                Geef je bonussen in onder Gokken/Bonussen.
                            </div>
                        </div>
                    </div>
                </div>

            <?php }      ?>
         
            <!-- Answered Tickets -->
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 d-flex">
                    <div class="card">
                        <div class="body bg">
                            <div class="font-bold m-b--35">VORM</div> <br> <br>
							<div class="table-responsive">
								 <table class="table">
								  <thead>								  
									<tr>
										<th scope="col"><small></small></th>
										<th scope="col"><small>UITSLAG</small></th>
										<th scope="col"><small>GOK</small></th>
									</tr>									
								</thead>
								<tbody>
									<tr> 
										<td> <small>PANAMA - PANAMA </small></td>
										<td> <small>0-0</small> </td>
										<td><span class="col-blue"><b>1-0</b> </span></td>					
									</tr>
									<tr> 
										<td><small>PANAMA - PANAMA</small> </td>
										<td> <small>0-0 </small></td>
										<td><span class="col-blue"><b>1-0</b> </span></td>					
									</tr>
									<tr> 
										<td> <small>PANAMA - PANAMA </small></td>
										<td> <small>0-0</small> </td>
										<td><span class="col-blue"><b>1-0</b> </span></td>					
									</tr>
									<tr> 
										<td><small> PANAMA - PANAMA </small></td>
										<td><small> 0-0 </small></td>
										<td><span class="col-blue"><b>1-0</b> </span></td>					
									</tr>			
								</tbody>
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

    <!-- Jquery Knob Plugin Js -->
    <script src="../plugins/jquery-knob/jquery.knob.min.js"></script>

    <!-- Custom Js -->
    <script src="../js/admin.js"></script>
    <script src="../js/pages/charts/jquery-knob.js"></script>

    <!-- Demo Js -->
    <script src="../js/demo.js"></script>

    <?php $looper = 0; ?>
    <script>
        function getTimeRemaining(endtime) {
            var t = Date.parse(endtime) - Date.parse(new Date());
            var seconds = Math.floor((t / 1000) % 60);
            var minutes = Math.floor((t / 1000 / 60) % 60);
            var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
            var days = Math.floor(t / (1000 * 60 * 60 * 24));
            return {
            'total': t,
            'days': days,
            'hours': hours,
            'minutes': minutes,
            'seconds': seconds
            };
        }

        function initializeClock(endtime) {
            var daysSpan = document.getElementById('daysclock');
            var hoursSpan = document.getElementById('hoursclock');
            var minutesSpan = document.getElementById('minutesclock');
            var secondsSpan = document.getElementById('secondsclock');

            function updateClock() {
                var t = getTimeRemaining(endtime);
                function setClock(t){
                    $('.seconds').val(t.seconds).trigger('change').trigger('draw');
                    $('.minutes').val(t.minutes).trigger('change').trigger('draw');
                    $('.hours').val(t.hours).trigger('change').trigger('draw');
                    $('.days').val(t.days).trigger('change').trigger('draw');
                }
                if (t.total <= 0) {
                    // teller++;
                    // var deadline = new Date(Date.parse(new Date(deadlinesArray[teller])));
                    initializeClock(deadline);

                    //clearInterval(timeinterval);
                }
                setClock(t);
            }
            updateClock();
            var timeinterval = setInterval(updateClock, 1000);
        }
        // var deadline = new Date(Date.parse(new Date("June 14, 2018 16:00:00")));
        // var deadline = new Date(Date.parse(new Date("Jan 26, 2018 15:06:00")));
        // initializeClock(deadline);

        
        var deadlinestring = "<?php echo $deadlines; ?>";
        var deadlinesArray = deadlinestring.split(',');
        var teller = 0;
        var deadline = new Date(Date.parse(new Date(deadlinesArray[teller])));
        initializeClock(deadline);

    </script>
    
</body>

</html>