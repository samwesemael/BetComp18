<?php 
if (session_status() == PHP_SESSION_NONE){
    session_start();
}
include 'server.php';

$result = mysqli_query($db, "SELECT bc18_chat.bc18_username as user, bc18_chat.bc18_msg as msg, bc18_chat.bc18_created as created, bc18_users.email AS mail, bc18_users.pic_path as picture FROM bc18_chat INNER JOIN bc18_users on bc18_chat.bc18_username = bc18_users.user_name ORDER BY bc18_id ASC LIMIT 100 ");

echo '<center>Welkom in de chat!'.$_SESSION['email'].'</center>';
while($extract = mysqli_fetch_array($result)){
	// echo $extract['bc18_username'].": ".$extract['bc18_msg']."<br>";
	if ($extract['mail'] === $_SESSION['email']){
  echo '<div class="chat self">
          <div class="user-photo img-circle"><img src='.$_SESSION['profilepicpath'].'></div>
          <p class="chat-message">'.$extract['msg'].'<br><small>'.$extract['created'].'</small></p></div>';
      }
      else{
     	$picture = $extract['picture'];
      	if($extract['picture'] == '')
      	{
      		$picture = '../images/users/noImage.jpg';
      	}
        echo '<div class="chat friend">
                    <div class="user-photo"><img src="'.$picture.'"></div>
                    <p class="chat-message">'.$extract['msg'].'<br><small>'.$extract['created'].'</small></p>
                </div>';
      }
}
?>
