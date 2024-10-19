<?php
include 'koneksi.php'; // Include your database connection

// Check if the 'id' parameter is set in the URL
if (isset($_GET['id'])) {
  $id = $_GET['id'];

  // Prepare the SQL statement to update the status
  $sql = "UPDATE pengaduan SET status = 'ditolak' WHERE Id_pengaduan = '$id'";

  // Execute the query
  if (mysqli_query($koneksi, $sql)) {
    // If the update was successful, redirect back to the previous page with a success message
    header("Location: admin.php?message=Pengaduan ditolak dengan sukses");
    exit;
  } else {
    // If there was an error, redirect back with an error message
    header("Location: admin.php?message=Gagal menolak pengaduan");
    exit;
  }
} else {
  // Redirect back if the 'id' parameter is not set
  header("Location: admin.php?message=ID pengaduan tidak ditemukan");
  exit;
}
