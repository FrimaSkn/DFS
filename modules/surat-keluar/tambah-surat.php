<?php
    if (empty($_SESSION['hak_akses'])){
        echo "<meta http-equiv='refresh' content='0; url=../../index.php?alert=3'>";
        die();
      }
      if(isset($_REQUEST['submit'])){

        //validasi form kosong
        if($_REQUEST['no_agenda'] == "" || $_REQUEST['no_surat'] == "" || $_REQUEST['tujuan'] == "" || $_REQUEST['isi'] == ""
            || $_REQUEST['kode'] == "" || $_REQUEST['tgl_surat'] == ""  || $_REQUEST['keterangan'] == ""){
            $_SESSION['errEmpty'] = 'ERROR! Semua form wajib diisi';
            echo '<script language="javascript">window.history.back();</script>';
        } else {

            $no_agenda = $_REQUEST['no_agenda'];
            $no_surat = $_REQUEST['no_surat'];
            $tujuan = $_REQUEST['tujuan'];
            $isi = $_REQUEST['isi'];
            $kode = substr($_REQUEST['kode'],0,30);
            $nkode = trim($kode);
            $tgl_surat = $_REQUEST['tgl_surat'];
            $keterangan = $_REQUEST['keterangan'];
            $id_user = $_SESSION['id_user'];

            //validasi input data
            if(!preg_match("/^[0-9]*$/", $no_agenda)){
                $_SESSION['no_agendak'] = 'Form Nomor Agenda harus diisi angka!';
                echo '<script language="javascript">window.history.back();</script>';
            } else {

                if(!preg_match("/^[a-zA-Z0-9.\/ -]*$/", $no_surat)){
                    $_SESSION['no_suratk'] = 'Form No Surat hanya boleh mengandung karakter huruf, angka, spasi, titik(.), minus(-) dan garis miring(/)';
                    echo '<script language="javascript">window.history.back();</script>';
                } else {

                    if(!preg_match("/^[a-zA-Z0-9.,(): \/ -]*$/", $tujuan)){
                        $_SESSION['tujuan_surat'] = 'Form Tujuan Surat hanya boleh mengandung karakter huruf, angka, spasi, titik(.), koma(,), minus(-), kurung() dan garis miring(/)';
                        echo '<script language="javascript">window.history.back();</script>';
                    } else {

                        if(!preg_match("/^[a-zA-Z0-9.:,_()%&@\/\r\n -]*$/", $isi)){
                            $_SESSION['isik'] = 'Form Isi Ringkas hanya boleh mengandung karakter huruf, angka, spasi, titik(.), koma(,), minus(-), garis miring(/), kurung(), underscore(_), dan(&) persen(%) dan at(@)';
                            echo '<script language="javascript">window.history.back();</script>';
                        } else {

                            if(!preg_match("/^[a-zA-Z0-9., ]*$/", $nkode)){
                                $_SESSION['kodek'] = 'Form Kode Klasifikasi hanya boleh mengandung karakter huruf, angka, spasi, titik(.) dan koma(,)';
                                echo '<script language="javascript">window.history.back();</script>';
                            } else {

                                if(!preg_match("/^[0-9.-]*$/", $tgl_surat)){
                                    $_SESSION['tgl_suratk'] = 'Form Tanggal Surat hanya boleh mengandung angka dan minus(-)';
                                    echo '<script language="javascript">window.history.back();</script>';
                                } else {

                                    if(!preg_match("/^[a-zA-Z0-9.,()\/ -]*$/", $keterangan)){
                                        $_SESSION['keterangank'] = 'Form Keterangan hanya boleh mengandung karakter huruf, angka, spasi, titik(.), koma(,), minus(-), garis miring(/), dan kurung()';
                                        echo '<script language="javascript">window.history.back();</script>';
                                    } else {

                                        $cek = mysqli_query($config, "SELECT * FROM tbl_surat_keluar WHERE no_surat='$no_surat'");
                                        $result = mysqli_num_rows($cek);

                                        if($result > 0){
                                            $_SESSION['errDup'] = 'Nomor Surat sudah terpakai, gunakan yang lain!';
                                            echo '<script language="javascript">window.history.back();</script>';
                                        } else {

                                            $ekstensi = array('jpg','png','jpeg','doc','docx','pdf');
                                            $file = $_FILES['file']['name'];
                                            $x = explode('.', $file);
                                            $eks = strtolower(end($x));
                                            $ukuran = $_FILES['file']['size'];
                                            $target_dir = "upload/surat_keluar/";

                                            if (! is_dir($target_dir)) {
                                                mkdir($target_dir, 0755, true);
                                            }

                                            //jika form file tidak kosong akan mengekse
                                            if($file != ""){

                                                $rand = rand(1,10000);
                                                $nfile = $rand."-".$file;
                                                if(in_array($eks, $ekstensi) == true){
                                                    if($ukuran < 2500000){

                                                        move_uploaded_file($_FILES['file']['tmp_name'], $target_dir.$nfile);

                                                        $query = mysqli_query($config, "INSERT INTO tbl_surat_keluar(no_agenda,tujuan,no_surat,isi,kode,tgl_surat,
                                                            tgl_catat,file,keterangan,id_user)
                                                            VALUES('$no_agenda','$tujuan','$no_surat','$isi','$nkode','$tgl_surat',NOW(),'$nfile','$keterangan','$id_user')");

                                                        if($query == true){
                                                            $_SESSION['succAdd'] = 'SUKSES! Data berhasil ditambahkan';
                                                            echo '<script language="javascript">
                                                                    window.location.href="./main.php?module=surat_keluar";
                                                                </script>';
                                                            die();
                                                        } else {
                                                            $_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
                                                            echo '<script language="javascript">window.history.back();</script>';
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
                                                $query = mysqli_query($config, "INSERT INTO tbl_surat_keluar(no_agenda,tujuan,no_surat,isi,kode,tgl_surat,
                                                    tgl_catat,file,keterangan,id_user)
                                                    VALUES('$no_agenda','$tujuan','$no_surat','$isi','$nkode','$tgl_surat',NOW(),'','$keterangan','$id_user')");

                                                if($query == true){
                                                    $_SESSION['succAdd'] = 'SUKSES! Data berhasil ditambahkan';
                                                    echo '<script language="javascript">
                                                                    window.location.href="./main.php?module=surat_keluar";
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
    } else {?>

            <!-- Row Start -->
            <section class="content-header">
                <div class="container-sm">
                    <h1>
                        <i class="fa fa-envelope icon-title ml-4"></i> Tambah Data Surat Keluar

                     
                    </h1>
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
                            <form class="container-sm" method="POST" action="?module=surat_keluar&act=add" enctype="multipart/form-data">

                                <!-- Row in form START -->
                                <div class="row row-cols-2">
                                    <div class="col">
                                    <div class="form-group">
                                    <label for="no_agenda">Nomor Agenda</label>
                                        <?php
                                        echo '<input id="no_agenda" type="number" class="form-control" name="no_agenda" value="';
                                            $sql = mysqli_query($config, "SELECT no_agenda FROM tbl_surat_keluar");
                                            $no_agenda = "1";
                                            if (mysqli_num_rows($sql) == 0){
                                                echo $no_agenda;
                                            }

                                            $result = mysqli_num_rows($sql);
                                            $counter = 0;
                                            while(list($no_agenda) = mysqli_fetch_array($sql)){
                                                if (++$counter == $result) {
                                                    $no_agenda++;
                                                    echo $no_agenda;
                                                }
                                            }
                                            echo '" required>';

                                            if(isset($_SESSION['no_agendak'])){
                                                $no_agendak = $_SESSION['no_agendak'];
                                                echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$no_agendak.'</div>';
                                                unset($_SESSION['no_agendak']);
                                            }
                                        ?>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                        <label for="kode">Kode Klasifikasi</label>
                                        <input id="kode" type="text" class="form-control" name="kode" required>
                                            <?php
                                                if(isset($_SESSION['kodek'])){
                                                    $kodek = $_SESSION['kodek'];
                                                    echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$kodek.'</div>';
                                                    unset($_SESSION['kodek']);
                                                }
                                            ?>
                                            </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                        <label for="tujuan">Tujuan Surat</label>
                                        <input id="tujuan" type="text" class="form-control" name="tujuan" required>
                                            <?php
                                                if(isset($_SESSION['tujuan_surat'])){
                                                    $tujuan_surat = $_SESSION['tujuan_surat'];
                                                    echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$tujuan_surat.'</div>';
                                                    unset($_SESSION['tujuan_surat']);
                                                }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                        <label for="no_surat">Nomor Surat</label>
                                        <input id="no_surat" type="text" class="form-control" name="no_surat" required>
                                            <?php
                                                if(isset($_SESSION['no_suratk'])){
                                                    $no_suratk = $_SESSION['no_suratk'];
                                                    echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$no_suratk.'</div>';
                                                    unset($_SESSION['no_suratk']);
                                                }
                                                if(isset($_SESSION['errDup'])){
                                                    $errDup = $_SESSION['errDup'];
                                                    echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$errDup.'</div>';
                                                    unset($_SESSION['errDup']);
                                                }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                        <label for="tgl_surat">Tanggal Surat</label>
                                        <input id="tgl_surat" type="text" name="tgl_surat" class="form-control datepicker" autocomplete="off" required>
                                            <?php
                                                if(isset($_SESSION['tgl_suratk'])){
                                                    $tgl_suratk = $_SESSION['tgl_suratk'];
                                                    echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$tgl_suratk.'</div>';
                                                    unset($_SESSION['tgl_suratk']);
                                                }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col">
                                    <div class="form-group">
                                        <label for="keterangan">Perihal</label>
                                        <input id="keterangan" type="text" class="form-control" name="keterangan" required>
                                            <?php
                                                if(isset($_SESSION['keterangank'])){
                                                    $keterangank = $_SESSION['keterangank'];
                                                    echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$keterangank.'</div>';
                                                    unset($_SESSION['keterangank']);
                                                }
                                            ?>
                                        </div>    
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                        <label for="isi">Isi Ringkas</label>
                                        <textarea id="isi" class="materialize-textarea form-control" name="isi" required></textarea>
                                            <?php
                                                if(isset($_SESSION['isik'])){
                                                    $isik = $_SESSION['isik'];
                                                    echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$isik.'</div>';
                                                    unset($_SESSION['isik']);
                                                }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="file-field input-field">
                                            <div class="custom-file">
                                            <div class="form-file">
                                                <label>Upload File</label>
                                                <input class="form-control" type="file" id="file" name="file">
                                            </div>
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
                                <!-- Row in form END -->
                                <div class="modal-footer">
                                    <a href="?module=surat_keluar" type="button"  class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> BATAL</a>
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
    
?>
