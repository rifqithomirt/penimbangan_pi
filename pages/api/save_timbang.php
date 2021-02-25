<?php
  $spk = $_POST['no_spk_produksi'];
  $id_resep = $_POST['id_resep'];
  $id_obat = $_POST['id_obat'];
  $berat = $_POST['berat'];
  $satuan = $_POST['satuan'];
  $url = "https://produksi.goldenrubber.co.id/api/obat/save_timbang";
  $data = array(
  	'no_spk_produksi' => $spk, 
  	'id_resep' => $id_resep, 
  	'id_obat' => $id_obat, 
  	'berat' => $berat, 
  	'satuan' => $satuan, 
  	'token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1bmlxdWVJZCI6IjEiLCJ1c2VyIjoicGVyZGFtYWlhbmluZG9uZXNpYSIsInRpbWVTdGFtcCI6IjIwMTktMDUtMTEgMTI6MDk6MzQifQ.6Yrsq8qFN6d_eiGcjPL096S3M1OX-qe6z2wtx8Xp9Z4', 
  	'apikey' => '0ff4cf817ed19fd8354fe72f9cc8e1d16e88f4b1');
  $options = array(
    'http' => array(
      //'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
      'header' => array(
        "Authorization: Basic cHRwaTpwdHBpMTIzLg==",
        "api_auth_key: 2114d9d47905e856521b5fdfb8faecd5d16c8928",
        "Content-type: application/x-www-form-urlencoded\r\n"
      ),
      'method'  => 'POST',
      'content' => http_build_query($data)
    )
  );
  $context  = stream_context_create($options);
  $result = file_get_contents($url, false, $context);
  http_response_code(200);
 		print  json_encode($result) ;
?>