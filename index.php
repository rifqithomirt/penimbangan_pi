 <!DOCTYPE html>
  <html>
    <head>
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
      <link href="assets/keyboard-master/css/keyboard.css" rel="stylesheet">
      <link href="css/all.css" rel="stylesheet">
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <style>
        .ui-keyboard {
            border-radius: 0 0 0 0 !important;
            font-family: 'Helvetica Neue', Helvetica, sans-serif !important;
            left: 0px !important;
            top: auto !important;
            bottom: 0px;
            position: fixed !important;
            width: 100%;
        }
        .ui-keyboard-keyset {
          background-color: rgba(255, 255, 255, 0.3);
          border-radius: 30px;
        }
      </style>
    </head>

    <body>
      <div id="main" class="row">
        <div class="col s6 bg_dark1">
          <div class="container" style="height:600px; padding-top: 50px;">
            <br>
            <h5 class="white-text center-align" style="font-size: 40px;"><b>Selamat Datang!</b></h5>
            <p class="white-text center-align" style="font-size: 16px;">App Timbangan Obat dan Warna</p>
            <br>
            <div class="center-align">
              <img  src="img/logo_baru.png" height="270" width="270"></img>
            </div>
            <br>
            <br>
            <p class="white-text" style="font-size: 11px;">@ 2020 PT GOLDEN RUBBER INDUSTRY</p>
          </div>
        </div>
        <div class="col s6 bg_light1">
          <div class="container" style="height:600px; padding-top: 150px;">
            <?php 
              if(isset($_GET['message'])){
                if($_GET['message'] == "failed"){
                  echo '<div class="white-text box-info-error">';
                  echo "Login gagal! username dan password salah!";
                  echo '</div>';
                }else if($_GET['message'] == "logout"){
                  echo '<div class="white-text box-info">';
                  echo "Anda telah berhasil logout";
                  echo '</div>';
                }else if($_GET['message'] == "not_logged_in"){
                  echo '<div class="box-info-error">';
                  echo "Anda Belum Login!";
                  echo '</div>';
                }
              }
            ?>
            <div class="row">
              <form id="login_form" class="col s12" method="POST" action="pages/process.php">
                <label class="white-text"  for="username" style="font-size: 16px;">Username</label>
                <input id="user" name="username" style="font-size: 16px; background-color: #fff; border-bottom: none; border-radius: 17px; margin-top: 5px; padding-left: 10px;" placeholder="Username" id="username" type="text">
                <label class="white-text" for="password" style="font-size: 16px;">Password</label>
                <input id="pass" name="password" style="font-size: 16px; background-color: #fff; border-bottom: none; border-radius: 17px; margin-top: 5px; padding-left: 10px;" placeholder="Password" id="password" type="text">
                <br>
                <div class="center-align s12 mt-2">
                  <a onclick="document.getElementById('login_form').submit()" class="bg_brown1 fullwidth waves-effect waves-light btn"><b>Masuk</b></a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <script type="text/javascript" src="js/materialize.min.js"></script>
      <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
      <script src="assets/js/jquery-ui.min.js"></script>
      <script src="assets/keyboard-master/js/jquery.keyboard.js"></script>
      <script type="text/javascript">
        $('#user').keyboard({
            usePreview: false
          });
        $('#pass').keyboard({
            usePreview: false
          });
        </script>
    </body>
  </html>
