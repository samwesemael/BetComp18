<?php include 'navigator.php';
    include('server.php');
?>
<!DOCTYPE html>
<html>
<!-- navigator inladen en juist actief zetten -->
<script type="text/javascript">
    document.getElementById('nav-klassement').classList.toggle('active');
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
                            <small>CT = Correct Team that goes to the next round (knockout phase)</small> </br>
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
                                        <th>CT</th>
										<th>BP</th>
										<th>TOT</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $sqlklassement = "SELECT bc18_users.email, bc18_users.user_name, bc18_klassement.totaal, bc18_klassement.bonus, bc18_klassement.uitslag_correct, bc18_klassement.winnaar_correct, bc18_users.pic_path FROM bc18_klassement inner join bc18_users on bc18_klassement.email = bc18_users.email WHERE bc18_users.verification = 1 ORDER BY totaal DESC, uitslag_correct DESC, winnaar_correct DESC,user_name ";
                                        $results = mysqli_query($db, $sqlklassement);
                                        if (!$results) {
                                            printf("Error: %s\n", mysqli_error($conn));
                                            exit();
                                          }
                                        $ranking = 1;
										
										/// GELD BEREKENN ///
										$pot = 220;
										$geldarray = [];
										$totpointstop5 = 0;
										for($j=0;$j<5;$j++){											
											$d = mysqli_fetch_array($results);			
											$totpointstop5 += $d['totaal'];
										}	

										$sqlklassement = "SELECT bc18_users.email, bc18_users.user_name, bc18_klassement.totaal, bc18_klassement.bonus, bc18_klassement.uitslag_correct, bc18_klassement.winnaar_correct, bc18_users.pic_path FROM bc18_klassement inner join bc18_users on bc18_klassement.email = bc18_users.email WHERE bc18_users.verification = 1 ORDER BY totaal DESC, uitslag_correct DESC, winnaar_correct DESC,user_name ";
                                        $results = mysqli_query($db, $sqlklassement);
																				
										
                                        while($data = mysqli_fetch_array($results)){
                                            $adres = $data['email'];
                                            if($data['pic_path']===''){
                                                $afbeelding = '../images/users/noImage.jpg';
                                                }
                                            else{
                                                $afbeelding = $data['pic_path'];
                                            }
                                            $rank = "SELECT * from bc18_achieved where bc18_user = '$adres' ";
                                            // echo $sql;
                                            $result = mysqli_query($db,$rank);
                                            $numberofAchievements = mysqli_num_rows($result);
                                            $star = false;
											if($ranking < 6){
                                            echo'
                                                <tr>
                                                    <th scope="row">'.$ranking.'</th>
                                                    <td><img style="max-height:40px;" src="'.$afbeelding.'" alt="" class="img-circle">';
											}
											else{
												 echo'
                                                <tr>
                                                    <th scope="row">'.$ranking.'</th>
                                                    <td><img style="max-height:40px;" src="'.$afbeelding.'" alt="" class="img-circle">';
											}
                                            if($numberofAchievements<10 && $numberofAchievements>=5){
                                                echo '<img style="max-height:20px; position: relative; left:-20px; top:15px;" src="../images/1star.png" alt="">';
                                                $star = true;
                                            }
                                            if($numberofAchievements<15 && $numberofAchievements>=10){
                                                echo '<img style="max-height:20px; position: relative; left:-20px; top:15px;" src="../images/2star.png" alt="">';
                                                $star = true;
                                            }
                                            if($numberofAchievements>=15){
                                                echo '<img style="max-height:20px; position: relative; left:-20px; top:15px;" src="../images/3star.png" alt="">';
                                                $star = true;
                                            }
                                            if($star){
                                                echo '<span style="margin-left:10px";>' . htmlspecialchars($data['user_name']) . '</span>';												
                                            }else{
                                                echo '<span style="margin-left:32px";>' . htmlspecialchars($data['user_name']) . '</span>';
                                            }
											if($ranking < 6){
												$ratio = $data['totaal'] / $totpointstop5;
												$geld = $ratio * $pot;
												// echo '<div align="right" class="col-blue"><b>'  .  round($geld) . '€</b></div></td>';
											}
											else{
												echo '</td>';
											}
                                            $teamcorrect = (int)$data['totaal']-3*(int)$data['uitslag_correct']-(int)$data['winnaar_correct'];
                                            echo'
                                                <td>' . $data['winnaar_correct'] . '</td>
                                                <td>' . $data['uitslag_correct'] . '</td>
                                                <td>' . $teamcorrect.'</td>
												<td>' . $data['bonus'] . '</td>
                                                <td><b>' . $data['totaal'] . '</b></td>
                                            </tr>';
											if($ranking == 5){ ?>
												<tr style="border-bottom:1px solid black"><td colspan="100%"></td></tr> 
												<hr class="line1">
																									<?php
											}
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