<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    if ($id > 0) {
        $sql = "DELETE FROM pengaduan WHERE id_pengaduan = ?";
        $stmt = mysqli_prepare($koneksi, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "i", $id);

            if (mysqli_stmt_execute($stmt)) {
                // Redirect kembali ke halaman utama setelah menghapus
                header("Location: petugas.php");
                exit();
            }

            mysqli_stmt_close($stmt);
        }
    }
}

mysqli_close($koneksi);
?>