<?php
session_start();
include 'koneksi.php'; // Koneksi ke database

// Helper function untuk membuat session token unik
function generateSessionToken()
{
  return bin2hex(random_bytes(32));
}

if (isset($_POST['nik']) && isset($_POST['password'])) {
  $nik = $_POST['nik'];
  $password = $_POST['password'];

  // Query untuk mendapatkan data user berdasarkan NIK
  $query = mysqli_query($koneksi, "SELECT * FROM masyarakat WHERE nik='$nik'");
  $data = mysqli_fetch_assoc($query);

  if ($data) {
    // Verifikasi password
    if (password_verify($password, $data['password'])) {

      // Cek apakah pengguna sudah memiliki session aktif
      $cek_session = mysqli_query($koneksi, "SELECT * FROM sessions WHERE nik='$nik'");

      if (mysqli_num_rows($cek_session) > 0) {
        // Jika session ditemukan, berarti akun sedang login di perangkat lain
        echo "<script>if (confirm('Akun ini sudah login di perangkat lain.')) {
                        window.location.href = 'index.php';
                    } else {
                        window.location.href = 'index.php';
                    }</script>";
        exit();
      }

      // Jika tidak ada session aktif, buat session baru
      $session_token = generateSessionToken();
      $_SESSION['nik'] = $data['nik'];
      $_SESSION['nama'] = $data['nama'];

      // Simpan session ke database
      $insert_session = mysqli_query($koneksi, "INSERT INTO sessions (nik, session_token) VALUES ('$nik', '$session_token')");

      // Jika checkbox "Remember Me" diaktifkan, set cookie dengan token session
      if (isset($_POST['remember'])) {
        setcookie('login_session', $session_token, time() + (86400 * 30), "/"); // 30 hari
      }

      // Redirect ke halaman dashboard atau halaman lain
      header("Location: masyarakat.php");
      exit();
    } else {
      echo "Password salah!";
    }
  } else {
    echo "NIK tidak ditemukan!";
  }
}
