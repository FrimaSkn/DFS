<?php
    //cek session
    if (empty($_SESSION['hak_akses'])){
        echo "<meta http-equiv='refresh' content='0; url=../../index.php?alert=3'>";
        die();
    } else {

        if(isset($_REQUEST['submit'])){

            $id_surat = $_REQUEST['id_surat'];
            $query = mysqli_query($config, "SELECT * FROM tbl_surat_masuk WHERE id_surat='$id_surat'");
            list($id_surat) = mysqli_fetch_array($query);

            //validasi form kosong
            if($_REQUEST['tujuan'] == "" || $_REQUEST['isi_disposisi'] == "" || $_REQUEST['sifat'] == "" || $_REQUEST['batas_waktu'] == ""
                || $_REQUEST['catatan'] == ""){
                $_SESSION['errEmpty'] = 'ERROR! Semua form wajib diisi';
                echo '<script language="javascript">window.history.back();</script>';
            } else {

                $id_disposisi = $_REQUEST['id_disposisi'];
                $tujuan = $_REQUEST['tujuan'];
                $isi_disposisi = $_REQUEST['isi_disposisi'];
                $sifat = $_REQUEST['sifat'];
                $batas_waktu = $_REQUEST['batas_waktu'];
                $catatan = $_REQUEST['catatan'];
                $id_user = $_SESSION['id_user'];

                //validasi input data
                if(!preg_match("/^[a-zA-Z0-9.,()\/ -]*$/", $tujuan)){
                    $_SESSION['tujuan'] = 'Form Tujuan Disposisi hanya boleh mengandung karakter huruf, angka, spasi, titik(.), koma(,) minus(-). kurung() dan garis miring(/)';
                    echo '<script language="javascript">window.history.back();</script>';
                } else {

                    if(!preg_match("/^[a-zA-Z0-9.,_()%&@\/\r\n -]*$/", $isi_disposisi)){
                        $_SESSION['isi_disposisi'] = 'Form Isi Disposisi hanya boleh mengandung karakter huruf, angka, spasi, titik(.), koma(,), minus(-), garis miring(/), dan(&), underscore(_), kurung(), persen(%) dan at(@)';
                        echo '<script language="javascript">window.history.back();</script>';
                    } else {

                        if(!preg_match("/^[0-9 -]*$/", $batas_waktu)){
                            $_SESSION['batas_waktu'] = 'Form Batas Waktu hanya boleh mengandung karakter huruf dan minus(-)';
                            echo '<script language="javascript">window.history.back();</script>';
                        } else {

                            if(!preg_match("/^[a-zA-Z0-9.,()%@\/ -]*$/", $catatan)){
                                $_SESSION['catatan'] = 'Form catatan hanya boleh mengandung karakter huruf, angka, spasi, titik(.), koma(,), minus(-) garis miring(/), dan kurung()';
                                echo '<script language="javascript">window.history.back();</script>';
                            } else {

                                if(!preg_match("/^[a-zA-Z0 ]*$/", $sifat)){
                                    $_SESSION['catatan'] = 'Form SIFAT hanya boleh mengandung karakter huruf dan spasi';
                                    echo '<script language="javascript">window.history.back();</script>';
                                } else {

                                    $query = mysqli_query($config, "UPDATE tbl_disposisi SET tujuan='$tujuan', isi_disposisi='$isi_disposisi', sifat='$sifat', batas_waktu='$batas_waktu', catatan='$catatan', id_surat='$id_surat', id_user='$id_user' WHERE id_disposisi='$id_disposisi'");

                                    if($query == true){
                                        $_SESSION['succEdit'] = 'SUKSES! Data berhasil diupdate';
                                        echo '<script language="javascript">
                                                window.location.href="./main.php?module=surat_masuk&act=disp&id_surat='.$id_surat.'";
                                              </script>';
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
        } else {

            $id_disposisi = mysqli_real_escape_string($config, $_REQUEST['id_disposisi']);
            $query = mysqli_query($config, "SELECT * FROM tbl_disposisi WHERE id_disposisi='$id_disposisi'");
            if(mysqli_num_rows($query) > 0){
                $no = 1;
                while($row = mysqli_fetch_array($query)){?>

                <!-- Row Start -->
                <section class="content-header">
                    <div class="container-sm">
                        <h1><i class="fa fa-edit icon-title ml-4"></i> Edit Disposisi Surat</h1>
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
                                    <form class="col s12" method="post" action="">

                                        <!-- Row in form START -->
                                        <div class="row row-cols-2">
                                            <div class="col form-group">
                                                <input type="hidden" value="<?php echo $row['id_disposisi'] ;?>">
                                                <label for="tujuan">Tujuan Disposisi</label>
                                                <input id="tujuan" type="text" class="validate form-control" name="tujuan" value="<?php echo $row['tujuan'] ;?>" required>
                                                    <?php
                                                        if(isset($_SESSION['tujuan'])){
                                                            $tujuan = $_SESSION['tujuan'];
                                                            echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$tujuan.'</div>';
                                                            unset($_SESSION['tujuan']);
                                                        }
                                                    ?>
                                            </div>
                                            <div class="col form-group">
                                                <label for="batas_waktu">Batas Waktu</label>
                                                <input id="batas_waktu" type="text" name="batas_waktu" class="form-control datepicker" value="<?php echo $row['batas_waktu']; ?>"required>
                                                    <?php
                                                        if(isset($_SESSION['batas_waktu'])){
                                                            $batas_waktu = $_SESSION['batas_waktu'];
                                                            echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$batas_waktu.'</div>';
                                                            unset($_SESSION['batas_waktu']);
                                                        }
                                                    ?>
                                            </div>
                                            <div class="col form-group">
                                                <label for="isi_disposisi">Isi Disposisi</label>
                                                <textarea id="isi_disposisi" class="form-control validate" name="isi_disposisi" required><?php echo $row['isi_disposisi'] ;?></textarea>
                                                    <?php
                                                        if(isset($_SESSION['isi_disposisi'])){
                                                            $isi_disposisi = $_SESSION['isi_disposisi'];
                                                            echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$isi_disposisi.'</div>';
                                                            unset($_SESSION['isi_disposisi']);
                                                        }
                                                    ?>
                                            </div>
                                            <div class="col form-group">
                                                <label for="catatan">Catatan</label>
                                                <input id="catatan" type="text" class="form-control validate" name="catatan" value="<?php echo $row['catatan'] ;?>" required>
                                                    <?php
                                                        if(isset($_SESSION['catatan'])){
                                                            $catatan = $_SESSION['catatan'];
                                                            echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$catatan.'</div>';
                                                            unset($_SESSION['catatan']);
                                                        }
                                                    ?>
                                            </div>
                                            <div class="col form-group">
                                                <label>Pilih Sifat Disposisi</label>
                                                <select class="form-control validate" name="sifat" id="sifat" required>
                                                        <option value="<?php echo $row['sifat']; ?>"><?php echo $row['sifat']; ?></option>
                                                        <option value="Biasa">Biasa</option>
                                                        <option value="Penting">Penting</option>
                                                        <option value="Segera">Segera</option>
                                                        <option value="Rahasia">Rahasia</option>
                                                </select>
                                            </div>
                                                <?php
                                                    if(isset($_SESSION['sifat'])){
                                                        $sifat = $_SESSION['sifat'];
                                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$sifat.'</div>';
                                                        unset($_SESSION['sifat']);
                                                    }
                                                ?>
                                        </div>
                                        <!-- Row in form END -->
                                        <div class="modal-footer">
                                        <a href="main.php?module=surat_masuk&act=disp&id_surat=<?php echo $row['id_surat']; ?>" class="btn btn-secondary"><i class="fas fa-times"></i> BATAL</a>
                                            <button type="submit" name ="submit" class="btn btn-primary"><i class="fas fa-save"></i> SIMPAN</button>
                                        </div>
                                        <div class="row">
                                            <div class="col 6">
                                                
                                            </div>
                                            <div class="col 6">
                                                
                                            </div>
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
