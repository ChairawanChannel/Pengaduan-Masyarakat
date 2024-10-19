<?php
// Memulai sesi
session_start();

// Menghubungkan ke database
include 'koneksi.php';

// Mengecek apakah form telah disubmit
if (isset($_POST['id_pengaduan']) && isset($_POST['tanggapan'])) {
    // Ambil data dari form
    $id_pengaduan = $_POST['id_pengaduan'];
    $tanggapan = $_POST['tanggapan'];
    $id_petugas = $_SESSION['id_petugas']; // Asumsikan id_petugas dari sesi

    // Tentukan tanggal tanggapan (tanggal saat ini)
    $tgl_tanggapan = date('Y-m-d');

    // Insert tanggapan ke tabel tanggapan
    $insert_tanggapan = mysqli_query($koneksi, "INSERT INTO tanggapan (id_pengaduan, tgl_tanggapan, tanggapan, id_petugas) 
        VALUES ('$id_pengaduan', '$tgl_tanggapan', '$tanggapan', '$id_petugas')");

    // Jika berhasil menambah tanggapan, update status pengaduan
    if ($insert_tanggapan) {
        // Update status pengaduan menjadi 'proses'
        $update_pengaduan = mysqli_query($koneksi, "UPDATE pengaduan SET status='proses' WHERE id_pengaduan='$id_pengaduan'");

        // Jika update berhasil, redirect dengan pesan sukses
        if ($update_pengaduan) {
            $_SESSION['message'] = 'Tanggapan berhasil disimpan dan pengaduan diverifikasi.';
            header("Location: admin.php");
            exit();
        } else {
            $_SESSION['error'] = 'Gagal memperbarui status pengaduan.';
            header("Location: admin.php");
            exit();
        }
    } else {
        // Jika gagal menyimpan tanggapan
        $_SESSION['error'] = 'Gagal menyimpan tanggapan.';
        header("Location: admin.php");
        exit();
    }
} else {
    // Jika form tidak disubmit dengan benar
    $_SESSION['error'] = 'Data tidak valid.';
    header("Location: admin.php");
    exit();
}
