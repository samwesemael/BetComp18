<?php include 'navigator.php';
    include 'server.php';
<!DOCTYPE html>
<html>

<!-- Link Swiper's CSS -->
  <link rel="stylesheet" href="../css/swiper.min.css">

  <!-- Demo styles -->
  <!-- Demo styles -->
    <style>
    html, body {
        position: relative;
        height: 100%;
    }
    body {
        background: #eee;
        font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
        font-size: 14px;
        color:#000;
        margin: 0;
        padding: 0;
    }
    .swiper-container {
        width: 100%;
        height: 100%;
    }
    .swiper-slide {
        text-align: center;
        font-size: 18px;
        background: #fff;

        /* Center slide text vertically */
        display: -webkit-box;
        display: -ms-flexbox;
        display: -webkit-flex;
        display: flex;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        -webkit-justify-content: center;
        justify-content: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        -webkit-align-items: center;
        align-items: center;
    }
    .swiper-pagination-bullet {
        width: 20px;
        height: 20px;
        text-align: center;
        line-height: 20px;
        font-size: 12px;
        color:#000;
        opacity: 1;
        background: rgba(0,0,0,0.2);
    }
    .swiper-pagination-bullet-active {
        color:#fff;
        background: #007aff;
    }
    </style>

<!-- navigator inladen en juist actief zetten -->


    $matchenPerDag = array(1, 3, 4, 3, 3, 3, 3, 3, 3, 3, 3, 4, 4, 4, 4, 2, 2, 2, 2, 2, 2, 1, 1, 1, 1);
    $speeldagen = array("2018-06-14", "2018-06-15", "2018-06-16", "2018-06-17", "2018-06-18", "2018-06-19", "2018-06-20", "2018-06-21", "2018-06-22", "2018-06-23", "2018-06-24", "2018-06-25", "2018-06-26", "2018-06-27", "2018-06-28", "2018-06-30", "2018-07-01", "2018-07-02", "2018-07-03", "2018-07-06", "2018-07-07", "2018-07-10", "2018-07-11", "2018-07-14", "2018-07-15");
    $eerste = true; 
    ?>
<script type="text/javascript">
    document.getElementById("nav-matches").classList.toggle('active');
