<?php require_once('../../connections/cnPenimbangan.php') ?>
<?php 
	header("Access-Control-Allow-Origin: *");
	//$json = '[{"id":"33","nama":"DEG","netto":253.17,"status":"created","timbangan":1},{"id":"39","nama":"Disperflo LMA - V66","netto":333,"status":"created","timbangan":2}]'; 
	$json = file_get_contents('php://input');
	$result = json_decode($json);
	if(is_array($result)){
		$sqlDelete = "DELETE FROM status WHERE true";
    	$query = mysqli_query($cnPenimbangan, $sqlDelete);
		
		$DataArr = array();
	    foreach($result as $row){
	        $id = $row->id;
	        $nama = $row->nama;
	        $netto = $row->netto;
	        $status = $row->status;
	        $timbangan = $row->timbangan;
	        $merk = $row->merk;
	        $id_merk = $row->id_merk;
	        $DataArr[] = "('$id', '$nama', '$netto', '$status', '$timbangan', '$merk', '$id_merk')";
	    }
	    $sql = "INSERT INTO status (id, nama, netto, status, timbangan, merk, id_merk) values ";
    	$sql .= implode(',', $DataArr);
    	$query = mysqli_query($cnPenimbangan, $sql);
		echo json_encode($query);
	} else {
		echo "wrog";
	}

?>