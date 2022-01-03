<?php
    //cek session
    if (empty($_SESSION['hak_akses'])){
        echo "<meta http-equiv='refresh' content='0; url=../../index.php?alert=3'>";
        die();
    } else {

        if($_SESSION['hak_akses'] != 'Super Admin' AND $_SESSION['hak_akses'] != 'Manajer'){
            echo '<script language="javascript">
                    window.alert("ERROR! Anda tidak memiliki hak akses untuk menambahkan data");
                    window.location.href="./main.php?module=ref";
                  </script>';
        } else {

            if(isset($_REQUEST['submit'])){

                //validasi form kosong
                if($_REQUEST['kode'] == "" || $_REQUEST['nama'] == "" || $_REQUEST['uraian'] == ""){
                    $_SESSION['errEmpty'] = 'ERROR! Semua form wajib diisi';
                    echo '<script language="javascript">window.history.back();</script>';
                } else {

                    $kode = $_REQUEST['kode'];
                    $nama = $_REQUEST['nama'];
                    $uraian = $_REQUEST['uraian'];
                    $id_user = $_SESSION['hak_akses'];

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
                                $_SESSION['uraian'] = 'Form Uraian hanya boleh mengandung karakter huruf, angka, spasi, titik(.), koma(,), minus(-), garis miring(/), dan kurung()';
                                echo '<script language="javascript">window.history.back();</script>';
                            } else {

                                $cek = mysqli_query($config, "SELECT * FROM tbl_klasifikasi WHERE kode='$kode'");
                                $result = mysqli_num_rows($cek);

                                if($result > 0){
                                    $_SESSION['duplikasi'] = 'Kode sudah ada, pilih yang lainnya!';
                                    echo '<script language="javascript">window.history.back();</script>';
                                } else {

                                    $query = mysqli_query($config, "INSERT INTO tbl_klasifikasi(kode,nama,uraian,id_user) VALUES('$kode','$nama','$uraian','$id_user')");

                                    if($query != false){
                                        $_SESSION['succAdd'] = 'SUKSES! Data berhasil ditambahkan';
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
                }
            } else {?>
                <!-- Row Start -->
                <section class="content-header">
                    <div class="container-sm">
                        <h1><i class="fa fa-bookmark icon-title ml-4"></i> Tambah Kode Klasifikasi Surat</h1>
                    </div>
                </section>
                <!-- Row END -->

                <?php
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
                ?>

                <!-- Row form Start -->
                <section class="content">
                    <div class="container-sm">
                        <div class="col-md-12">
                            <div class="card card-outline card-dark shadow">
                                <div class="card-body">

                                    <!-- Form START -->
                                    <form class="container-sm" method="post" action="?module=ref&act=add">

                                        <!-- Row in form START -->
                                        <div class="row row-cols-2">
                                            <div class="col col-md-4 form-group">
                                                <label for="kd">Kode</label>
                                                <input id="kd" type="text" class="form-control validate" maxlength="30" name="kode" required>
                                                    <?php
                                                        if(isset($_SESSION['kode'])){
                                                            $kode = $_SESSION['kode'];
                                                            echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$kode.'</div>';
                                                            unset($_SESSION['kode']);
                                                        }
                                                        if(isset($_SESSION['duplikasi'])){
                                                            $duplikasi = $_SESSION['duplikasi'];
                                                            echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$duplikasi.'</div>';
                                                            unset($_SESSION['duplikasi']);
                                                        }
                                                    ?>
                                            </div>
                                            <div class="col col-md-8 form-group">
                                                <label for="nama">Nama</label>
                                                <input id="nama" type="text" class="form-control validate" name="nama" required>
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
                                                    <textarea id="uraian" class="form-control" name="uraian" required></textarea>
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
?>
