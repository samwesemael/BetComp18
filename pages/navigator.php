<?php 
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

  if (!isset($_SESSION['email'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: sign-in.php');
  }
  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['email']);
    header("location: sign-in.php");
  }

?>


<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Betcompetition WK2018</title>

    <!-- Favicon-->
    <link rel="icon" href="../images/favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Waves Effect Css -->
    <link href="../plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="../plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Sweetalert Css -->
    <link href="../plugins/sweetalert/sweetalert.css" rel="stylesheet" />
    
     <!-- Dropzone Css -->
    <link href="../plugins/dropzone/dropzone.css" rel="stylesheet">

    <!-- Bootstrap Core Css -->
    <link href="../plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
    
    <!-- Bootstrap Select Css -->
    <link href="../plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />


    <!-- Custom Css -->
    <link href="../css/style.css" rel="stylesheet">


    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../css/themes/all-themes.css" rel="stylesheet" />




</head>

<body class="theme-red">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
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
        echo "<script>
                var span = document.getElementById('notiflabel');
                var waarde = document.getElementById('notiflabel').innerHTML;
                if (waarde == '' || waarde == null){
                    while( span.firstChild ) {
                        span.removeChild( span.firstChild );
                    }
                    span.appendChild( document.createTextNode('1'));
                }
                else {
                    waarde = parseInt(waarde)+1;

                    while( span.firstChild ) {
                        span.removeChild( span.firstChild );
                    }
                    span.appendChild( document.createTextNode(waarde) );
                }
            </script>";
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

    if (!empty($_GET['notif'])) {
        $notification = $_GET['notif'];
        if($notification == "called"){
        $mail = $_SESSION['email'];
        $sqlnotif = "UPDATE bc18_notifications SET bc18_read=1 WHERE bc18_user = '$mail'";
        $results = mysqli_query($db, $sqlnotif);
    }
}
?>

    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="index.php">Betcompetition WK2018</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!-- Call Search 
                    <li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons">search</i></a></li> -->
                    <!-- #END# Call Search -->
                    <!-- Notifications -->
                    <?php
                        $mail = $_SESSION['email'];
                        $sql = "SELECT * FROM bc18_notifications WHERE bc18_read = 0 AND bc18_user = '$mail'";
                        $res = mysqli_query($db,$sql);
                        $aantal = mysqli_num_rows($res);

                        $sql = "SELECT * from bc18_notifications where bc18_user = '$mail' ORDER BY bc18_created DESC LIMIT 5";
                        $result = mysqli_query($db,$sql);
                    ?>

                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="material-icons">notifications</i>
                            <?php if($aantal != 0){ ?>
                                <span id="notiflabel" class="label-count"><?php echo $aantal; ?></span>
                            <?php }
                            else{ ?>
                                <span id="notiflabel" class="label-count"><?php echo ''; ?></span>
                            <?php } ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">NOTIFICATIONS</li>
                            <li class="body">
                                <ul class="menu" style="list-style-type: none;">
                                    <?php
                                        while ($data = mysqli_fetch_array($result)){
                                            // color are classes from style.css
                                            //options: 
                                            switch ($data['bc18_class']) {
                                                case "chat":
                                                    $icon = 'chat';
                                                    $color = 'bg-light-green';
                                                    break;
                                                case "mededeling":
                                                    $icon = 'add_shopping_cart';
                                                    $color = 'bg-blue-grey';
                                                    break;
                                                case "klassement":
                                                    $icon = 'format_list_numbered';
                                                    $color = 'bg-orange';
                                                    break;
                                                case "newUser":
                                                    $icon = 'person_add';
                                                    $color = 'bg-indigo';
                                                    break;
                                                case "achieve":
                                                    $icon = 'whatshot';
                                                    $color = 'bg-cyan';
                                                    break;
                                            }
                                            echo '
                                            <li>    
                                                <a href="'.$data['bc18_link'].'?notif=called">
                                                    <div class="icon-circle '.$color.'">
                                                        <i class="material-icons">'.$icon.'</i>
                                                    </div>
                                                    <div class="menu-info">
                                                        <h4>'.$data['bc18_message'].'</h4>
                                                        <p>
                                                            <i class="material-icons">access_time</i>'.$data['bc18_created'].'
                                                        </p>
                                                    </div>
                                                </a>
                                            </li>';
                                        }

                                    ?>
                            <li class="footer">
                                <a href="profile.php">View All Notifications</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <?php

                        $rank = "SELECT * from bc18_achieved where bc18_user = '$mail'";
                        // echo $sql;
                        $result = mysqli_query($db,$rank);
                        $numberofAchievements = mysqli_num_rows($result);

                ?>

                <div class="image">
                    <img src="<?php echo $_SESSION['profilepicpath'] ?>" width="48" height="48" alt="User" class="img-responsive"/>
                    <?php 
                    if( $numberofAchievements>5)
                        echo '<img src="../images/1star.svg" style="width:25px; position: absolute; top:40px; left:50px" />'; 
                    ?>
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['username']?></div>
                    <div class="email"><?php echo $_SESSION['email']?></div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="profile.php"><i class="material-icons">person</i>Profile</a></li>
                            <li role="seperator" class="divider"></li>
                            <li><a href="index.php?logout='1'""><i class="material-icons">input</i>Sign Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                
                    <li class="header">MAIN NAVIGATION</li>
                    <li id = 'nav-home'>
                        <a href="index.php">
                            <i class="material-icons">home</i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li <?php if($_SESSION['role']!='bc_18_admin')
                            {
                                echo 'style="display:none;"';
                            } ?> 
                            id = 'nav-adminpage'>
                        <a href="adminpage.php">
                            <i class="material-icons">account_circle</i>
                            <span>Admin</span>
                        </a>
                    </li>
                    <li id = 'nav-profile' hidden>
                        <a href="profile.php">
                            <i class="material-icons">today</i>
                            <span>Profile</span>
                        </a>
                    </li>
                    <li id="nav-gokken">
                        <a href="matchen_indienen.php">
                            <i class="material-icons">input</i>
                            <span>Betting</span>
                        </a>
                        
                    </li>
                    <li id = 'nav-klassement'>
                        <a href="klassement.php">
                            <i class="material-icons">format_list_numbered</i>
                            <span>Ranking</span>
                        </a>
                    </li>
                    <li id = 'nav-bonussen'>
                        <a href="bonussen.php">
                            <i class="material-icons">redeem</i>
                            <span>Bonusses</span>
                        </a>
                    </li>
                    <li
                    id = 'nav-matches'>
                        <a href="matches.php">
                            <i class="material-icons">today</i>
                            <span>Fixtures</span>
                        </a>
                    </li>
                                       
                    <li id = 'nav-rules'>
                        <a href="rules.php">
                            <i class="material-icons">book</i>
                            <span>Rules</span>
                        </a>
                    </li>
                    
                    <li id="nav-extra">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">pages</i>
                            <span>Extra</span>
                        </a>
                        <ul class="ml-menu">
                            <li id = 'nav-streaming'>
                                <a href="streaming.php">
                                <i class="material-icons">tv</i>
                                <span>Streaming</span>
                                </a>
                             <li id = 'nav-twitter'>
                                <a href="twitterfeed.php">
                                <i class="material-icons">whatshot</i>
                                <span>Social media</span>
                                </a>
                            </li>                                                                    
                            <li id = 'nav-maps'>
                                <a href="maps.php">
                                <i class="material-icons">map</i>
                                <span>Stadiums</span>
                                </a>
                            </li>
                            <li id = 'nav-contact'>                                
                                <a href="contact.php">                             
                                <i class="material-icons">chat</i>                              
                                <span>Contact</span>                               
                                </a>                            
                            </li> 
                        </ul>
                    </li>
                        
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; 2018 <a href="javascript:void(0);">Betcompetition WK2018</a>.
                </div>
                <div class="version">
                    <b>Version: </b> 0.0.69
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
        <!-- Right Sidebar -->
        <aside id="rightsidebar" class="right-sidebar">
            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                <li role="presentation" class="active"><a href="#skins" data-toggle="tab">SKINS</a></li>
                <li role="presentation"><a href="#settings" data-toggle="tab">SETTINGS</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active in active" id="skins">
                    <ul class="demo-choose-skin">
                        <li data-theme="red" class="active">
                            <div class="red"></div>
                            <span>Red</span>
                        </li>
                        <li data-theme="pink">
                            <div class="pink"></div>
                            <span>Pink</span>
                        </li>
                        <li data-theme="purple">
                            <div class="purple"></div>
                            <span>Purple</span>
                        </li>
                        <li data-theme="deep-purple">
                            <div class="deep-purple"></div>
                            <span>Deep Purple</span>
                        </li>
                        <li data-theme="indigo">
                            <div class="indigo"></div>
                            <span>Indigo</span>
                        </li>
                        <li data-theme="blue">
                            <div class="blue"></div>
                            <span>Blue</span>
                        </li>
                        <li data-theme="light-blue">
                            <div class="light-blue"></div>
                            <span>Light Blue</span>
                        </li>
                        <li data-theme="cyan">
                            <div class="cyan"></div>
                            <span>Cyan</span>
                        </li>
                        <li data-theme="teal">
                            <div class="teal"></div>
                            <span>Teal</span>
                        </li>
                        <li data-theme="green">
                            <div class="green"></div>
                            <span>Green</span>
                        </li>
                        <li data-theme="light-green">
                            <div class="light-green"></div>
                            <span>Light Green</span>
                        </li>
                        <li data-theme="lime">
                            <div class="lime"></div>
                            <span>Lime</span>
                        </li>
                        <li data-theme="yellow">
                            <div class="yellow"></div>
                            <span>Yellow</span>
                        </li>
                        <li data-theme="amber">
                            <div class="amber"></div>
                            <span>Amber</span>
                        </li>
                        <li data-theme="orange">
                            <div class="orange"></div>
                            <span>Orange</span>
                        </li>
                        <li data-theme="deep-orange">
                            <div class="deep-orange"></div>
                            <span>Deep Orange</span>
                        </li>
                        <li data-theme="brown">
                            <div class="brown"></div>
                            <span>Brown</span>
                        </li>
                        <li data-theme="grey">
                            <div class="grey"></div>
                            <span>Grey</span>
                        </li>
                        <li data-theme="blue-grey">
                            <div class="blue-grey"></div>
                            <span>Blue Grey</span>
                        </li>
                        <li data-theme="black">
                            <div class="black"></div>
                            <span>Black</span>
                        </li>
                    </ul>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="settings">
                    <div class="demo-settings">
                        <p>GENERAL SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Report Panel Usage</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Email Redirect</span>
                                <div class="switch">
                                    <label><input type="checkbox"><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                        <p>SYSTEM SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Notifications</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Auto Updates</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                        <p>ACCOUNT SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Offline</span>
                                <div class="switch">
                                    <label><input type="checkbox"><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Location Permission</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </aside>
        <!-- #END# Right Sidebar -->
    </section>
</body>