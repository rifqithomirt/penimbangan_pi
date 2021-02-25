<!DOCTYPE html>
<html>

<head>
  <?php require_once('../connections/cnPenimbangan.php'); ?>
  <?php
  session_start();
  if ($_SESSION['status'] != "login") {
    header("location:../index.php?message=not_logged_in");
  }
  $sql = "SELECT nama_user,posisi FROM data_user WHERE username = '" . $_SESSION['username'] . "'";
  $result = mysqli_query($cnPenimbangan, $sql);
  $row = mysqli_fetch_array($result);
  #echo json_encode($row);
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
      document.getElementById('time_detail').innerHTML =
        h + ":" + m + ":" + s;
      var t = setTimeout(startTime, 500);
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
            <div class="bg_light1" style="height: 75px; margin-bottom:30px; border-radius: 15px;">
              <div class="row">
                <div class="col s4" style="text-align:center; padding-top:20px;">
                  <img src="../img/img_fotoprofile.jpeg" style="width:30px; height:30px; border-radius: 50%;"></img>
                </div>
                <div class="col s8" style="text-align:left; margin:auto;">
                  <h6 class="white-text" style="margin-bottom: 0px; margin-top:1em;"><b><?php
                                                                                        echo $row['nama_user'] ?></b></h6>
                  <p class="white-text" style="margin: 0px; padding: 0px; font-size:14px;"><?php echo $row['posisi'] ?></p>
                </div>
              </div>
            </div>
            <div class="bg_light1" style="height: 180px; margin-bottom:0px; border-radius: 15px;">
              <div class="row">
                <div class="col s12" style="text-align:left; padding: 15px 35px 0px 35px;">
                  <p class="white-text" style="margin: 0px; padding: 0px;">INFORMASI</p>
                </div>
                <div class="col s12" style="text-align:left; padding: 5px 35px 0px 35px; margin-top:10px;">
                  <p class="white-text informasi-label" style="margin:0px; padding:0px; font-size:12px;">Waktu</p>
                  <p class="white-text" style="margin:0px; padding:0px; font-size:20px; letter-spacing: 2px;"><b><span id="time_detail">11:25:12</span></b></p>
                </div>
                <div class="col s12" style="text-align:left; padding: 5px 35px 0px 35px;">
                  <p class="white-text" style="margin:0px; padding:0px; font-size:12px;">Tanggal</p>
                  <p class="white-text" style="margin:0px; padding:0px; font-size:20px; letter-spacing: 2px;"><b><?php echo date("d M Y") ?></b></p>
                </div>
              </div>
            </div>
            <div style="float:left; padding-top:20px;">
              <p class="white-text" style="font-size:12px; margin:0px">@ 2020 PT GOLDEN RUBBER INDUSTRY</p>
            </div>
          </div>
          <div class="col s7">
            <h5 class="white-text mt-0"><b>DAFTAR OBAT - <span><?php echo ($_GET['nama']); ?></span></b></h5>
            <div class="menu" style="height: 450px; overflow: scroll;">
              <table class="daftar_obat white-text" style="width:100%">
                <thead class="bg_light1 ">
                  <tr class="">
                    <th style="border-radius: 1em 0 0 1em;">Nama</th>
                    <th>Netto</th>
                    <th>Unit</th>
                    <th style="border-radius: 0 1em 1em 0;">Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $spk = $_GET['spk'];
                  $url = "https://produksi.goldenrubber.co.id/api/obat/list_obat";
                  $data = array("no_spk_produksi" => $spk, 'token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1bmlxdWVJZCI6IjEiLCJ1c2VyIjoicGVyZGFtYWlhbmluZG9uZXNpYSIsInRpbWVTdGFtcCI6IjIwMTktMDUtMTEgMTI6MDk6MzQifQ.6Yrsq8qFN6d_eiGcjPL096S3M1OX-qe6z2wtx8Xp9Z4', 'apikey' => '0ff4cf817ed19fd8354fe72f9cc8e1d16e88f4b1');

                  // use key 'http' even if you send the request to https://...
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

                  $sqlHasil = "SELECT * FROM hasil WHERE no_spk_produksi = '" . $spk . "'";
                  $resultHasil = mysqli_query($cnPenimbangan, $sqlHasil);
                  //$rowHasil = mysqli_fetch_array($resultHasil);
                  $arrHasil = array();
                  while ($rowHasil = mysqli_fetch_object($resultHasil)) {
                    //echo (json_encode($rowHasil) );
                    //if( ($rowHasil->state) == "done" ) {
                    array_push($arrHasil, $rowHasil->id_obat);
                    //}
                  }

                  //echo json_encode($arrHasil);

                  if ($result === FALSE) {
                    echo ("<p class='white-text'>Error</p>");
                  } else {
                    //echo($result);
                    $obj = json_decode($result, false);
                    foreach ($obj as $doc) {
                      if (in_array($doc->id_obat, $arrHasil)) {
                        $hashTimbang = '<span class="bdg bg_blue1">Sudah</span>';
                        $hashClass = 'sudah';
                      } else {
                        $hashTimbang = '<span class="bdg bg_red1">Belum</span>';
                        $hashClass = 'belum';
                      }
                      echo ('<tr class="'. $hashClass .'" data-satuan="' . $doc->satuan . '" data-berat=' . $doc->berat . ' data-idobat=' . $doc->id_obat . ' data-namaobat="' . $doc->nama_obat . '" data-nospk="' . $doc->no_spk_produksi . '">
                                    <td>' . $doc->nama_obat . '</td>
                                    <td>' . $doc->berat . '</td>
                                    <td>' . $doc->satuan . '</td>
                                    <td>' . $hashTimbang . '</td>
                                </tr>');
                    }
                  }

                  ?>
                </tbody>
              </table>
            </div>
            <div class="button_collection row">
              <div class="col s2">
                <a id="back" class="waves-effect waves-light btn bg_brown1 white-text text-center">Back</a>
              </div>
              <div class="col s2">
                <a id="reset" class="waves-effect waves-light btn bg_brown1 white-text text-center">Reset</a>
              </div>
              <div class="col s4">
              </div>
              <div class="col s2">

                <a id="start" data-spk=<?php
                                        $spk = $_GET['spk'];
                                        echo ($spk);
                                        ?> data-nama=<?php
                                                      $nama = $_GET['nama'];
                                                      echo ($nama);
                                                      ?> data-idresep=<?php
                                                          $idresep = $_GET['idresep'];
                                                          echo ($idresep);
                                                          ?> class="waves-effect waves-light btn bg_brown1 white-text text-center">Start</a>
              </div>
              <div class="col s2">
                <a id="finish" class="waves-effect waves-light btn bg_brown1 white-text text-center">Finish</a>
              </div>
            </div>
          </div>

          <div class="col s2">
            <div class="row " style=" padding:35px 20px 0px 0px; ">
              <div id="up" class="col s12 bg_light1 waves-effect waves-light" style="height:100px; border-radius:15px;">
                <img src="../img/up-arrow.svg" class="responsive-img"></img>
              </div>
            </div>
            <div class="row" style=" padding:5px 20px 0px 0px;">
              <div id="down" class="col s12 bg_light1 waves-effect waves-light" style="height:100px; border-radius:15px;">
                <img src="../img/down-arrow.svg" class="responsive-img"></img>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
  <div id="modal_reset" class="modal">
    <div class="modal-content">
      <div class="row">
        <div class="col s4">
          <img src="../img/refreshing.svg" class="responsive-img"></img>
        </div>
        <div class="col s8">
          <div class="row">
            <div class="col s12">
              <div style="font-size: 20px;font-weight:900;">Apakah anda yakin untuk reset semua hasil timbangan?</div>
            </div>
            <div class="col s12">
              <a class="waves-effect waves-light btn btn-large btn-border bg_brown1 white-text text-center fullwidth">Ya, saya yakin.</a>
            </div>
            <div class="col s12 pt3">
              <a class="waves-effect waves-light btn btn-large btn-border outline_brown1 text-center fullwidth">Batalkan</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="modal_finish" class="modal">
    <div class="modal-content">
      <div class="row">
        <div class="col s4">
          <img src="../img/scale.png" class="responsive-img"></img>
        </div>
        <div class="col s8">
          <div class="row">
            <div class="col s12">
              <div style="font-size: 20px;font-weight:900;">Apakah anda yakin sudah menimbang semua obat?</div>
            </div>
            <div class="col s12">
              <a id="finishYakin" class="waves-effect waves-light btn btn-large btn-border bg_brown1 white-text text-center fullwidth">Ya, saya yakin.</a>
            </div>
            <div class="col s12 pt3">
              <a id="finishRagu" class="waves-effect waves-light btn btn-large btn-border outline_brown1 text-center fullwidth">Batalkan</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="modal_start" class="modal">
    <div class="modal-content">
      <div class="row">
        <div class="col offset-s4 s4">
          <img src="../img/scale.png" class="responsive-img"></img>
        </div>
      </div>
      <div class="row">
        <div class="col s12">
          <div style="text-align:center; font-size: 36px;font-weight:900;">Silahkan Menimbang</div>
        </div>
      </div>
      <div class="row">
        <div class="col s12">
          <div style="text-align:center; font-size: 24px;font-weight:400;">Pastikan berat aktual sama dengan berat target</div>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript" src="../js/jquery-3.3.1.min.js"></script>
  <script type="text/javascript" src="../js/materialize.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      function getUrlParameter(name) {
        name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
        var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
        var results = regex.exec(location.search);
        return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
      };
      //$('.merk').on('click', function() {
      //  var id = $(this).attr('data_id');
      //  var merk = $(this).attr('data_merk');
        //console.log(id, merk);
      //  window.location.href = 'formula.php?id=' + id + '&merk=' + merk;
      //});
      var nowPos = 0;
      var body = $("html, body");
      $("#down").click(function() {
        var positionScroll = $('.menu').scrollTop();
        if (positionScroll < 1080) {
          nowPos += 80;
          $('.menu').stop().animate({
            scrollTop: nowPos
          }, 400, 'swing', function() {
            //alert("Finished animating");
          });
        }
      });
      $("#up").click(function() {
        var positionScroll = $('.menu').scrollTop();
        if (positionScroll > 0) {
          nowPos -= 80;
          $('.menu').stop().animate({
            scrollTop: nowPos
          }, 400, 'swing', function() {
            //alert("Finished animating");
          });
        }
      });

      //$('.menu').delegate('.item_produk', 'click', function() {
      //  window.location = "./formula.php"
      //});

      $('.modal').modal();
      $('#reset').on('click', function() {
        $('#modal_reset').modal('open');
      });
      $('#finish').on('click', function() {
        $('#modal_finish').modal('open');
      });
      $('#back').on('click', function() {
        window.location = './home.php'
      });
      $('#finishRagu').on('click', function() {
        $('#modal_finish').modal('close');
      });
      $('#finishYakin').on('click', function() {
        var sql = `SELECT * FROM spk WHERE no_spk_produksi = "${getUrlParameter('spk')}" AND (state = "" OR state IS NULL)`;
        $.ajax({
          url: './api/api.php?sql=' + sql,
          method: "GET",
          statusCode: {
            200: function(data, textStatus, jqXHR) {
              console.log(data)
              var obj = JSON.parse(data);
              if (obj.rows.length == 0) {
                var sql = `SELECT * FROM hasil WHERE no_spk_produksi = "${getUrlParameter('spk')}"`;
                $.ajax({
                  url: './api/api.php?sql=' + sql,
                  method: "GET",
                  statusCode: {
                    200: function(data, textStatus, jqXHR) {
                      console.log(data)
                      var obj = JSON.parse(data);
                      if (obj.rows.length > 0) {
                        saveTimbangSPK(obj.rows, function(){
                          var sql = `DELETE FROM spk WHERE no_spk_produksi = "${getUrlParameter('spk')}"`;
                          $.ajax({
                            url: './api/api.php?sql=' + sql,
                            method: "GET",
                            statusCode: {
                              200: function(data, textStatus, jqXHR) {
                                window.location = './home.php'
                              }}});
                        });
                      } else {
                        alert('Belum ada Hasil Timbang')
                      }
                    },
                    500: function(data, textStatus, jqXHR) {}
                  }
                });

              } else {
                alert('Penimbangan belum selesai')
              }
            },
            500: function(data, textStatus, jqXHR) {}
          }
        });
      });
      $('#start').on('click', function() {
        $('#modal_start').modal('open');
        var spk = $(this).data('spk');
        var nama = $(this).data('nama');
        var idresep = $(this).data('idresep');

        var arrDatas = $('table tbody tr').toArray().map(function(elm) {

          return {
            'no_spk_produksi': $(elm).data('nospk'),
            'id_obat': $(elm).data('idobat'),
            'nama_obat': $(elm).data('namaobat'),
            'berat': $(elm).data('berat'),
            'satuan': $(elm).data('satuan'),
          };
        });
        //console.log(arrDatas)
        sendSPK(arrDatas, function() {
          setTimeout(function() {
            window.location = './timbangan.php?spk=' + spk + "&nama=" + nama + "&idresep=" + idresep;
          }, 500)
        });


      });

      function saveTimbangSPK(arr, callback) {
        var doneLoop = 0;
        for (var i = 0; i < arr.length; i++) {
          var data = arr[i];
          $.ajax({
            url: './api/save_timbang.php',
            method: "POST",
            data: data,
            statusCode: {
              200: function(data, textStatus, jqXHR) {
                doneLoop++;
                console.log(data);
                if( doneLoop == arr.length ) {
                  callback();
                }
              },
              500: function(data, textStatus, jqXHR) {
                doneLoop++;
                console.log(data);
                if( doneLoop == arr.length ) {
                  callback();
                }
              }
            }
          });
        }
        callback();
      }

      function sendSPK(arr, callback) {
        var doneLoop = 0;
        for (var i = 0; i < arr.length; i++) {
          var data = arr[i];
          $.ajax({
            url: './api/post_spk.php',
            method: "POST",
            data: data,
            statusCode: {
              200: function(data, textStatus, jqXHR) {
                doneLoop++;
                console.log(data);
                if( doneLoop == arr.length ) {
                  callback();
                }
              },
              500: function(data, textStatus, jqXHR) {
                doneLoop++;
                console.log(data);
                if( doneLoop == arr.length ) {
                  callback();
                }
              }
            }
          });
        }
        
      }
    });
  </script>
</body>

</html>