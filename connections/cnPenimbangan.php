<?php
$hostname_cnPenimbangan = "localhost";
$database_cnPenimbangan = "mydb";
$username_cnPenimbangan = "root";
$password_cnPenimbangan = "";
$cnPenimbangan = mysqli_connect($hostname_cnPenimbangan, $username_cnPenimbangan, $password_cnPenimbangan, $database_cnPenimbangan) or trigger_error(mysql_error(),E_USER_ERROR); 
?>
