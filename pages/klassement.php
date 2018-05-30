<?php include 'navigator.php';
include('server.php');
?>
<!DOCTYPE html>
<html>
<!-- navigator inladen en juist actief zetten -->
<script type="text/javascript">
    document.getElementById("nav-klassement").classList.toggle('active');
</script>

    <section class="content">
	
	
	            <!-- Basic Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h4>
                                RANKING
							</h4>
                                <small>CW = Correct Winner</small> <br>
								<small>CS = Correct Score</small> </br>
								<small>BP = Bonus Points</small>
                            
                            
                        </div>
                        <div class="body table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>CW</th>
                                        <th>CS</th>
										<th>BP</th>
										<th>TOT</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php

                                        $sqlklassement = "SELECT bc18_users.user_name, bc18_klassement.totaal, bc18_klassement.bonus, bc18_klassement.uitslag_correct, bc18_klassement.winnaar_correct, bc18_users.pic_path FROM bc18_klassement inner join bc18_users on bc18_klassement.email = bc18_users.email WHERE bc18_users.verification = 1 ORDER BY totaal DESC, uitslag_correct DESC, winnaar_correct DESC ";
                                        $results = mysqli_query($db, $sqlklassement);
                                        if (!$results) {
                                            printf("Error: %s\n", mysqli_error($conn));
                                            exit();
                                          }
                                        $ranking = 1;
                                        while($data = mysqli_fetch_array($results)){
                                             if($data['pic_path']===''){
                                                        $afbeelding = '../images/users/noImage.jpg';
                                                    }
                                                    else{
                                                        $afbeelding = $data['pic_path'];
                                                    }
                                        echo'
                                            <tr>
                                                <th scope="row">'.$ranking.'</th>
                                                <td><img style="max-height:40px;" src="'.$afbeelding.'" alt="" class="img-circle">';
                                            if( $numberofAchievements>5 && $data['user_name'] == $_SESSION['username'])
                                                echo '<img style="max-height:20px; position: relative; left:-20px; top:15px;" src="../images/1star.svg" alt="" > ';
                                            echo $data['user_name'].'</td>
                                                <td>'.$data['winnaar_correct'].'</td>
                                                <td>'.$data['uitslag_correct'].'</td>
												<td>'.$data['bonus'].'</td>
                                                <td><b>'.$data['totaal'].'</b></td>
                                            </tr>
                                        ';
                                        $ranking++;
                                        }
                                        ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Table -->
	
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