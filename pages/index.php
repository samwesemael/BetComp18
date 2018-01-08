<!DOCTYPE html>
<html>

<?php include 'navigator.php';?>
<script type="text/javascript">
    document.getElementById("nav-home").classList.toggle('active');
</script>

	
    <section class="content">
    
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
            <!-- CountDown Timer -->
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="row clearfix">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="body">
                                <div class="row clearfix">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                        <center><input id="daysclock" data-min="0" data-max="356" type="text" class="knob" data-width="90%" data-thickness="0.25" data-fgColor="#F44336" data-rotation=anticlockwise data-readOnly=true>
                                        DAGEN</center>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                        <center><input id="hoursclock" data-min="0" data-max="24" type="text" class="knob" data-width="90%" data-thickness="0.25" data-fgColor="#E91E63" data-rotation=anticlockwise
                                        data-readOnly = "true">
                                        UREN</center>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                        <center><input id="minutesclock" data-min="0" data-max="60" ype="text" class="knob" data-width="90%" data-thickness="0.25" data-fgColor="#00BCD4" data-rotation=anticlockwise data-readOnly="true">
                                        MINUTEN</center>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                        <center><input id="secondsclock" data-min="0" data-max="60" type="text" class="knob" data-width="90%" data-thickness="0.25" data-fgColor="#009688" data-rotation=anticlockwise data-readOnly="true">
                                        SECONDEN</center>
                                    </div>
                                </div>
                                <center><b> TILL WORLD CUP 2018</b></center> 
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
                                    // console.log('start');
                                    function setClock(t){
                                        // console.log('setCalled');
                                        daysSpan.setAttribute('value', t.days);
                                        hoursSpan.setAttribute('value', t.hours);
                                        minutesSpan.setAttribute('value', t.minutes);
                                        secondsSpan.setAttribute('value', t.seconds);
                                        // console.log('stop');
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
                                                include('server.php');
                                                $sqlklassement = "SELECT users.user_name, users.first_name, klassement.totaal, users.pic_path FROM klassement inner join users on klassement.email = users.email ORDER BY totaal DESC LIMIT 4";
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
            </div>
            <!-- #END# Top 4 Klassement -->


               <!-- NEXT GAME -->
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <div class="card">
                    <div class="body bg">
                        <div class="m-b--35 font-bold"> <center>VOLGENDE WEDSTRIJD</center></div>
                        <ul class="dashboard-stat-list">
                            <li>                                           
                                    <div class="media">
                                    <center>
                                        <div class="media-left media-middle">                               
                                            <a href="#">
                                                <img class="media-object" src="../images/flags/low_res/flag_por.png" width="23" height="15">
                                            </a>
                                        </div>                                      
                                        <div class="media-body">
                                            <h5>PORTUGAL - SPAIN</h5> 
                                                <h7> 15/6/2018 - 20:00 </h7>
                                        </div>
                                        <div class="media-right media-middle">
                                        <a href="#">
                                            <img class="media-object" src="../images/flags/low_res/flag_spa.png" width="23" height="15">
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
         
            <!-- Answered Tickets -->
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <div class="card">
                    <div class="body bg">
                        <div class="font-bold m-b--35">LAATSTE WEDSTRIJDEN</div>
                        <ul class="dashboard-stat-list">
                            <li>
                                PANAMA - PANAMA
                                <span class="pull-right col-blue"><b>0-0</b> <small></small></span>
                            </li>
                            <li>
                                PANAMA - PANAMA
                                <span class="pull-right col-blue"><b>0-0</b> <small></small></span>
                            </li>
                            <li>
                                PANAMA - PANAMA
                                <span class="pull-right col-blue"><b>0-0</b> <small></small></span>
                            </li>
                            <li>
                                PANAMA - PANAMA
                                <span class="pull-right col-blue"><b>0-0</b> <small></small></span>
                            </li>
                            <li>
                                PANAMA - PANAMA
                                <span class="pull-right col-blue"><b>GROEPSFASE</b> <small></small></span>
                            </li>
                        </ul>
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
</body>

</html>