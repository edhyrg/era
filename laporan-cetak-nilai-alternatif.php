<?php
require('includes/fpdf/fpdf.php');
@$periode = $_GET['periode'];
@$periode2 = $_GET['periode2'];
if ($periode != $periode2) {
	$periode3 = $periode . '-' . $periode2;
} else {
	$periode3 = $periode;
}

class PDF extends FPDF
{

	function PDF($orientation = 'P', $unit = 'mm', $size = 'A4')
	{
		$this->FPDF($orientation, $unit, $size);
	}

	function Header()
	{
		$this->SetFont('Times', 'B', 14);
		$kop = '_upload/kop.jpg';
		// $this->Cell(80);
		// $this->Cell(30, 10, 'LAPORAN EVALUASI SUPPLIER', 0, 0, 'C');
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
$pdf->Cell(30, 10, 'LAPORAN HASIL EVALUASI SUPPLIER', 0, 0, 'C');
$pdf->ln();
$pdf->SetFont('Times', 'B', 12);
$date = date("d-m-Y");
$pdf->Cell(16, 10, 'Periode : ', 0, 0, 'L');
$pdf->Cell(150, 10, $periode3, 0, 0, 'L');
$pdf->ln();
$pdf->ln();
$pdf->Cell(7, 7, 'No', 1, 0, 'C');
$pdf->Cell(40, 7, 'Kriteria/Alternatif', 1, 0, 'C');


include './includes/api.php';
// include './includes/header.php';
akses_pengguna(array(1));
if (count(data_alternatif2($periode, $periode2)) > 0) {
	foreach (data_kriteria() as $x) {
		$pdf->Cell(25, 7, $x[1], 1, 0, 'C');
	}
	$pdf->ln();
	$pdf->SetFont('Times', '', 12);
	$no = 1;
	foreach (data_alternatif2($periode, $periode2) as $x) {
		$pdf->Cell(7, 7, $no, 1, 0, 'C');
		$pdf->Cell(40, 7, $x[1], 1, 0, 'L');
		foreach (data_kriteria() as $y) {
			$n = nilai_alternatif($x[0], $y[0]);
			$pdf->Cell(25, 7, $n, 1, 0, 'C');
		}
		$pdf->ln();
		$no++;
	}
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


$pdf->Output('Laporan Evaluasi', 'i');
