<?php require_once('../../connections/cnPenimbangan.php') ?>
<?php 
 	header("Access-Control-Allow-Origin: *");
	$device 		=   $_GET['device'] * 1;
	$sql = "SELECT * FROM status, material_timbangan WHERE status.status = 'created' AND material_timbangan.id_timbangan = '".$device. "' AND material_timbangan.id_material = status.id";
	$query = mysqli_query($cnPenimbangan, $sql);
	$rows = array();
	while($r = mysqli_fetch_assoc($query)) {
		$rows['rows'][] = $r;
	}
	print json_encode($rows);
?>