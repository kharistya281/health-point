<?php
session_start();
require_once 'tcpdf/tcpdf.php';

// Ambil id_order dan unameCust dari session atau GET parameter
$id_order = isset($_GET['id_order']) ? $_GET['id_order'] : $_SESSION['id_order'];
$unameCust = isset($_SESSION['unameCust']) ? $_SESSION['unameCust'] : '';


// Buat dokumen baru
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Set informasi dokumen
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('Khrisma Agustya');
$pdf->setTitle('Laporan Pembelian');
$pdf->setSubject('Laporan Pembelian');
$pdf->setKeywords('Laporan Pembelian');

// Set font dan properti PDF lainnya
$pdf->setFont('Times', '', 13, '', true);
$pdf->setPrintHeader(false);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$pdf->AddPage();

// url dan generate hasil 
$url = "http://localhost/ujikom/formatLaporan.php?id_order=$id_order&unameCust=$unameCust"; 
$html = file_get_contents($url);

// Menulis HTML ke PDF
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// Output PDF ke browser
$pdf->Output('LaporanBelanja.pdf', 'I');
?>
