<?php
session_start();
include 'koneksi.php'; // Koneksi ke database

// Cek apakah session id_petugas ada
if (isset($_SESSION['id_petugas'])) {
    $id_petugas = $_SESSION['id_petugas'];

    // Hapus session dari database
    mysqli_query($koneksi, "DELETE FROM sessions_admin WHERE id_petugas='$id_petugas'");

    // Hapus session dari PHP
    session_destroy();

    // Hapus cookie (opsional jika digunakan)
    setcookie('login_session', '', time() - 3600, "/");

    // Redirect ke halaman login
    header("Location: ../index2.php");
    exit();
} else {
    header("Location: ../index2.php");
}
