<?php
    //cek session
    if (empty($_SESSION['hak_akses'])){
        echo "<meta http-equiv='refresh' content='0; url=../../index.php?alert=3'>";
        die();
      }
        if(isset($_REQUEST['submit'])){

            //validasi form kosong
            if($_REQUEST['no_agenda'] == "" || $_REQUEST['no_surat'] == "" || $_REQUEST['asal_surat'] == "" || $_REQUEST['isi'] == ""
                || $_REQUEST['kode'] == "" || $_REQUEST['indeks'] == "" || $_REQUEST['tgl_surat'] == ""  || $_REQUEST['keterangan'] == ""){
                $_SESSION['errEmpty'] = 'ERROR! Semua form wajib diisi';
                echo '<script language="javascript">window.history.back();</script>';
            } else {

                $no_agenda = $_REQUEST['no_agenda'];
                $no_surat = $_REQUEST['no_surat'];
                $asal_surat = $_REQUEST['asal_surat'];
                $isi = $_REQUEST['isi'];
                $kode = substr($_REQUEST['kode'],0,30);
                $nkode = trim($kode);
                $indeks = $_REQUEST['indeks'];
                $tgl_surat = $_REQUEST['tgl_surat'];
                $keterangan = $_REQUEST['keterangan'];
                $id_user = $_SESSION['id_user'];

                //validasi input data
                if(!preg_match("/^[0-9]*$/", $no_agenda)){
                    $_SESSION['eno_agenda'] = 'Form Nomor Agenda harus diisi angka!';
                    echo '<script language="javascript">window.history.back();</script>';
                } else {

                    if(!preg_match("/^[a-zA-Z0-9.\/ -]*$/", $no_surat)){
                        $_SESSION['eno_surat'] = 'Form No Surat hanya boleh mengandung karakter huruf, angka, spasi, titik(.), minus(-) dan garis miring(/)';
                        echo '<script language="javascript">window.history.back();</script>';
                    } else {

                        if(!preg_match("/^[a-zA-Z0-9.,() \/ -]*$/", $asal_surat)){
                            $_SESSION['easal_surat'] = 'Form Asal Surat hanya boleh mengandung karakter huruf, angka, spasi, titik(.), koma(,), minus(-),kurung() dan garis miring(/)';
                            echo '<script language="javascript">window.history.back();</script>';
                        } else {

                            if(!preg_match("/^[a-zA-Z0-9.:,_()%&@\/\r\n -]*$/", $isi)){
                                $_SESSION['eisi'] = 'Form Isi Ringkas hanya boleh mengandung karakter huruf, angka, spasi, titik(.), koma(,), minus(-), garis miring(/), kurung(), underscore(_), dan(&) persen(%) dan at(@)';
                                echo '<script language="javascript">window.history.back();</script>';
                            } else {

                                if(!preg_match("/^[a-zA-Z0-9., ]*$/", $nkode)){
                                    $_SESSION['ekode'] = 'Form Kode Klasifikasi hanya boleh mengandung karakter huruf, angka, spasi, titik(.) dan koma(,)';
                                    echo '<script language="javascript">window.history.back();</script>';
                                } else {

                                    if(!preg_match("/^[a-zA-Z0-9., -]*$/", $indeks)){
                                        $_SESSION['eindeks'] = 'Form Indeks hanya boleh mengandung karakter huruf, angka, spasi, titik(.) dan koma(,) dan minus (-)';
                                        echo '<script language="javascript">window.history.back();</script>';
                                    } else {

                                        if(!preg_match("/^[0-9.-]*$/", $tgl_surat)){
                                            $_SESSION['etgl_surat'] = 'Form Tanggal Surat hanya boleh mengandung angka dan minus(-)';
                                            echo '<script language="javascript">window.history.back();</script>';
                                        } else {

                                            if(!preg_match("/^[a-zA-Z0-9.,()\/ -]*$/", $keterangan)){
                                                $_SESSION['eketerangan'] = 'Form Keterangan hanya boleh mengandung karakter huruf, angka, spasi, titik(.), koma(,), minus(-), garis miring(/), dan kurung()';
                                                echo '<script language="javascript">window.history.back();</script>';
                                            } else {

                                                $ekstensi = array('jpg','png','jpeg','doc','docx','pdf');
                                                $file = $_FILES['file']['name'];
                                                $x = explode('.', $file);
                                                $eks = strtolower(end($x));
                                                $ukuran = $_FILES['file']['size'];
                                                $target_dir = "upload/surat_masuk/";

                                                if (! is_dir($target_dir)) {
                                                    mkdir($target_dir, 0755, true);
                                                }

                                            //jika form file tidak kosong akan mengeksekusi script dibawah ini
                                            if($file != ""){

                                                $rand = rand(1,10000);
                                                $nfile = $rand."-".$file;

                                                //validasi file
                                                if(in_array($eks, $ekstensi) == true){
                                                    if($ukuran < 2300000){

                                                        $id_surat = $_REQUEST['id_surat'];
                                                        $query = mysqli_query($config, "SELECT file FROM tbl_surat_masuk WHERE id_surat='$id_surat'");
                                                        list($file) = mysqli_fetch_array($query);

                                                        //jika file tidak kosong akan mengeksekusi script dibawah ini
                                                        if(!empty($file)){
                                                            unlink($target_dir.$file);

                                                            move_uploaded_file($_FILES['file']['tmp_name'], $target_dir.$nfile);

                                                            $query = mysqli_query($config, "UPDATE tbl_surat_masuk SET no_agenda='$no_agenda',no_surat='$no_surat',asal_surat='$asal_surat',isi='$isi',kode='$nkode',indeks='$indeks',tgl_surat='$tgl_surat',file='$nfile',keterangan='$keterangan',id_user='$id_user' WHERE id_surat='$id_surat'");

                                                            if($query == true){
                                                                $_SESSION['succEdit'] = 'SUKSES! Data berhasil diupdate';
                                                                echo '<script language="javascript">
                                                                            window.location.href="./main.php?module=surat_masuk&alert=2";
                                                                        </script>';
                                                                die();
                                                            } else {
                                                                $_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
                                                                echo '<script language="javascript">window.history.back();</script>';
                                                            }
                                                        } else {

                                                            //jika file kosong akan mengeksekusi script dibawah ini
                                                            move_uploaded_file($_FILES['file']['tmp_name'], $target_dir.$nfile);

                                                            $query = mysqli_query($config, "UPDATE tbl_surat_masuk SET no_agenda='$no_agenda',no_surat='$no_surat',asal_surat='$asal_surat',isi='$isi',kode='$nkode',indeks='$indeks',tgl_surat='$tgl_surat',file='$nfile',keterangan='$keterangan',id_user='$id_user' WHERE id_surat='$id_surat'");

                                                            if($query == true){
                                                                $_SESSION['succEdit'] = 'SUKSES! Data berhasil diupdate';
                                                                echo '<script language="javascript">
                                                                            window.location.href="./main.php?module=surat_masuk&alert=2";
                                                                        </script>';
                                                                die();
                                                            } else {
                                                                $_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
                                                                echo '<script language="javascript">window.history.back();</script>';
                                                            }
                                                        }
                                                    } else {
                                                        $_SESSION['errSize'] = 'Ukuran file yang diupload terlalu besar!';
                                                        echo '<script language="javascript">window.history.back();</script>';
                                                    }
                                                } else {
                                                    $_SESSION['errFormat'] = 'Format file yang diperbolehkan hanya *.JPG, *.PNG, *.DOC, *.DOCX atau *.PDF!';
                                                    echo '<script language="javascript">window.history.back();</script>';
                                                }
                                            } else {

                                                //jika form file kosong akan mengeksekusi script dibawah ini
                                                $id_surat = $_REQUEST['id_surat'];

                                                $query = mysqli_query($config, "UPDATE tbl_surat_masuk SET no_agenda='$no_agenda',no_surat='$no_surat',asal_surat='$asal_surat',isi='$isi',kode='$nkode',indeks='$indeks',tgl_surat='$tgl_surat',keterangan='$keterangan',id_user='$id_user' WHERE id_surat='$id_surat'");

                                                if($query == true){
                                                    $_SESSION['succEdit'] = 'SUKSES! Data berhasil diupdate';
                                                    echo '<script language="javascript">
                                                                            window.location.href="./main.php?module=surat_masuk&alert=2";
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

        $id_surat = mysqli_real_escape_string($config, $_REQUEST['id_surat']);
        $query = mysqli_query($config, "SELECT id_surat, no_agenda, no_surat, asal_surat, isi, kode, indeks, tgl_surat, file, keterangan, id_user FROM tbl_surat_masuk WHERE id_surat='$id_surat'");
        list($id_surat, $no_agenda, $no_surat, $asal_surat, $isi, $kode, $indeks, $tgl_surat, $file, $keterangan, $id_user) = mysqli_fetch_array($query);

        if($_SESSION['id_user'] != $id_user AND $_SESSION['id_user'] != 1){
            echo '<script language="javascript">
                    window.alert("ERROR! Anda tidak memiliki hak akses untuk mengedit data ini");
                    window.location.href="./main.php?module=tsm";
                  </script>';
        } else {?>

            <!-- Row Start -->
            <section class="content-header">
                <div class="container-sm">
                    <h1><i class="fa fa-edit icon-title ml-4"></i> Edit Surat Masuk</h1>
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
                            <form class="container-fluid" method="POST" action="?module=surat_masuk&act=edit" enctype="multipart/form-data">

                                <!-- Row in form START -->
                                <div class="row row-cols-2">
                                    <div class="col">
                                        <input type="hidden" name="id_surat" value="<?php echo $id_surat ;?>">
                                        <label for="no_agenda">Nomor Agenda</label>
                                        <input id="no_agenda" type="number" class="form-control validate" value="<?php echo $no_agenda ;?>" name="no_agenda" required>
                                            <?php
                                                if(isset($_SESSION['eno_agenda'])){
                                                    $eno_agenda = $_SESSION['eno_agenda'];
                                                    echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$eno_agenda.'</div>';
                                                    unset($_SESSION['eno_agenda']);
                                                }
                                            ?>
                                    </div>
                                    <div class="col">
                                        <label for="kode">Kode Klasifikasi</label>
                                        <input id="kode" type="text" class="form-control form-control validate" name="kode" value="<?php echo $kode ;?>" required>
                                            <?php
                                                if(isset($_SESSION['ekode'])){
                                                    $ekode = $_SESSION['ekode'];
                                                    echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$ekode.'</div>';
                                                    unset($_SESSION['ekode']);
                                                }
                                            ?>
                                    </div>
                                    <div class="col">
                                        
                                        <label for="asal_surat">Asal Surat</label>
                                        <input id="asal_surat" type="text" class="form-control validate" name="asal_surat" value="<?php echo $asal_surat ;?>" required>
                                            <?php
                                                if(isset($_SESSION['easal_surat'])){
                                                    $easal_surat = $_SESSION['easal_surat'];
                                                    echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$easal_surat.'</div>';
                                                    unset($_SESSION['easal_surat']);
                                                }
                                            ?>
                                    </div>
                                    <div class="col">
                                        <label for="indeks">Indeks Berkas</label>
                                        
                                        <input id="indeks" type="text" class="form-control validate" name="indeks" value="<?php echo $indeks ;?>" required>
                                            <?php
                                                if(isset($_SESSION['eindeks'])){
                                                    $eindeks = $_SESSION['eindeks'];
                                                    echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$eindeks.'</div>';
                                                    unset($_SESSION['eindeks']);
                                                }
                                            ?>
                                    </div>
                                    <div class="col">
                                       
                                        <label for="no_surat">Nomor Surat</label>
                                        <input id="no_surat" type="text" class="form-control validate" name="no_surat" value="<?php echo $no_surat ;?>" required>
                                            <?php
                                                if(isset($_SESSION['eno_surat'])){
                                                    $eno_surat = $_SESSION['eno_surat'];
                                                    echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$eno_surat.'</div>';
                                                    unset($_SESSION['eno_surat']);
                                                }
                                            ?>
                                    </div>
                                    <div class="col">
                                        
                                        <label for="tgl_surat">Tanggal Surat</label>
                                        <input id="tgl_surat" type="text" name="tgl_surat" class="form-control datepicker" value="<?php echo $tgl_surat ;?>" required>
                                            <?php
                                                if(isset($_SESSION['etgl_surat'])){
                                                    $etgl_surat = $_SESSION['etgl_surat'];
                                                    echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$etgl_surat.'</div>';
                                                    unset($_SESSION['etgl_surat']);
                                                }
                                            ?>
                                    </div>
                                    <div class="col">
                                        
                                        <label for="isi">Isi Ringkas</label>
                                        <textarea id="isi" class="materialize-textarea form-control validate" name="isi" required><?php echo $isi ;?></textarea>
                                            <?php
                                                if(isset($_SESSION['eisi'])){
                                                    $eisi = $_SESSION['eisi'];
                                                    echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$eisi.'</div>';
                                                    unset($_SESSION['eisi']);
                                                }
                                                ?>
                                    </div>
                                    <div class="col">
                                        
                                        <label for="keterangan">Perihal</label>
                                        <input id="keterangan" type="text" class="form-control validate" name="keterangan" value="<?php echo $keterangan ;?>" required>
                                            <?php
                                                if(isset($_SESSION['eketerangan'])){
                                                    $eketerangan = $_SESSION['eketerangan'];
                                                    echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$eketerangan.'</div>';
                                                    unset($_SESSION['eketerangan']);
                                                }
                                            ?>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="keterangan">Uploaded File</label>
                                            <div class="custom-file">
                                                <div class="form-file">
                                                    <input class="form-control" id="file" name="file" type="file" value="<?php echo $file ;?>">
                                                    <small>EX :<?php echo $file ;?></small><br>
                                                        <?php
                                                            if(isset($_SESSION['errSize'])){
                                                                $errSize = $_SESSION['errSize'];
                                                                echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$errSize.'</div>';
                                                                unset($_SESSION['errSize']);
                                                            }
                                                            if(isset($_SESSION['errFormat'])){
                                                                $errFormat = $_SESSION['errFormat'];
                                                                echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$errFormat.'</div>';
                                                                unset($_SESSION['errFormat']);
                                                            }
                                                        ?>
                                                    <small class="red-text">*Format file yang diperbolehkan *.JPG, *.PNG, *.DOC, *.DOCX, *.PDF dan ukuran maksimal file 2 MB!</small>
                                                 </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Row in form END -->

                                <div class="modal-footer">
                                    <a href="?module=surat_masuk" type="button"  class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> BATAL</a>
                                    <button type="submit" name="submit" class="btn btn-primary"><i class="fas fa-save"></i> SIMPAN</button>
                                </div>

                            </form>
                         </div><!-- /.box -->
                    </div><!-- /.box -->
                </div><!--/.col -->
            </div>   <!-- /.row -->
        </section><!-- /.content -->
            <!-- Row form END -->

<?php
            }
        }
    
?>