<?php if (empty($_SESSION['hak_akses'])){
        echo "<meta http-equiv='refresh' content='0; url=../../index.php?alert=3'>";
        die();
      } ?>
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <h1>
        <i class="fa fa-home icon-title"></i> Dashboard
      </h1>
      <ol class="breadcrumb">
        <li><a href="?module=beranda"><i class=""></i></a></li>
      </ol>
    </div>
  </section>
  
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
    <div class="alert alert-info alert-dismissible fade show" role="alert">
    
            <i class="icon fa fa-user"></i> Selamat datang <strong><?php echo $_SESSION['nama_user']; ?>.</strong> Berikut adalah informasi data yang tersimpan dalam sistem.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
      </button>
    </div>
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div style="background-color:#00c0ef;color:#fff" class="small-box shadow rounded-lg">
          <div class="inner">
            <?php  
            // fungsi query untuk menampilkan data dari tabel obat
            $query = mysqli_query($config, "SELECT COUNT(id_surat) as jumlah FROM tbl_surat_masuk")
                                            or die('Ada kesalahan pada query tampil Data Obat: '.mysqli_error($config));

            // tampilkan data
            $data = mysqli_fetch_assoc($query);
            ?>
            <h3><?php echo $data['jumlah']; ?></h3>
            <p>Surat Masuk</p>
          </div>
          <div class="icon">
            <i class="fa fa-envelope"></i>
          </div>
          <?php  
          if ($_SESSION['hak_akses']!='Camat') { ?>
            <a href="?module=surat_masuk&act=add" class="small-box-footer" title="Tambah Data" data-toggle="tooltip"><i class="fa fa-plus"></i></a>
          <?php
          } else { ?>
            <a class="small-box-footer"><i class="fa"></i></a>
          <?php
          }
          ?>
        </div>
      </div><!-- ./col -->

      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div style="background-color:#00a65a;color:#fff" class="small-box shadow">
          <div class="inner">
            <?php   
            // fungsi query untuk menampilkan data dari tabel obat masuk
            $query = mysqli_query($config, "SELECT COUNT(id_surat) as jumlah FROM tbl_surat_keluar")
                                            or die('Ada kesalahan pada query tampil Data obat Masuk: '.mysqli_error($config));

            // tampilkan data
            $data = mysqli_fetch_assoc($query);
            ?>
            <h3><?php echo $data['jumlah']; ?></h3>
            <p>Surat Keluar</p>
          </div>
          <div class="icon">
            <i class="fa fa-paper-plane"></i>
          </div>
          <?php  
          if ($_SESSION['hak_akses']!='Camat') { ?>
            <a href="?module=surat_keluar&act=add" class="small-box-footer" title="Tambah Data" data-toggle="tooltip"><i class="fa fa-plus"></i></a>
          <?php
          } else { ?>
            <a class="small-box-footer"><i class="fa"></i></a>
          <?php
          }
          ?>
        </div>
      </div><!-- ./col -->

      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div style="background-color:#f39c12;color:#fff" class="small-box shadow">
          <div class="inner">
            <?php  
            // fungsi query untuk menampilkan data dari tabel obat
            $query = mysqli_query($config, "SELECT COUNT(id_disposisi) as jumlah FROM tbl_disposisi")
                                            or die('Ada kesalahan pada query tampil Data Obat: '.mysqli_error($config));

            // tampilkan data
            $data = mysqli_fetch_assoc($query);
            ?>
            <h3><?php echo $data['jumlah']; ?></h3>
            <p>Disposisi</p>
          </div>
          <div class="icon">
            <i class="fa fa-file"></i>
          </div>
          <a class="small-box-footer"><i class="fa"></i></a>
        </div>
      </div><!-- ./col -->

      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div style="background-color:#dd4b39;color:#fff" class="small-box shadow">
          <div class="inner">
            <?php   
            // fungsi query untuk menampilkan data dari tabel obat masuk
            $query = mysqli_query($config, "SELECT COUNT(id_klasifikasi) as jumlah FROM tbl_klasifikasi")
                                            or die('Ada kesalahan pada query tampil Data obat Masuk: '.mysqli_error($config));

            // tampilkan data
            $data = mysqli_fetch_assoc($query);
            ?>
            <h3><?php echo $data['jumlah']; ?></h3>
            <p>Klasifikasi Surat</p>
          </div>
          <div class="icon">
          <i class="fas fa-bookmark"></i>
          </div>
          <a class="small-box-footer" ><i class="fa"></i></a>
        </div>
      </div><!-- ./col -->
    </div><!-- /.row -->
    <div class="row">
      <div class="col-lg-12">
        <div class="calendar"></div>
          <div class="box"></div>
          <br>
        </div><br>
    </div>
  </section><!-- /.content -->

  
