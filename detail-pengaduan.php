<?php
// Mengambil ID pengaduan dari URL
$id = $_GET['id'];
if (empty($id)) {
    header("Location: masyarakat.php");
    exit();
}
include 'koneksi.php';

// Retrieve complaint and response based on Id_pengaduan
$query = mysqli_query($koneksi, "SELECT p.*, t.tanggapan FROM pengaduan p LEFT JOIN tanggapan t ON p.Id_pengaduan = t.Id_pengaduan WHERE p.Id_pengaduan='$id'");
$data = mysqli_fetch_array($query);

if (!$data) {
    // Handle case where no data is found
    header("Location:masyarakat.php");
    exit;
}
?>

<div class="card shadow">
    <div class="card-header">
        <a href="masyarakat.php" class="btn btn-primary btn-icon-split">
            <span class="icon text-white">
                <i class="fa fa-arrow-left"></i>
            </span>
            <span class="text">Kembali</span>
        </a>
    </div>
    <div class="card-body">
        <form method="POST" action="proses-tanggapan.php">

            <input type="hidden" name="id_pengaduan" value="<?= $id; ?>">
            <div class="form-group">
                <label style="font-size: 14px;">Tgl Pengaduan</label>
                <input type="text" name="tgl_pengaduan" class="form-control" readonly
                    value="<?= $data['Tgl_pengaduan']; ?>">
            </div>
            <div class="form-group">
                <label style="font-size: 14px;">Isi Laporan</label>
                <textarea name="isi_laporan" class="form-control" readonly><?= $data['isi_laporan'] ?></textarea>
            </div>
            <div class="form-group">
                <label style="font-size: 14px;">Foto</label>
                <img class="img-thumbnail" src="foto/<?= $data['foto'] ?>" width="300">
            </div>
            <div class="form-group">
                <label style="font-size: 14px;">Tanggapan</label>
                <textarea name="tanggapan_laporan" class="form-control" readonly><?= $data['tanggapan']; ?></textarea>
            </div>
            <?php if ($data['status'] != 'ditolak' && $data['status'] != 'selesai') { ?>
                <button type="submit" class="btn btn-success">Verifikasi pengaduan</button>
            <?php } else { ?>
                <div class="alert alert-info" role="alert">
                    <?php if ($data['status'] == 'proses') { ?>
                        Pengaduan sudah diverifikasi.
                    <?php } elseif ($data['status'] == 'ditolak') { ?>
                        Pengaduan telah ditolak.
                    <?php } elseif ($data['status'] == 'selesai') { ?>
                        Pengaduan telah selesai.
                    <?php } ?>
                </div>
            <?php } ?>
        </form>
    </div>
</div>