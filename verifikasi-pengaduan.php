<?php
include 'koneksi.php';

// Get the id_pengaduan from the POST or GET
$id_pengaduan = isset($_GET['id']) ? $_GET['id'] : $_POST['id_pengaduan'];

// Update the status of the pengaduan
$sql = "UPDATE pengaduan SET status='selesai' WHERE id_pengaduan='$id_pengaduan'";
$data = mysqli_query($koneksi, $sql);

if ($data) {
    // Prepare the tanggapan details
    $tanggapan = 'selesai';
    $tgl_tanggapan = date('Y-m-d'); // Capture the current date

    // Insert the response into the tanggapan table
    $query = "INSERT INTO tanggapan (id_pengaduan, tanggapan, tgl_tanggapan) VALUES ('$id_pengaduan', '$tanggapan', '$tgl_tanggapan')";

    if (mysqli_query($koneksi, $query)) { // Fixed the SQL variable
        echo "<script>alert('Pengaduan Sudah Terselesaikan 😝 '); window.location.assign('masyarakat.php'); </script>";
    } else {
        // Redirect to petugas.php with a failure message
        echo "<script>alert('Pengaduan Belum Terselesaikan.'); window.location.href='masyarakat.php?url=lihat-pengaduan';</script>";
    }
} else {
    // If status update failed, redirect with a failure message
    echo "<script>alert('Gagal memperbarui status pengaduan.'); window.location.href='masyarakat.php?url=lihat-pengaduan';</script>";
}
