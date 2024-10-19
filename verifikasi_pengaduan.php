<!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>
            <div class="card-body style="font-size: 12px>
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>ID Pengaduan</th>
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
                      <th>ID Pengaduan</th>
                      <th>Tgl Pengaduan</th>
                      <th>NIK</th>
                      <th>Isi Laporan</th>
                      <th>foto</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php
                    include 'koneksi.php';
                    $sql = "SELECT * FROM pengaduan WHERE status ='0' ORDER BY id_pengaduan DESC";
                    $query = mysqli_query($koneksi, $sql);
                    $no = 1;
                    while ($data=mysqli_fetch_array($query)){ ?>
                    <tr>
                    <td><?= $data['Pengaduan']; ?></td>
                    <td><?= $data['Tgl_pengaduan']; ?></td>
                    <td><?= $data['nik']; ?></td>
                    <td><?=$data['isi_laporan']; ?></td>
                    <td><?= $data['foto']; ?></td>
                    <td><?=$data['status']; ?></td>
                    <td>

                    <!-- tombol -->
                    <a href="?url=detail-pengaduan&id=<?= $data['Id_pengaduan'] ?>" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white 5">
                    <i class="fa fa-info"></i>
                    </span>
                    <span class="text">Verifikasi</span>
                    </a>
                    </tr>
                 <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>