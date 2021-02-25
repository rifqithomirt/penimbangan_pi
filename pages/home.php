 <!DOCTYPE html>
  <html>
    <head>
      <?php require_once('../connections/cnPenimbangan.php'); ?>
      <?php 
        session_start();
        if($_SESSION['status']!="login"){
          header("location:../index.php?message=not_logged_in");
        }
        $sql = "SELECT nama_user,posisi FROM data_user WHERE username = '" . $_SESSION['username'] . "'";
        $result = mysqli_query($cnPenimbangan, $sql);
        $row = mysqli_fetch_array($result);
        #echo json_encode($row);
      ?>
      <link type="text/css" rel="stylesheet" href="../css/materialize.min.css"  media="screen,projection"/>
      <link type="text/css" rel="stylesheet" href="../css/all.css"  media="screen,projection"/>
      <link type="text/css" rel="stylesheet" href="../css/jquery-confirm.min.css"  media="screen,projection"/>
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
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
          if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
          return i;
        }
      </script>
      <style>
        .flex-container {
          display: flex;
          flex-direction: column;
        }

        .flex-container > div {
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
                      <img  src="../img/logo_baru.png" class="responsive-img"></img>
                    </div>
                  </div>
                </div>
                <div class="bg_light1" style="height: 75px; margin-bottom:30px; border-radius: 15px;">
                  <div class="row">
                    <div class="col s4" style="text-align:center; padding-top:20px;">
                      <img src="../img/img_fotoprofile.jpeg" style="width:30px; height:30px; border-radius: 50%;"></img>
                    </div>
                    <div class="col s8" style="text-align:left; margin:auto;" >
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
                <h5 class="white-text mt-0"><b>DAFTAR RESEP</b></h5>
                <div class="menu" style="height: 520px; overflow: scroll;">
                  <?php 

                    $url = "https://produksi.goldenrubber.co.id/api/obat/list_resep";
                    $data = array('token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1bmlxdWVJZCI6IjEiLCJ1c2VyIjoicGVyZGFtYWlhbmluZG9uZXNpYSIsInRpbWVTdGFtcCI6IjIwMTktMDUtMTEgMTI6MDk6MzQifQ.6Yrsq8qFN6d_eiGcjPL096S3M1OX-qe6z2wtx8Xp9Z4', 'apikey' => '0ff4cf817ed19fd8354fe72f9cc8e1d16e88f4b1');

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
                    if ($result === FALSE) { echo("<p class='white-text'>Error</p>"); }
                    else {
                      //echo($result);
                      $obj = json_decode($result, false);
                      //echo(json_encode($obj[0]));
                      foreach ($obj as $doc) {
                        echo ('<div data-idresep="'. $doc->id_resep  .'" data-nama="'. $doc->nama_resep  .'" data-spk="'. $doc->no_spk_produksi  .'" class="item_produk row bg_light1 white-text waves-effect waves-light" style="height:100px;   border-radius: 15px;">
                        <div class="col s12">
                          <div class="row row_label_list">
                            <div class="col s6">
                              <div class="label_list">Nama Resep</div>
                            </div>
                            <div class="col s3">
                              <div class="label_list">Jumlah Resep</div>
                            </div>
                            <div class="col s1">
                              <div class="label_list">Sisa</div>
                            </div>
                            <div class="col s2">
                              <div class="label_list">Nomor SPK</div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col s6">
                              <div class="item_list">'. $doc->nama_resep .'</div>
                            </div>
                            <div class="col s3">
                              <div class="item_list">'. $doc->jumlah_resep  .'</div>
                            </div>
                            <div class="col s1">
                              <div class="item_list">'. $doc->sisa  .'</div>
                            </div>
                            <div class="col s2">
                              <div class="item_list">'. $doc->no_spk_produksi  .'</div>
                            </div>
                          </div>
                        </div></div>');
                      }
                    }
                    //var_dump($result);
                    //$sql = "SELECT * FROM merk";
                    //$result = mysqli_query($cnPenimbangan, $sql);
                    
                  ?>
                </div>
              </div>

              <div class="col s2">
                    <div class="row" style=" padding:35px 20px 0px 0px; ">
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

      
      
      <script type="text/javascript" src="../js/jquery-3.3.1.min.js"></script>
      <script type="text/javascript" src="../js/materialize.min.js"></script>
      <script type="text/javascript" src="../js/jquery-confirm.min.js"></script>
      <script type="text/javascript">
        $('.merk').on('click', function(){
          var id = $(this).attr('data_id');
          var merk = $(this).attr('data_merk');
          //console.log(id, merk);
          window.location.href='formula.php?id='+ id +'&merk=' + merk;
        });
        var nowPos = 0;
        var body = $("html, body");
        $("#down").click(function() {
          var positionScroll = $('.menu').scrollTop();
          if( positionScroll < 1080 ) {
            nowPos += 80;
            $('.menu').stop().animate({scrollTop:nowPos}, 400, 'swing', function() { 
              //alert("Finished animating");
            });
          }
        });
        $("#up").click(function() {
          var positionScroll = $('.menu').scrollTop();
          if( positionScroll > 0 ) {
            nowPos -= 80;
            $('.menu').stop().animate({scrollTop:nowPos}, 400, 'swing', function() { 
              //alert("Finished animating");
            });
          }
        });

        $('.menu').delegate('.item_produk', 'click', function( e ){
          var spk = $(this).data('spk');
          var nama = $(this).data('nama');
          var idresep = $(this).data('idresep');
          window.location = "./obat.php?spk=" + spk + "&nama=" + nama + "&idresep=" +idresep;  
        });

        
      </script>
    </body>
  </html>
