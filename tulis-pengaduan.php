<div class="card shadow">
  <div class="card-header">
    <a href="masyarakat.php" class="btn btn-primary btn-icon-split'">
      <span class="icon text-white 5">
        <i class="fa fa-arrow-left"></i>

        <span class="text">Kembali</span>
    </a>
  </div>
  <div class="card-body">
    <form method="post" action="proses-pengaduan.php" enctype="multipart/form-data">
      <div class="form-group">
        <label style="font-size: 14px;">Tgl Pengaduan</label>
        <input type="text" name="tgl_pengaduan" class="form-control" readonly value="<?= date('Y-m-d'); ?>">
      </div>
      <div class="form-group">
        <label style="font-size: 14px;">lsi Laporan</label>
        <textarea name="isi_laporan" class="form-control" required></textarea>
      </div>
      <div class="form-group">
        <label style="font-size: 14px;">Foto</label>
        <input type="file" required class="form-control" name="foto" accept="image/*">
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-success"> SIMPAN</button>
      </div>
    </form>
  </div>
</div>
<footer class="sticky-footer bg-white">
  <div class="container my-auto">
    <div class="copyright text-center my-auto">
      <span>Aplikasi Pelaporan Pengaduan Masyarakat &copy 2024</span>
    </div>
  </div>
</footer>