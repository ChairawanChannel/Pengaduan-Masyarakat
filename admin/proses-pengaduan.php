<?php
// Memulai sesi jika diperlukan
session_start();

// Menghubungkan ke database
include 'koneksi.php';

// Mengecek apakah ID pengaduan ada di dalam request POST
if (isset($_POST['id_pengaduan'])) {
    // Ambil ID pengaduan dari POST
    $id_pengaduan = $_POST['id_pengaduan'];

    // Ambil status pengaduan dari tabel berdasarkan id_pengaduan
    $query = mysqli_query($koneksi, "SELECT status FROM pengaduan WHERE id_pengaduan='$id_pengaduan'");
    $data = mysqli_fetch_assoc($query);

    // Cek apakah data pengaduan ditemukan dan statusnya 0 (belum diverifikasi)
    if ($data && $data['status'] == '0') {
        // Ubah status pengaduan menjadi 'proses'
        $update = mysqli_query($koneksi, "UPDATE pengaduan SET status='proses' WHERE id_pengaduan='$id_pengaduan'");

        // Jika update berhasil
        if ($update) {
            // Redirect ke halaman admin dengan pesan sukses
            $_SESSION['message'] = 'Pengaduan berhasil diverifikasi.';
            header("Location: admin.php?url=verifikasi-pengaduan");
            exit();
        } else {
            // Jika update gagal
            $_SESSION['error'] = 'Terjadi kesalahan saat memverifikasi pengaduan.';
            header("Location: admin.php?url=verifikasi-pengaduan");
            exit();
        }
    } else {
        // Jika status pengaduan bukan 0 (misalnya sudah diverifikasi atau ditolak)
        $_SESSION['error'] = 'Pengaduan tidak valid atau sudah diverifikasi.';
        header("Location: admin.php?url=verifikasi-pengaduan");
        exit();
    }
} else {
    // Jika ID pengaduan tidak ada di request POST
    $_SESSION['error'] = 'ID pengaduan tidak ditemukan.';
    header("Location: admin.php?url=verifikasi-pengaduan");
    exit();
}
