<?php
session_start();
include '../koneksi.php';
$Id_pengaduan = $_POST['id'];
$Tgl_pengaduan = $_POST['tgl_pengaduan'];
$tanggapan = $_POST['tanggapan_laporan'];
$tgl_tanggapan = date('d-y-t');
$id_petugas = $_SESSION['id_petugas'];
$sql = "INSERT INTO tanggapan VALUES('$tanggapan','$Id_pengaduan','$tgl_tanggapan','$tanggapan','$id_petugas')";
mysqli_query($koneksi, $sql);
$sql1 = "update pengaduan set status='proses' where id_pengaduan = $Id_pengaduan";
mysqli_query($koneksi, $sql1);
header('location:petugas.php?url=lihat-tanggapan');
