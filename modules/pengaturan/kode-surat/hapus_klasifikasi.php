<?php
    //cek session
    if (empty($_SESSION['hak_akses'])){
        echo "<meta http-equiv='refresh' content='0; url=../../index.php?alert=3'>";
        die();
    } else {

        $id_klasifikasi = mysqli_real_escape_string($config, $_REQUEST['id_klasifikasi']);
        $query = mysqli_query($config, "SELECT * FROM tbl_klasifikasi WHERE id_klasifikasi='$id_klasifikasi'");

    	if(mysqli_num_rows($query) > 0){
            $no = 1;
            while($row = mysqli_fetch_array($query)){

            if($_SESSION['hak_akses'] != 'Super Admin' AND $_SESSION['hak_akses'] != 'Manajer'){
                echo '<script language="javascript">
                        window.alert("ERROR! Anda tidak memiliki hak akses untuk menghapus data ini");
                        window.location.href="./main.php?module=ref";
                      </script>';
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
                                            <td width="13%">Kode</td>
                                            <td width="1%">:</td>
                                            <td width="86%">'.$row['kode'].'</td>
                                        </tr>
                                        <tr>
                                            <td width="13%">Nama</td>
                                            <td width="1%">:</td>
                                            <td width="86%">'.$row['nama'].'</td>
                                        </tr>
                                        <tr>
                                            <td width="13%">Uraian</td>
                                            <td width="1%">:</td>
                                            <td width="86%">'.$row['uraian'].'</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                    <a href="?module=ref&act=del&submit=yes&id_klasifikasi='.$row['id_klasifikasi'].'" class="btn btn-danger"><i class="fa fa-trash"></i> HAPUS</a>
                                    <a href="?module=ref" class="btn btn-secondary"><i class="fas fa-times"></i> BATAL</a>
                            </div>
                        </div><!-- /.box -->
                    </div><!--/.col -->
                </div>   <!-- /.row -->
            </section><!-- /.content -->
            <!-- Row form END -->';

        	if(isset($_REQUEST['submit'])){
        		$id_klasifikasi = $_REQUEST['id_klasifikasi'];

                $query = mysqli_query($config, "DELETE FROM tbl_klasifikasi WHERE id_klasifikasi='$id_klasifikasi'");

            	if($query == true){
                    $_SESSION['succDel'] = 'SUKSES! Data berhasil dihapus<br/>';
                    echo '<script language="javascript">
                            window.location.href="./main.php?module=ref";
                          </script>';
                    die();
            	} else {
                    $_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
                    echo '<script language="javascript">
                            window.location.href="./main.php?module=ref&act=del&id_klasifikasi='.$id_klasifikasi.'";
                          </script>';
            	}
            }
	    }
    }
}
}
?>
