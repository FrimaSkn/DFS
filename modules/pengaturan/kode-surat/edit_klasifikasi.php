<?php
    //cek session
    if (empty($_SESSION['hak_akses'])){
        echo "<meta http-equiv='refresh' content='0; url=../../index.php?alert=3'>";
        die();
    } else {

        if(isset($_REQUEST['submit'])){

                $id_klasifikasi = $_REQUEST['id_klasifikasi'];
                $kode = $_REQUEST['kode'];
                $nama = $_REQUEST['nama'];
                $uraian = $_REQUEST['uraian'];
                $id_user = $_SESSION['hak_akses'];

                //validasi form kosong
                if($_REQUEST['kode'] == "" || $_REQUEST['nama'] == "" || $_REQUEST['uraian'] == ""){
                    $_SESSION['errEmpty'] = 'ERROR! Semua form wajib diisi';
                    echo '<script language="javascript">
                            window.location.href="./main.php?module=ref&act=edit&id_klasifikasi='.$id_klasifikasi.'";
                          </script>';
                } else {

                //validasi input data
                if(!preg_match("/^[a-zA-Z0-9. ]*$/", $kode)){
                    $_SESSION['kode'] = 'Form Kode hanya boleh mengandung karakter huruf, angka, spasi dan titik(.)';
                    echo '<script language="javascript">window.history.back();</script>';
                } else {

                    if(!preg_match("/^[a-zA-Z0-9.,\/ -]*$/", $nama)){
                        $_SESSION['namaref'] = 'Form Nama hanya boleh mengandung karakter huruf, spasi, titik(.), koma(,) dan minus(-)';
                        echo '<script language="javascript">window.history.back();</script>';
                    } else {

                        if(!preg_match("/^[a-zA-Z0-9.,()\/\r\n -]*$/", $uraian)){
                            $_SESSION['uraian'] = 'Form Uraian hanya boleh mengandung  huruf, angka, spasi, titik(.), koma(,), minus(-), garis miring(/), dan kurung()';
                            echo '<script language="javascript">window.history.back();</script>';
                        } else {

                            $query = mysqli_query($config, "UPDATE tbl_klasifikasi SET kode='$kode', nama='$nama', uraian='$uraian', id_user='$id_user' WHERE id_klasifikasi='$id_klasifikasi'");

                            if($query != false){
                                $_SESSION['succEdit'] = 'SUKSES! Data berhasil diupdate';
                                echo '  <script language="javascript">
                                            window.location.href="./main.php?module=ref";
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
        } else {

            $id_klasifikasi = mysqli_real_escape_string($config, $_REQUEST['id_klasifikasi']);
            $query = mysqli_query($config, "SELECT * FROM tbl_klasifikasi WHERE id_klasifikasi='$id_klasifikasi'");
            if(mysqli_num_rows($query) > 0){
                $no = 1;
                while($row = mysqli_fetch_array($query))
                if($_SESSION['hak_akses'] != 'Super Admin' AND $_SESSION['hak_akses'] != 'Manajer'){
                    echo '<script language="javascript">
                            window.alert("ERROR! Anda tidak memiliki hak akses untuk mengedit data ini");
                            window.location.href="./main.php?module=ref";
                          </script>';
                } else {?>

                    <!-- Row Start -->
                    <section class="content-header">
                        <div class="container-sm">
                            <h1><i class="fa fa-bookmark icon-title ml-4"></i> Edit Kode Klasifikasi Surat</h1>
                        </div>
                    </section>
                    <!-- Row END -->

                    <?php
                        if(isset($_SESSION['errEmpty'])){
                            $errEmpty = $_SESSION['errEmpty'];
                            echo '<div id="alert-message" class="row">
                                    <div class="col m12">
                                        <div class="card red lighten-5">
                                            <div class="card-content notif">
                                                <span class="card-title red-text"><i class="material-icons md-36">clear</i> '.$errEmpty.'</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                            unset($_SESSION['errEmpty']);
                        }
                        if(isset($_SESSION['errQ'])){
                            $errQ = $_SESSION['errQ'];
                            echo '<div id="alert-message" class="row">
                                    <div class="col m12">
                                        <div class="card red lighten-5">
                                            <div class="card-content notif">
                                                <span class="card-title red-text"><i class="material-icons md-36">clear</i> '.$errQ.'</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                            unset($_SESSION['errQ']);
                        }
                    ?>

                    <!-- Row form Start -->
                    <section class="content">
                        <div class="container-sm">
                            <div class="col-md-12">
                                <div class="card card-outline card-dark shadow">
                                    <div class="card-body">

                        <!-- Form START -->
                        <form class="col s12" method="post" action="?module=ref&act=edit">

                            <!-- Row in form START -->
                            <div class="row row-cols-2">
                                <div class="col col-md-4 form-group">
                                    <input type="hidden" value="<?php echo $row['id_klasifikasi']; ?>" name="id_klasifikasi">
                                    <label for="kd">Kode</label>
                                    <input id="kd" type="text" class="form-control validate" name="kode" maxlength="30" value="<?php echo $row['kode']; ?>" required>
                                        <?php
                                            if(isset($_SESSION['kode'])){
                                                $kode = $_SESSION['kode'];
                                                echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$kode.'</div>';
                                                unset($_SESSION['kode']);
                                            }
                                        ?>
                                </div>
                                <div class="col col-md-8 form-group">
                                    <label for="nama">Nama</label>
                                    <input id="nama" type="text" class="form-control validate" name="nama" value="<?php echo $row['nama']; ?>" required>
                                        <?php
                                            if(isset($_SESSION['namaref'])){
                                                $namaref = $_SESSION['namaref'];
                                                echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$namaref.'</div>';
                                                unset($_SESSION['namaref']);
                                            }
                                        ?>
                                </div>
                            </div>
                                    <div class="form-group">
                                        <label for="uraian">Uraian</label>
                                        <textarea id="uraian" class="form-control" name="uraian" required><?php echo $row['uraian']; ?></textarea>
                                            <?php
                                                if(isset($_SESSION['uraian'])){
                                                    $uraian = $_SESSION['uraian'];
                                                    echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$uraian.'</div>';
                                                    unset($_SESSION['uraian']);
                                                }
                                            ?>
                                    </div>
                            <!-- Row in form END -->
                            <div class="modal-footer">
                                            <a href="?module=ref" type="button"  class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> BATAL</a>
                                            <button type="submit" name="submit" class="btn btn-primary"><i class="fas fa-save"></i> SIMPAN</button>
                                        </div>

                        </form>
                        <!-- Form END -->

                                </div><!-- /.box -->
                            </div><!-- /.box -->
                        </div><!--/.col -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
                    <!-- Row form END -->

<?php
                }
            }
        }
    }
?>
