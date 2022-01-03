<!-- Brand Logo -->
<a href="?module=beranda" class="brand-link">
      <img src="assets/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Digital Filing System</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        <?php  
            if ($data['foto']=="") { ?>
              <img src="images/user/user-default.png" class="img-circle" alt="User Image"/>
            <?php
            }
            else { ?>
              <img src="images/user/<?php echo $data['foto']; ?>" class="img-circle" alt="User Image"/>
            <?php
            }
            ?>
        </div>
        <div class="info">
          <a href="?module=profil" class="d-block"><?php echo $data['nama_user']; ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <?php include "sidebar-menu.php" ?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>