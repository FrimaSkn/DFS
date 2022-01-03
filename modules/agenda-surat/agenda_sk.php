<?php
    //cek session
    if (empty($_SESSION['hak_akses'])){
        echo "<meta http-equiv='refresh' content='0; url=../../index.php?alert=3'>";
        die();
    } else {

        echo '
        <style type="text/css">
            .hidd {
                display: none
            }
            @media print{
                body {
                    font-size: 12px!important;
                    color: #212121;
                }
                .disp {
                    text-align: center;
                    margin: -.5rem 0;
                    width: 100%;
                }
                .input-group, .btn {
                    display: none
                }
                .hidd {
                    display: block
                }
                .logodisp {
                    position: absolute;
                        width: 150px;
                        height: 120px;
                        left: 70px;
                        margin: 0 0 0 1.2rem;
                }
                .up {
                    font-size: 17px!important;
                    font-weight: normal;
                    margin-top: 45px;
                    text-transform: uppercase
                }
                #nama {
                    font-size: 20px!important;
                    text-transform: uppercase;
                    margin-top: 5px;
                    font-weight: bold;
                }
                .status {
                    font-size: 17px!important;
                    font-weight: normal;
                    margin-top: -1.5rem;
                }
                #alamat {
                    margin-top: -15px;
                    font-size: 13px;
                }
                .separator {
                    border-bottom: 2px solid #616161;
                    margin: 1rem 0;
                }
            }
        </style>';

        if(isset($_REQUEST['submit'])){

            $dari_tanggal = $_REQUEST['dari_tanggal'];
            $sampai_tanggal = $_REQUEST['sampai_tanggal'];

            if($_REQUEST['dari_tanggal'] == "" || $_REQUEST['sampai_tanggal'] == ""){
                header("Location: ./main.php?module=ask");
                die();
            } else {

                $query = mysqli_query($config, "SELECT * FROM tbl_surat_keluar WHERE tgl_catat BETWEEN '$dari_tanggal' AND '$sampai_tanggal'");

                $query2 = mysqli_query($config, "SELECT nama FROM tbl_instansi");
                list($nama) = mysqli_fetch_array($query2);

                echo '
                    <!-- SHOW DAFTAR AGENDA -->
                    <section class="content-header">
                        <div class="container-fluid">
                            <h1><i class="fas fa-calendar-check icon-title ml-4"></i> Agenda Surat Keluar</h1>
                        </div>
                    </section>

                    <!-- Row form Start -->
                    <section class="content">
                        <div class="container-fluid">
                            <div class="col-md-12">
                                <div class="">
                                    <div class="card-body">
                                        <div class="">
                                            <form class="col-12" method="post" action="">
                                                <div class="form-row">
                                                    <div class=" col-md-2">
                                                        <div class="input-group mb-2">
                                                            <div class="input-group-prepend">
                                                            <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                                                            </div>
                                                            <input type="text" class="form-control datepicker" name="dari_tanggal" id="dari_tanggal" placeholder="Dari Tanggal" autocomplete="off" required>
                                                        </div>
                                                    </div> 
                                                    <div class=" col-md-2">
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
                                        </div>

                                        <div class="row agenda">
                                            <div class="disp hidd">';
                                                $query2 = mysqli_query($config, "SELECT institusi, nama, alamat, tlp, logo FROM tbl_instansi");
                                                list($institusi, $nama, $alamat, $tlp, $logo) = mysqli_fetch_array($query2);
                                                    echo '<img class="logodisp" src="./upload/'.$logo.'"/>';

                                                    echo '<h6 class="up" id="nama">'.$institusi.'</h6>';

                                                    echo '<h5 class="nama" id="nama">'.$nama.'</h5><br/>';

                                                    echo '<h6 class="alamat">'.$alamat.'</h6>';

                                                    echo '<span id="tlp">'.$tlp.'</span>

                                                </div>
                                                <div class="disp mt-2">
                                                <div class="separator"></div>
                                                <h5 class="hid">AGENDA SURAT KELUAR</h5>
                                                </div>
                                            <div class="col mt-3">
                                                <p class="warna agenda">Agenda Surat Keluar dari tanggal <strong>'.indoDate($dari_tanggal).'</strong> sampai dengan tanggal <strong>'.indoDate($sampai_tanggal).'</strong></p>
                                            </div>
                                            <div class="col-auto my-3">
                                                <button type="submit" onClick="window.print()" class="btn btn-warning right"><i class="fa fa-print"></i> CETAK</button>
                                            </div>
                                        </div>
                                        <div id="colres" class="warna cetak">
                                            <table class="table" id="tbl" width="100%">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th width="3%">No</th>
                                                        <th width="5%">Kode</th>
                                                        <th width="21%">Isi Ringkas</th>
                                                        <th width="18%">Tujuan Surat</th>
                                                        <th width="15%">Nomor Surat</th>
                                                        <th width="10%">Tanggal<br/> Surat</th>
                                                        <th width="12%">Pengelola</th>
                                                        <th width="10%">Keterangan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>';

                                                if(mysqli_num_rows($query) > 0){
                                                    $no = 0;
                                                    while($row = mysqli_fetch_array($query)){
                                                    echo '
                                                        <tr>
                                                            <td>'.$row['no_agenda'].'</td>
                                                            <td>'.$row['kode'].'</td>
                                                            <td>'.$row['isi'].'</td>
                                                            <td>'.$row['tujuan'].'</td>
                                                            <td>'.$row['no_surat'].'</td>
                                                            <td>'.indoDate($row['tgl_surat']).'</td>
                                                            <td>';

                                                            if($row['id_user'] == 1){
                                                                $row['id_user'] = 'Administrator';
                                                            } else {
                                                                $id_user = $row['id_user'];
                                                                $query3 = mysqli_query($config, "SELECT nama FROM tbl_user WHERE id_user='$id_user'");
                                                                list($nama) = mysqli_fetch_array($query3);
                                                                $row['id_user'] = ''.$nama.'';
                                                            }

                                                            echo ''.$row['id_user'].'</td>
                                                            <td>'.$row['keterangan'].'';
                                                    echo ' </td>
                                                    </tr>';
                                                        }
                                                    } else {
                                                        echo '<tr><td colspan="9"><center><p class="add">Tidak ada agenda surat</p></center></td></tr>';
                                                    } echo '
                                                </tbody></table>
                                        </div>

                                    </div><!-- /.box-body -->
                                </div><!-- /.box -->
                            </div><!--/.col -->
                        </div>   <!-- /.row -->
                    </section><!-- /.content -->';
            }
        } else {
            echo '
                <!-- Row Start -->
                <section class="content-header">
                    <div class="container-fluid">
                        <h1><i class="fas fa-calendar-check icon-title ml-4"></i> Agenda Surat Keluar</h1>
                    </div>
                </section>
                <!-- Row END -->

                <!-- Row form Start -->
                    <section class="content">
                        <div class="container-fluid">
                            <div class="col-md-12">
                                <div class="card card-outline card-dark shadow">
                                    <div class="card-body">
                                        <div class="modal-header">
                                            <form class="col-12" method="post" action="">
                                                <div class="form-row">
                                                    <div class=" col-md-2">
                                                        <div class="input-group mb-2">
                                                            <div class="input-group-prepend">
                                                            <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                                                            </div>
                                                            <input type="text" class="form-control datepicker" name="dari_tanggal" id="dari_tanggal" placeholder="Dari Tanggal" autocomplete="off" required>
                                                        </div>
                                                    </div> 
                                                    <div class=" col-md-2">
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
                                        </div>
                                    </div><!-- /.box -->
                                </div><!-- /.box -->
                            </div><!--/.col -->
                        </div>   <!-- /.row -->
                    </section><!-- /.content -->';
        }
    }
?>
