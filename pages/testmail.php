<?php

// ---------------------- werkt voor brackemannen en gmail adressen, NIET VOOR HOtMAIL --------------
// ini_set('display_errors', 1);
// error_reporting(E_ALL);

$sAfzender = "development@brackemannen.be";
$sNaar = "development@brackemannen.be, nexuspc0nline@gmail.com";
$sNaarGmail = "nexuspc0nline@gmail.com";

// Headers
$headers = "From: \"Test mail\" <".$sAfzender.">\r\n"; 
$headers .= "Reply-To: \"Test mail\" <".$sAfzender.">\n";
$headers .= 'Cc: jordy_vds@hotmail.com' . "\r\n";
$headers .= "Return-Path: Mail-Error <".$sAfzender.">\n";
$headers .= 'X-Mailer: PHP v'.phpversion().PHP_EOL;
$headers .= 'X-Originating-IP: '.$_SERVER['REMOTE_ADDR'].PHP_EOL;
$headers .= "MIME-Version: 1.0\n";
$headers .= "Content-Transfer-Encoding: 8bit\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\n";
$headers .= 'Cc: jordy_vds@hotmail.com' . "\r\n";
                
// HTML Bericht        
$bericht = '
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
</head>
<body>
test mailtje hier
</body>
</html>';


if(mail($sNaar, "Maitlje", $bericht, $headers)) {
    echo 'Succesvol gemailt';
}
else {
    echo 'foutje';
}
if(mail($sNaarGmail, "Maitlje", $bericht, $headers)) {
    echo 'Succesvol gemailt';
}
else {
    echo 'foutje';
}

?>