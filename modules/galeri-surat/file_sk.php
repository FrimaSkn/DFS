<?php
    //cek session
    if (empty($_SESSION['hak_akses'])){
        echo "<meta http-equiv='refresh' content='0; url=../../index.php?alert=3'>";
        die();
      }
        $id_surat = mysqli_real_escape_string($config, $_REQUEST['id_surat']);
        $query = mysqli_query($config, "SELECT * FROM tbl_surat_keluar WHERE id_surat='$id_surat'");
        if(mysqli_num_rows($query) > 0){
            while($row = mysqli_fetch_array($query)){ ?>
                    <!-- Row Start -->
                    <section class="content-header">
                        <div class="container-sm">
                            <h1>
                                <i class="fas fa-info-circle"></i></i> Detail File Surat Keluar
                                <button onclick="window.history.back()" class="btn blue btn-secondary"><i class="fas fa-arrow-left"></i> KEMBALI</button>
                            </h1>
                        </div>
                    </section>
                    <!-- Row END -->
                     <!-- Row form Start -->
                     <section class="content">
                        <div class="container-sm">
                            <div class="card card-outline card-dark shadow">
                                <div class="card-body">
                                    <div class="row">
                                        
                                        <div class="col-5">
                                            <?php
                                            if(empty($row['file'])){
                                                echo '';
                                            } else {

                                                $ekstensi = array('jpg','png','jpeg');
                                                $ekstensi2 = array('doc','docx');
                                                $file = $row['file'];
                                                $x = explode('.', $file);
                                                $eks = strtolower(end($x));

                                                if(in_array($eks, $ekstensi) == true){
                                                    echo '<img class="file" data-caption="'.date('d M Y', strtotime($row['tgl_catat'])).'" src="./upload/surat_keluar/'.$row['file'].'"/>';
                                                } else {

                                                    if(in_array($eks, $ekstensi2) == true){ ?>
                                                        

                                                                    <div class="col s3 right">
                                                                        <img class="file" src="assets/img/word.png">
                                                                    </div>
                                                <?php } else { ?>
                                                        
                                                                    <div class="col s3 right">
                                                                        <img class="file" src="assets/img/pdf.png">
                                                                     </div>
                                                <?php }
                                                }
                                            }?>
                                        </div>
                                        <div class="col-7">
                                            <table class="table">
                                                <tbody>
                                                <tr>
                                                        <td width="40%">No. Agenda</td>
                                                        <td width="1%">:</td>
                                                        <td width="86%"><?= $row['no_agenda'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="13%">Kode Klasifikasi</td>
                                                        <td width="1%">:</td>
                                                        <td width="86%"><?= $row['kode'] ?> </td>
                                                    </tr>
                                                    </tr>
                                                    <tr>
                                                    <td width="13%">Isi Ringkas</td>
                                                    <td width="1%">:</td>
                                                    <td width="86%"><?= $row['isi'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="13%">Tujuan Surat</td>
                                                        <td width="1%">:</td>
                                                        <td width="86%"><?= $row['tujuan'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="13%">No. Surat</td>
                                                        <td width="1%">:</td>
                                                        <td width="86%"><?= $row['no_surat'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="13%">Tanggal Surat</td>
                                                        <td width="1%">:</td><td width="86%"><?= indoDate($row['tgl_surat']) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="13%">Perihal</td>
                                                        <td width="1%">:</td>
                                                        <td width="86%"><?= $row['keterangan'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="13%"><strong> Lihat File</strong></td>
                                                        <td width="1%">:</td>
                                                        <td width="86%"><a class="blue-text" href="./upload/surat_keluar/<?= $row['file'] ?>" target="_blank"><?= $row['file'] ?></a></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                        
                        
                    </div><!-- Row form End -->
                            </div><!-- /.box -->
                            </div><!--/.col -->
                          </div>   <!-- /.row -->
                        </section><!-- /.content --';
          <?php  }
        }
    
?>
