<?php
require('fpdf.php');
include 'koneksi.php';

$tgl_awal = isset($_GET['tgl_awal']) ? $_GET['tgl_awal'] : null;
$tgl_akhir = isset($_GET['tgl_akhir']) ? $_GET['tgl_akhir'] : null;
$status = isset($_GET['status']) ? $_GET['status'] : null;

$pdf = new FPDF('L', 'mm', 'A4');
$pdf->AddPage();

$pdf->SetFont('Times', 'B', 13);
$pdf->Cell(250, 10, 'DATA PENGADUAN MASYARAKAT', 0, 0, 'C');
$pdf->Ln(15);

$pdf->SetFont('Times', 'B', 9);
$pdf->Cell(10, 7, 'NO', 1, 0, 'C');
$pdf->Cell(20, 7, 'Id_pengaduan', 1, 0, 'C');
$pdf->Cell(35, 7, 'Tgl_pengaduan', 1, 0, 'C');
$pdf->Cell(25, 7, 'NIK', 1, 0, 'C');
$pdf->Cell(50, 7, 'Isi Laporan', 1, 0, 'C');
$pdf->Cell(60, 7, 'Foto', 1, 0, 'C');
$pdf->Cell(35, 7, 'Tanggapan', 1, 0, 'C');
$pdf->Cell(35, 7, 'Status', 1, 1, 'C');

// Construct the SQL query based on the status
if ($status === '1' || $status === null) {
    // Status is '1' (Semua) or not set; show all statuses
    $sql = "SELECT * FROM pengaduan WHERE tgl_pengaduan BETWEEN '$tgl_awal' AND '$tgl_akhir'";
} else {
    // Status is specific; filter by status and date range
    $sql = "SELECT * FROM pengaduan WHERE status='$status' AND tgl_pengaduan BETWEEN '$tgl_awal' AND '$tgl_akhir'";
}

$query = mysqli_query($koneksi, $sql);
$no = 1;

while ($data = mysqli_fetch_array($query)) {
    $pdf->Cell(10, 6, $no++, 1, 0, 'C');
    $pdf->Cell(20, 6, $data['Id_pengaduan'], 1, 0, 'C');
    $pdf->Cell(35, 6, $data['Tgl_pengaduan'], 1, 0, 'C');
    $pdf->Cell(25, 6, $data['nik'], 1, 0, 'C');
    $pdf->Cell(50, 6, $data['isi_laporan'], 1, 0, 'C');
    $pdf->Cell(60, 6, $data['foto'], 1, 0, 'C');

    // Fetch tanggapan data
    $sql1 = "SELECT * FROM tanggapan WHERE id_pengaduan = '" . $data['Id_pengaduan'] . "'";
    $query1 = mysqli_query($koneksi, $sql1);
    if ($data1 = mysqli_fetch_array($query1)) {
        $pdf->Cell(35, 6, $data1['tanggapan'], 1, 0);
    } else {
        $pdf->Cell(35, 6, "-", 1, 0);
    }
    $pdf->Cell(35, 6, $data['status'], 1, 1);
}

$pdf->Output();
