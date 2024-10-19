<?php
session_start();
include 'koneksi.php'; // Koneksi ke database

// Cek apakah session nik ada
if (isset($_SESSION['nik'])) {
    $nik = $_SESSION['nik'];

    // Hapus session dari database
    mysqli_query($koneksi, "DELETE FROM sessions WHERE nik='$nik'");

    // Hapus session dari PHP
    session_destroy();

    // Hapus cookie
    setcookie('login_session', '', time() - 3600, "/");

    // Redirect ke halaman index
    header("Location: index.php");
    exit();
} else {
    header("Location: index.php");
}
