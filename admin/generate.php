<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h5 class="m-0 font-weight-bold text-primary">Data Pengaduan</h5>
  </div>
  <div class="card-body" style="font-size: 12px">
    <div class="col-lg-6">
      <div class="p-2">
        <form class="user" method="GET" action="print.php">
          <div class="form-group">
            <input id="datepicker" width="276" placeholder="Tanggal Awal" name="tgl_awal" />
            <script>
              $('#datepicker').datepicker({
                format: 'yyyy-mm-dd',
                uiLibrary: 'bootstrap5'
              });
            </script>
          </div>

          <div class="form-group">
            <input id="datepicker1" width="276" placeholder="Tanggal Akhir" name="tgl_akhir" />
            <script>
              $('#datepicker1').datepicker({
                format: 'yyyy-mm-dd',
                uiLibrary: 'bootstrap5'
              });
            </script>
          </div>

          <div class="form-group">
            <label for="cars">Status Laporan</label>
            <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="status">
              <option value="1">Semua</option>
              <option value="proses">Proses</option>
              <option value="0">Belum Diproses</option>
              <option value="ditolak">Ditolak</option> <!-- Added rejected status -->
            </select>
          </div>
          <button type="submit" class="btn btn-primary btn-user btn-block">Generate Laporan</button>
        </form>
      </div>
    </div>
  </div>
</div>