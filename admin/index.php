<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="admin-css/style.css">
</head>
<body>
	<div class="container">
	<h2>FORM USER</h2>
		<form id="post" method="post">
			<div class="row">
				<div class="col-25">
					<label for="fname">Nama Lengkap</label>
				</div>
				<div class="col-75">
					<input type="text" id="nama_user" name="nama_user" placeholder="Nama Lengkap Anda...">
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="lname">Posisi</label>
				</div>
				<div class="col-75">
					<input type="text" id="posisi" name="posisi" placeholder="Posisi Pekerjaan Anda...">
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="lname">Username</label>
				</div>
				<div class="col-75">
					<input type="text" id="username" name="username" placeholder="Username...">
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="lname">Password</label>
				</div>
				<div class="col-75">
					<input type="text" id="password" name="password" placeholder="Password...">
				</div>
			</div>
			<div class="row">
				<button id="save" type="submit" value="simpan">SIMPAN</button>
			</div>
		</form>
	</div>
<script src="../js/jquery-3.3.1.min.js"></script>
<script src="../js/jquery-confirm.min.js"></script>
<script type="text/javascript">
	$(function(){
	$('#save').click(function(){
	var nama_user = $('#nama_user').val();
	var posisi 	  = $('#posisi').val();
	var username  = $('#username').val();
	var password  = $('#password').val();
		$.ajax({
		type:"POST",
		url:"save.php",
		data:$("#post").serialize(),
			success:function(data){
			alert("Nama User :" + " " + $('#nama_user').val()+ "\r\n" + 
				"Posisi :" + " " + $('#posisi').val() + "\r\n" +
				"Username :" + " " + $('#username').val() + "\r\n" +
				"Password :" + " " + $('#password').val()
				);
			location.reload('1500');
			},
		});
		return false;
	});
});
</script>
</body>
</html>