<!-- DataTales Example-->
<div class="card shadow mb-4">
<div class="card-header py-3">
<h6 class="m-0 font-weight-bold text-primary">DataTables
pengaduan</h6>
</div>
<div class="card-body" style="font-size: 14px">
<div class="table-responsive">
<table class="table table-bordered" id="dataTable" width="100%"
cellspacing="0">
<thead>
<tr>
<th>ID Pengaduan</th>
<th>Tanggal Pengaduan</th>
<th>NIK</th>
<th>Isi Laporan</th>
<th>Foto</th>
<th>Status</th>
<th>Action</th>
</tr>
</thead>

<tfoot>
    <tr>
    <th>ID Pengaduan</th>
    <th>Tanggal Pengaduan</th>
    <th>NIK</th>
    <th>Isi Laporan</th>
    <th>Foto</th>
    <th>Status</th>
    <th>Action</th>
    </tr>
</tfoot>
<tbody>
    <?php
    include '../koneksi.php';
    $sql = "SELECT * FROM  pengaduan where status = '0' ORDER BY id_pengaduan DESC";
    $query = mysqli_query($koneksi, $sql);
    $no = 1;

    while ($data = mysqli_fetch_array($query)) { ?>
    <tr>

    <td><?= $data ['id_pengaduan'];?></td>
    <td><?= $data ['tgl_pengaduan'];?></td>
    <td><?= $data ['nik'];?></td>

    <td><?= $data ['isi_laporan'];?></td>
    <td><?= $data ['foto'];?></td>
    <td><?= $data ['status'];?></td>
    <td>
        <a href="?url=daftar-verifikasi&id=<?=
        $data['id_pengaduan'] ?>"class="btn btn-primary btn-icon-split">
        <span class="icon text-white-50">
            <i class="fa fa-info"></i>
        </span>
        <span class="text">Verifikasi</span>
    </a> 
    </td>
    </tr>
    <?php } ?>
</tbody>
</table>
</div>
</div>
</div>