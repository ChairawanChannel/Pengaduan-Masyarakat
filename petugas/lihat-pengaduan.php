<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTables pengaduan</h6>
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
                    </tr>
                </tfoot>
                <tbody>
                <?php
                include '../koneksi.php';

                if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $sql = "SELECT * FROM pengaduan, tanggapan WHERE tanggapan.id_pengaduan='$id' AND tanggapan.id_pengaduan=pengaduan.id_pengaduan";
                } else {
                $sql = "SELECT * FROM pengaduan, tanggapan WHERE tanggapan.id_pengaduan=pengaduan.id_pengaduan";
                }

                $query = mysqli_query($koneksi, $sql);
                $no = 1;
                while ($data = mysqli_fetch_array($query)) { ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $data['Tgl_pengaduan']; ?></td>
                            <td><?= $data['nik']; ?></td> <!-- Added this line -->
                            <td><?= $data['isi_laporan']; ?></td>
                            <td><?= $data['tanggapan']; ?></td>
                            <td><?= $data['foto']; ?></td>
                            <td><?= $data['status']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
