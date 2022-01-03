<?php 
if (empty($_SESSION['hak_akses'])){
  echo "<meta http-equiv='refresh' content='0; url=../../index.php?alert=3'>";
  die();
}

if ($_SESSION['hak_akses']=='Super Admin') { ?>

    <li class="nav-item">
      <a href="?module=beranda" class="nav-link <?php if($_GET["module"]=="beranda"){echo 'active';} ?>">
        <i class="nav-icon fas fa-home"></i>
        <p>Dashboard</p>
      </a>
    </li>
   <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link <?php if($_GET["module"]=="surat_masuk"){ echo 'active';} ?> <?php if($_GET["module"]=="surat_keluar"){echo 'active';} ?>">
              <i class="nav-icon fas fa-inbox"></i>
              <p>
                Data Arsip Surat
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="?module=surat_masuk" class="nav-link <?php if($_GET["module"]=="surat_masuk"){echo 'active';} ?>">
                  <i class="fas fa-envelope"></i>
                  <p>Surat Masuk</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?module=surat_keluar" class="nav-link <?php if($_GET["module"]=="surat_keluar"){echo 'active';} ?>">
                  <i class="fas fa-paper-plane"></i>
                  <p>Surat Keluar</p>
                </a>
            </ul>
            </li>
            <li class="nav-item has-treeview menu-open">
                    <a href="#" class="nav-link <?php if($_GET["module"]=="asm"){ echo 'active';} ?> <?php if($_GET["module"]=="ask"){echo 'active';} ?>">
                      <i class="nav-icon fas fa-calendar-check"></i>
                      <p>
                        Laporan
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="?module=asm" class="nav-link <?php if($_GET["module"]=="asm"){echo 'active';} ?>">
                          <i class="fas fa-envelope"></i>
                          <p>Agenda Surat Masuk</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="?module=ask" class="nav-link <?php if($_GET["module"]=="ask"){echo 'active';} ?>">
                          <i class="fas fa-paper-plane"></i>
                          <p>Agenda Surat Keluar</p>
                        </a>
                    </ul>
            </li>
            <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link <?php if($_GET["module"]=="gsm"){ echo 'active';} ?> <?php if($_GET["module"]=="gsk"){echo 'active';} ?>">
              <i class="nav-icon far fa-image"></i>
              <p>
                Galeri Surat
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="?module=gsm" class="nav-link <?php if($_GET["module"]=="gsm"){echo 'active';} ?>">
                  <i class="fas fa-envelope"></i>
                  <p>Galeri Surat Masuk</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?module=gsk" class="nav-link <?php if($_GET["module"]=="gsk"){echo 'active';} ?>">
                  <i class="fas fa-paper-plane"></i>
                  <p>Galeri Surat Keluar</p>
                </a>
            </ul>
    </li>
    <li class="nav-header"><i class="nav-icon fas fa-cog"></i> PENGATURAN</li>
    <li class="nav-item">
      <a href="?module=ref" class="nav-link <?php if($_GET["module"]=="ref"){echo 'active';} ?>">
        <i class="nav-icon fas fa-bookmark"></i>
        <p>Kode Klasifikasi Surat</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="?module=ints" class="nav-link <?php if($_GET["module"]=="ints"){echo 'active';} ?>">
        <i class="nav-icon fas fa-building"></i>
        <p>Instansi</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="?module=user" class="nav-link <?php if($_GET["module"]=="user"){echo 'active';} ?>">
        <i class="nav-icon fas fa-users"></i>
        <p>Manajemen User</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="?module=password" class="nav-link <?php if($_GET["module"]=="password"){echo 'active';} ?>">
        <i class="nav-icon fas fa-lock"></i>
        <p>Ubah Password</p>
      </a>
    </li>
    


<?php  
} elseif($_SESSION['hak_akses']=="Sekcam") { ?>
     <li class="nav-item">
      <a href="?module=beranda" class="nav-link <?php if($_GET["module"]=="beranda"){echo 'active';} ?>">
        <i class="nav-icon fas fa-home"></i>
        <p>Dashboard</p>
      </a>
    </li>
   <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link <?php if($_GET["module"]=="surat_masuk"){ echo 'active';} ?> <?php if($_GET["module"]=="surat_keluar"){echo 'active';} ?>">
              <i class="nav-icon fas fa-inbox"></i>
              <p>
                Data Arsip Surat
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="?module=surat_masuk" class="nav-link <?php if($_GET["module"]=="surat_masuk"){echo 'active';} ?>">
                  <i class="fas fa-envelope"></i>
                  <p>Surat Masuk</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?module=surat_keluar" class="nav-link <?php if($_GET["module"]=="surat_keluar"){echo 'active';} ?>">
                  <i class="fas fa-paper-plane"></i>
                  <p>Surat Keluar</p>
                </a>
            </ul>
            </li>
            <li class="nav-item has-treeview menu-open">
                    <a href="#" class="nav-link <?php if($_GET["module"]=="asm"){ echo 'active';} ?> <?php if($_GET["module"]=="ask"){echo 'active';} ?>">
                      <i class="nav-icon fas fa-calendar-check"></i>
                      <p>
                        Laporan
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="?module=asm" class="nav-link <?php if($_GET["module"]=="asm"){echo 'active';} ?>">
                          <i class="fas fa-envelope"></i>
                          <p>Agenda Surat Masuk</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="?module=ask" class="nav-link <?php if($_GET["module"]=="ask"){echo 'active';} ?>">
                          <i class="fas fa-paper-plane"></i>
                          <p>Agenda Surat Keluar</p>
                        </a>
                    </ul>
            </li>
            <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link <?php if($_GET["module"]=="gsm"){ echo 'active';} ?> <?php if($_GET["module"]=="gsk"){echo 'active';} ?>">
              <i class="nav-icon far fa-image"></i>
              <p>
                Galeri Surat
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="?module=gsm" class="nav-link <?php if($_GET["module"]=="gsm"){echo 'active';} ?>">
                  <i class="fas fa-envelope"></i>
                  <p>Galeri Surat Masuk</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?module=gsk" class="nav-link <?php if($_GET["module"]=="gsk"){echo 'active';} ?>">
                  <i class="fas fa-paper-plane"></i>
                  <p>Galeri Surat Keluar</p>
                </a>
            </ul>
    </li>
    <li class="nav-header"><i class="nav-icon fas fa-cog"></i> PENGATURAN</li>
    <li class="nav-item">
      <a href="?module=ref" class="nav-link <?php if($_GET["module"]=="ref"){echo 'active';} ?>">
        <i class="nav-icon fas fa-bookmark"></i>
        <p>Kode Klasifikasi Surat</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="?module=password" class="nav-link <?php if($_GET["module"]=="password"){echo 'active';} ?>">
        <i class="nav-icon fas fa-lock"></i>
        <p>Ubah Password</p>
      </a>
    </li>

<?php } 
if ($_SESSION['hak_akses']=="Camat"){ ?>
  <li class="nav-item">
      <a href="?module=beranda" class="nav-link <?php if($_GET["module"]=="beranda"){echo 'active';} ?>">
        <i class="nav-icon fas fa-home"></i>
        <p>Dashboard</p>
      </a>
    </li>
    <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link <?php if($_GET["module"]=="gsm"){ echo 'active';} ?> <?php if($_GET["module"]=="gsk"){echo 'active';} ?>">
              <i class="nav-icon far fa-image"></i>
              <p>
                Galeri Surat
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="?module=gsm" class="nav-link <?php if($_GET["module"]=="gsm"){echo 'active';} ?>">
                  <i class="fas fa-envelope"></i>
                  <p>Galeri Surat Masuk</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?module=gsk" class="nav-link <?php if($_GET["module"]=="gsk"){echo 'active';} ?>">
                  <i class="fas fa-paper-plane"></i>
                  <p>Galeri Surat Keluar</p>
                </a>
            </ul>
    </li>
    <li class="nav-item has-treeview menu-open">
                    <a href="#" class="nav-link <?php if($_GET["module"]=="asm"){ echo 'active';} ?> <?php if($_GET["module"]=="ask"){echo 'active';} ?>">
                      <i class="nav-icon fas fa-calendar-check"></i>
                      <p>
                        Laporan
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="?module=asm" class="nav-link <?php if($_GET["module"]=="asm"){echo 'active';} ?>">
                          <i class="fas fa-envelope"></i>
                          <p>Agenda Surat Masuk</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="?module=ask" class="nav-link <?php if($_GET["module"]=="ask"){echo 'active';} ?>">
                          <i class="fas fa-paper-plane"></i>
                          <p>Agenda Surat Keluar</p>
                        </a>
                    </ul>
            </li>
    <li class="nav-header"><i class="nav-icon fas fa-cog"></i> PENGATURAN</li>
    <li class="nav-item">
      <a href="?module=ref" class="nav-link <?php if($_GET["module"]=="ref"){echo 'active';} ?>">
        <i class="nav-icon fas fa-bookmark"></i>
        <p>Kode Klasifikasi Surat</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="?module=ints" class="nav-link <?php if($_GET["module"]=="ints"){echo 'active';} ?>">
        <i class="nav-icon fas fa-building"></i>
        <p>Instansi</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="?module=user" class="nav-link <?php if($_GET["module"]=="user"){echo 'active';} ?>">
        <i class="nav-icon fas fa-users"></i>
        <p>Manajemen User</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="?module=password" class="nav-link <?php if($_GET["module"]=="password"){echo 'active';} ?>">
        <i class="nav-icon fas fa-lock"></i>
        <p>Ubah Password</p>
      </a>
    </li>



<?php }?>