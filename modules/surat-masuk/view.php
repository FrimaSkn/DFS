<?php 
if (empty($_SESSION['hak_akses'])){
  echo "<meta http-equiv='refresh' content='0; url=../../index.php?alert=3'>";
  die();
}

    if(isset($_REQUEST['act'])){
        $act = $_REQUEST['act'];
        switch ($act) {
            case 'add':
                include "tambah-surat.php";
                break;
            case 'edit':
                include "edit-surat.php";
                break;
            case 'del':
                include "hapus-surat.php";
                break;
            case 'disp':
                include "./modules/disposisi/view.php";
                break;
            case 'ctk':
                include "./modules/disposisi/cetak_disposisi.php";
                break;
        }
    } else {
?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
  <?php include "alert.php";?>
  <h1>
    <i class="fa fa-envelope icon-title ml-4"></i> Surat Masuk

    <a class="btn btn-primary btn-social" href="?module=surat_masuk&act=add" title="Tambah Data" data-toggle="toolkit">
      <i class="fa fa-plus"></i> Tambah
    </a>
  </h1>
</div>
</section>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="col-md-12">
      <div class="card card-outline card-dark shadow">
        <div class="card-body">
          <!-- tampilan tabel user -->
          <table id="dataTb2" class="table table-striped">
            <!-- tampilan tabel header -->
            <thead class="thead-dark">
              <tr>
                <th width='9%' class="center">No. Agenda<hr>Kode</th>
                <th class="center">Isi Ringkas <hr>File</th>
                <th class="align-middle">Alamat Surat</th>
                <th class="center">No. Surat<hr>Tanggal</th>
                <th width='13%' class="align-middle">Action</th>
              </tr>
            </thead>
            <!-- tampilan tabel body -->
            <tbody>
            <?php  
            $no = 1;
            /// fungsi query untuk menampilkan data 
            $query = mysqli_query($config, "SELECT * FROM tbl_surat_masuk ORDER BY id_surat DESC")
                                            or die('Ada kesalahan pada query tampil data user: '.mysqli_error($config));
                                            if(mysqli_num_rows($query) > 0){
                                              $no = 1;
                                              while($row = mysqli_fetch_array($query)){
                                                echo '
                                                <tr>
                                                  <td>'.$row['no_agenda'].'<br/><hr/>'.$row['kode'].'</td>
                                                  <td>'.substr($row['isi'],0,200).'<br/><br/><strong>File :</strong>';
              
                                                  if(!empty($row['file'])){
                                                      echo ' <strong><a href="?module=gsm&act=fsm&id_surat='.$row['id_surat'].'">'.$row['file'].'</a></strong>';
                                                  } else {
                                                      echo '<em>Tidak ada file yang di upload</em>';
                                                  } echo '</td>
                                                  <td>'.$row['asal_surat'].'</td>
                                                  <td>'.$row['no_surat'].'<br/><hr/>'.indoDate($row['tgl_surat']).'</td>

                                                  <td>';
                                                  if($_SESSION['hak_akses']!=='Camat'){
                                                    echo '<a class="btn btn-primary shadow" href="?module=surat_masuk&act=edit&id_surat='.$row['id_surat'].'">
                                                              <i class="fa fa-edit"></i>EDIT</a>
                                                          <a class="btn btn-info ml-2 shadow" data-position="left" data-tooltip="Pilih Disp untuk menambahkan Disposisi Surat" href="?module=surat_masuk&act=disp&id_surat='.$row['id_surat'].'">
                                                              <i class="fa fa-file"></i> DISP</a><br>
                                                          <a class="btn btn-warning mt-2 shadow" href="?module=surat_masuk&act=ctk&id_surat='.$row['id_surat'].'" target="_blank">
                                                              <i class="fa fa-print"></i> PRINT</a>
                                                          <a class="btn btn-danger mt-2 shadow" href="?module=surat_masuk&act=del&id_surat='.$row['id_surat'].'">
                                                              <i class="fa fa-trash"></i> DEL</a>';
                                                            } else {
                                                              echo '<a class="btn btn-warning shadow" href="?module=surat_masuk&act=ctk&id_surat='.$row['id_surat'].'" target="_blank">
                                                                  <i class="fa fa-print "></i> PRINT</a>';
                                                  } echo '
                                                      </td>
                                                  </tr>';
                                              }
                                          } else {
                                              echo '<tr><td colspan="5"><center><p class="add">Tidak ada data yang ditemukan</p></center></td></tr>';
                                          }
              $no++;
            ?>
            </tbody>
          </table>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!--/.col -->
  </div>   <!-- /.row -->
</section><!-- /.content -->

<?php } ?>