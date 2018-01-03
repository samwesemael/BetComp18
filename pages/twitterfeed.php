<!DOCTYPE html>
<html>
<!-- navigator inladen en juist actief zetten -->
<?php include 'navigator.php';?>
<script type="text/javascript">
    document.getElementById("nav-twitter").classList.toggle('active');
</script>

    <section class="content">
      
	  
	   <div class="container-fluid">
            <div class="block-header">
                <h1>
                    Twitterfeed
                </h1>
            </div>
            <div class="row clearfix">
                <!-- Basic Example -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                            <div class="body">
                            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                <!-- Indicators -->
                                <ol class="carousel-indicators">
                                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                                </ol>

                                <!-- Wrapper for slides -->
                                <div class="carousel-inner" role="listbox">
                                    <div class="item active">
                                        <blockquote>
											<!-- cards = hidden zou normaal foto moeten negeren maar werkt niet -->
											<a class="twitter-timeline"
											href="https://twitter.com/GaryLineker"
											data-tweet-limit="1"
											data-cards="hidden" 
											hide_media=true
											data-src="false">
										    </a>
											<script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
											
										</blockquote>
                                    </div>
                                    <div class="item">
                                      <blockquote>
										<a class="twitter-timeline"  href="https://twitter.com/hashtag/WorldCup2018" data-widget-id="947215590632185858">Tweets over #WorldCup2018</a>
										<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
									
										</blockquote>
                                    </div>
                                    <div class="item">
                                       <blockquote>
											<a class="twitter-timeline"
											href="https://twitter.com/BelRedDevils"
											data-tweet-limit="1"
											data-cards="hidden" 
											hide_media=true
											data-src="false">
											</a>
                <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
               
              </blockquote>
                                    </div>
                                </div>
			
                                <!-- 
                                <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
								Controls -->
                            </div>
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