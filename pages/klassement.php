<!DOCTYPE html>
<html>
<!-- navigator inladen en juist actief zetten -->
<?php include 'navigator.php';?>
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
                                KLASSEMENT
							</h4>
                                <small>WJ = winnaar juist</small> <br>
								<small>SJ = score juist</small> </br>
								<small>B = bonuspunten</small>
                            
                            
                        </div>
                        <div class="body table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Naam</th>
                                        <th>WJ</th>
                                        <th>SJ</th>
										<th>B</th>
										<th>TOT</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                        include('server.php');
                                        $sqlklassement = "SELECT bc18_users.user_name, bc18_klassement.totaal, bc18_klassement.uitslag_correct, bc18_klassement.winnaar_correct, bc18_users.pic_path FROM bc18_klassement inner join bc18_users on bc18_klassement.email = bc18_users.email ORDER BY totaal DESC, uitslag_correct DESC, winnaar_correct DESC ";
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
                                                <td><img style="max-height:40px;" src="'.$afbeelding.'" alt="" max-height=50px class="img-circle"> '.$data['user_name'].'</td>
                                                <td>'.$data['uitslag_correct'].'</td>
                                                <td>'.$data['winnaar_correct'].'</td>
												<td></td>
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