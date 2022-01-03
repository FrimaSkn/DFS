
<?php  
if (isset($_SESSION['id_user'])) {
  // fungsi query untuk menampilkan data dari tabel user
  $query = mysqli_query($config, "SELECT * FROM tbl_users WHERE id_user='$_SESSION[id_user]'") 
                                  or die('Ada kesalahan pada query tampil data user : '.mysqli_error($config));
  $data  = mysqli_fetch_assoc($query);
} 
?>

<!-- Content Header (Page header) -->
<section class="content-header container-md">
  <h1>
    <i class="fa fa-user icon-title"></i> Profil User
  </h1>
</section>

<!-- Main content -->
<section class="content container-md">
  <div class="row">
    <div class="col-md-10">

    <?php  
    // fungsi untuk menampilkan pesan
    // jika alert = "" (kosong)
    // tampilkan pesan "" (kosong)
    if (empty($_GET['alert'])) {
      echo "";
    } 
    // jika alert = 1
    // tampilkan pesan Sukses "Profil user berhasil diubah"
    elseif ($_GET['alert'] == 1) {
      echo "<div id='alert-message' class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
              Profil user berhasil diubah.
            </div>";
    }
    // jika alert = 2
    // tampilkan pesan Upload Gagal "Pastikan file yang diupload sudah benar"
    elseif ($_GET['alert'] == 2) {
    echo "  <div id='alert-message' class='alert alert-danger alert-dismissible' role='alert'>
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                  <span aria-hidden='true'>&times;</span>
              </button>
              <strong><i class='fa fa-check-circle'></i> Upload Gagal!</strong> Pastikan file yang diupload sudah benar.
            </div>";
    }
    // jika alert = 3
    // tampilkan pesan Upload Gagal "Pastikan ukuran foto tidak lebih dari 1MB"
    elseif ($_GET['alert'] == 3) {
    echo "  <divid='alert-message'  class='alert alert-danger alert-dismissible' role='alert'>
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                  <span aria-hidden='true'>&times;</span>
              </button>
              <strong><i class='fa fa-check-circle'></i> Upload Gagal!</strong> Pastikan ukuran foto tidak lebih dari 1MB.
            </div>";
    }
    // jika alert = 4
    // tampilkan pesan Upload Gagal "Pastikan file yang diupload bertipe *.JPG, *.JPEG, *.PNG"
    elseif ($_GET['alert'] == 4) {
    echo "  <div id='alert-message' class='alert alert-danger alert-dismissible' role='alert'>
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                  <span aria-hidden='true'>&times;</span>
              </button>
              <strong><i class='fa fa-check-circle'></i> Upload Gagal!</strong> Pastikan file yang diupload bertipe *.JPG, *.JPEG, *.PNG.
            </div>";
    }
    ?>

      <div class="card card-outline card-dark shadow">
        <div class="card-body mx-5">
        <!-- form start -->
        <form role="form" class="form-horizontal" method="POST" action="?module=form_profil" enctype="multipart/form-data">
          <br>
            <input type="hidden" name="id_user" value="<?php echo $data['id_user']; ?>">
            <div class="form-group">
              <label class="col-sm-2 control-label">
              <?php  
              if ($data['foto']=="") { ?>
                <img style="border:1px solid #eaeaea;border-radius:50px;" src="images/user/user-default.png" width="75">
              <?php
              }
              else { ?>
                <img style="border:1px solid #eaeaea;border-radius:50px;" src="images/user/<?php echo $data['foto']; ?>" width="75">
              <?php
              }
              ?>
              </label>
              <label style="font-size:25px;margin-top:10px;" class="col-sm-8"><?php echo $data['nama_user']; ?></label>
            </div>
            <hr>
            <div class="form-group">
              <label class="col-sm-2 control-label">Username</label>
              <label style="text-align:left" class="col-sm-8 control-label">: <?php echo $data['username']; ?></label>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label">Email</label>
              <label style="text-align:left" class="col-sm-8 control-label">: <?php echo $data['email']; ?></label>
            </div>
          
            <div class="form-group">
              <label class="col-sm-2 control-label">Telepon</label>
              <label style="text-align:left" class="col-sm-8 control-label">: <?php echo $data['telepon']; ?></label>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label">Hak Akses</label>
              <label style="text-align:left" class="col-sm-8 control-label">: <?php echo $data['hak_akses']; ?></label>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label">Status</label>
              <label style="text-align:left" class="col-sm-8 control-label">: <?php echo $data['status']; ?></label>
            </div>

              <div class="modal-footer">
                <button type="submit" class="btn btn-primary" name="ubah" value="Ubah"><i class="fas fa-edit"></i> UBAH</button>
              </div>
        </form>
          </div>
      </div><!-- /.box -->
    </div><!--/.col -->
  </div>   <!-- /.row -->
</section><!-- /.content