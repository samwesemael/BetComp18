<!DOCTYPE html>
<html>

<?php include 'navigator.php';?>
<script type="text/javascript">
    document.getElementById("nav-home").classList.toggle('active');
</script>

	
    <section class="content">
        <div class="container-fluid">
		<!--
            <div class="block-header">
                <h2>DASHBOARD</h2>
            </div> -->
			
			<!-- MEDEDELINGEN -->
			<div class="row clearfix">
			      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="info-box-4 hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons col-green">announcement</i>
                        </div>
                        <div class="content">
                            <div class="text"><b>MEDEDELINGEN</b></div>
                            <div class="text">Jullie zijn allemaal lelijk.</div>
                        </div>
                    </div>
				</div>
			</div>

        	<!-- CountDown Timer -->
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="row clearfix">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>Countdown</h2>
                                <ul class="header-dropdown m-r--5">
                                    <li class="dropdown">
                                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                            <i class="material-icons">more_vert</i>
                                        </a>
                                        <ul class="dropdown-menu pull-right">
                                            <li><a href="javascript:void(0);">Action</a></li>
                                            <li><a href="javascript:void(0);">Another action</a></li>
                                            <li><a href="javascript:void(0);">Something else here</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <div class="body">
                                <div class="row clearfix">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                        <input id="daysclock" data-min="0" data-max="200" type="text" class="knob days" data-readOnly=true data-width="80%" data-thickness="0.25" data-fgColor="#F44336" data-rotation=anticlockwise>

                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                        <input id="hoursclock" data-min="0" data-max="24" type="text" class="knob hour" data-readOnly=true data-width="80%" data-thickness="0.25" data-fgColor="#E91E63" data-rotation=anticlockwise>
                                        
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                        <input id="minutesclock" data-min="0" data-max="60" type="text" class="knob minute" data-readOnly=true data-width="80%" data-thickness="0.25" data-fgColor="#00BCD4" data-rotation=anticlockwise>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                        <input id="secondsclock" data-min="0" data-max="60" type="text" class="knob second" data-readOnly=true data-width="80%" data-thickness="0.25" data-fgColor="#009688" data-rotation=anticlockwise>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                console.log('start');
                                function setClock(t){
                                    console.log('setCalled');
                                    daysSpan.setAttribute('value', t.days);
                                    hoursSpan.setAttribute('value', t.hours);
                                    minutesSpan.setAttribute('value', t.minutes);
                                    secondsSpan.setAttribute('value', t.seconds);
                                    console.log('stop');
                                }
                                

                                if (t.total <= 0) {
                                    clearInterval(timeinterval);
                                }
                                setClock(t);
                            }

                            updateClock();
                            //var timeinterval = setInterval(updateClock, 3000);
                            }

                            var deadline = new Date(Date.parse(new Date("June 14, 2018 16:00:00")));
                            initializeClock(deadline);
                    </script>
                    <!-- #END# Basic Example -->
                    <!-- END CountDown Timer -->

                    <!-- Top4 Klassement -->
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="card">
                            <div class="header">
                                <div class="row clearfix">
                                    <div class="col-xs-12 col-sm-12">
                                        <h2>Klassement Top 4</h2>
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
                                                include('server.php');
                                                $sqlklassement = "SELECT users.user_name, klassement.totaal, users.pic_path FROM klassement inner join users on klassement.email = users.email ORDER BY totaal DESC LIMIT 4";
                                                $results = mysqli_query($db, $sqlklassement);
                                                if (!$results) {
                                                    printf("Error: %s\n", mysqli_error($conn));
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
                                                                <img src=" '.$afbeelding.'" alt="" class="img-circle img-responsive">
                                                                <div>
                                                                <br>
                                                                  <h4><center>'.$data['user_name'].'</center></h4>
                                                                  <h5 class="role"><center>'.$loop.'e plaats</center></h5>
                                                                  <p><center>'.$data['totaal'].' punten</center></p>
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
            </div>
            <!-- #END# Top 4 Klassement -->


            <div>
                <!-- Visitors -->
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="card">
                        <div class="body bg-pink">
                            <div class="sparkline" data-type="line" data-spot-Radius="4" data-highlight-Spot-Color="rgb(233, 30, 99)" data-highlight-Line-Color="#fff"
                                 data-min-Spot-Color="rgb(255,255,255)" data-max-Spot-Color="rgb(255,255,255)" data-spot-Color="rgb(255,255,255)"
                                 data-offset="90" data-width="100%" data-height="92px" data-line-Width="2" data-line-Color="rgba(255,255,255,0.7)"
                                 data-fill-Color="rgba(0, 188, 212, 0)">
                                12,10,9,6,5,6,10,5,7,5,12,13,7,12,11
                            </div>
                            <ul class="dashboard-stat-list">
                                <li>
                                    TODAY
                                    <span class="pull-right"><b>1 200</b> <small>USERS</small></span>
                                </li>
                                <li>
                                    YESTERDAY
                                    <span class="pull-right"><b>3 872</b> <small>USERS</small></span>
                                </li>
                                <li>
                                    LAST WEEK
                                    <span class="pull-right"><b>26 582</b> <small>USERS</small></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- #END# Visitors -->
                <!-- Latest Social Trends -->
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="card">
					<div
                        <div class="body bg">
                            <div class="m-b--35 font-bold"> <center>VOLGENDE WEDSTRIJD</center></div>
                            <ul class="dashboard-stat-list">
                                <li>									       
										<div class="media">
										<center>
										<div class="media-left media-middle">								
											<a href="#">
												<img class="media-object" src="../images/flags/flag_por.png" width="23" height="15">
											</a>
										</div>										
										<div class="media-body">
											<h5>PORTUGAL - SPAIN</h5> 
												<h7> 15/6/2018 - 20:00 </h7>
										</div>
										<div class="media-right media-middle">
										<a href="#">
											<img class="media-object" src="../images/flags/flag_spa.png" width="23" height="15">
										</a>
										</div>   
										</center>
									</div>							
								</li>
									
                            </ul>	
<div class="media-middle col-blue">
						                      <center>      <big><b>2-2</b></big> </center> <center> <small>MIJN GOK</small> </center>
									</div>							
                        </div>
                    </div>
                </div>
                <!-- #END# Latest Social Trends -->
                <!-- Answered Tickets -->
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="card">
                        <div class="body bg">
                            <div class="font-bold m-b--35">MIJN BONUSSEN</div>
                            <ul class="dashboard-stat-list">
                                <li>
                                    WERELDKAMPIOEN
                                    <span class="pull-right col-blue"><b>COSTA RICA</b> <small></small></span>
                                </li>
                                <li>
                                    VERLIEZEND FINALIST
                                    <span class="pull-right col-blue"><b>PANAMA</b> <small></small></span>
                                </li>
                                <li>
                                    TOPSCHUTTER
                                    <span class="pull-right col-blue"><b>COURTOIS</b> <small></small></span>
                                </li>
                                <li>
                                    VUILSTE PLOEG
                                    <span class="pull-right col-blue"><b>BELGIE</b> <small></small></span>
                                </li>
                                <li>
                                    POSITIE BELGIE
                                    <span class="pull-right col-blue"><b>GROEPSFASE</b> <small></small></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- #END# Answered Tickets -->
            </div>
            <!-- CPU Usage -->
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <div class="row clearfix">
                                <div class="col-xs-12 col-sm-6">
                                    <h2>CPU USAGE (%)</h2>
                                </div>
                                <div class="col-xs-12 col-sm-6 align-right">
                                    <div class="switch panel-switch-btn">
                                        <span class="m-r-10 font-12">REAL TIME</span>
                                        <label>OFF<input type="checkbox" id="realtime" checked><span class="lever switch-col-cyan"></span>ON</label>
                                    </div>
                                </div>
                            </div>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div id="real_time_chart" class="dashboard-flot-chart"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# CPU Usage -->
            <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                    <div class="card">
                        <div class="header">
                            <h2>TASK INFOS</h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Task</th>
                                            <th>Status</th>
                                            <th>Manager</th>
                                            <th>Progress</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Task A</td>
                                            <td><span class="label bg-green">Doing</span></td>
                                            <td>John Doe</td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar bg-green" role="progressbar" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100" style="width: 62%"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Task B</td>
                                            <td><span class="label bg-blue">To Do</span></td>
                                            <td>John Doe</td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar bg-blue" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Task C</td>
                                            <td><span class="label bg-light-blue">On Hold</span></td>
                                            <td>John Doe</td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar bg-light-blue" role="progressbar" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100" style="width: 72%"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>Task D</td>
                                            <td><span class="label bg-orange">Wait Approvel</span></td>
                                            <td>John Doe</td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar bg-orange" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100" style="width: 95%"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>Task E</td>
                                            <td>
                                                <span class="label bg-red">Suspended</span>
                                            </td>
                                            <td>John Doe</td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar bg-red" role="progressbar" aria-valuenow="87" aria-valuemin="0" aria-valuemax="100" style="width: 87%"></div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Task Info -->
                <!-- Browser Usage -->
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="card">
                        <div class="header">
                            <h2>BROWSER USAGE</h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div id="donut_chart" class="dashboard-donut-chart"></div>
                        </div>
                    </div>
                </div>
                <!-- #END# Browser Usage -->
				
			 <!-- Widgets -->
            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">playlist_add_check</i>
                        </div>
                        <div class="content">
                            <div class="text">NEW TASKS</div>
                            <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">help</i>
                        </div>
                        <div class="content">
                            <div class="text">NEW TICKETS</div>
                            <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">forum</i>
                        </div>
                        <div class="content">
                            <div class="text">NEW COMMENTS</div>
                            <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-orange hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">person_add</i>
                        </div>
                        <div class="content">
                            <div class="text">NEW VISITORS</div>
                            <div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Widgets -->			
			
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

    <!-- Jquery CountTo Plugin Js -->
    <script src="../plugins/jquery-countto/jquery.countTo.js"></script>

    <!-- Morris Plugin Js -->
    <script src="../plugins/raphael/raphael.min.js"></script>
    <script src="../plugins/morrisjs/morris.js"></script>

    <!-- ChartJs -->
    <script src="../plugins/chartjs/Chart.bundle.js"></script>

    <!-- Flot Charts Plugin Js -->
    <script src="../plugins/flot-charts/jquery.flot.js"></script>
    <script src="../plugins/flot-charts/jquery.flot.resize.js"></script>
    <script src="../plugins/flot-charts/jquery.flot.pie.js"></script>
    <script src="../plugins/flot-charts/jquery.flot.categories.js"></script>
    <script src="../plugins/flot-charts/jquery.flot.time.js"></script>

    <!-- Sparkline Chart Plugin Js -->
    <script src="../plugins/jquery-sparkline/jquery.sparkline.js"></script>

    <!-- Custom Js -->
    <script src="../js/admin.js"></script>
    <script src="../js/pages/index.js"></script>

    <!-- Demo Js -->
    <script src="../js/demo.js"></script>

    <!-- Jquery Knob Plugin Js -->
    <script src="../plugins/jquery-knob/jquery.knob.min.js"></script>
    <script src="../js/pages/charts/jquery-knob.js"></script>

</body>

</html>