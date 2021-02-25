<?php require_once('../../connections/cnPenimbangan.php') ?>
<?php 
 	header("Access-Control-Allow-Origin: *");
	date_default_timezone_set('Asia/Jakarta');
	$no_spk_produksi =  $_POST['no_spk_produksi'];
	$id_obat		 = $_POST['id_obat'];
	$nama_obat		 = $_POST['nama_obat'];
 	$berat	         = $_POST['berat'];
 	$satuan		     = $_POST['satuan'];
	$cetak2 = "INSERT INTO spk (no_spk_produksi, nama_obat, id_obat, berat, satuan)" .
				"VALUES ( '" .
						$no_spk_produksi .	"' , '" .
						$nama_obat . 	"' , '" .
						$id_obat .	"' , '" .
						$berat .	"' , '" .
						$satuan .	"' ) ON DUPLICATE KEY UPDATE berat= ('". $berat ."'), satuan= ('". $satuan ."')";
    echo $cetak2;

    if (mysqli_query($cnPenimbangan, $cetak2)) {
        http_response_code(200);
 		print  "Data Berhasil Disimpan" ;
 	} else{
        http_response_code(500);
 		print "Gagal Disave";
 	}
?>