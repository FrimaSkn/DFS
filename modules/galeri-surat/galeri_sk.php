<?php
    //cek session
    if (empty($_SESSION['hak_akses'])){
        echo "<meta http-equiv='refresh' content='0; url=../../index.php?alert=3'>";
        die();
    } else {
        if(isset($_REQUEST['act'])){
            $act = $_REQUEST['act'];
            switch ($act) {
                case 'fsk':
                    include "file_sk.php";
                    break;
            }
        } else { 

        

                    echo '
                    <!-- Row Start -->
                    <section class="content-header">
                        <div class="container-fluid">
                            <h1><i class="fa fa-image icon-title"></i> Galeri Surat Keluar</h1>
                        </div>
                    </section>
                    <!-- Row END -->

                    <!-- Row form Start -->
                    <section class="content">
                        <div class="container-fluid">
                            <div class="card card-outline card-dark shadow">
                                <div class="card-body">
                                    ';

                                    if(isset($_REQUEST['submit'])){

                                        $dari_tanggal = $_REQUEST['dari_tanggal'];
                                        $sampai_tanggal = $_REQUEST['sampai_tanggal'];
                
                                        if($_REQUEST['dari_tanggal'] == "" || $_REQUEST['sampai_tanggal'] == ""){
                                            header("Location: ./main.php?module=gsk");
                                            die();
                                        } else {
                
                                        $query = mysqli_query($config, "SELECT * FROM tbl_surat_keluar WHERE tgl_catat BETWEEN '$dari_tanggal' AND '$sampai_tanggal' ORDER By id_surat DESC");

                        echo '<!-- Row form Start -->
                        <div class="modal-header">
                            <form class="" method="post" action="">
                                <div class="form-row">
                                    <div class="col">
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                                            </div>
                                            <input type="text" class="form-control datepicker" name="dari_tanggal" id="dari_tanggal" placeholder="Dari Tanggal" autocomplete="off" required>
                                        </div>
                                    </div> 
                                    <div class="col">
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                            </div>
                                            <input type="text" class="form-control datepicker" name="sampai_tanggal" id="sampai_tanggal" placeholder="Samapai Tanggal" autocomplete="off" required>
                                        </div>
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-primary mb-2"><i class="far fa-eye"></i> TAMPILKAN </button>
                                    <button type="reset" onclick="window.history.back()" class="btn btn-success ml-2 mb-2"><i class="fas fa-redo"> RESET </i></button>
                                </div>
                            </form>
                        </div>
                            <!-- Row form END -->

                            <div class="">
                                <div class=""> 
                                    <p class="warna agenda text-center">Galeri file surat masuk antara tanggal <strong>'.indoDate($dari_tanggal).'</strong> sampai dengan tanggal <strong>'.indoDate($sampai_tanggal).'</strong></p>
                                </div>
                            </div>
                            <div class="row container-fluid">';

                            if(mysqli_num_rows($query) > 0){
                                while($row = mysqli_fetch_array($query)){
                                if(empty($row['file'])){
                                    echo '';
                                } else {

                                    $ekstensi = array('jpg','png','jpeg');
                                    $ekstensi2 = array('doc','docx');
                                    $file = $row['file'];
                                    $x = explode('.', $file);
                                    $eks = strtolower(end($x));

                                    if(in_array($eks, $ekstensi) == true){
                                        echo '
                                            <div class="col-3">
                                                <img style="border:1px solid #444;border-radius:5px;" class="galeri" data-caption="'.indoDate($row['tgl_catat']).'" src="./upload/surat_keluar/'.$row['file'].'"/>
                                                <a class="col btn btn-info my-2" href="?module=gsk&act=fsk&id_surat='.$row['id_surat'].'">Tampilkan Ukuran Penuh</a>
                                            </div>';
                                    } else {

                                        if(in_array($eks, $ekstensi2) == true){
                                            echo '
                                                <div class="col-3">
                                                    <img class="galeri" data-caption="'.indoDate($row['tgl_catat']).'" src="./assets/img/word.png"/>
                                                    <a class="col btn btn-info my-2" href="?module=gsk&act=fsk&id_surat='.$row['id_surat'].'">Lihat Detail File</a>
                                                ';
                                        } else {
                                            echo '
                                                <div class="col-3">
                                                    <img class="galeri" data-caption="'.indoDate($row['tgl_catat']).'" src="./assets/img/pdf.png"/>
                                                    <a class="col btn btn-info my-2" href="?module=gsk&act=fsk&id_surat='.$row['id_surat'].'">Lihat Detail File</a>
                                                
                                            </div>';
                                        }
                                    }
                                }
                                }
                            } else {
                                echo '<div class="col m12">
                                                <span class="text-center lampiran"><center>Tidak ada file lampiran surat masuk yang ditemukan</center></span>
                                    </div>';
                            } echo '
                            </div><!-- Row form End -->
                            </div><!-- /.box -->
                            </div><!--/.col -->
                          </div>   <!-- /.row -->
                        </section><!-- /.content -->';
                        }
                    } else {

                        //script untuk menampilkan data
                        $query = mysqli_query($config, "SELECT * FROM tbl_surat_keluar ORDER BY id_surat DESC");
                        if(mysqli_num_rows($query) > 0){

                            echo '
                            <!-- Row form Start -->
                            <div class="modal-header">
                                <form class="" method="post" action="">
                                    <div class="form-row">
                                        <div class="col">
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                                                </div>
                                                <input type="text" class="form-control datepicker" name="dari_tanggal" id="dari_tanggal" placeholder="Dari Tanggal" autocomplete="off" required>
                                            </div>
                                        </div> 
                                        <div class="col">
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                                </div>
                                                <input type="text" class="form-control datepicker" name="sampai_tanggal" id="sampai_tanggal" placeholder="Samapai Tanggal" autocomplete="off" required>
                                            </div>
                                    </div>
                                        <button type="submit" name="submit" class="btn btn-primary mb-2"><i class="far fa-eye"></i> TAMPILKAN </button>
                                    </div>
                                </form>
                            </div><br>
                           <div class="row container-fluid">

                         ';

                            while($row = mysqli_fetch_array($query)){
                               
                                if(empty($row['file'])){
                                    echo '';
                                } else {

                                    $ekstensi = array('jpg','png','jpeg');
                                    $ekstensi2 = array('doc','docx');
                                    $file = $row['file'];
                                    $x = explode('.', $file);
                                    $eks = strtolower(end($x));
                                    
                                    if(in_array($eks, $ekstensi) == true){
                                    
                                    echo '
                                        <div class="col-3">
                                            <img style="border:1px solid #444;border-radius:5px;" class="galeri" data-caption="'.indoDate($row['tgl_catat']).'" src="./upload/surat_keluar/'.$row['file'].'"/>
                                            <a class="col btn btn-info my-2" href="?module=gsk&act=fsk&id_surat='.$row['id_surat'].'">Lihat Detail File</a>
                                        </div>';
                                    } else {

                                        if(in_array($eks, $ekstensi2) == true){
                                        echo '
                                            <div class="col-3">
                                                <img class="galeri" data-caption="'.indoDate($row['tgl_catat']).'" src="./assets/img/word.png"/>
                                                <a class="col btn btn-info my-2" href="?module=gsk&act=fsk&id_surat='.$row['id_surat'].'">Lihat Detail File</a>
                                            </div>';
                                        } else {
                                            echo '
                                                <div class="col-3">
                                                    <img class="galeri" data-caption="'.indoDate($row['tgl_catat']).'" src="./assets/img/pdf.png"/>
                                                    <a class="col btn btn-info my-2" href="?module=gsk&act=fsk&id_surat='.$row['id_surat'].'">Lihat Detail File</a>
                                                </div>
                                            
                                            ';
                                        }
                                    }
                                }
                            }
                        } else {
                            echo '</div>
                                <div class="col m12">
                                    <div class="card blue lighten-5">
                                        <div class="card-content notif">
                                            <span class="card-title lampiran"><center>Tidak ada data untuk ditampilkan</center></span>
                                        </div>
                                    </div>
                                </div>';
                        } echo '
                        </div>
                        </div><!-- /.box -->
                        </div><!--/.col -->
                      </div>   <!-- /.row -->
                    </section><!-- /.content -->';

                       
                }
            }
        }
?>
