<!-- Left navbar links -->
<ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="?module=beranda" class="nav-link">Home</a>
      </li>
    </ul>


    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <?php  
      /* panggil file database.php untuk koneksi ke database */
      require_once "config/database.php";

      // fungsi query untuk menampilkan data dari tabel user
      $query = mysqli_query($config, "SELECT id_user, nama_user, foto, hak_akses FROM tbl_users WHERE id_user='$_SESSION[id_user]'")
                                      or die('Ada kesalahan pada query tampil Manajemen User: '.mysqli_error($config));

      // tampilkan data
      $data = mysqli_fetch_assoc($query);
      ?>

      <li class="nav-item dropdown user user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
        <!-- User image -->

        <?php  
        if ($data['foto']=="") { ?>
          <img src="images/user/user-default.png" class="user-image" alt="User Image"/>
        <?php
        }
        else { ?>
          <img src="images/user/<?php echo $data['foto']; ?>" class="user-image" alt="User Image"/>
        <?php
        }
        ?>

          <span class="hidden-xs"><?php echo $data['nama_user']; ?> <i style="margin-left:5px" class=""></i></span>
        </a>
        <ul class="dropdown-menu rounded-lg shadow-lg">
          <!-- User image -->
          <li class="user-header">

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

            <p>
              <?php echo $data['nama_user']; ?>
              <small><?php echo $data['hak_akses']; ?></small>
            </p>
          </li>
          
          <!-- Menu Footer-->
          <li class="user-footer">
            <div class="row">
              <div class="col">
               <a style="width:80px" href="?module=profil" class="btn btn-default btn-flat">Profil</a>
              </div>
              <div class="col">
                <a style="width:80px" data-toggle="modal" href="#logout" class="btn btn-default btn-flat">Logout</a>
              </div>
            </div>
          </li>
        </ul>
      </li>

    </ul>