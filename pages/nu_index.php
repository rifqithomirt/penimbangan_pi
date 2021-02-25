<!DOCTYPE html>
 <!-- <meta http-equiv="refresh" content="3;url=http://localhost/penimbangan/index.php"/> -->
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Login Form</title>
  <link rel="stylesheet" href="assets/css/css-login/style.css">
  <link href="assets/keyboard-master/css/keyboard.css" rel="stylesheet">
  <link href="assets/css/jquery-ui.css" rel="stylesheet">
  <link href="assets/css/css-bootstrap/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="wrapper">
  <div class="container">
    <?php 
      if(isset($_GET['message'])){
        if($_GET['message'] == "failed"){
          echo '<div class="box-info-error">';
          echo "Login gagal! username dan password salah!";
          echo '</div>';
        }else if($_GET['message'] == "logout"){
          echo '<div class="box-info">';
          echo "Anda telah berhasil logout";
          echo '</div>';
        }else if($_GET['message'] == "not_logged_in"){
          echo '<div class="box-info-error">';
          echo "Anda Belum Login!";
          echo '</div>';
        }
                  
      }
    ?>
      <h1 style="color: #fff;">Welcome</h1>
      <form class="form" name="a" method="POST" action="pages/process.php">
        <p><input id="user" type="text" name="username" value="" placeholder="Username"></p>
        <p><input id="pass" type="password" name="password" value="" placeholder="Password"></p>
        <p class="submit"><input type="submit" name="masuk" value="Login"></p>
      </form>

  <div class="login-help">
    <p>&nbsp;</p>
  </div>
  <ul class="bg-bubbles">
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
  </ul>
</div>
</div>
<!-- jQuery -->
<script src="assets/js/jquery-3.3.1.min.js"></script>
<script src="assets/js/jquery-ui.min.js"></script>
<script src="assets/keyboard-master/js/jquery.keyboard.js"></script>
<script src="assets/keyboard-master/js/jquery.keyboard.extension-autocomplete.js"></script>

<!-- optional plugins -->
<script src="assets/keyboard-master/js/jquery.mousewheel.js"></script>
<script type="text/javascript">
  $('#user').on('mouseenter', function(){
  console.log('berhasil');
  $(this)
    .keyboard({ layout: 'qwerty' })
    .autocomplete({source: availableTags})
    .addAutocomplete({
      position : {
        of : null,        // when null, element will default to kb.$keyboard
        my : 'center top', // 'center top', (position under keyboard)
        at : 'center bottom',  // 'center bottom',
        collision: 'flip'
      }
    })
});
$('#pass').on('mouseenter', function(){
  console.log('berhasil');
  $(this)
    .keyboard({ layout: 'qwerty' })
    .autocomplete({source: availableTags})
    .addAutocomplete({
      position : {
        of : null,        // when null, element will default to kb.$keyboard
        my : 'center top', // 'center top', (position under keyboard)
        at : 'center bottom',  // 'center bottom',
        collision: 'flip'
      }
    })
});
</script>
</body>
</html>
