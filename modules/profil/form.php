<?php  
    if (empty($_SESSION['hak_akses'])){
      echo "<meta http-equiv='refresh' content='0; url=../../index.php?alert=3'>";
      die();
    }

    
if (isset($_POST['id_user'])) {
  // fungsi query untuk menampilkan data dari tabel user
  $query = mysqli_query($config, "SELECT * FROM tbl_users WHERE id_user='$_POST[id_user]'") 
                                  or die('Ada kesalahan pada query tampil data user : '.mysqli_error($config));
  $data  = mysqli_fetch_assoc($query);
}	
?>
	<!-- tampilkan form edit data -->
  <!-- Content Header (Page header) -->
  <section class="content-header container-md mx-auto">
    <h1>
      <i class="fa fa-edit icon-title ml-2"></i> Ubah Profil User
    </h1>
  </section>

  <!-- Main content -->
  <section class="content container-md">
      <div class="col-md-12">
        <div class="card card-outline card-dark shadow">
          <!-- form start -->
          <form role="form" class="form" method="POST" action="modules/profil/proses.php?act=update" enctype="multipart/form-data">
            <div class="card-body">
            <div class="row row-cols-2">
              <input type="hidden" name="id_user" value="<?php echo $data['id_user']; ?>">

              <div class="form-group">
                <label class="col-sm control-label">Username</label>
                <div class="col-sm">
                  <input type="text" class="form-control" name="username" autocomplete="off" value="<?php echo $data['username']; ?>" required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm control-label">Nama User</label>
                <div class="col-sm">
                  <input type="text" class="form-control" name="nama_user" autocomplete="off" value="<?php echo $data['nama_user']; ?>" required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm control-label">Email</label>
                <div class="col-sm">
                  <input type="email" class="form-control" name="email" autocomplete="off" value="<?php echo $data['email']; ?>">
                </div>
              </div>
            
              <div class="form-group">
                <label class="col-sm control-label">Telepon</label>
                <div class="col-sm">
                  <input type="text" class="form-control" name="telepon" autocomplete="off" maxlength="13" onKeyPress="return goodchars(event,'0123456789',this)" value="<?php echo $data['telepon']; ?>">
                </div>
              </div>

              <div class="form-group">
                  <label class="col-sm control-label">Foto</label>
                  <div class="col-sm">
                  <?php  
                  if ($data['foto']=="") { ?>
                    <img style="border:1px solid #eaeaea;border-radius:5px;" src="images/user/user-default.png" width="128">
                  <?php
                  }
                  else { ?>
                    <img style="border:1px solid #eaeaea;border-radius:5px;" src="images/user/<?php echo $data['foto']; ?>" width="128">
                  <?php
                  }
                  ?>
                    <br/>
                    <input type="file" name="foto">
                  </div>
                </div>
              </div>
            </div><!-- /.box body -->

            <div class="modal-footer">
                  <button type="submit" class="btn btn-primary btn-submit" name="simpan"><i class="fas fa-save"></i> SIMPAN</button>
                  <a href="?module=profil" class="btn btn-secondary btn-reset"><i class="fas fa-times"></i> BATAL</a>
            </div><!-- /.card footer -->
          </form>
        </div><!-- /.box -->
      </div><!--/.col -->
    </div>   <!-- /.row -->
  </section><!-- /.content -->