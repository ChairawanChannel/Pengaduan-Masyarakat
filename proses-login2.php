<?php
session_start();
include 'koneksi.php'; // Koneksi ke database

// Helper function untuk membuat session token unik
function generateSessionToken()
{
    return bin2hex(random_bytes(32));
}

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk mendapatkan data petugas berdasarkan username dan password
    $query = mysqli_query($koneksi, "SELECT * FROM petugas WHERE username='$username'");
    $data = mysqli_fetch_assoc($query);

    if ($data) {
        // Verifikasi password (asumsi password di database sudah di-hash)
        if ($password == $data['password']) {

            // Cek apakah pengguna sudah memiliki session aktif
            $cek_session = mysqli_query($koneksi, "SELECT * FROM sessions_admin WHERE id_petugas=" . $data['id_petugas']);

            if (mysqli_num_rows($cek_session) > 0) {
                // Jika session ditemukan, berarti akun sedang login di perangkat lain
                echo "<script>
                    if (confirm('Akun ini sudah login di perangkat lain.')) {
                        window.location.href = 'index2.php';
                    } else {
                        window.location.href = 'index2.php';
                    }
                </script>";
                exit();
            }

            // Jika tidak ada session aktif, buat session baru
            $session_token = generateSessionToken();
            $_SESSION['nama_petugas'] = $data['nama_petugas'];
            $_SESSION['username'] = $data['username'];
            $_SESSION['level'] = $data['level'];
            $_SESSION['id_petugas'] = $data['id_petugas'];

            // Simpan session ke database
            $insert_session = mysqli_query($koneksi, "INSERT INTO sessions_admin (id_petugas, session_token) VALUES ('" . $data['id_petugas'] . "', '$session_token')");

            // Redirect berdasarkan level
            if ($data['level'] == "admin") {
                header("Location: admin/admin.php");
            } elseif ($data['level'] == "petugas") {
                header("Location: petugas/petugas.php");
            }
            exit();
        } else {
            echo "<script>alert('Password salah!'); window.location.assign('index2.php');</script>";
        }
    } else {
        echo "<script>alert('Username tidak ditemukan!'); window.location.assign('index2.php');</script>";
    }
} else {
    echo "<script>alert('Username dan Password harus diisi!'); window.location.assign('index2.php');</script>";
}
