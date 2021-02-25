<?php include('Connections/cnpenimbangan.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Pilihan</title>
	<link rel="stylesheet" type="text/css" href="js/jquery-confirm.min.css">
	<style type="text/css">
	body{
		max-width: 100%;
		max-height: 100%;
		font-family: 'Open Sans', sans-serif;

	}
		.menu {
			float: left;
			background-color: #ff6347;
			color: #fff;
			width: 300px;
			height: 115px;
			margin: 10px 20px 20px 10px;
			-moz-box-shadow: 0px 10px 14px -7px #8a2a21;
			-webkit-box-shadow: 0px 10px 14px -7px #8a2a21;
			box-shadow: 0px 10px 14px -7px #8a2a21;
			background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #c62d1f), color-stop(1, #f24437));
			background:-moz-linear-gradient(top, #c62d1f 5%, #f24437 100%);
			background:-webkit-linear-gradient(top, #c62d1f 5%, #f24437 100%);
			background:-o-linear-gradient(top, #c62d1f 5%, #f24437 100%);
			background:-ms-linear-gradient(top, #c62d1f 5%, #f24437 100%);
			background:linear-gradient(to bottom, #c62d1f 5%, #f24437 100%);
			filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#c62d1f', endColorstr='#f24437',GradientType=0);
			background-color:#c62d1f;
			-moz-border-radius:4px;
			-webkit-border-radius:4px;
			border-radius:4px;
			/*border:1px solid #d02718;*/
			text-decoration:none;
			text-shadow:0px 1px 0px #810e05;
		}
		.menu-img {
			width: 135px;
			height: 115px;
			top: 0;
			border-top-left-radius: 5px;
			border-bottom-left-radius: 5px;
			float: left;
		}
		.menu-title {
			width: 165px;
			height: 115px;
			float: left;
			font-size: 20pt;
			/*padding: 40px 10px;*/
			border-top-right-radius: 5px;
			border-bottom-right-radius: 5px;
			font-weight:bold; 
			color: #FFFFFF;
			display:inline-block;
			-moz-box-shadow: 0px 10px 14px -7px #8a2a21;
			-webkit-box-shadow: 0px 10px 14px -7px #8a2a21;
			box-shadow: 0px 10px 14px -7px #8a2a21;
			background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #c62d1f), color-stop(1, #f24437));
			background:-moz-linear-gradient(top, #c62d1f 5%, #f24437 100%);
			background:-webkit-linear-gradient(top, #c62d1f 5%, #f24437 100%);
			background:-o-linear-gradient(top, #c62d1f 5%, #f24437 100%);
			background:-ms-linear-gradient(top, #c62d1f 5%, #f24437 100%);
			background:linear-gradient(to bottom, #c62d1f 5%, #f24437 100%);
			filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#c62d1f', endColorstr='#f24437',GradientType=0);
			background-color:#c62d1f;/*
			-moz-border-radius:4px;
			-webkit-border-radius:4px;
			border-top-right-radius:4px;
			border-bottom-right-radius:4px;*/
			border:1px solid #d02718;
			text-decoration:none;
			text-shadow:0px 1px 0px #810e05;
		}
	</style>
</head>
<body>
	<?php 
		$sql = "SELECT idf, nama_produk FROM formula GROUP BY nama_produk";
		$query = mysqli_query($cnPenimbangan, $sql); 
	 while ($cetak = mysqli_fetch_array($query))
	 	echo '<div class="menu"> 
					<img src="image/logo.jpg" class="menu-img">
					<button id="BtnNamaProduk" class="menu-title">'.$cetak['nama_produk'].'</button>
				  </div>';
	?>
</body>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/jquery-confirm.min.js"></script>
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
		httpGet("modeSetStatus.php?" + buildQuerystring, callback);
	}
	var funFinish = function(callback){
		httpGet("select.php", callback);
	}
	var httpGet = function(url, callback){
		console.log(url);
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
<script type="text/javascript">
$('button#BtnNamaProduk').on('click',function(){
	var namaProdukPilihan = $(this).text();
	$.confirm({
	    title: 'Lanjutkan Proses!',
	    content: 'Apakah anda ingin menimbang '+ namaProdukPilihan +'?',
	    buttons: {
	        confirm: function () {
	        	$($('.jconfirm button')[2]).attr('disabled', 'disabled');
	          funUpdateStatus({no_urut: 1, nama_produk_aktif: namaProdukPilihan}, function(result){
	           	$.alert(result); 
	          });
	          return false;
	        },
	        cancel: function () {},
	        somethingElse: {
	            text: 'Finish',
	            btnClass: 'btn-blue',
	            keys: ['enter', 'shift'],
	            action: function(){
	                $.alert('Selesai Melakukan Penimbangan');
	            }
	        }
	    },
	    onContentReady: function () {
	    	$($('.jconfirm button')[2]).attr('disabled', 'disabled');
	        var jc = this;
	        this.$content.find('form').on('enter', function (e) {
	            e.preventDefault();
	            jc.$$formSubmit.trigger('click'); // reference the button and click it
	        });
	        $($('.jconfirm button')[0]).text('Start');
	        var funCheckFinish = function(){
	        	funFinish((result) => {
					result = JSON.parse(result);
					if (result.rows[0].no_urut_formula < result.rows[0].no_urut_status) {
						$($('.jconfirm button')[2]).removeAttr('disabled');
					}
						
				});
	        }
	        var funCheckStart = function(){
	        	funFinish((result) => {
					result = JSON.parse(result);
					if (result.rows[0].no_urut_formula >= result.rows[0].no_urut_status) {
						$($('.jconfirm button')[0]).attr('disabled', 'disabled');
					}
						
				});
	        }
	        setInterval(function(){
	        	funCheckStart();
	        	funCheckFinish();

	        }, 2500);
	    }
	}); 

});
</script>
</html>