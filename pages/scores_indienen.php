<?php 
  session_start(); 

  if (!isset($_SESSION['email'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ./pages/sign-in.php');
  }
  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['email']);
    header("location: pages/sign-in.php");
  }
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Betcompetition WK2018</title>

    <!-- Favicon-->
    <link rel="icon" href="../favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="../plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="../plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="../plugins/animate-css/animate.css" rel="stylesheet" />

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
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="widgets/../../index.html">Betcompetition WK2018</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!-- Call Search -->
                    <li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons">search</i></a></li>
                    <!-- #END# Call Search -->
                    <!-- Notifications -->
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="material-icons">notifications</i>
                            <span class="label-count">7</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">NOTIFICATIONS</li>
                            <li class="body">
                                <ul class="menu">
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-light-green">
                                                <i class="material-icons">person_add</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4>12 new members joined</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 14 mins ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-cyan">
                                                <i class="material-icons">add_shopping_cart</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4>4 sales made</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 22 mins ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-red">
                                                <i class="material-icons">delete_forever</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4><b>Nancy Doe</b> deleted account</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 3 hours ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-orange">
                                                <i class="material-icons">mode_edit</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4><b>Nancy</b> changed name</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 2 hours ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-blue-grey">
                                                <i class="material-icons">comment</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4><b>John</b> commented your post</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 4 hours ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-light-green">
                                                <i class="material-icons">cached</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4><b>John</b> updated status</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 3 hours ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-purple">
                                                <i class="material-icons">settings</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4>Settings updated</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> Yesterday
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="footer">
                                <a href="javascript:void(0);">View All Notifications</a>
                            </li>
                        </ul>
                    </li>
                    <!-- #END# Notifications -->
                    <!-- Tasks -->
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="material-icons">flag</i>
                            <span class="label-count">9</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">TASKS</li>
                            <li class="body">
                                <ul class="menu tasks">
                                    <li>
                                        <a href="javascript:void(0);">
                                            <h4>
                                                Footer display issue
                                                <small>32%</small>
                                            </h4>
                                            <div class="progress">
                                                <div class="progress-bar bg-pink" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 32%">
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <h4>
                                                Make new buttons
                                                <small>45%</small>
                                            </h4>
                                            <div class="progress">
                                                <div class="progress-bar bg-cyan" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <h4>
                                                Create new dashboard
                                                <small>54%</small>
                                            </h4>
                                            <div class="progress">
                                                <div class="progress-bar bg-teal" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 54%">
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <h4>
                                                Solve transition issue
                                                <small>65%</small>
                                            </h4>
                                            <div class="progress">
                                                <div class="progress-bar bg-orange" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 65%">
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <h4>
                                                Answer GitHub questions
                                                <small>92%</small>
                                            </h4>
                                            <div class="progress">
                                                <div class="progress-bar bg-purple" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 92%">
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="footer">
                                <a href="javascript:void(0);">View All Tasks</a>
                            </li>
                        </ul>
                    </li>
                    <!-- #END# Tasks -->
                    <li class="pull-right"><a href="javascript:void(0);" class="js-right-sidebar" data-close="true"><i class="material-icons">more_vert</i></a></li>
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
                <div class="image">
                    <img src="../images/user.png" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">John Doe</div>
                    <div class="email"><?php echo $_SESSION['email']?></div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                            <li role="seperator" class="divider"></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">group</i>Followers</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">shopping_cart</i>Sales</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">favorite</i>Likes</a></li>
                            <li role="seperator" class="divider"></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">input</i>Sign Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>
                    <li>
                        <a href="../index.php">
                            <i class="material-icons">home</i>
                            <span>Home</span>
                        </a>
                    </li>
					<li class="active">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">archive</i>
                            <span>Gokken</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="matchen_indienen.php">Matchen</a>
                              
                            </li>
                            <li>
                               <a href="bonussen_indienen.php">Bonussen</a>
                               
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="klassement.php">
                            <i class="material-icons">format_list_numbered</i>
                            <span>Klassement</span>
                        </a>
                    </li>
                    <li>
                        <a href="bonussen.php">
                            <i class="material-icons">redeem</i>
                            <span>Bonussen</span>
                        </a>
                    </li>
                    <li>
                        <a href="matches.php">
                            <i class="material-icons">today</i>
                            <span>Matches</span>
                        </a>
                    </li>
                            <li>
                        <a href="twitterfeed.php">
                            <i class="material-icons">whatshot</i>
                            <span>Twitterfeed</span>
                        </a>
                    </li>
                    
                    <li>
                        <a href="rules.php">
                            <i class="material-icons">book</i>
                            <span>Spelregels</span>
                        </a>
                    </li>
                    <li>
                        <a href="../pages/typography.html">
                            <i class="material-icons">text_fields</i>
                            <span>Typography</span>
                        </a>
                    </li>
                    <li>
                        <a href="../pages/helper-classes.html">
                            <i class="material-icons">layers</i>
                            <span>Helper Classes</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">widgets</i>
                            <span>Widgets</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="javascript:void(0);" class="menu-toggle">
                                    <span>Cards</span>
                                </a>
                                <ul class="ml-menu">
                                    <li>
                                        <a href="../pages/widgets/cards/basic.html">Basic</a>
                                    </li>
                                    <li>
                                        <a href="../pages/widgets/cards/colored.html">Colored</a>
                                    </li>
                                    <li>
                                        <a href="../pages/widgets/cards/no-header.html">No Header</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="menu-toggle">
                                    <span>Infobox</span>
                                </a>
                                <ul class="ml-menu">
                                    <li>
                                        <a href="../pages/widgets/infobox/infobox-1.html">Infobox-1</a>
                                    </li>
                                    <li>
                                        <a href="../pages/widgets/infobox/infobox-2.html">Infobox-2</a>
                                    </li>
                                    <li>
                                        <a href="../pages/widgets/infobox/infobox-3.html">Infobox-3</a>
                                    </li>
                                    <li>
                                        <a href="../pages/widgets/infobox/infobox-4.html">Infobox-4</a>
                                    </li>
                                    <li>
                                        <a href="../pages/widgets/infobox/infobox-5.html">Infobox-5</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">swap_calls</i>
                            <span>User Interface (UI)</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="../pages/ui/alerts.html">Alerts</a>
                            </li>
                            <li>
                                <a href="../pages/ui/animations.html">Animations</a>
                            </li>
                            <li>
                                <a href="../pages/ui/badges.html">Badges</a>
                            </li>

                            <li>
                                <a href="../pages/ui/breadcrumbs.html">Breadcrumbs</a>
                            </li>
                            <li>
                                <a href="../pages/ui/buttons.html">Buttons</a>
                            </li>
                            <li>
                                <a href="../pages/ui/collapse.html">Collapse</a>
                            </li>
                            <li>
                                <a href="../pages/ui/colors.html">Colors</a>
                            </li>
                            <li>
                                <a href="../pages/ui/dialogs.html">Dialogs</a>
                            </li>
                            <li>
                                <a href="../pages/ui/icons.html">Icons</a>
                            </li>
                            <li>
                                <a href="../pages/ui/labels.html">Labels</a>
                            </li>
                            <li>
                                <a href="../pages/ui/list-group.html">List Group</a>
                            </li>
                            <li>
                                <a href="../pages/ui/media-object.html">Media Object</a>
                            </li>
                            <li>
                                <a href="../pages/ui/modals.html">Modals</a>
                            </li>
                            <li>
                                <a href="../pages/ui/notifications.html">Notifications</a>
                            </li>
                            <li>
                                <a href="../pages/ui/pagination.html">Pagination</a>
                            </li>
                            <li>
                                <a href="../pages/ui/preloaders.html">Preloaders</a>
                            </li>
                            <li>
                                <a href="../pages/ui/progressbars.html">Progress Bars</a>
                            </li>
                            <li>
                                <a href="../pages/ui/range-sliders.html">Range Sliders</a>
                            </li>
                            <li>
                                <a href="../pages/ui/sortable-nestable.html">Sortable & Nestable</a>
                            </li>
                            <li>
                                <a href="../pages/ui/tabs.html">Tabs</a>
                            </li>
                            <li>
                                <a href="../pages/ui/thumbnails.html">Thumbnails</a>
                            </li>
                            <li>
                                <a href="../pages/ui/tooltips-popovers.html">Tooltips & Popovers</a>
                            </li>
                            <li>
                                <a href="../pages/ui/waves.html">Waves</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">assignment</i>
                            <span>Forms</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="../pages/forms/basic-form-elements.html">Basic Form Elements</a>
                            </li>
                            <li>
                                <a href="../pages/forms/advanced-form-elements.html">Advanced Form Elements</a>
                            </li>
                            <li>
                                <a href="../pages/forms/form-examples.html">Form Examples</a>
                            </li>
                            <li>
                                <a href="../pages/forms/form-validation.html">Form Validation</a>
                            </li>
                            <li>
                                <a href="../pages/forms/form-wizard.html">Form Wizard</a>
                            </li>
                            <li>
                                <a href="../pages/forms/editors.html">Editors</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">view_list</i>
                            <span>Tables</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="../pages/tables/normal-tables.html">Normal Tables</a>
                            </li>
                            <li>
                                <a href="../pages/tables/jquery-datatable.html">Jquery Datatables</a>
                            </li>
                            <li>
                                <a href="../pages/tables/editable-table.html">Editable Tables</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">perm_media</i>
                            <span>Medias</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="../pages/medias/image-gallery.html">Image Gallery</a>
                            </li>
                            <li>
                                <a href="../pages/medias/carousel.html">Carousel</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">pie_chart</i>
                            <span>Charts</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="../pages/charts/morris.html">Morris</a>
                            </li>
                            <li>
                                <a href="../pages/charts/flot.html">Flot</a>
                            </li>
                            <li>
                                <a href="../pages/charts/chartjs.html">ChartJS</a>
                            </li>
                            <li>
                                <a href="../pages/charts/sparkline.html">Sparkline</a>
                            </li>
                            <li>
                                <a href="../pages/charts/jquery-knob.html">Jquery Knob</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">content_copy</i>
                            <span>Example Pages</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="../pages/examples/sign-in.html">Sign In</a>
                            </li>
                            <li>
                                <a href="../pages/examples/sign-up.html">Sign Up</a>
                            </li>
                            <li>
                                <a href="../pages/examples/forgot-password.html">Forgot Password</a>
                            </li>
                            <li>
                                <a href="../pages/examples/blank.html">Blank Page</a>
                            </li>
                            <li>
                                <a href="../pages/examples/404.html">404 - Not Found</a>
                            </li>
                            <li>
                                <a href="../pages/examples/500.html">500 - Server Error</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">map</i>
                            <span>Maps</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="../pages/maps/google.html">Google Map</a>
                            </li>
                            <li>
                                <a href="../pages/maps/yandex.html">YandexMap</a>
                            </li>
                            <li>
                                <a href="../pages/maps/jvectormap.html">jVectorMap</a>
                            </li>
                        </ul>
                    </li>
			
					            				
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; 2016 - 2017 <a href="javascript:void(0);">AdminBSB - Material Design</a>.
                </div>
                <div class="version">
                    <b>Version: </b> 1.0.5
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

    <section class="content">
	
	<div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Gokken indienen
						     </h2>
							 <br>                     
                 
                        </div>
						
						
					
                        <div class="body">
						
						<div class="panel-group" id="accordion_1" role="tablist" aria-multiselectable="true">
                                        <div class="panel panel-primary">
                                            <div class="panel-heading" role="tab" id="headingOne_1">
                                                <h4 class="panel-title">
                                                    <a role="button" data-toggle="collapse" data-parent="#accordion_1" href="#collapseOne_1" aria-expanded="true" aria-controls="collapseOne_1">
                                                        Bonussen
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseOne_1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_1">
                                                <div class="panel-body">
												
												 <ul class="nav nav-tabs tab-nav-right" role="tablist">
							<!-- TODO: active de speeldag van die dag laten zijn -->
                                <li role="presentation" class="active"><a href="#1" data-toggle="tab">1</a></li>
                                <li role="presentation"><a href="#2" data-toggle="tab">2</a></li>
                                <li role="presentation"><a href="#3" data-toggle="tab">3</a></li>
                                <li role="presentation"><a href="#4" data-toggle="tab">4</a></li>
                                <li role="presentation"><a href="#5" data-toggle="tab">5</a></li>
                                <li role="presentation"><a href="#6" data-toggle="tab">6</a></li>
                                <li role="presentation"><a href="#7" data-toggle="tab">7</a></li>
                                <li role="presentation"><a href="#8" data-toggle="tab">8</a></li>
                                <li role="presentation"><a href="#9" data-toggle="tab">9</a></li>
                                <li role="presentation"><a href="#10" data-toggle="tab">10</a></li>
                                <li role="presentation"><a href="#11" data-toggle="tab">11</a></li>
                                <li role="presentation"><a href="#12" data-toggle="tab">12</a></li>
                                <li role="presentation"><a href="#13" data-toggle="tab">13</a></li>
                                <li role="presentation"><a href="#14" data-toggle="tab">14</a></li>
                                <li role="presentation"><a href="#15" data-toggle="tab">15</a></li>
												</ul>
                                                   
                                                </div>
												
								<div class="tab-content">
							
							
                                <div role="tabpanel" class="tab-pane fade in active" id="1">
								<div class="media">
                                <div class="media-left media-middle">
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <a href="#">
                                        <img class="media-object" src="../images/flags/flag_rus.png" width="64" height="64">
                                    </a>
                                </div>
								
                                <div class="media-body media-middle centered-content">
                                     <h6>RUSLAND - SAUDI-ARABIA</h6> <br>
									  <h5>2-2</h5>
                                </div>
                                <div class="media-right media-middle">
                                    <a href="#">
                                        <img class="media-object" src="../images/flags/flag_sau.png" width="64" height="64">
                                    </a>
                                
                            </div>
                                  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    </div>
                        <div class="header">
                            <h3>
                                Scores
							</h3>                                                   
                            
                       
                        <div class="body table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>                                
                                        <th>Naam</th>
										<th>Score</th>
										<th>Punten</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                   
                                        <td>Mark</td>
										<td>2-2</td>
										<td>3</td>

                                    </tr>
                                    <tr>
                              
                                        <td>Jacob</td>
										<td>2-2</td>
										<td>3</td>
                                    </tr>
                                    <tr>
                         
                                        <td>Larry</td>
										<td>2-2</td>
										<td>3</td>
                                    </tr>
                                    <tr>
                              
                                        <td>Larry</td>
											<td>2-2</td>
											<td>3</td>
                                    </tr>
                                    <tr>
                          
                                        <td>Larry</td>
										<td>2-2</td>
										<td>3</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
				
                  </div>
            
				</div>
				</div>				
				</div>				
	
	
	
	 <div class="container-fluid">
			 <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">	
					<div class="header">
                            <h1>
                                Spelregels
                            </h1>
							</div>
					 <div class="body">
					   <h3>Wedstrijden</h3>
					      <p> We gokken op 1 wedstrijd per dag (de leukste affiche, bij twijfel de wedstrijd ‘s avonds), dit zijn in totaal 23 wedstrijden.</p>
					<h3> Punten </h3>
					
					<p> Iedereen geeft voor aanvang van de wedstrijd zijn gok voor de einduitslag mee. Indien volledig juist: 3 punten, indien de winnaar of gelijkspel juist: 1 punt. De laatste 3 wedstrijden (de 2 halve finales en de finale) zijn dubbel zo belangrijk en daarvoor krijg je respectievelijk 6 en 2 punten. 
					De score die je indient is de score na 120'. Wanneer je een gelijkspel indient tijdens de knockoutfase, vul je in het vakje 'extra' ook de winnaar van de penalties in. De puntenverdeling is dan als volgt: je had het gelijkspel voor de penalties perfect juist: 3 punten, je hebt gelijkspel gegokt, maar geen exacte score: 1 punt, wanneer je de winnaar van de penalties ook nog eens juist hebt, komt bij beiden nog 1 punt bij. 
                    Indien er na puntenverdeling van alle wedstrijden een gelijkstand plaatsvindt zijn dit de volgende criteria waarop je positie bepaald wordt :
                                <ol>
                                <li>Aantal maal de score volledig correct tijdens het EK</li>
                                <li>Aantal punten behaald tijdens de voorbereiding</li>
                                <li>Aantal maal de score volledig correct tijdens de voorbereiding</li>
                                <li>Minuut van de eerste goal in de finale</li>             
                                </ol> </p>
								
				<h3> Gokken indienen </h3>
                <p> De gokken zullen worden ingediend met Google Forms (https://docs.google.com/…/1wKYJ2O7NW8F42kUyoJa7GWT…/viewform). Dit is anders als bij de vorige editie en kan omslachtiger lijken, maar heeft enkele voordelen:
				<ol> <li>Bij de laatste wedstrijden kunnen personen vanboven in het klassement hetzelfde gokken als personen net onder hun om ervoor te zorgen dat die hen niet meer kunnen inhalen, een anoniem systeem verhindert dit. Er zal wel voor gezorgd worden dat je op 1 of andere manier de scores van de andere personen tijdens/na de wedstrijd kan zien. </li>
				<li> Ik heb een script geschreven dat automatisch alle data ophaalt, de score per persoon berekent en een tussenstand bijhoudt, dit bespaart mij veel kopieerwerk van Facebook. </li>
				<li>Je zal je score steeds via dezelfde link indienen, als je het dus als bladwijzer in je browser of als shortcut op de homepage van je smartphone (zie foto in de groep) hebt staan gaat dit heel snel. </li>
				<li> Hoe minder je als student op Facebook zit, hoe beter :) </li>
				Nadeel: Er wordt uitgegaan van de eerlijkheid van de deelnemers. In theorie kan je gokken uitbrengen in de naam van iemand anders. Ik stel voor dat we dit niet doen, anders moet iedereen nog eens een persoonlijke code beginnen bijhouden... </ol> 
