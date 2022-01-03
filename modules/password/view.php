<?php
if (empty($_SESSION['hak_akses'])){
        echo "<meta http-equiv='refresh' content='0; url=../../index.php?alert=3'>";
        die();
      } ?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-sm">
    <h1>
      <i class="ml-4 fa fa-lock icon-title"></i> Ubah Password
    </h1>
  </div>  
</section>

<!-- Main content -->
<section class="content">
  <div class="container-sm">
    <div class="col-md-12">

    <?php  
    // fungsi untuk menampilkan pesan
    // jika alert = "" (kosong)
    // tampilkan pesan "" (kosong)
    if (empty($_GET['alert'])) {
      echo "";
    } 
    // jika alert = 1
    // tampilkan pesan Gagal "Paswword lama Anda salah"
    elseif ($_GET['alert'] == 1) {
      echo "<div id='alert-message' class='alert alert-danger alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-times-circle'></i> Gagal!</h4>
              Paswword lama Anda salah.
            </div>";
    }
    // jika alert = 2
    // tampilkan pesan Gagal "Password baru dan Ulangi password baru tidak cocok"
    elseif ($_GET['alert'] == 2) {
      echo "<div id='alert-message' class='alert alert-danger alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-times-circle'></i> Gagal!</h4>
              Password baru dan Ulangi password baru tidak cocok.
            </div>";
    }
    // jika alert = 3
    // tampilkan pesan Sukses "Password berhasil diubah"
    elseif ($_GET['alert'] == 3) {
      echo "<div id='alert-message' class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
              Password berhasil diubah.
            </div>";
    }
    ?>

      <!-- form ubah password -->
      <div class="card card-outline card-dark shadow">
        <!-- form start -->
        <form role="form" class="form-horizontal" method="POST" action="modules/password/proses.php">
          <div class="card-body px-5">
          
            <div class="row form-group">
              <label class="col-sm-3 control-label">Password Lama</label>
              <div class="col-sm">
                <input type="password" class="form-control" name="old_pass" autocomplete="off" required>
              </div>
            </div>

            <div class="row form-group">
              <label class="col-sm-3 control-label">Password Baru</label>
              <div class="col-sm">
                <input type="password" class="form-control" name="new_pass" autocomplete="off" required>
              </div>
            </div>

            <div class="row form-group">
              <label class="col-sm-3 control-label">Ulangi Password Baru</label>
              <div class="col-sm">
                <input type="password" class="form-control" name="retype_pass" autocomplete="off" required>
              </div>
            </div>
            <div class="modal-footer">
              <button onclick="window.history.back()" type="button"  class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> BATAL</button>
              <button type="submit" name="simpan" value="Simpan" class="btn btn-primary"><i class="fas fa-save"></i> SIMPAN</button>
            </div>
          </div>
        </form>
      </div><!-- card-outline -->
    </div><!--/.col -->
  </div>   <!-- /.row -->
</section><!-- /.content -->