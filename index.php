
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Login | Digital Filing System</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="description" content="Aplikasi Persediaan Obat pada Apotek">
    <meta name="author" content="Indra Styawantoro" />

     <!-- favicon -->
     <link rel="shortcut icon" href="assets/img/favicon.png" />
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="assets/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/css/adminlte.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="assets/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="assets/plugins/summernote/summernote-bs4.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">

  </head>
  <body class="login-page">
    <div class="login-box">
      <?php  
      // fungsi untuk menampilkan pesan
      // jika alert = "" (kosong)
      // tampilkan pesan "" (kosong)
      if (empty($_GET['alert'])) {
        echo "";
      } 
      // jika alert = 1
      // tampilkan pesan Gagal "Username atau Password salah, cek kembali Username dan Password Anda"
      elseif ($_GET['alert'] == 1) {
        echo "<div id='alert-message'class='alert alert-danger alert-dismissable shadow'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
        <h4>  <i class='icon fa fa-times-circle'></i> Gagal Login!</h4>
        Username atau Password salah, cek kembali Username dan Password Anda.
        </div>";
      }
      // jika alert = 2
      // tampilkan pesan Sukses "Anda telah berhasil logout"
      elseif ($_GET['alert'] == 2) {
        echo "<div id='alert-message' class='alert alert-success alert-dismissable shadow'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
        <h4>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
        Anda telah berhasil logout.
        </div>";
      }
      // jika alert = 2
      // tampilkan pesan Sukses "Anda telah berhasil logout"
      elseif ($_GET['alert'] == 3) {
        echo "<div id='alert-message'class='alert alert-danger alert-dismissable shadow'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
        <h4>  <i class='icon fa fa-times-circle'></i>Error</h4>
        Anda harus login terlebih dahulu.
        </div>";
      }
      ?>
<div style="color:#3c8dbc" class="login-logo">
  <a>Kecamatan Larangan</a><br>
<img style="margin-top:12px" src="assets/img/kec-lar.png" alt="Logo" height="100">
</div>
<div style="color:#3c8dbc" class="login-logo">
<img style="margin-top:-12px" src="assets/img/AdminLTELogo.png" alt="Logo" height="40"><a>Digital Filing System</a>
</div><!-- /.login-logo -->

<div class="card card-outline card-primary shadow">
  <div class="card-body login-card-body">
        <p class="login-box-msg"><i class="fa fa-user icon-title"></i> Silahkan Login</p>

        <form action="login-check.php" method="POST">

        <div class="input-group mb-3">
          <div class="input-group-append ml-2">
            <div class="input-group-text rounded-pill shadow-sm">
              <span class="fas fa-user"></span>
            </div>
          </div>
          <input type="text" name="username" class="form-control rounded-pill shadow-sm" placeholder="Username" autocomplete="off" required />
        </div>
        <div class="input-group mb-3">
          <div class="input-group-append ml-2">
            <div class="input-group-text rounded-pill shadow-sm">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          <input type="password"  name="password" class="form-control rounded-pill shadow-sm" placeholder="Password" required />
        </div>
        <div class="form-group has-feedback"></div>
        <div class="row mt-4">
          <div class="col-2"></div>
          <!-- /.col -->
          <div class="col-7 ml-3">
            <input type="submit" class="btn btn-primary btn-lg btn-block rounded-pill shadow" name="login" value="Login" />
          </div>
          <!-- /.col -->
        </div>

          
        </form>

       </div>
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

 <!-- jQuery -->
 <script src="assets/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap-->
<script src="assets/js/bootstrap.js"></script>
<!-- ChartJS -->
<script src="assets/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="assets/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="assets/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="assets/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="assets/plugins/moment/moment.min.js"></script>
<script src="assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="assets/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/js/adminlte.js"></script>

    <!-- Jquery auto hide untuk menampilkan pesan error -->
    <script type="text/javascript">
        $("#alert-message").alert().delay(3000).slideUp('slow');
    </script>
    <!-- Javascript END -->
  </body>
</html>