Noot:
<ul> <li> Je kan je gok zoveel aanpassen als je wilt (opnieuw indienen van die speeldag), enkel de laatst ingediende telt. </li>
<li> Er is een timecheck ingebouwd, je kan tot 1 seconde voor aanvang van de wedstrijd posten, als je na aanvang post, wordt je gok door het algoritme genegeerd. </li>
<li> Indien je geen internet hebt: je zal steeds kunnen gokken op een aantal wedstrijden op voorhand, en in het slechtste geval sms je naar Aaron of ik. </li> </ul>
</p>

				<h3> Bonussen </h3>

<p> Met de bonussen blijft het spannend tot op het einde. Vorige edities was er een absolute puntenverdeling voor de bonussen die uiteindelijk niet super bleek te zijn wegens te doorslaggevend in vergelijking met de daarvoor gehaalde punten. Dit jaar opteren we voor een relatieve verdeling. De bonussen wegen op zo’n manier door dat de personen die in het bovenste 1/3de van het klassement theoretisch gezien nog 1ste kunnen eindigen (indien alles juist, en alle personen boven zich, alles fout). Voor de start van het toernooi moet ik van iedereen een voorspelling hebben voor onderstaande gebeurtenissen (https://docs.google.com/…/1r0oPBjcNkf8ACdtYfMgQY-…/viewform…):

<ul> <li>  Wie wordt Europees kampioen? 40% van totaal aantal bonussen die zullen verdeeld worden </li>
     <li>  Wie is verliezend finalist? 20% </li>
<li> Waar eindigen de Belgen? 20% </li>
<li>  Wie wordt de vuilste ploeg? 10% </li>
<li> Wie wordt topschutter? 10% </li> </ul>
Als je finalist blijkt kampioen te worden en omgekeerd krijg je ook nog een aantal punten (15% indien 1 vd 2 juist, maar omgewisseld, 35% indien beiden juist maar plaats omgewisseld). </p>

<h3> Berekening bonussen </h3>
<p>
Vuilste ploeg:
<ul> <li> gele kaart = 1 punt </li>
<li> geel-geel = 2.5 punten </li>
<li> rode kaart = 3 punten </li>
<li> geel-rood = 4 punten </li> </ul>
Bij gelijkstand --> iedereen die een van de ploegen heeft ingevuld met het maximale aantal 'vuilepunten', krijgt de bonuspunten
</p> <p>
Topschutter:
<ul> <li> bij gelijkstand --> iedereen die een speler heeft ingevuld die met het maximale aantal goals eindigt, krijgt de bonuspunten </li> </ul>
</p> <p>
Positie België:
<ul> <li>
finale </li>
<li> halve finale </li>
<li> kwartfinale </li>
<li> 1/8ste finale </li>
<li>  groepsfase </li> </ul>
Je gokt het verst je denkt dat ze geraken. </p>

<h3> Inzet </h3>

<p> Iedereen bezorgt mij 10€ voor 10 juni. Om niet met te weinig geld te eindigen zoals in vorige edities schrijft iedereen dit over op:
<div class="row">
 <div class="col-lg-4 col-md-4 col-sm-8 col-xs-12">
                    <div class="info-box-4">
                       <div class="icon">
                            <i class="material-icons col-light-green">credit_card</i>
                        </div>
                        <div class="content">
                            <div class="text"><h4>Sam Wesemael</h4></div>
                            <div class="number">BE46 7805 9286 6336</div>
                        </div>
                    </div>
                </div>
				</div>
</p>

<h3> Winst </h3>

<ul> <li> 60% van de pot wordt onder iedereen verdeeld. Je krijgt een bedrag in verhouding met je aantal behaalde punten </li>
<li> 40% van de pot wordt uitsluitend verdeeld onder de top 3 (50% naar de winnaar, 33% naar de 2de en 17% naar de 3de. Alsook ontvangt de top 3 een mooie herinnering in de vorm van een certificaat/beker (nog te bepalen) </li>
</ul>	  

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