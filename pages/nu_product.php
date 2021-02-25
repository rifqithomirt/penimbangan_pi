<?php require_once('../connections/cnPenimbangan.php'); ?>
<?php 
	session_start();
	if($_SESSION['status']!="login"){
		header("location:index.php?message=not_logged_in");
	}
	$sql = "SELECT nama_user,posisi FROM data_user WHERE username = '" . $_SESSION['username'] . "'";
	$result = mysqli_query($cnPenimbangan, $sql);
	$row = mysqli_fetch_array($result);
	$sql = "SELECT idf, nama_produk FROM formula GROUP BY nama_produk";
	$queryFormula = mysqli_query($cnPenimbangan, $sql); 
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="../assets/css/style.css">
	<title>Swan</title>
	<script>
		function startTime() {
		  var today = new Date();
		  var h = today.getHours();
		  var m = today.getMinutes();
		  var s = today.getSeconds();
		  m = checkTime(m);
		  s = checkTime(s);
		  document.getElementById('txt').innerHTML =
		  h + ":" + m + ":" + s;
		  var t = setTimeout(startTime, 500);
		}
		function checkTime(i) {
		  if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
		  return i;
		}
	</script>
</head>
<body onload="startTime()">
	<header>
		<div class="title">PRODUKSI HARI INI</div>
		<div  class="date_time">
			<div class="box_time">
				<div id="txt" class="txt"></div>
				<div id="datetime" class="date"></div> 
			</div>
		</div>
		<div class="user_menu">
			<div class="user_logout_box">
				<a href="logout.php" class="user_logout">Logout</a>
			</div>
			<img src="../assets/image/avatar.png" class="img-admin">
			<div class="user_name">
				<div style="font-weight:bold;width: auto;text-transform: capitalize;"><?php echo $row['nama_user']; ?></div> 
				<div style="font-size: 10pt;width: auto;text-transform: capitalize;"><?php echo $row['posisi']; ?></div>
			</div> 
		</div>
	</header>

	<div class="containerMenu">
		<div class="iframe">
			<!--?php 
			 while ($cetak = mysqli_fetch_array($queryFormula))
			 	echo '<div class="menu"> 
						<img src="../assets/image/logo.jpg" class="menu-img">
						<button id="BtnNamaProduk" class="menu-title">'.$cetak['nama_produk'].'</button>
					</div>';
			?-->
		</div>
	</div>

	<footer>
		<img src="../assets/image/Untitled-1.png" class="logo-footer">
		<div class="pt_name"> 
			<div style="font-weight: bold;padding:0px 5px 0px;"> PT. PERDAMAIAN INDONESIA </div> 
			<div style="font-size: 10pt;padding:0px 5px 0px;">produsen karet gelang</div> 
	</footer>

<script src="/coba/assets/js/jquery-3.3.1.min.js"></script>
<script src="/coba/assets/js/js-bootstrap/bootstrap.js"></script>
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
</script>
<script>
	var dt = new Date();
	var months = new Array();
	 months[0] = "January";
	 months[1] = "February";
	 months[2] = "March";
	 months[3] = "April";
	 months[4] = "May";
	 months[5] = "June";
	 months[6] = "July";
	 months[7] = "August";
	 months[8] = "September";
	 months[9] = "October";
	 months[10] = "November";
	 months[11] = "December";
	var month = months[dt.getMonth()];
	document.getElementById("datetime").innerHTML = (("0"+dt.getDate()).slice(-2)) +" "+ month +" "+ (dt.getFullYear());
</script>
<script type="text/javascript">
	function getUrlParameter(name) {
	    name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
	    var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
	    var results = regex.exec(location.search);
	    return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
	};
	tipeProduk = getUrlParameter('tipe');
	httpGet("http://127.0.0.1:3008/master", function( master ){
		var master_data = JSON.parse(master);
		var filtered = master_data.filter(( obj ) => {
			var key = Object.keys(obj)[0];
			return key == tipeProduk;
		});
		var objProduk = filtered[0][tipeProduk];
		var str = objProduk.map(( obj ) => {
			console.log(obj);
			return '<div class="menu"><img src="../assets/image/logo.jpg" class="menu-img"><button id="BtnNamaProduk" class="menu-title" onclick="window.location.href='+ "'" +'formula.php?tipe='+ tipeProduk + "&id=" + obj["id_" + tipeProduk] + "'" +';">' + obj["nama_" + tipeProduk] + '</button></div>';
		}).join('');
		$('.iframe').html(str);
	});
</script>
</body>
</html>