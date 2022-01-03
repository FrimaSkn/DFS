
<?php
/* panggil file database.php untuk koneksi ke database */
require_once "config/database.php";
/* panggil file fungsi tambahan */
require_once 'include/functions.php';

// fungsi untuk pengecekan status login user 
// jika user belum login, alihkan ke halaman login dan tampilkan message = 1
if (empty($_SESSION['hak_akses'])){
	echo "<meta http-equiv='refresh' content='0; url=index.php?alert=3'>";
	die();
}
// jika user sudah login, maka jalankan perintah untuk pemanggilan file halaman konten
else {
	// jika halaman konten yang dipilih beranda, panggil file view beranda
	if ($_GET['module'] == 'beranda') {
		include "modules/beranda/view.php";
	}
// -----------------------------------------------------------------------------
	// jika halaman konten yang Surat keluar
	elseif ($_GET['module'] == 'surat_keluar') {
		include "modules/surat-keluar/view.php";
	}
	// jika halaman konten yang Surat masuk
	elseif ($_GET['module'] == 'surat_masuk') {
		include "modules/surat-masuk/view.php";
	}
	// jika halaman konten agenda
	elseif ($_GET['module'] == 'asm') {
		include "modules/agenda-surat/agenda_sm.php";
	}
	// jika halaman konten agenda
	elseif ($_GET['module'] == 'ask') {
		include "modules/agenda-surat/agenda_sk.php";
	}
	// jika halaman konten galeri
	elseif ($_GET['module'] == 'gsm') {
		include "modules/galeri-surat/galeri_sm.php";
	}
	elseif ($_GET['module'] == 'gsk') {
		include "modules/galeri-surat/galeri_sk.php";
	}
// -----------------------------------------------------------------------------
	
	// jika halaman konten yang dipilih user, panggil file view user
	elseif ($_GET['module'] == 'user') {
		include "modules/user/view.php";
	}

	// jika halaman konten yang dipilih form user, panggil file form user
	elseif ($_GET['module'] == 'form_user') {
		include "modules/user/form.php";
	}
	// -----------------------------------------------------------------------------

	// jika halaman konten yang dipilih profil, panggil file view profil
	elseif ($_GET['module'] == 'profil') {
		include "modules/profil/view.php";
	}

	// jika halaman konten yang dipilih form profil, panggil file form profil
	elseif ($_GET['module'] == 'form_profil') {
		include "modules/profil/form.php";
	}
	// -----------------------------------------------------------------------------
	//pegaturan
	// jika halaman konten yang dipilih password, panggil file view password
	elseif ($_GET['module'] == 'password') {
		include "modules/password/view.php";
	}
	//intansi
	elseif ($_GET['module'] == 'ints') {
		include "modules/pengaturan/intansi.php";
	}
	//kode surat
	elseif ($_GET['module'] == 'ref') {
		include "modules/pengaturan/kode-surat/kode_surat.php";
	}
}
?>