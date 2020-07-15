<?php
@$periode = $_GET['periode'];
// var_dump($periode);
// die;
require('includes/fpdf/fpdf.php');
class PDF extends FPDF
{

	function PDF($orientation = 'P', $unit = 'mm', $size = 'A4')
	{
		$this->FPDF($orientation, $unit, $size);
	}

	function Header()
	{
		$kop = '_upload/kop.jpg';
		$this->SetFont('Times', 'B', 14);
		// $this->Cell(80);
		$this->Cell(0, 30, $this->image($kop, $this->GetX(), $this->GetY()), 0, 0, 'C', false);

		$this->Ln(20);
	}

	function Footer()
	{
		$this->SetY(-15);
		$this->SetFont('Times', '', 8);
		$this->Cell(0, 10, $this->PageNo(), 0, 0, 'R');
	}
}
$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Times', 'B', 14);
$pdf->ln();
$pdf->Cell(80);
$pdf->Cell(30, 10, 'SURAT HASIL KEPUTUSAN', 0, 0, 'C');
$pdf->ln();
$pdf->SetFont('Times', '', 12);
$date = date("d-m-Y");
$pdf->Cell(16, 10, 'periode :', 0, 0, 'L');
$pdf->Cell(150, 10, $periode, 0, 0, 'L');
$pdf->ln();
$pdf->ln();
$pdf->Cell(60, 7, 'Berdasarkan perhitungan penilaian supplier, maka supplier dengan data', 0, 0, 'L');
$pdf->ln();
$pdf->Cell(60, 7, 'sebagai berikut :', 0, 0, 'L');
// $pdf->Cell(40, 7, 'Nilai', 1, 0, 'C');
$pdf->ln();
$pdf->ln();

include './includes/api.php';
// include './includes/header.php';
akses_pengguna(array(1));
if (count(data_alternatif()) > 0 && count(hasil($periode)) > 0) {


	$guru = hasil($periode);
	$id = "Kode Supplier        : " . $guru[0]['id_alternatif'];
	$nama = "Nama Supplier       : " . $guru[0]['nama'];
	$alamat = "Alamat                   : " . $guru[0]['alamat'];
	$telp = "No. Telp                 : " . $guru[0]['telp'];
	$hasil = "Hasil                       : " . $guru[0]['hasil'];

	$ket = "Menyatakan bahwa supplier tersebut terpilih sebagai Supplier Terbaik";
	$pdf->Cell(90, 7, $id, 0, 0, 'L');
	$pdf->ln();
	$pdf->Cell(90, 7, $nama, 0, 0, 'L');
	$pdf->ln();
	$pdf->Cell(90, 7, $alamat, 0, 0, 'L');
	$pdf->ln();
	$pdf->Cell(90, 7, $telp, 0, 0, 'L');
	$pdf->ln();
	$pdf->Cell(90, 7, $hasil, 0, 0, 'L');
	$pdf->ln();
	$pdf->ln();
	$pdf->Cell(60, 7, $ket, 0, 0, 'L');
	$pdf->ln();
	$pdf->ln();
	$pdf->ln();
	$pdf->Cell(160, 7, 'Pimpinan Chanipil Collection', 0, 0, 'R');
	$pdf->ln();
	$pdf->ln();
	$pdf->ln();
	$pdf->ln();
	$pdf->Cell(145, 7, 'Umar Aziz', 0, 0, 'R');
} else {
	if (count(data_kriteria()) < 1) echo '<div class="alert alert-dismissable alert-danger"><b>Data kriteria kosong</b>, silahkan hubungi Petugas.</div>';
	if (count(data_alternatif()) < 1) echo '<div class="alert alert-dismissable alert-danger"><b>Data alternatif kosong</b>, silahkan hubungi Petugas.</div>';
	if (!cek_valid_bobot()) echo '<div class="alert alert-dismissable alert-danger"><b>Perbadingan bobot kriteria tidak valid</b>, silahkan hubungi Pakar/Ahli.</div>';
}


$pdf->ln();

$pdf->Output();
