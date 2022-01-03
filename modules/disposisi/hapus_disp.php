<?php
    //cek session
    if (empty($_SESSION['hak_akses'])){
        echo "<meta http-equiv='refresh' content='0; url=../../index.php?alert=3'>";
        die();
    } else {

        if(isset($_SESSION['errQ'])){
            $errQ = $_SESSION['errQ'];
            echo '<div id="alert-message" class="row jarak-card">
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

    	$id_disposisi = mysqli_real_escape_string($config, $_REQUEST['id_disposisi']);

    	$query = mysqli_query($config, "SELECT * FROM tbl_disposisi WHERE id_disposisi='$id_disposisi'");

    	if(mysqli_num_rows($query) > 0){
            $no = 1;
            while($row = mysqli_fetch_array($query)){

              echo '
                    <section class="content-header">
                        <div class="container-sm"></div>
                    </section>

                    <!-- Row form Start -->
    				 <section class="content">
                        <div class="container-sm">
                            <div class="col-md-12">
                                <div class="card card-outline card-dark shadow">
                                    <div class="card-body">
            				        <table>
            				            <thead class="red lighten-5 red-text">
                                            <div  class="alert alert-danger alert-dismissable shadow">
                                                <h4>  <i class="fas fa-exclamation-circle"></i>Hapus Data</h4>
                                                Apakah anda yakin akan menghapus data ini ?
                                            </div>
            				            </thead>

            				            <tbody>
            				                <tr>
            				                    <td width="20%">Tujuan</td>
            				                    <td width="5%">:</td>
            				                    <td width="50%">'.$row['tujuan'].'</td>
            				                </tr>
            				                <tr>
            				                    <td width="20%">Isi Disposis</td>
            				                    <td width="5%">:</td>
            				                    <td width="50%">'.$row['isi_disposisi'].'</td>
            				                </tr>
            				                <tr>
            				                    <td width="20%">Sifat</td>
            				                    <td width="5%">:</td>
            				                    <td width="50%">'.$row['sifat'].'</td>
            				                </tr>
            				                <tr>
            				                    <td width="20%">Batas Waktu</td>
            				                    <td width="5%">:</td>
            				                    <td width="50%">'.date('d M Y', strtotime($row['batas_waktu'])).'</td>
            				                </tr>
                                            <tr>
                                                <td width="20%">Catatan</td>
                                                <td width="5%">:</td>
                                                <td width="50%">'.$row['catatan'].'</td>
                                            </tr>
            				            </tbody>
            				   		</table>
                                </div>
                                <div class="modal-footer">
                                    <a href="?module=surat_masuk&act=disp&id_surat='.$row['id_surat'].'&sub=del&submit=yes&id_disposisi='.$row['id_disposisi'].'" class="btn btn-danger"><i class="fa fa-trash"></i> HAPUS </a>
                                    <a href="?module=surat_masuk&act=disp&id_surat='.$row['id_surat'].'" class="btn btn-secondary"><i class="fas fa-times"></i> BATAL </a>
    	                        </div>
                            </div><!-- /.box -->
                            </div><!-- /.box -->
                            </div><!--/.col -->
                        </div>   <!-- /.row -->
                    </section><!-- /.content -->
                    <!-- Row form END -->';

                	if(isset($_REQUEST['submit'])){
                		$id_disposisi = $_REQUEST['id_disposisi'];

                		$query = mysqli_query($config, "DELETE FROM tbl_disposisi WHERE id_disposisi='$id_disposisi'");

                		if($query == true){
                            $_SESSION['succDel'] = 'SUKSES! Data berhasil dihapus ';
                            echo '<script language="javascript">
                                    window.location.href="./main.php?module=surat_masuk&act=disp&id_surat='.$row['id_surat'].'";
                                  </script>';
                		} else {
                            $_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
                            echo '<script language="javascript">
                                    window.location.href="./main.php?module=surat_masuk&act=disp&id_surat='.$row['id_surat'].'&sub=del&id_disposisi='.$row['id_disposisi'].'";
                                  </script>';
                		}
                	}
    		    }
    	    }
        }
?>
