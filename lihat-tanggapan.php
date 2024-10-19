<?php
$id = $_GET['id'];
if (empty($id)) {
  header("Location:masyarakat.php");
}

?>

<div class="card shadow">
  <div class="card-header">
    <a href="admin.php" class="btn btn-primary btn-icon-split'">
      <span class="icon text-white 5">
        <i class="fa fa-arrow-left"></i>

        <span class="text">Kembali</span>
    </a>
  </div>
  <div class="card-body">
    <?php
    include 'koneksi.php';
    $query = mysqli_query($koneksi, "SELECT * FROM pengaduan,tanggapan WHERE tanggapan.id_pengaduan='$id'AND tanggapan.id_pengaduan=pengaduan.id_pengaduan");
    if (mysqli_num_rows($query) == 0) {
      echo "<div class='alert-danger'>Maaf Pengaduan Anda Belum Ditanggapi.</div>";
    } else {

      $data = mysqli_fetch_array($query); ?>

      <form method="post" action="proses-pengaduan.php" enctype="multipart/form-data">
        <div class="form-group">
          <label style="font-size: 14px;">Tgl Pengaduan</label>
          <input type="text" name="tgl_pengaduan" class="form-control" readonly value="<?= $data['Tgl_pengaduan']; ?>">
        </div>

        <div class="form-group">
          <label style="font-size: 14px;">lsi Laporan</label>
          <textarea name="isi_laporan" class="form-control" readonly><?= $data['isi_laporan'] ?></textarea>
        </div>

        <div class="form-group">
          <label style="font-size: 14px;"></label>
          <img class="img-thumbnail" src="foto/<?= $data['foto'] ?>" width="300">
        </div>

        <div class="form-group">
          <label style="font-size: 14px;">Tanggapan</label>
          <textarea name="isi_laporan" class="form-control" readonly><?= $data['tanggapan'] ?></textarea>
        </div>
  </div>
  </form>
<?php } ?>
</div>
</div>