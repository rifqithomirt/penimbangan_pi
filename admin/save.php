<?php require_once('../Connections/cnPenimbangan.php') ?>
<?php 
	$username = $_POST['username'];
	$password = $_POST['password'];
	$nama_user = $_POST['nama_user'];
	$posisi = $_POST['posisi'];

	$query = "INSERT INTO `data_user`(`username`, `password`, `nama_user`, `posisi`) VALUES ('".$username."','".$password."','".$nama_user."','".$posisi."')";

	if (mysqli_query($cnPenimbangan, $query)) {
	 	print  "Data Berhasil Disimpan" ;
	}else{
	 	print "Gagal Disave" ;
	}
?>