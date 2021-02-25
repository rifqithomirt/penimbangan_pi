<?php require_once('../../connections/cnPenimbangan.php') ?>
<?php 
	$sql = "SELECT * FROM status";
	$query = mysqli_query($cnPenimbangan, $sql);
	$rows = array();
	while($r = mysqli_fetch_assoc($query)) {
		$rows['rows'][] = $r;
	}
	print json_encode($rows);
?>