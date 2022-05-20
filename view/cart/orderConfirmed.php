<!-- <h1> Your order was successfully created! Thank you for choosing Erebor merchandise!<h1> -->
<?php

require_once File::build_path(['lib', 'fpdf', 'fpdf.php']);
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
		$this->Ln(20);
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

// Define alias for number of pages
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',14);
$pdf->Cell(20);
$pdf->Cell(45, 10, 'Order id:', 0, 0);
$pdf->Cell(45, 10, $order->getId(), 0, 1);
$pdf->Ln(10);
$pdf->Cell(20);
$pdf->Cell(45, 10, 'Product id', 0, 0);
$pdf->Cell(45, 10, 'Name', 0, 0);
$pdf->Cell(45, 10, 'Quantity', 0, 0);
$pdf->Cell(45, 10, 'Price', 0, 1);
foreach ($order->getOrderRows() as $id => $quantity) {
	$product = ModelProduct::getProductById($id);
	$pdf->Cell(20);
	$pdf->Cell(45, 10, ''.$id, 0, 0);
	$pdf->Cell(45, 10, ''.$product->getName(), 0, 0);
	$pdf->Cell(45, 10, ''.$quantity, 0, 0);
	$pdf->Cell(45, 10, ''.($product->getPrice() * $quantity), 0, 1);
}
$pdf->Ln(10);
$pdf->Cell(20);
$pdf->Cell(135, 10, 'Total', 0, 0);
$pdf->Cell(45, 10, ''.$order->countTotal(), 0, 1);
$pdf->Output();

?>