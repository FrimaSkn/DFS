<?php
    //cek session
    if (empty($_SESSION['hak_akses'])){
        echo "<meta http-equiv='refresh' content='0; url=../../index.php?alert=3'>";
        die();
    } else {
        if(isset($_REQUEST['sub'])){
            $sub = $_REQUEST['sub'];
            switch ($sub) {
                case 'add':
                    include "tambah_disp.php";
                    break;
                case 'edit':
                    include "edit_disp.php";
                    break;
                case 'del':
                    include "hapus_disp.php";
                    break;
            }
        } else {

            
            //pagging
            $limit = 5;
            $pg = @$_GET['pg'];
                if(empty($pg)){
                    $curr = 0;
                    $pg = 1;
                } else {
                    $curr = ($pg - 1) * $limit;
                }

                $id_surat = $_REQUEST['id_surat'];

                $query = mysqli_query($config, "SELECT * FROM tbl_surat_masuk WHERE id_surat='$id_surat'");

                if(mysqli_num_rows($query) > 0){
                    $no = 1;
                    while($row = mysqli_fetch_array($query)){

                    if($_SESSION['id_user'] != $row['id_user'] AND $_SESSION['id_user'] != 1){
                        echo '<script language="javascript">
                                window.alert("ERROR! Anda tidak memiliki hak akses untuk melihat data ini");
                                window.location.href="./main.php?module=surat_masuk";
                              </script>';
                    } else {

                      echo '<section class="content-header">
                                <div class="container-fluid">'; include "alert.php";
                      echo             '<h1>
                                        <i class="fa fa-envelope icon-title ml-1"></i> Disposisi Surat
                                        <a class="btn btn-primary btn-secondary" href="?module=surat_masuk">
                                        <i class="fas fa-arrow-left"></i> Kembali
                                        </a>
                                        <a class="btn btn-primary btn-social" href="?module=surat_masuk&act=disp&id_surat='.$row['id_surat'].'&sub=add">
                                        <i class="fa fa-plus"></i> Tambah
                                        </a>
                                    </h1>
                                </div>
                            </section>

                            <section class="content">
                                <div class="container-fluid">
                                    <div class="card card-outline card-dark shadow">
                                        <div class="card-body">
                            <!-- Perihal START -->
                           
                                <div class="card alert-primary">
                                    <div class="card-body text-body">
                                        <p class="font-weight-bold">Perihal Surat: <p>'.$row['isi'].'</p></p>
                                    </div>
                                </div>
                         
                            <!-- Perihal END -->

                            <!-- Row form Start -->
                            <div class="row jarak-form">

                                <div class="col m12" id="colres">
                                    <table id="dataTb2" class="table table-striped">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th width="6%" class="align-middle">No</th>
                                                <th width="22%" class="align-middle">Tujuan Disposisi</th>
                                                <th width="32%" class="align-middle">Isi Disposisi</th>
                                                <th width="24%">Sifat<hr/>Batas Waktu</th>
                                                <th width="16%" class="align-middle">Tindakan</th>
                                            </tr>
                                        </thead>
                                        <tbody>';

                                        $query2 = mysqli_query($config, "SELECT * FROM tbl_disposisi JOIN tbl_surat_masuk ON tbl_disposisi.id_surat = tbl_surat_masuk.id_surat WHERE tbl_disposisi.id_surat='$id_surat'");

                                        if(mysqli_num_rows($query2) > 0){
                                            $no = 0;
                                            while($row = mysqli_fetch_array($query2)){
                                            $no++;
                                             echo '
                                                <tr>
                                                    <td class="align-middle">'.$no.'</td>
                                                    <td class="align-middle">'.$row['tujuan'].'</td>
                                                    <td class="align-middle">'.$row['isi_disposisi'].'</td>
                                                    <td>'.$row['sifat'].'<hr/>'.indoDate($row['batas_waktu']).'</td>
                                                    <td class="align-middle">
                                                        <a class="btn btn-primary shadow" href="?module=surat_masuk&act=disp&id_surat='.$id_surat.'&sub=edit&id_disposisi='.$row['id_disposisi'].'">
                                                              <i class="fa fa-edit"></i> EDIT</a>
                                                        <a class="btn btn-danger shadow" href="?module=surat_masuk&act=disp&id_surat='.$id_surat.'&sub=del&id_disposisi='.$row['id_disposisi'].'">
                                                              <i class="fa fa-trash"></i> HAPUS</a>
                                                        
                                                    </td>
                                            </tr>';
                                            }
                                        } else {
                                            echo '<tr><td colspan="5"><center><p class="add">Tidak ada data untuk ditampilkan. <u><a href="?module=surat_masuk&disp&act=disp&id_surat='.$row['id_surat'].'&sub=add">Tambah data baru</a></u></p></center></td></tr>';
                                        }
                                echo '</tbody></table>
                                </div>
                            </div>
                            </div><!-- /.box -->
                            </div><!--/.col -->
                          </div>   <!-- /.row -->
                        </section><!-- /.content -->
                            <!-- Row form END -->';
                    }
                }
            }
        }
    }
?>
