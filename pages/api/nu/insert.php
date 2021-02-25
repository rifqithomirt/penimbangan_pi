<?php require_once('../../connections/cnPenimbangan.php') ?>
<?php 
 	header("Access-Control-Allow-Origin: *");
	date_default_timezone_set('Asia/Jakarta');
	$jam_timbang2 = new DateTime('NOW');
        $jam_timbang3 = $jam_timbang2->format('c');
	$nama_produk 		=   $_GET['nama_produk'];
	$nama_material		= $_GET['nama_material'];
	$netto				= $_GET['netto'];
 	$tara				= $_GET['tara'];
 	$no_timbangan		= $_GET['no_timbangan'];
 	$jam_timbang		= $_GET['jam_timbang'];
 	$id_merk		    = $_GET['id_merk'];
 	$id_material		= $_GET['id_material'];
	#echo $nama_material;
	$cetak2 = "INSERT INTO hasil " .
				"VALUES ( '" .
						$nama_produk .	"' , '" .
						$nama_material . 	"' , '" .
						$netto .	"' , '" .
						$tara .	"' , '" .
						$no_timbangan .	"' , '" .
						$jam_timbang3 .	"' , '" .
						$id_merk .	"' , '" .
						$id_material .	"' )";
    echo $cetak2;
    if (mysqli_query($cnPenimbangan, $cetak2)) {
 		print  "Data Berhasil Disimpan" ;
 	} else{
 		print "Gagal Disave";
 	}
?>