</script>
    <section class="content">
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
                                $image= array('aaron.jpg', 'sam.jpg', 'stan.jpg', 'jordy.jpg');
                                $matchquery = "SELECT bc18_games.datum as datum, bc18_games.team_home as hometeam, bc18_games.team_away as awayteam, bc18_games.goals_home as goals_home, bc18_games.goals_away as goals_away, home.team_crest as homeflag, away.team_crest as awayflag FROM bc18_games INNER JOIN bc18_teams AS home ON bc18_games.team_home = home.team_name INNER JOIN bc18_teams AS away ON bc18_games.team_away = away.team_name WHERE bc18_games.datum between '2018-06-14' and '2018-06-28 23:59:59' ORDER BY bc18_games.datum ASC ";
                                $results = mysqli_query($db, $matchquery);
                                $i = 1;
                                $data = mysqli_fetch_array($results);
                                while ($data){
                                    $date = new DateTime($data['datum']);
                                    $dateCheck = $date->format('Y-m-d');
                                    echo 
                                        '<div role="tabpanel" class="tab-pane fade';
                                        if ($eerste == true){
                                            echo " active in";
                                            $eerste = false;
                                        }
                                        echo '" id="'.$i.'">';
                                        echo '<div class="swiper-container">
                                                <div class="swiper-wrapper">';
                                        $temp = $i-1;
                                        for($x=1;$x<=$matchenPerDag[$temp];$x++){
                                            if($x==1){
                                                echo '
                                                   <div class="swiper-slide">
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
                                                                                    <h4>'.$data['goals_home'].'-'.$data['goals_away'].'</h4>
                                                                                    <h6>'.$data['datum'].'</h6>
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
                                                                <div class="swiper-pagination"></div>
                                                            </div>

                                                        </div>';
                                            }                                        
                                            else{
                                                echo'
                                                    <div class="swiper-slide">
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
                                                                                    <h4>'.$data['goals_home'].'-'.$data['goals_away'].'</h4>
                                                                                    <h6>'.$data['datum'].'</h6>
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

                                                    </div>';
                                            }
                                        

                                        // echo '<div id="myCarousel'.$i.'" class="carousel slide" data-ride="carousel" data-interval="false">
                                        // <!-- Indicators -->
                                        // <ol class="carousel-indicators">';
                                        // $temp = $i-1;
                                        // for($x=1;$x<=$matchenPerDag[$temp];$x++){
                                        //     $tempx = $x-1;
                                        //     if($x==1){
                                        //         echo '<li data-target="#myCarousel'.$i.'" data-slide-to="'.$tempx.'" class="active"></li>';
                                        //         }    
                                        //     else{
                                        //         echo '<li data-target="#myCarousel'.$i.'" data-slide-to="'.$tempx.'"></li>';
                                        //         }
                                        //     }
                                        // echo '</ol><div class="carousel-inner">';
                                        // for($x=1;$x<=$matchenPerDag[$temp];$x++){
                                        //     if($x==1){
                                        //         echo '
                                        //             <div class="item active">
                                        //                 <div class="row clearfix">
                                        //                     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        //                         <div class="media">
                                        //                             <div class="media-left media-middle media-right">
                                        //                                 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                        //                                     <center><a href="#">
                                        //                                         <img class="media-object" src="'.$data['homeflag'].'" width="80%">
                                        //                                     </a></center>
                                        //                                 </div>
                                        //                                 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                        //                                     <div class="media-body media-middle centered-content">
                                        //                                         <center>
                                        //                                             <h3>'.$data['hometeam'].' - '.$data['awayteam'].'</h3> <br>
                                        //                                             <h4>'.$data['goals_home'].'-'.$data['goals_away'].'</h4>
                                        //                                             <h6>'.$data['datum'].'</h6>
                                        //                                         </center>
                                        //                                     </div>
                                        //                                 </div>
                                        //                                 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                        //                                     <center>
                                        //                                         <a href="#">
                                        //                                             <img class="media-object" src="'.$data['awayflag'].'" width="80%">
                                        //                                         </a>
                                        //                                     </center>
                                        //                                 </div>
                                        //                             </div>
                                        //                         </div>
                                        //                     </div>
                                        //                 </div>
                                        //             </div>';
                                        //     }
                                        //     else{
                                        //         echo'
                                        //             <div class="item">
                                        //                 <div class="row clearfix">
                                        //                     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        //                         <div class="media">
                                        //                             <div class="media-left media-middle media-right">
                                        //                                 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                        //                                     <center><a href="#">
                                        //                                         <img class="media-object" src="'.$data['homeflag'].'" width="80%">
                                        //                                     </a></center>
                                        //                                 </div>
                                        //                                 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                        //                                     <div class="media-body media-middle centered-content">
                                        //                                         <center>
                                        //                                             <h3>'.$data['hometeam'].' - '.$data['awayteam'].'</h3> <br>
                                        //                                             <h4>'.$data['goals_home'].'-'.$data['goals_away'].'</h4>
                                        //                                             <h6>'.$data['datum'].'</h6>
                                        //                                         </center>
                                        //                                     </div>
                                        //                                 </div>
                                        //                                 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                        //                                     <center>
                                        //                                         <a href="#">
                                        //                                             <img class="media-object" src="'.$data['awayflag'].'" width="80%">
                                        //                                         </a>
                                        //                                     </center>
                                        //                                 </div>
                                        //                             </div>
                                        //                         </div>
                                        //                     </div>
                                        //                 </div>
                                        //             </div>';
                                        //     }
                                            $data = mysqli_fetch_array($results);
                                        }
                                        if($matchenPerDag[$i-1] != 1){
                                            // echo '
                                            //   <!-- Left and right controls -->
                                            //   <a class="left carousel-control" href="#myCarousel'.$i.'" data-slide="prev">
                                            //     <span class="glyphicon glyphicon-chevron-left"></span>
                                            //     <span class="sr-only">Previous</span>
                                            //   </a>
                                            //   <a class="right carousel-control" href="#myCarousel'.$i.'" data-slide="next">
                                            //     <span class="glyphicon glyphicon-chevron-right"></span>
                                            //     <span class="sr-only">Next</span>
                                            //   </a>';
                                            }
                                        $i++;

                                        echo '</div><div class="swiper-pagination">
                                        
                                        </div></div></div>';
                                    }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
                <!-- Swiper JS -->
    <script src="../js/swiper.min.js"></script>


    <script>
    var swiper = new Swiper('.swiper-container', {
        pagination: '.swiper-pagination',
        paginationClickable: true,
        paginationBulletRender: function (swiper, index, className) {
            return '<span class="' + className + '">' + (index + 1) + '</span>';
        }
    });
    </script>
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
                                $image= array('aaron.jpg', 'sam.jpg', 'stan.jpg', 'jordy.jpg');
                                $matchquery = "SELECT bc18_games.datum as datum, bc18_games.team_home as hometeam, bc18_games.team_away as awayteam, bc18_games.goals_home as goals_home, bc18_games.goals_away as goals_away, home.team_crest as homeflag, away.team_crest as awayflag FROM bc18_games INNER JOIN bc18_teams AS home ON bc18_games.team_home = home.team_name INNER JOIN bc18_teams AS away ON bc18_games.team_away = away.team_name WHERE bc18_games.datum between '2018-06-30' and '2018-07-03 23:59:59' ORDER BY bc18_games.datum ASC LIMIT 15";
                                $results = mysqli_query($db, $matchquery);
                                $i = 16;
                                $data = mysqli_fetch_array($results);
                                $eerste = true;
                                while ($data){
                                    $date = new DateTime($data['datum']);
                                    $dateCheck = $date->format('Y-m-d');
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
                                                                                    <h4>'.$data['goals_home'].'-'.$data['goals_away'].'</h4>
                                                                                    <h6>'.$data['datum'].'</h6>
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
                                                                                    <h4>'.$data['goals_home'].'-'.$data['goals_away'].'</h4>
                                                                                    <h6>'.$data['datum'].'</h6>
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
                                $image= array('aaron.jpg', 'sam.jpg', 'stan.jpg', 'jordy.jpg');
                                $matchquery = "SELECT bc18_games.datum as datum, bc18_games.team_home as hometeam, bc18_games.team_away as awayteam, bc18_games.goals_home as goals_home, bc18_games.goals_away as goals_away, home.team_crest as homeflag, away.team_crest as awayflag FROM bc18_games INNER JOIN bc18_teams AS home ON bc18_games.team_home = home.team_name INNER JOIN bc18_teams AS away ON bc18_games.team_away = away.team_name WHERE bc18_games.datum between '2018-07-06' and '2018-07-07 23:59:59' ORDER BY bc18_games.datum ASC LIMIT 15";
                                $results = mysqli_query($db, $matchquery);
                                $i = 20;
                                $data = mysqli_fetch_array($results);
                                $eerste = true;
                                while ($data){
                                    $date = new DateTime($data['datum']);
                                    $dateCheck = $date->format('Y-m-d');
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
                                                                                    <h4>'.$data['goals_home'].'-'.$data['goals_away'].'</h4>
                                                                                    <h6>'.$data['datum'].'</h6>
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
                                                                                    <h4>'.$data['goals_home'].'-'.$data['goals_away'].'</h4>
                                                                                    <h6>'.$data['datum'].'</h6>
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
                                $image= array('aaron.jpg', 'sam.jpg', 'stan.jpg', 'jordy.jpg');
                                $matchquery = "SELECT bc18_games.datum as datum, bc18_games.team_home as hometeam, bc18_games.team_away as awayteam, bc18_games.goals_home as goals_home, bc18_games.goals_away as goals_away, home.team_crest as homeflag, away.team_crest as awayflag FROM bc18_games INNER JOIN bc18_teams AS home ON bc18_games.team_home = home.team_name INNER JOIN bc18_teams AS away ON bc18_games.team_away = away.team_name WHERE bc18_games.datum between '2018-07-10' and '2018-07-11 23:59:59' ORDER BY bc18_games.datum ASC LIMIT 15";
                                $results = mysqli_query($db, $matchquery);
                                $i = 22;
                                $data = mysqli_fetch_array($results);
                                $eerste = true;
                                while ($data){
                                    $date = new DateTime($data['datum']);
                                    $dateCheck = $date->format('Y-m-d');
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
                                                                                    <h3>'.$data['hometeam'].' - '.$data['awayteam'].'</h3> <br>';
                                                                                    echo 
                                                                                    '<h4>'.$data['goals_home'].'-'.$data['goals_away'].'</h4>';
                                                                                    echo '<h6>'.$data['datum'].'</h6>
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
                                                                                    <h4>'.$data['goals_home'].'-'.$data['goals_away'].'</h4>
                                                                                    <h6>'.$data['datum'].'</h6>
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
                                $image= array('aaron.jpg', 'sam.jpg', 'stan.jpg', 'jordy.jpg');
                                $matchquery = "SELECT bc18_games.datum as datum, bc18_games.team_home as hometeam, bc18_games.team_away as awayteam, bc18_games.goals_home as goals_home, bc18_games.goals_away as goals_away, home.team_crest as homeflag, away.team_crest as awayflag FROM bc18_games INNER JOIN bc18_teams AS home ON bc18_games.team_home = home.team_name INNER JOIN bc18_teams AS away ON bc18_games.team_away = away.team_name WHERE bc18_games.datum between '2018-07-14' and '2018-07-1 5 23:59:59' ORDER BY bc18_games.datum ASC LIMIT 15";
                                $results = mysqli_query($db, $matchquery);
                                $i = 24;
                                $data = mysqli_fetch_array($results);
                                $eerste = true;
                                while ($data){
                                    $date = new DateTime($data['datum']);
                                    $dateCheck = $date->format('Y-m-d');
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
                                                                                    <h4>'.$data['goals_home'].'-'.$data['goals_away'].'</h4>
                                                                                    <h6>'.$data['datum'].'</h6>
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
                                                                                    <h4>'.$data['goals_home'].'-'.$data['goals_away'].'</h4>
                                                                                    <h6>'.$data['datum'].'</h6>
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