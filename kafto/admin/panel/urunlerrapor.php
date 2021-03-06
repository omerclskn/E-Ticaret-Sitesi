<?php
include('../../config.php');
require('fpdf.php');

class PDF extends FPDF
{
// Page header
    function Header()
    {
        // Logo
        $this->Image('logo.png',10,6,30);
        // Arial bold 15
        $this->SetFont('Arial','B',15);
        // Move to the right
        $this->Cell(60);
        // Title
        $this->Cell(90,10,'Kafto Collection Urunler Raporu',1,0,'C');
        // Line break
        $this->Ln(20);
    }

// Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Page number
        $this->Cell(0,10,'Sayfa '.$this->PageNo().'/{nb}',0,0,'C');
    }
}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);

$veriler = $db->prepare("SELECT id,ad,kategori,fiyat,gorsel FROM urunler");
$veriler->execute();
$dizi = $veriler->fetchAll(PDO::FETCH_OBJ);
foreach ($dizi as $item) {

    $pdf->Cell(0, 10, 'ID: ' .$item->id. ' / ' . $item->ad.' / '.ucwords($item->kategori). ' / '.$item->fiyat. ' / ' .$item->gorsel, 0, 1);

}

ob_start();
$pdf->Output();
?>