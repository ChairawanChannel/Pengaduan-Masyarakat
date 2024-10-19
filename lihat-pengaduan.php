<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
  </div>
  <div class="card-body style=" font-size: 12px>
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No</th>
            <th>Tgl Pengaduan</th>
            <th>NIK</th>
            <th>Isi Laporan</th>
            <th>foto</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>No</th>
            <th>Tgl Pengaduan</th>
            <th>NIK</th>
            <th>Isi Laporan</th>
            <th>Foto</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </tfoot>
        <tbody>
          <?php
          include 'koneksi.php';
          $sql = "SELECT * FROM pengaduan WHERE nik='$_SESSION[nik]' ORDER BY id_pengaduan DESC";
          $query = mysqli_query($koneksi, $sql);
          $no = 1;
          while ($data = mysqli_fetch_array($query)) { ?>
            <tr>
              <td><?= $data['Id_pengaduan']; ?></td>
              <td><?= $data['Tgl_pengaduan']; ?></td>
              <td><?= $data['nik']; ?></td>
              <td><?= $data['isi_laporan']; ?></td>
              <td><img class="img-thumbnail" src="foto/<?= $data['foto'] ?>" width="150"></td>
              <td><?= $data['status']; ?></td>
              <!-- tombol -->
              <td><a href="?url=detail-pengaduan&id=<?= $data['Id_pengaduan'] ?>" class="btn btn-primary btn-icon-split">
                  <span class="icon text-white 5">
                    <i class="fa fa-info"></i>
                  </span>
                  <span class="text">Detail Pengaduan</span>
                </a></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Footer -->
<footer class="sticky-footer bg-white">
  <div class="container my-auto">
    <div class="copyright text-center my-auto">
      <span>Aplikasi Pelaporan Pengaduan Masyarakat &copy 2024</span>
    </div>
  </div>
</footer>
<!-- End of Footer -->
</body>

</html>