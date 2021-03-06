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

    	$id_surat = mysqli_real_escape_string($config, $_REQUEST['id_surat']);
    	$query = mysqli_query($config, "SELECT * FROM tbl_surat_keluar WHERE id_surat='$id_surat'");

    	if(mysqli_num_rows($query) > 0){
            $no = 1;
            while($row = mysqli_fetch_array($query)){

            if($_SESSION['id_user'] != $row['id_user'] AND $_SESSION['id_user'] != 1){
                echo '<script language="javascript">
                        window.alert("ERROR! Anda tidak memiliki hak akses untuk menghapus data ini");
                        window.location.href="./main.php?module=tsk";
                      </script>';
            } else {

              echo '
              <!-- Row Start -->
            <section class="content-header">
                <div class="container-sm"></div>
            </section>
            <!-- Row END -->
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
        				                    <td width="13%">No. Agenda</td>
        				                    <td width="1%">:</td>
        				                    <td width="86%">'.$row['no_agenda'].'</td>
        				                </tr>
        				                <tr>
        				                    <td width="13%">Kode Klasifikasi</td>
        				                    <td width="1%">:</td>
        				                    <td width="86%">'.$row['kode'].'</td>
        				                </tr>
        				                <tr>
        				                    <td width="13%">No. Isi</td>
        				                    <td width="1%">:</td>
        				                    <td width="86%">'.$row['isi'].'</td>
        				                </tr>
        				                <tr>
        				                    <td width="13%">File</td>
        				                    <td width="1%">:</td>
                                            <td width="86%">';
                                            if(!empty($row['file'])){
                                                echo ' <a class="blue-text" href="?page=gsk&act=fsk&id_surat='.$row['id_surat'].'">'.$row['file'].'</a>';
                                            } else {
                                                echo ' Tidak ada file yang diupload';
                                            } echo '</td>
                                        </tr>
        				                <tr>
        				                    <td width="13%">Tujuan </td>
        				                    <td width="1%">:</td>
        				                    <td width="86%">'.$row['tujuan'].'</td>
        				                </tr>
        				                <tr>
        				                    <td width="13%">No. Surat</td>
        				                    <td width="1%">:</td>
        				                    <td width="86%">'.$row['no_surat'].'</td>
        				                </tr>
        				                <tr>
        				                    <td width="13%">Tanggal Surat</td>
        				                    <td width="1%">:</td>
        				                    <td width="86%">'.indoDate($row['tgl_surat']).'</td>
        				                </tr>
                                        <tr>
                                            <td width="13%">Keterangan</td>
                                            <td width="1%">:</td>
                                            <td width="86%">'.$row['keterangan'].'</td>
                                        </tr>
        				            </tbody>
    				   		    </table>
				            </div>
                            <div class="modal-footer">
        	                    <a href="?module=surat_keluar&act=del&submit=yes&id_surat='.$row['id_surat'].'" class="btn btn-danger"><i class="fa fa-trash"></i> HAPUS</a>
        	                    <a href="?module=surat_keluar" class="btn btn-secondary"><i class="fas fa-times"></i> BATAL</a>
    	                    </div>
                            </div><!-- /.box -->
                            </div><!-- /.box -->
                        </div><!--/.col -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
                <!-- Row form END -->';

            	if(isset($_REQUEST['submit'])){
            		$id_surat = $_REQUEST['id_surat'];

                    //jika ada file akan mengekseskusi script dibawah ini
                    if(!empty($row['file'])){

                        unlink("upload/surat_keluar/".$row['file']);
                        $query = mysqli_query($config, "DELETE FROM tbl_surat_keluar WHERE id_surat='$id_surat'");

                		if($query == true){
                            $_SESSION['succDel'] = 'SUKSES! Data berhasil dihapus<br/>';
                             echo  '<script language="javascript">
                                    window.location.href="./main.php?module=surat_keluar&alert=2";
                                  </script>';
                            die();
                		} else {
                            $_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
                            echo '<script language="javascript">
                                    window.location.href="./?module=surat_keluar&act=del&id_surat='.$id_surat.'";
                                  </script>';
                		}
                	} else {

                        //jika tidak ada file akan mengekseskusi script dibawah ini
                        $query = mysqli_query($config, "DELETE FROM tbl_surat_keluar WHERE id_surat='$id_surat'");

                        if($query == true){
                            $_SESSION['succDel'] = 'SUKSES! Data berhasil dihapus<br/>';
                             echo  '<script language="javascript">
                                    window.location.href="./main.php?module=surat_keluar&alert=2";
                                  </script>';
                            die();
                        } else {
                            $_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
                            echo '<script language="javascript">
                                    window.location.href="./?module=surat_keluar&act=del&id_surat='.$id_surat.'";
                                  </script>';
                        }
                    }
                }
		    }
	    }
    }
}
?>
