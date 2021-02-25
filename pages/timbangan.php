<!DOCTYPE html>
<html>

<head>
  <?php require_once('../connections/cnPenimbangan.php'); ?>
  <?php

  $spk = $_GET['spk'];
  $nama = $_GET['nama'];
  $idresep = $_GET['idresep'];
  session_start();
  if ($_SESSION['status'] != "login") {
    header("location:../index.php?message=not_logged_in");
  }
  $sql = "SELECT nama_user,posisi FROM data_user WHERE username = '" . $_SESSION['username'] . "'";
  $result = mysqli_query($cnPenimbangan, $sql);
  $row = mysqli_fetch_array($result);
  /*
        $url = "https://produksi.goldenrubber.co.id/api/obat/list_obat";
        $data = array("no_spk_produksi" => $spk, 'token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1bmlxdWVJZCI6IjEiLCJ1c2VyIjoicGVyZGFtYWlhbmluZG9uZXNpYSIsInRpbWVTdGFtcCI6IjIwMTktMDUtMTEgMTI6MDk6MzQifQ.6Yrsq8qFN6d_eiGcjPL096S3M1OX-qe6z2wtx8Xp9Z4', 'apikey' => '0ff4cf817ed19fd8354fe72f9cc8e1d16e88f4b1');

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
        if ($result === FALSE) { echo("ERROR"); }
        else {
          //echo($result);
          $obj = json_decode($result, false);
          //echo($obj);
        }*/

  ?>
  <link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection" />
  <link type="text/css" rel="stylesheet" href="../css/all.css" media="screen,projection" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script>
    function startTime() {
      var today = new Date();
      var h = today.getHours();
      var m = today.getMinutes();
      var s = today.getSeconds();
      m = checkTime(m);
      s = checkTime(s);
      //document.getElementById('time_detail').innerHTML =
      //h + ":" + m + ":" + s;
      //var t = setTimeout(startTime, 500);
    }

    function checkTime(i) {
      if (i < 10) {
        i = "0" + i
      }; // add zero in front of numbers < 10
      return i;
    }
  </script>
  <style>
    .flex-container {
      display: flex;
      flex-direction: column;
    }

    .flex-container>div {
      text-align: center;
    }
  </style>
</head>

