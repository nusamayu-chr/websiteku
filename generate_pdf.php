<?php
// Memuat file TCPDF
require_once('tcpdf/tcpdf.php'); // pastikan path ke file tcpdf.php benar

// Koneksi ke database
include('db.php');

// Ambil data riwayat absensi dari database
$sql = "SELECT * FROM absensi";
$result = $conn->query($sql);

// Inisialisasi objek TCPDF
$pdf = new TCPDF();
$pdf->AddPage();

// Set font
$pdf->SetFont('helvetica', '', 12);

// Judul PDF
$pdf->Cell(0, 10, 'Riwayat Absensi Pegawai', 0, 1, 'C');

// Tabel header
$pdf->Ln(10);
$pdf->Cell(30, 10, 'Nama', 1, 0, 'C');
$pdf->Cell(50, 10, 'NIP/NIK', 1, 0, 'C');
$pdf->Cell(50, 10, 'Absen Masuk', 1, 0, 'C');
$pdf->Cell(50, 10, 'Absen Pulang', 1, 1, 'C');

// Isi tabel dengan data dari database
while ($row = $result->fetch_assoc()) {
    $pdf->Cell(30, 10, $row['nama'], 1, 0, 'C');
    $pdf->Cell(50, 10, $row['nip'], 1, 0, 'C');
    $pdf->Cell(50, 10, $row['absen_masuk'], 1, 0, 'C');
    $pdf->Cell(50, 10, $row['absen_pulang'], 1, 1, 'C');
}

// Output PDF ke browser
$pdf->Output('riwayat_absensi.pdf', 'I'); // 'I' untuk menampilkan langsung di browser
?>
