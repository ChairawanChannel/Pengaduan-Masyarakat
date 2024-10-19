<?php
if(isset($_GET['url'])){
	switch ($_GET['url']) {
		case 'verifikasi_pengaduan.php';
		include 'verifikasi_pengaduan.php';
		break;

		case 'tulis-pengaduan':
			include 'tulis-pengaduan.php';
			break;
			
		case 'lihat-pengaduan':
		include 'lihat-pengaduan.php';
		break;

		case'detail-pengaduan':
			include'detail-pengaduan.php';
		break;

		case'lihat-tanggapan':
			include'lihat-tanggapan.php';
		break;

		default:
		echo "Halaman Tidak Ditemukan";
		break;
	}
}else{
	echo "Selamat Datang Di Aplikasi Pengaduan Masyarakat Dimana Aplikasi Ini Dibuat Untuk Melaporkan Tindakan Yang Menyimpang Dari Ketentuan.<br>";
	echo "Anda Login Sebagai:".$_SESSION['nama'];
}