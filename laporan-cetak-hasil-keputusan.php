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
$pdf->Cell(30, 10, 'LAPORAN HASIL KEPUTUSAN', 0, 0, 'C');
$pdf->ln();
$pdf->SetFont('Times', 'B', 12);
$date = date("d-m-Y");
$pdf->Cell(16, 10, 'Periode : ', 0, 0, 'L');
$pdf->Cell(150, 10, $periode3, 0, 0, 'L');
$pdf->ln();
$pdf->ln();
$pdf->Cell(55, 7, 'Alternatif', 1, 0, 'C');
$pdf->Cell(55, 7, 'Nilai', 1, 0, 'C');
$pdf->Cell(55, 7, 'Periode', 1, 0, 'C');
$pdf->ln();

include './includes/api.php';
// include './includes/header.php';
akses_pengguna(array(1));
if (count(data_alternatif()) > 0 && count(hasil($periode, $periode2)) > 0) {

	$pdf->SetFont('Times', '', 12);
	$no = 1;

	foreach (hasil($periode, $periode2) as $x) {
		$pdf->Cell(55, 7, $x['nama'], 1, 0, 'L');
		$pdf->Cell(55, 7, $x['hasil'], 1, 0, 'C');
		$pdf->Cell(55, 7, $x['periode'], 1, 0, 'C');
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

$pdf->Output();
