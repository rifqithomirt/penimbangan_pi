<?php require_once('../../connections/cnPenimbangan.php') ?>
<?php 
 	header("Access-Control-Allow-Origin: *");
	$device 		=   $_GET['device'] * 1;
	$sql = "UPDATE status SET status.status = 'finished' WHERE status.status = 'created' AND status.timbangan = ' ".$device." '";
	$query = mysqli_query($cnPenimbangan, $sql);
	print json_encode($query);
?>