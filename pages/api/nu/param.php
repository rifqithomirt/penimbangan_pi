<?php require_once('../../connections/cnPenimbangan.php') ?>
<?php 
	header("Access-Control-Allow-Origin: *");
	$sql = "SELECT * FROM material_timbangan";
	$query = mysqli_query($cnPenimbangan, $sql);
	$rows = array();
	while($r = mysqli_fetch_assoc($query)) {
		$rows['rows'][] = $r;
	}
	print json_encode($rows);
?>