<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">DataTables Pengaduan</h6>
  </div>
  <div class="card-body" style="font-size: 14px">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No</th>
            <th>Tgl Pengaduan</th>
            <th>NIK</th>
            <th>Isi Laporan</th>
            <th>Tanggapan</th>
            <th>Foto</th>
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
            <th>Tanggapan</th>
            <th>Foto</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </tfoot>
        <tbody>
          <?php
          include '../koneksi.php';

          // Prepared statements to prevent SQL injection
          if (isset($_GET['id'])) {
            $id = mysqli_real_escape_string($koneksi, $_GET['id']);
            $stmt = $koneksi->prepare("SELECT pengaduan.Tgl_pengaduan, pengaduan.nik, pengaduan.isi_laporan, pengaduan.foto, pengaduan.status, tanggapan.tanggapan, pengaduan.Id_pengaduan 
                                       FROM pengaduan 
                                       LEFT JOIN tanggapan ON pengaduan.Id_pengaduan = tanggapan.Id_pengaduan 
                                       WHERE pengaduan.Id_pengaduan = ?");
            $stmt->bind_param("s", $id);
          } else {
            // General query for all complaints
            $stmt = $koneksi->prepare("SELECT pengaduan.Tgl_pengaduan, pengaduan.nik, pengaduan.isi_laporan, pengaduan.foto, pengaduan.status, tanggapan.tanggapan, pengaduan.Id_pengaduan 
                                       FROM pengaduan 
                                       LEFT JOIN tanggapan ON pengaduan.Id_pengaduan = tanggapan.Id_pengaduan");
          }

          // Execute query and check for errors
          if ($stmt->execute()) {
            $result = $stmt->get_result();
            $no = 1;
            while ($data = $result->fetch_assoc()) { ?>
              <tr>
                <td><?= $no++; ?></td>
                <td><?= htmlspecialchars($data['Tgl_pengaduan']); ?></td>
                <td><?= htmlspecialchars($data['nik']); ?></td>
                <td><?= htmlspecialchars($data['isi_laporan']); ?></td>
                <td><?= htmlspecialchars($data['tanggapan']) ? htmlspecialchars($data['tanggapan']) : 'Belum ada tanggapan'; ?></td> <!-- Handle null tanggapan -->
                <td><img src="<?= htmlspecialchars($data['foto']); ?>" alt="Foto" width="100px"></td>
                <td><?= htmlspecialchars($data['status']); ?></td>
                <td>
                  <a href="?url=detail-pengaduan&id=<?= $data['Id_pengaduan'] ?>" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fa fa-info"></i>
                    </span>
                    <span class="text">Detail Pengaduan</span>
                  </a>
                </td>
              </tr>
          <?php }
          } else {
            echo "Error: " . $stmt->error;
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>