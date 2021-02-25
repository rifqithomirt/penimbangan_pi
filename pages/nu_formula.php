 <?php require_once('../connections/cnPenimbangan.php'); ?>
<?php 
	session_start();
	if($_SESSION['status']!="login"){
		header("location:../index.php?message=not_logged_in");
	}
	$sql = "SELECT nama_user,posisi FROM data_user WHERE username = '" . $_SESSION['username'] . "'";
	$result = mysqli_query($cnPenimbangan, $sql);
	$row = mysqli_fetch_array($result);
?>
<!DOCTYPE html>
  <html>
    <head>
      <link type="text/css" rel="stylesheet" href="../css/materialize.min.css"  media="screen,projection"/>
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
      <div class="row">
        <div class="col s12 blue-grey lighten-5">
          <div style="height:600px; padding-top: 30px; padding-left:20px;">
            <div class="row">
              <div class="flex-container col s3">
                <div class="blue-grey darken-3" style="height: 75px; margin-bottom:30px; border-radius: 15px;">
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
                <div class="blue-grey darken-3" style="height: 200px; margin-bottom:30px; border-radius: 15px;">
                  <div class="row">
                  <div class="col s12" style="text-align:center; padding: 15px 35px 0px 35px;">
                      <p class="white-text" style="margin: 0px; padding: 0px;">INFORMASI</p>
                      <hr>
                    </div>
                    <div class="col s12" style="text-align:left; padding: 5px 35px 0px 35px;">
                      <p class="white-text" style="margin:0px; padding:0px; font-size:12px;">Waktu</p>
                      <p class="white-text" style="margin:0px; padding:0px; font-size:24px; letter-spacing: 2px;"><b><span id="time_detail">00:00:00</span></b></p>
                    </div>
                    <div class="col s12" style="text-align:left; padding: 5px 35px 0px 35px;">
                      <p class="white-text" style="margin:0px; padding:0px; font-size:12px;">Tanggal</p>
                      <p class="white-text" style="margin:0px; padding:0px; font-size:24px; letter-spacing: 2px;"><b><?php echo date("d M Y") ?></b></p>
                    </div>
                  </div>
                </div>
                <div class="blue-grey darken-3" style="height: 150px; margin-bottom:30px; border-radius: 15px;"><div class="row">
                  <div class="col s12" style="text-align:center; padding: 15px 35px 0px 35px;">
                      <p class="white-text" style="margin: 0px; padding: 0px;">ACTION</p>
                      <hr>
                    </div>
                    <div class="col s12" style="text-align:center; padding: 5px 35px 0px 35px;">
                      <a href="formula.php?id=<?php echo htmlspecialchars($_GET['id']) ?>&merk=<?php echo htmlspecialchars($_GET['merk']) ?>" class="waves-effect waves-light btn" style="width:150px;">Reload</a>
                    </div>
                    <div class="col s12" style="text-align:center; padding: 5px 35px 0px 35px;">
                      <a href="logout.php" class="waves-effect waves-light btn" style="width:150px;">Logout</a>
                    </div>
                  </div></div>  
              </div>
              <div class="col s9 white" style="height: 475px; width:700px; border-radius: 1em; margin-left: 20px;">
                <div class="menu" style="margin:20px;">
                  <h5 style="font-size:19px;"><b>DAFTAR OBAT - <span><?php echo htmlspecialchars($_GET["merk"]) ;?></span></b></h5>
                  <div style="height:380px; overflow:auto;">
                  <table id="table_formula" class="table_data" style="max-height:380px; overflow: scroll;">
                    <thead>
                      <tr style="height: 1em;">
                          <th class="teal lighten-3" style="border-radius: 1em 0 0 1em; padding: 7px 5px;  text-align: center;">Nama</th>
                          <th class="teal lighten-3" style="padding: 7px 5px; text-align: center;">Netto</th>
                          <th class="teal lighten-3" style="padding: 7px 5px; text-align: center;">Unit</th>
                          <th class="teal lighten-3" style="border-radius: 0 1em 1em 0; padding: 7px 5px; text-align: center;">Status</th>
                      </tr>
                    </thead>
                    <tbody id="list-formula">
                     
                    </tbody>
                  </table>
                  </div>
                  <div>
                    <a href="home.php" class="waves-effect waves-light btn">back</a>
                    <a onclick="reset()" class="waves-effect waves-light btn">reset</a>
                    <a onclick="start()" class="waves-effect waves-light btn" style="float: right;">start</a>
                  </div>
                </div>
              </div>
            </div>
            
            <div style="float:left;">
              <p style="font-size:12px;">@ 2020 PT GOLDEN RUBBER INDUSTRY</p>
            </div>
          </div>
        </div>
      </div>
      <script type="text/javascript" src="../js/materialize.min.js"></script>
      <script type="text/javascript" src="../js/jquery-3.3.1.min.js"></script>
      <script src="../assets/js/js-bootstrap/bootstrap.js"></script>
      <script type="text/javascript">
        var funRequestGet = function( option, callback ){
          httpGet("api.php?tablename=" + option.tablename, callback);
        }
        var funInsertHasil = function(option, callback) {
          var buildQuerystring = Object.keys(option).map(( objName ) => { return objName + '=' + option[objName]; }).join('&');
          console.log(encodeURIComponent(buildQuerystring) );
          httpGet("insert.php?" + buildQuerystring, callback);
        };
        var funUpdateStatus = function(option, callback){
          var buildQuerystring = Object.keys(option).map((objName) => { return objName + '=' + option[objName]; }).join('&');
          httpGet("update.php?" + buildQuerystring, callback);
        }
        var httpGet = function(url, callback){
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              callback( this.responseText );      
            }
          };
          xmlhttp.open("GET", url, true);
          xmlhttp.send();
        }
        var httpPost = function(url, obj, callback){
          var xmlhttp = new XMLHttpRequest();
          let json = JSON.stringify(obj);
          xmlhttp.open("POST", url);
          xmlhttp.onloadend = function() {
              callback(this);
          };
          xmlhttp.setRequestHeader('Content-type', 'application/json; charset=utf-8');
          xmlhttp.send(json);
        }
      </script>
      <script type="text/javascript">
        //var URL = "http://192.168.100.30:3008/";
        var URL = "http://localhost:3008/";
        function getUrlParameter(name) {
            name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
            var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
            var results = regex.exec(location.search);
            return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
        };
        idMerk = getUrlParameter('id');
        merkOnGoing = getUrlParameter('merk');
        $('#nama_produk').empty().text(merkOnGoing);
        httpGet(URL + "master", function( master_d ){
          var master_data = JSON.parse(master_d);
          var objMaster_data = {
            'obat': {},
            'warna': {}
          }; 
          master_data.forEach(function( headData ){
            var tipe = Object.keys(headData)[0];
              headData[tipe].forEach(function(objData){
                objMaster_data[tipe][objData['id_' + tipe]] = objData['nama_' + tipe];
              });
          });
          console.log(objMaster_data);
          console.log(URL + "komposisi" );
          httpGet( URL + "komposisi", function( master ){
            var komposisi = JSON.parse(master);
            console.log(komposisi);
            var objKomposisi = komposisi.reduce(( old, obj ) => {
              old[obj['id_merk']] = obj['komposisi'];
              return old;
            }, {});
            var arrData = objKomposisi[idMerk];
            console.log(arrData);
            httpGet("api/get_status_process.php",  function(res){
              var arrRes = JSON.parse(res);
              console.log(arrRes);
              if( 'rows' in arrRes ) {
                var objArrProcess = {};
                arrRes.rows.forEach(function( data ){

                  objArrProcess[ data['id_merk'] + '-' + data['id'] ] = data;
                });
                console.log(objArrProcess);
                var str = arrData.map(( obj ) => {
                  if( (idMerk + '-' + obj.id_obat) in objArrProcess ) {
                    //console.log(objArrProcess[idMerk + '-' + obj.id_obat]['status']);
                    var status = objArrProcess[idMerk + '-' + obj.id_obat]['status'] == 'finished' ? '<span class="badge badge-success">selesai</span>' : '<span class="badge badge-warning">belum</span>';
                  } else {
                    var status = '<span class="badge badge-warning">belum</span>'
                  }
                  
                  return '<tr class="data" data-id="'+ obj.id_obat +'" data-merk="'+ merkOnGoing +'" ><td>' + objMaster_data['obat'][obj.id_obat] + '</td><td>' + obj.netto + '</td><td>' + obj.satuan + '</td><td>' + status + '</td></tr>';
                }).join('');
                $('#list-formula').html(str);
              } else{
                var str = arrData.map(( obj ) => {
                  return '<tr class="data" data-id="'+ obj.id_obat +'" data-merk="'+ merkOnGoing +'" ><td>' + objMaster_data['obat'][obj.id_obat] + '</td><td>' + obj.netto + '</td><td>' + obj.satuan + '</td><td>' + '<span class="badge badge-warning">belum</span>' + '</td></tr>';
                }).join('');
                $('#list-formula').html(str);
              }
            });

            setInterval(function(){

              httpGet("api/get_status_process.php",  function(res){
                var arrRes = JSON.parse(res);
                if( 'rows' in arrRes ) {
                  var objArrProcess = {};
                  arrRes.rows.forEach(function( data ){

                    objArrProcess[ data['id_merk'] + '-' + data['id'] ] = data;
                  });
                  console.log(objArrProcess);
                  var str = arrData.map(( obj ) => {
                    if( (idMerk + '-' + obj.id_obat) in objArrProcess ) {
                      //console.log(objArrProcess[idMerk + '-' + obj.id_obat]['status']);
                      var status = objArrProcess[idMerk + '-' + obj.id_obat]['status'] == 'finished' ? '<span class="badge badge-success">selesai</span>' : '<span class="badge badge-warning">belum</span>';
                    } else {
                      var status = '<span class="badge badge-warning">belum</span>'
                    }
                    
                    return '<tr class="data" data-id="'+ obj.id_obat +'" data-merk="'+ merkOnGoing +'" ><td>' + objMaster_data['obat'][obj.id_obat] + '</td><td>' + obj.netto + '</td><td>' + obj.satuan + '</td><td>' + status + '</td></tr>';
                  }).join('');
                  $('#list-formula').html(str);
                } else{
                  var str = arrData.map(( obj ) => {
                    return '<tr class="data" data-id="'+ obj.id_obat +'" data-merk="'+ merkOnGoing +'" ><td>' + objMaster_data['obat'][obj.id_obat] + '</td><td>' + obj.netto + '</td><td>' + obj.satuan + '</td><td>' + '<span class="badge badge-warning">belum</span>' + '</td></tr>';
                  }).join('');
                  $('#list-formula').html(str);
                }
              });

            }, 2500);

          });
        });
        start = function(){
          var response = confirm('Anda yakin?');
          if( response ) {

            httpGet("api/check_status.php",  function(res){
              var arrRes = JSON.parse(res);
              //console.log(arrRes);
              if( arrRes.length == 0 ) {
                httpGet("api/param.php",  function(res){
                  var objParamTimbangan = JSON.parse(res);
                  var objTimbanganID = {};
                  objParamTimbangan.rows.forEach(function( row ){
                    objTimbanganID[row['id_material']] = row['id_timbangan'];
                  });
                  var arrTDs = Array.from(document.getElementById("table_formula").rows);
                  var arrData = arrTDs.filter(( tr ) => {
                    return $(tr).hasClass( "data" );
                  }).map(( tr , index) => {
                    var child = $(tr).children();
                    return {
                      id : $(tr).attr('data-id'),
                      nama : $(child[0]).text().trim(),
                      netto : $(child[1]).text().trim() * 1,
                      status : 'created',
                      timbangan :  objTimbanganID[ $(tr).attr('data-id') ] * 1,
                      merk : $(tr).attr('data-merk'),
                      id_merk : idMerk
                    };
                  });
                  
                  httpPost("api/post_status.php", arrData, function(res){
                    console.log(res);
                    alert('Sukses');
                  });
                });
              } else {
                alert('Proses Penimbangan Belum Selesai')
              }
            });
          }
        }
        reset = function(){
          var response = confirm('Anda yakin?');
          if( response ) {
            httpPost("api/reset_status.php", [{'reset':true}] , function(res){
              console.log(res);
              alert('Sukses');
              //window.location.reload();
            });
          }
        }
      </script>
    </body>
  </html>
