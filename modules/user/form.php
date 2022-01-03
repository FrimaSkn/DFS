<?php  

if (empty($_SESSION['username']) && empty($_SESSION['password'])){
  echo "<meta http-equiv='refresh' content='0; url=../../index.php?alert=3'>";
  die();
}

// fungsi untuk pengecekan tampilan form
// jika form add data yang dipilih
if ($_GET['form']=='add') { ?>
  <!-- tampilkan form add data -->
	<!-- Content Header (Page header) -->
  <section class="content-header container-md">
    <h1>
      <i class="fa fa-edit icon-title"></i> Input User
    </h1>
  </section>

  <!-- Main content -->
  <section class="content container-md">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-outline card-dark shadow">
          <!-- form start -->
          <form role="form" class="form-horizontal" method="POST" action="modules/user/proses.php?act=insert" enctype="multipart/form-data">
            <div class="card-body mx-5 my-5">
          
              <div class="row form-group ml-5">
                <label class="col-sm-3 control-label">Username</label>
                <div class="col-sm mr-5">
                  <input type="text" class="form-control" name="username" autocomplete="off" required>
                </div>
              </div>

              <div class="row form-group ml-5">
                <label class="col-sm-3 control-label">Password</label>
                <div class="col-sm mr-5">
                  <input type="password" class="form-control" name="password" autocomplete="off" required>
                </div>
              </div>

              <div class="row form-group ml-5">
                <label class="col-sm-3 control-label">Nama User</label>
                <div class="col-sm mr-5">
                  <input type="text" class="form-control" name="nama_user" autocomplete="off" required>
                </div>
              </div>

              <div class="row form-group ml-5">
                <label class="col-sm-3 control-label">Hak Akses</label>
                <div class="col-sm mr-5">
                  <select class="form-control" name="hak_akses" required>
                    <option value=""></option>
                    <option value="Super Admin">Super Admin</option>
                    <option value="Camat">Camat</option>
                    <option value="Sekcam">Sekertaris Camat</option>
                  </select>
                </div>
              </div>
            </div><!-- /.box body -->

            <div class="modal-footer">
                  <button type="submit" class="btn btn-primary btn-submit" name="simpan"><i class="fas fa-save"></i> SIMPAN</button>
                  <a href="?module=user" class="btn btn-secondary btn-reset"><i class="fas fa-times"></i> BATAL</a>
            </div><!-- /.box footer -->
          </form>
        </div><!-- /.box -->
      </div><!--/.col -->
    </div>   <!-- /.row -->
  </section><!-- /.content -->
<?php
}

// jika form edit data yang dipilih
elseif ($_GET['form']=='edit') { 
  	if (isset($_GET['id'])) {
      // fungsi query untuk menampilkan data dari tabel user
      $query = mysqli_query($config, "SELECT * FROM tbl_users WHERE id_user='$_GET[id]'") 
                                      or die('Ada kesalahan pada query tampil data user : '.mysqli_error($config));
      $data  = mysqli_fetch_assoc($query);
  	}	
?>
	<!-- tampilkan form edit data -->
  <!-- Content Header (Page header) -->
  <section class="content-header container-md">
    <h1>
      <i class="fa fa-edit icon-title"></i> Ubah Data User
    </h1>
  </section>

  <!-- Main content -->
  <section class="content container-md">
    <div class="row">
      <div class="col-md">
        <div class="card card-outline card-dark shadow">
          <!-- form start -->
          <form role="form" class="form-horizontal" method="POST" action="modules/user/proses.php?act=update" enctype="multipart/form-data">
            <div class="card-body">

              <input type="hidden" name="id_user" value="<?php echo $data['id_user']; ?>">
              <div class="row  row-cols-2">
                <div class="form-group">
                  <label class="col-sm control-label">Username</label>
                  <div class="col-sm">
                    <input type="text" class="form-control" name="username" autocomplete="off" value="<?php echo $data['username']; ?>" required>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm control-label">Password</label>
                  <div class="col-sm">
                    <input type="password" class="form-control" name="password" autocomplete="off" placeholder="Kosongkan password jika tidak diubah">
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
                  <label class="col-sm control-label">Hak Akses</label>
                  <div class="col-sm">
                    <select class="form-control" name="hak_akses" required>
                      <option value="<?php echo $data['hak_akses']; ?>"><?php echo $data['hak_akses']; ?></option>
                      <option value="Super Admin">Super Admin</option>
                      <option value="Camat">Camat</option>
                      <option value="sekcam">Sekcam</option>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Foto</label>
                  <div class="col-sm-5">
                    <input type="file" name="foto">
                    <br/>
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
                  </div>
                </div>

              </div>
            </div><!-- /.card body -->

            <div class="modal-footer">
                  <button type="submit" class="btn btn-primary btn-submit" name="simpan"><i class="fas fa-save"></i> SIMPAN</button>
                  <a href="?module=user" class="btn btn-secondary btn-reset"><i class="fas fa-times"></i> BATAL</a>
            </div><!-- /.card footer -->
          </form>
        </div><!-- /.box -->
      </div><!--/.col -->
    </div>   <!-- /.row -->
  </section><!-- /.content -->
<?php
}
?>