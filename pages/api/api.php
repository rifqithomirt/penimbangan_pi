<?php require_once('../../connections/cnPenimbangan.php') ?>
<?php 
	header("Access-Control-Allow-Origin: *");
	$sql = $_GET['sql'];
	//$sql = "SELECT * FROM $tablename";
	//echo $sql;
	$query = mysqli_query($cnPenimbangan, $sql);
	$rows = array();
	$rows['rows'] = [];
	while($r = mysqli_fetch_assoc($query)) {
		$rows['rows'][] = $r;
	}
	http_response_code(200);
	print json_encode($rows);
?>