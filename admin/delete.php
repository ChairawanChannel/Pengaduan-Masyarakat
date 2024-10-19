<?php
include '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_pengaduan = $_POST['Id_pengaduan'];

    // Check if the ID is provided
    if (empty($id_pengaduan)) {
        header("Location: admin.php");
        exit;
    }

    // Prepare and execute the deletion for tanggapan
    $deleteTanggapanQuery = "DELETE FROM tanggapan WHERE Id_pengaduan='$id_pengaduan'";
    mysqli_query($koneksi, $deleteTanggapanQuery);

    // Prepare and execute the deletion for pengaduan
    $deletePengaduanQuery = "DELETE FROM pengaduan WHERE Id_pengaduan='$id_pengaduan'";
    if (mysqli_query($koneksi, $deletePengaduanQuery)) {
        // Redirect to the admin page with a success message
        header("Location: admin.php?message=Pengaduan berhasil dihapus");
    } else {
        // Handle error
        header("Location: admin.php?error=Gagal menghapus pengaduan");
    }
    exit;
} else {
    // Redirect if accessed directly without a POST request
    header("Location: admin.php");
    exit;
}
