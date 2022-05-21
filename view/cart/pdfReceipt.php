<?php

require_once File::build_path(['lib', 'fpdf', 'fpdf.php']);
// error_reporting(0);
ob_end_clean();
header("Content-Encoding: None", true);

class PDF extends FPDF {

	// Page header
	function Header() {
		
		// Add logo to page
		$this->Image(File::build_path(['src', 'images', 'PageIcons', 'erebor_logo2.jpg']),10,8,33);

		$this->Ln(10);
		
		// Set font family to Arial bold
		$this->SetFont('Arial','B',20);
		
		// Move to the right
		$this->Cell(60);
		
		// Header
		$this->Cell(80,10,'Order Confirmation',1,0,'C');
		
		// Line break
		$this->Ln(30);
	}

	// Page footer
	function Footer() {
		
		// Position at 1.5 cm from bottom
		$this->SetY(-15);
		
		// Arial italic 8
		$this->SetFont('Arial','I',8);
		
		// Page number
		$this->Cell(0,10,'Page ' .
			$this->PageNo() . '/{nb}',0,0,'C');
	}
}

// Instantiation of FPDF class
$pdf = new PDF();
$pdf->SetTitle($pageTitle);

// Define alias for number of pages
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','B',14);
$pdf->Cell(20);
$pdf->Cell(35, 10, 'Order id:', 'B', 0);
$pdf->Cell(35, 10, $order->getId(), 'B', 1, 'R');
$pdf->Ln(10);
$pdf->Cell(20);
$pdf->Cell(40, 10, 'Quantity', 'B', 0);
$pdf->Cell(40, 10, 'Name', 'B', 0);
$pdf->Cell(40, 10, 'Unit price', 'B', 0);
$pdf->Cell(40, 10, 'Amount', 'B', 1);

$pdf->SetFont('Times','',14);
foreach ($order->getOrderRows() as $id => $quantity) {
	$product = ModelProduct::getProductById($id);
	$pdf->Cell(20);
	$pdf->Cell(40, 10, ''.$quantity, 'R', 0);
	$pdf->Cell(40, 10, ''.$product->getName(), 'R', 0);
	$pdf->Cell(40, 10, ''.$product->getPrice(), 'R', 0);
	$pdf->Cell(40, 10, ''.($product->getPrice() * $quantity), 0, 1);
}
$pdf->Ln(10);
$pdf->Cell(20);
$pdf->SetFont('Times','',12);
$pdf->Cell(120, 10, 'Subtotal', 1, 0);
$pdf->Cell(40, 10, ''.$order->getTotal() * 0.8, 1, 1);
$pdf->Cell(20);
$pdf->Cell(120, 10, 'TVA', 1, 0);
$pdf->Cell(40, 10, ''.$order->getTotal() * 0.2, 1, 1);
$pdf->SetFont('Times','B',12);
$pdf->Cell(20);
$pdf->Cell(120, 10, 'Total', 1, 0);
$pdf->Cell(40, 10, ''.$order->getTotal(), 1, 1);
$pdf->Ln(10);
$pdf->Cell(20);
$pdf->Cell(35, 10, 'Payment Date and Time:', 'B', 0);
$pdf->SetFont('Times','I',12);
$pdf->Cell(65, 10, $order->getDate(), 'B', 1, 'R');
$pdf->SetFont('Times','I',16);
$pdf->Ln(30);
$pdf->Cell(180, 10, 'Erebor Merchandise', 'I', 1, 'R');
$pdf->Output();

?>