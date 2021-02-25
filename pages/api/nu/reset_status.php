<?php require_once('../../connections/cnPenimbangan.php') ?>
<?php 
    header("Access-Control-Allow-Origin: *");
    echo "oke";
	$json = file_get_contents('php://input');
	$result = json_decode($json);
	if( is_array($result) || TRUE) {
		$sql = "DELETE FROM status WHERE true";
		$query = mysqli_query($cnPenimbangan, $sql);
		print json_encode($query);
	}
?>