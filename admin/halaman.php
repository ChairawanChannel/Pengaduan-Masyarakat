<?php
if (isset($_GET['url'])) {
	switch ($_GET['url']) {
		case 'verifikasi_pengaduan';
			include 'verifikasi_pengaduan.php';
			break;

		case 'lihat-tanggapan':
			include 'lihat-tanggapan.php';
			break;

		case 'detail-pengaduan':
			include 'detail-pengaduan.php';
			break;

		case 'delete':
			include 'delete.php';
			break;

		case 'generate':
			include 'generate.php';
			break;

		default:
			echo "Halaman Tidak Ditemukan";
			break;
	}
} else {
	echo "Selamat Datang Di Sesi Admin Pada Aplikasi Pengaduan Masyarakat Dimana Aplikasi Ini Dibuat Untuk Melaporkan Tindakan Yang Menyimpang Dari Ketentuan.<br>";
	echo "Anda Login Sebagai:" . $_SESSION['nama_petugas'];
}
