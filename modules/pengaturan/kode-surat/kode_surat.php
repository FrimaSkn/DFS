<?php
    //cek session
    if (empty($_SESSION['hak_akses'])){
        echo "<meta http-equiv='refresh' content='0; url=../../index.php?alert=3'>";
        die();
    } else {

        if(isset($_REQUEST['act'])){
            $act = $_REQUEST['act'];
            switch ($act) {
                case 'add':
                    include "tambah_klasifikasi.php";
                    break;
                case 'edit':
                    include "edit_klasifikasi.php";
                    break;
                case 'del':
                    include "hapus_klasifikasi.php";
                    break;
                case 'imp':
                    include "upload_referensi.php";
                    break;
            }
        } else {

                echo '<!-- Row Start -->
                <section class="content-header">
                    <div class="container-sm">
                        <h1>
                            <i class="fa fa-bookmark icon-title ml-4"></i> Kode Klasifikasi Surat ';
                            if($_SESSION['hak_akses'] !='Sekcam'){
                                echo '
                            <a class="btn btn-primary btn-social" href="?module=ref&act=add" title="Tambah Data" data-toggle="toolkit">
                            <i class="fa fa-plus"></i> Tambah
                            </a>
                        </h1>';
                            }else {
                                echo '';
                            }
                            
                   echo '  
                    </div>
                </section>';

               echo '<div class="container-sm">';
                            
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
                           
                echo '</div>';

                echo '
                <!-- Row form Start -->
                <section class="content">
                    <div class="container-sm">
                        <div class="col-md-12">
                            <div class="card card-outline card-dark shadow">
                                <div class="card-body">
                                    <table class="table table-striped" id="dataTb2">
                                        <thead class="thead-dark" id="head">
                                            <tr>
                                                <th width="10%">Kode</th>
                                                <th width="30%">Nama</th>
                                                <th width="42%">Uraian</th>
                                                <th width="25%">Tindakan</th>    
                                            </tr>
                                        </thead>
                                        <tbody>';

                                            //script untuk menampilkan data
                                            $query = mysqli_query($config, "SELECT * FROM tbl_klasifikasi ORDER BY id_klasifikasi DESC");
                                            if(mysqli_num_rows($query) > 0){
                                                while($row = mysqli_fetch_array($query)){
                                                    echo '
                                                    <tr>
                                                        <td>'.$row['kode'].'</td>
                                                        <td>'.$row['nama'].'</td>
                                                        <td>'.$row['uraian'].'</td>
                                                        <td>';

                                                        if($_SESSION['hak_akses'] != 'Super Admin' AND $_SESSION['hak_akses'] != 'Manajer'){
                                                            echo '<a class="btn small blue-grey waves-effect waves-light"><i class="fa fa-gov"></i> NO ACTION</a>';
                                                        } else {
                                                            echo '<a class="btn btn-primary shadow" href="?module=ref&act=edit&id_klasifikasi='.$row['id_klasifikasi'].'">
                                                                    <i class="fa fa-edit"></i> EDIT</a>
                                                                <a class="btn btn-danger shadow" href="?module=ref&act=del&id_klasifikasi='.$row['id_klasifikasi'].'">
                                                                    <i class="fa fa-trash"></i> DEL</a>';
                                                        } echo '
                                                        </td>
                                                    </tr>';
                                                }
                                            } else {
                                                echo '<tr><td colspan="5"><center><p class="add">Tidak ada data yang ditemukan. <u><a href="?module=ref&act=add">Tambah data baru</a></u></p></center></td></tr>';
                                            }
                                            echo '

                                        </tbody>
                                    </table><br/><br/>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div><!--/.col -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
             <!-- Row form END -->';
            }
        }
?>
