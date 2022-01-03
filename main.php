<?php

session_start();
if (empty($_SESSION['hak_akses'])){
  echo "<meta http-equiv='refresh' content='0; url=index.php?alert=3'>";
  die();
} 

$timeout = 5; // setting timeout dalam menit
$logout = "index.php"; // redirect halaman logout

$timeout = $timeout * 60; // menit ke detik
if(isset($_SESSION['start_session'])){
  $elapsed_time = time()-$_SESSION['start_session'];
  if($elapsed_time >= $timeout){
    session_destroy();
    echo "<script type='text/javascript'>alert('Sesi telah berakhir');window.location='$logout'</script>";
  }
}

$_SESSION['start_session']=time();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Digital Filing System</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="description" content="Aplikasi Persediaan">
        <!-- favicon -->
        <link rel="shortcut icon" href="assets/img/favicon.png" />
        <!-- DataTables -->
        <link rel="stylesheet" href="assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
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
        <link href="assets/plugins/datepicker/datepicker.min.css" rel="stylesheet" type="text/css" />
        <!-- summernote -->
        <link rel="stylesheet" href="assets/plugins/summernote/summernote-bs4.css">
        <link rel="stylesheet" href="assets/css/bootstrap.css">
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
        <!-- calender -->
        <link rel="stylesheet" href="assets/calender/css/style.css">
	    	<link rel="stylesheet" href="assets/calender/css/pignose.calendar.css">
    
        <link rel="stylesheet" href="assets/css/style.css">
    </head>
    <body class="hold-transition sidebar-mini layout-fixed layout-footer-fixed layout-navbar-fixed">
        <div class="wrapper">
            <nav class="main-header navbar navbar-expand navbar-white navbar-light shadow-sm">
                <?php include "modules/template/header.php" ?>
            </nav>
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <?php include "modules/template/sidebar.php" ?>
            </aside>

            <div class="content-wrapper">
                <!-- panggil file "content-menu.php" untuk menampilkan content -->
                <?php include "content.php" ?>
                 <!-- Modal Logout -->
                <div class="modal" tabindex="-1" id="logout">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Logout</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p>Apakah Anda yakin ingin logout?</p>
                      </div>
                      <div class="modal-footer">
                        <a type="button" class="btn btn-danger" href="logout.php">Ya, Logout</a>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                      </div>
                    </div>
                  </div>
                </div><!-- /.modal -->
            </div><!-- /.content-wrapper -->

            <?php include "modules/template/footer.php"?>
        