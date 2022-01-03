<?php
if(isset($_REQUEST['submit'])){

//validasi form kosong
if ($_REQUEST['institusi'] == "" || $_REQUEST['nama'] == "" || $_REQUEST['alamat'] == "" || $_REQUEST['tlp'] == "" || $_REQUEST['camat'] == "" || $_REQUEST['nip'] == ""
    || $_REQUEST['website'] == "" || $_REQUEST['email'] == ""){
    $_SESSION['errEmpty'] = 'ERROR! Semua form wajib diisi';
    echo '  <script language="javascript">
                window.location.href="././main.php?module=ints";
            </script>';
    die();
} else {

    $id_instansi = "1";
    $institusi = $_REQUEST['institusi'];
    $nama = $_REQUEST['nama'];
    $alamat = $_REQUEST['alamat'];
    $tlp = $_REQUEST['tlp'];
    $camat = $_REQUEST['camat'];
    $nip = $_REQUEST['nip'];
    $website = $_REQUEST['website'];
    $email = $_REQUEST['email'];
    $id_user = $_SESSION['id_user'];

    //validasi input data
    if(!preg_match("/^[a-zA-Z0-9. -]*$/", $nama)){
        $_SESSION['namains'] = 'Form Nama Instansi hanya boleh mengandung karakter huruf, angka, spasi, titik(.) dan minus(-)';
        echo '<script language="javascript">window.history.back();</script>';
    } else {

        if(!preg_match("/^[a-zA-Z0-9. -]*$/", $institusi)){
            $_SESSION['institusi'] = 'Hanya boleh mengandung karakter huruf, angka, spasi, titik(.) dan minus(-)';
            echo '<script language="javascript">window.history.back();</script>';
        } else {

            if(!preg_match("/^[a-zA-Z0-9.,:\/<> -\"]*$/", $alamat)){
                $_SESSION['alamat'] = 'Form Status hanya boleh mengandung karakter huruf, angka, spasi, titik(.), koma(,), titik dua(:), petik dua(""), garis miring(/) dan minus(-)';
                echo '<script language="javascript">window.history.back();</script>';
            } else {

                if(!preg_match("/^[a-zA-Z0-9.,()\/ -]*$/", $tlp)){
                    $_SESSION['tlp'] = 'Form Alamat hanya boleh mengandung karakter huruf, angka, spasi, titik(.), koma(,), minus(-), garis miring(/), dan kurung()';
                    echo '<script language="javascript">window.history.back();</script>';
                } else {

                    if(!preg_match("/^[a-zA-Z., ]*$/", $camat)){
                        $_SESSION['camat'] = 'Form Nama Camat hanya boleh mengandung karakter huruf, spasi, titik(.) dan koma(,)<br/><br/>';
                        echo '<script language="javascript">window.history.back();</script>';
                    } else {

                        if(!preg_match("/^[0-9 -]*$/", $nip)){
                            $_SESSION['nip'] = 'Form NIP Camat hanya boleh mengandung karakter angka, spasi, dan minus(-)<br/><br/>';
                            echo '<script language="javascript">window.history.back();</script>';
                        } else {

                            //validasi url website
                            if(!filter_var($website, FILTER_VALIDATE_URL)){
                                $_SESSION['website'] = 'Format URL Website tidak valid';
                                echo '  <script language="javascript">
                                             window.location.href="././main.php?module=ints";
                                        </script>';
                                die();
                            } else {

                                //validasi email
                                if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                                    $_SESSION['email'] = 'Format Email tidak valid';
                                    echo '  <script language="javascript">
                                                window.location.href="././main.php?module=ints";
                                            </script>';
                                    die();
                                } else {

                                    $ekstensi = array('png','jpg');
                                    $logo = $_FILES['logo']['name'];
                                    $x = explode('.', $logo);
                                    $eks = strtolower(end($x));
                                    $ukuran = $_FILES['logo']['size'];
                                    $target_dir = "upload/";

                                    if (! is_dir($target_dir)) {
                                        mkdir($target_dir, 0755, true);
                                    }

                                    //jika form logo tidak kosong akan mengeksekusi script dibawah ini
                                    if(!empty($logo)){

                                        $nlogo = $logo;
                                        //validasi gambar
                                        if(in_array($eks, $ekstensi) == true){
                                            if($ukuran < 2000000){

                                                $query = mysqli_query($config, "SELECT logo FROM tbl_instansi");
                                                list($logo) = mysqli_fetch_array($query);

                                                unlink($target_dir.$logo);

                                                move_uploaded_file($_FILES['logo']['tmp_name'], $target_dir.$nlogo);

                                                $query = mysqli_query($config, "UPDATE tbl_instansi SET institusi='$institusi',nama='$nama',alamat='$alamat',tlp='$tlp',camat='$camat',nip='$nip',website='$website',email='$email',logo='$nlogo',id_user='$id_user' WHERE id_instansi='$id_instansi'");

                                                if($query == true){
                                                    $_SESSION['succEdit'] = 'SUKSES! Data instansi berhasil diupdate';
                                                    echo '  <script language="javascript">
                                                                window.location.href="././main.php?module=ints";
                                                            </script>';
                                                    die();
                                                } else {
                                                    $_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
                                                    echo '<script language="javascript">window.history.back();</script>';
                                                }
                                            } else {
                                                $_SESSION['errSize'] = 'Ukuran file yang diupload terlalu besar!<br/><br/>';
                                                echo '<script language="javascript">window.history.back();</script>';
                                            }
                                        } else {
                                            $_SESSION['errSize'] = 'Format file gambar yang diperbolehkan hanya *.JPG dan *.PNG!<br/><br/>';
                                            echo '<script language="javascript">window.history.back();</script>';
                                        }
                                    } else {

                                        //jika form logo kosong akan mengeksekusi script dibawah ini
                                        $query = mysqli_query($config, "UPDATE tbl_instansi SET institusi='$institusi',nama='$nama',alamat='$alamat',tlp='$tlp',camat='$camat',nip='$nip',website='$website',email='$email',id_user='$id_user' WHERE id_instansi='$id_instansi'");

                                        if($query == true){
                                            $_SESSION['succEdit'] = 'SUKSES! Data instansi berhasil diupdate';
                                            echo '  <script language="javascript">
                                                        window.location.href="././main.php?module=ints";
                                                    </script>';
                                            die();
                                        } else {
                                            $_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
                                            echo '<script language="javascript">window.history.back();</script>';
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}
} else {

$query = mysqli_query($config, "SELECT * FROM tbl_instansi");
if(mysqli_num_rows($query) > 0){
    $no = 1;
    while($row = mysqli_fetch_array($query)){?>

    <!-- Row Start -->
    <section class="content-header">
        <div class="container-sm">
            <h1><i class="fa fa-building icon-title ml-4"></i> Manajemen instansi</h1>
           
        </div>
    </section>
    <!-- Row END -->
    <div class="container-sm">
            <?php
                if(isset($_SESSION['errEmpty'])){
                    $errEmpty = $_SESSION['errEmpty'];
                    echo '  <div id="alert-message" class="alert alert-success alert-dismissable mx-3">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h4>  <i class="icon fa fa-check-circle"></i>'.$errEmpty.'</h4>
                            </div>';
                    unset($_SESSION['errEmpty']);
                }
                if(isset($_SESSION['succEdit'])){
                    $succEdit = $_SESSION['succEdit'];
                    echo '  <div id="alert-message" class="alert alert-success alert-dismissable mx-3">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h4>  <i class="icon fa fa-check-circle"></i>'.$succEdit.'</h4>
                            </div>';
                    unset($_SESSION['succEdit']);
                }
                if(isset($_SESSION['errQ'])){
                    $errQ = $_SESSION['errQ'];
                    echo '  <div id="alert-message" class="alert alert-success alert-dismissable mx-3">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h4>  <i class="icon fa fa-check-circle"></i>'.$errQ.'</h4>
                            </div>';
                    unset($_SESSION['errQ']);
                }
            ?>
    </div>
    <!-- Row form Start -->
    <section class="content">
        <div class="container-sm">
            <div class="col-md-12">
                <div class="card card-outline card-dark shadow">
                    <div class="card-body">

        <!-- Form START -->
        <form class="col s12" method="post" action="?module=ints" enctype="multipart/form-data">

            <!-- Row in form START -->
            <div class="row row-cols-2">
                <div class="col form-group">
                    <input type="hidden" value="<?php echo $id_instansi; ?>" name="id_instansi">
                    <label for="nama">Nama Kecamatan</label>
                    <input id="nama" type="text" class="form-control validate" name="nama" value="<?php echo $row['nama']; ?>" required>
                        <?php
                            if(isset($_SESSION['namains'])){
                                $namains = $_SESSION['namains'];
                                echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$namains.'</div>';
                                unset($_SESSION['namains']);
                            }
                        ?>
                </div>
                <div class="col form-group">
                    <label for="institusi">Pemerintahan</label>
                    <input id="institusi" type="text" class="form-control validate" name="institusi" value="<?php echo $row['institusi']; ?>" required>
                        <?php
                            if(isset($_SESSION['institusi'])){
                                $institusi = $_SESSION['institusi'];
                                echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$institusi.'</div>';
                                unset($_SESSION['institusi']);
                            }
                        ?>
                </div>
                <div class="col form-group">
                    <label for="alamat">Alamat</label>
                    <input id="alamat" type="text" class="form-control validate" name="alamat" value='<?php echo $row['alamat']; ?>' required>
                        <?php
                            if(isset($_SESSION['alamat'])){
                                $alamat = $_SESSION['alamat'];
                                echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$alamat.'</div>';
                                unset($_SESSION['alamat']);
                            }
                        ?>
                </div>
                <div class="col form-group">
                    <label for="camat">Nama Camat</label>
                    <input id="camat" type="text" class="form-control validate" name="camat" value="<?php echo $row['camat']; ?>" required>
                        <?php
                            if(isset($_SESSION['camat'])){
                                $camat = $_SESSION['camat'];
                                echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$camat.'</div>';
                                unset($_SESSION['camat']);
                            }
                        ?>
                </div>
                <div class="col form-group">
                    <label for="tlp">No. Telepon</label>
                    <input id="tlp" type="text" class="form-control validate" name="tlp" value="<?php echo $row['tlp']; ?>" required>
                        <?php
                            if(isset($_SESSION['tlp'])){
                                $tlp = $_SESSION['tlp'];
                                echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$tlp.'</div>';
                                unset($_SESSION['tlp']);
                            }
                        ?>
                </div>
                <div class="col form-group">
                    <label for="nip">NIP</label>
                    <input id="nip" type="text" class="form-control validate" name="nip" value="<?php echo $row['nip']; ?>" required>
                        <?php
                            if(isset($_SESSION['nip'])){
                                $nip = $_SESSION['nip'];
                                echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$nip.'</div>';
                                unset($_SESSION['nip']);
                            }
                        ?>
                </div>
                <div class="col form-group">
                    <label for="website">Website</label>
                    <input id="website" type="url" class="form-control validate" name="website" value="<?php echo $row['website']; ?>" required>
                        <?php
                            if(isset($_SESSION['website'])){
                                $website = $_SESSION['website'];
                                echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$website.'</div>';
                                unset($_SESSION['website']);
                            }
                        ?>
                </div>
                <div class="col form-group">
                    <label for="email">Email Instansi</label>
                    <input id="email" type="email" class="form-control validate" name="email" value="<?php echo $row['email']; ?>" required>
                        <?php
                            if(isset($_SESSION['email'])){
                                $email = $_SESSION['email'];
                                echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$email.'</div>';
                                unset($_SESSION['email']);
                            }
                        ?>
                </div>
                <div class="form-group">
                  <label class="col-sm control-label">Logo</label>
                  <div class="col-sm">
                    <img  style="border:1px solid #eaeaea;border-radius:5px;" src="upload/<?php echo $row['logo']; ?>" width="120" />
                    <br>
                    <input type="file" id="logo" name="logo">
                  </div>
                </div>
                
            </div>
            <!-- Row in form END -->
            <div class="modal-footer">
            <button type="submit" name="submit" class="btn btn-primary"><i class="fas fa-save"></i> SIMPAN </button>
            <a href="./main.php?module=beranda" class="btn btn-secondary"><i class="fas fa-times"></i> BATAL </a>
            </div>
            
        </form>
        <!-- Form END -->

                    </div><!-- /.cardby -->
                </div><!-- /.card.ot -->
            </div><!--/.col -->
        </div>   <!-- /.container -->
    </section><!-- /.content -->
    <!-- Row form END -->

<?php
    }
}
}?>