<body onload="startTime()">
  <div class="row" style="margin-bottom:0px;">
    <div class="col s12 bg_dark1">
      <div style="height:600px; padding-top: 30px; padding-left:20px;">
        <div class="row">
          <div class="flex-container col s3">
            <div class="bg_light1" style="height: 200px; margin-bottom:30px; border-radius: 15px;">
              <div class="row">
                <div class="col s12" style="text-align:center; padding:20px 35px 0px 35px;">
                  <img src="../img/logo_baru.png" class="responsive-img"></img>
                </div>
              </div>
            </div>
            <div class="bg_light1" style="height: 280px; margin-bottom:0px; border-radius: 15px;">
              <div class="row">
                <div class="col s12" style="text-align:left; padding: 15px 35px 0px 35px;">
                  <p class="white-text" style="margin: 0px; padding: 0px;">ACTION</p>
                  <hr>
                </div>
                <div class="col s12" style="text-align:center; padding: 20px 15px 5px 15px;">
                  <a id="skip" class="waves-effect waves-light btn button_action" style="width:150px; border-radius:15px;">Skip ></a>
                </div>
                <div class="col s12" style="text-align:center; padding: 10px 15px 5px 15px;">
                  <a id="kembali" data-spk=<?php echo ($spk); ?> data-nama=<?php echo ($nama); ?> class="waves-effect waves-light btn button_action" style="width:150px; border-radius:15px;">
                    < Kembali</a>
                </div>
                <div class="col s12" style="text-align:center; padding: 20px 15px 5px 15px;">
                  <a id="simpan" class="waves-effect waves-light btn-large bg_brown1" style="width:150px; border-radius:15px;">Simpan</a>
                </div>
              </div>
            </div>

            <div style="float:left; padding-top:20px;">
              <p class="white-text" style="font-size:12px; margin:0px">@ 2020 PT GOLDEN RUBBER INDUSTRY</p>
            </div>
          </div>
          <div class="col s9">
            <div class="menu">
              <div class="row" style="margin-bottom: 10px;">
                <div class="col s12 bg_light1" style="height: 160px; border-radius: 15px;">
                  <p class="white-text" style="margin: 10px 0px 0px 0px; padding: 0px; text-align: left;"><b>Nama Obat</b></p>
                  <hr>
                  <h5 data-spk=<?php echo ($spk); ?> data-nama=<?php echo ($nama); ?> data-idresep=<?php  echo ($idresep); ?> class="white-text" style="margin: 0px; padding: 0px; text-align: center; font-size:54px; font-weight:bold;" id="nama_obat">-</h5>
                </div>
              </div>
              <div class="row" style="margin-bottom: 10px;">
                <div class="col s12 bg_red1" style="height: 175px; border-radius: 15px;">
                  <p class="white-text" style="margin-top: 10px; padding: 0px; text-align: left;"><b>BERAT TARGET</b></p>
                  <hr>
                  <h1 class="white-text" style="margin: 0px; padding-top: 15px; text-align: center;"><span id="berat" class="weightunit-target" style="font-size: 100px; font-weight:bold;">0000.00</span>&nbsp;<span class="unit-target" id="satuan"> -</span></h1>
                </div>
              </div>
              <div class="row " style="margin-bottom: 10px;">
                <div class="col s12 bg_blue1" style="height: 175px; border-radius: 15px;">
                  <p class="white-text" style="margin-top: 10px; padding: 0px; text-align: left;"><b>BERAT AKTUAL</b></p>
                  <hr>
                  <h1 class="white-text" style="margin: 0px; padding-top: 15px; text-align: center;"><span id="beratAktual" class="weight-num-aktual" style="font-size: 100px; font-weight:bold;">null</span>&nbsp;<span class="unit-aktual">Gram</span></h1>
                </div>
              </div>
            </div>

          </div>
        </div>

      </div>
    </div>
  </div>

  <div id="modal_tersimpan" class="modal">
    <div class="modal-content">
      <div class="row">
        <div class="col offset-s4 s4">
          <img src="../img/check.svg" class="responsive-img"></img>
        </div>
      </div>
      <div class="row">
        <div class="col s12">
          <div style="text-align:center; font-size: 36px;font-weight:900;">Berhasil Tersimpan</div>
        </div>
      </div>
      <div class="row">
        <div class="col s12">
          <div style="text-align:center; font-size: 24px;font-weight:400;">Hasil timbang berat telah dicek dan berat berhasil tersimpan.</div>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript" src="../js/jquery-3.3.1.min.js"></script>
  <script type="text/javascript" src="../js/materialize.min.js"></script>
  <script type="text/javascript" src="js/socket.io.js"></script>
  <script type="text/javascript">
    socket = io("http://localhost:8080");
    window.addEventListener("load", function() {});
    socket.on('timbangan', (kgUm) => {
      var kg = kgUm.split("#")[0];
      var um = kgUm.split("#")[1];
      console.log(kg)
      //$('.weight-num-aktual').text((kg*1).toFixed(0));
      //$('.unit-target').text(um);
      //$('.unit-aktual').text(um);
    });
  </script>
  <script type="text/javascript">
    var toleransi = 0.01;
    function getUrlParameter(name) {
      name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
      var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
      var results = regex.exec(location.search);
      return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
    };
    $(document).ready(function() {
      $('.modal').modal();
      //$('#modal_tersimpan').modal('open');
      $('#kembali').on('click', function() {
        var spk = $(this).data('spk');
        var nama = $(this).data('nama');
        window.location = './obat.php?spk=' + spk + '&nama=' + nama + '&idresep=' + getUrlParameter('idresep');
      });

      $('#simpan').on('click', function() {
        var id_obat = $('#nama_obat').data('idobat');
        var id_resep = $('#nama_obat').data('idresep');
        var no_spk_produksi = $('#nama_obat').data('spk');
        var berat = $('#berat').text();
        var satuan = $('#satuan').text();
        var waktu = new Date().toISOString().replace(/\T/, ' ').replace(/\.\d\d\dZ$/, '');

        var beratAktual = $('#beratAktual').text();
        console.log(Math.abs( (beratAktual * 1) - (berat * 1) ))
        if( Math.abs( (beratAktual * 1) - (berat * 1) ) <= toleransi || true ) {
          var sql = `INSERT INTO hasil (id_obat, id_resep, no_spk_produksi, berat, satuan)
            VALUES (${id_obat}, ${id_resep}, "${no_spk_produksi}" , ${berat} , "${satuan}"  )`;
          $.ajax({
            url: './api/api.php?sql=' + sql,
            method: "GET",
            statusCode: {
              200: function(data, textStatus, jqXHR) {
                var sql = ` UPDATE spk SET state="done" WHERE no_spk_produksi = "${ no_spk_produksi }" AND id_obat = "${id_obat}"`;
                $.ajax({
                  url: './api/api.php?sql=' + sql,
                  method: "GET",
                  statusCode: {
                    200: function(data, textStatus, jqXHR) {
                      $('#modal_tersimpan').modal('open');
                      setTimeout(function(){
                        window.location.reload();
                      }, 1000);
                    },
                    500: function(data, textStatus, jqXHR) {
                      alert('Error')
                    }
                  }
                });
              },
              500: function(data, textStatus, jqXHR) {
                alert('Error')
              }
            }
          });
        } else {
        }
      });

      $('#skip').on('click', function() {
        var nama_obat = $('#nama_obat').text();
        var sql = ` UPDATE spk SET state="skip" WHERE no_spk_produksi = "${ getUrlParameter('spk') }" AND nama_obat = "${nama_obat}"`;
        $.ajax({
          url: './api/api.php?sql=' + sql,
          method: "GET",
          statusCode: {
            200: function(data, textStatus, jqXHR) {
              window.location.reload();
            },
            500: function(data, textStatus, jqXHR) {
              alert('Error')
            }
          }
        });
      });

      var sql = ` SELECT * FROM spk WHERE no_spk_produksi = "${ getUrlParameter('spk') }" AND state IS NULL LIMIT 1`;
      $.ajax({
        url: './api/api.php?sql=' + sql,
        method: "GET",
        statusCode: {
          200: function(data, textStatus, jqXHR) {
            console.log(data)
            var obj = JSON.parse(data);
            if( obj.rows.length > 0 ) {
              var namaObat = obj.rows[0]['nama_obat'];
              var idObat = obj.rows[0]['id_obat'];
              var berat = obj.rows[0]['berat'];
              var satuan = obj.rows[0]['satuan'];
              $('#nama_obat').text(namaObat);
              $('#nama_obat').data('idobat', idObat);
              $('#berat').text(berat);
              $('#satuan').text(satuan);
            } else {
              window.location = './obat.php?spk=' + getUrlParameter('spk') + '&nama=' + getUrlParameter('nama') + '&idresep=' + getUrlParameter('idresep');
            }
          },
          500: function(data, textStatus, jqXHR) {
            console.log(data)
          }
        }
      });

    });
  </script>
</body>

</html>