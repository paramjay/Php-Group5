<?php
include_once('lib/fpdf186/fpdf.php');

class PDF extends FPDF
{
    // Page header
    function Header()
    {
        $this->Image('images/header-logo-color.png', 10, 10, 40);
        $this->Ln(25);
        $this->SetFont('Arial', 'B', 20);
        // Move to the right
        $this->Cell(50);
        // Title
        $this->Cell(100, 10, 'Vikram Motors Car Invoice', 0, 0, 'C');
        // Line break
        $this->Ln(10);

        // Dummy seller address
        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 10, 'Vikram Motors Pvt. Ltd.', 0, 1, 'C');
        $this->Cell(0, 10, '123 Street, Cityville, Countryland', 0, 1, 'C');
        $this->Cell(0, 10, 'Phone: +1234567890 | Email: info@vikrammotors.com', 0, 1, 'C');
        $this->Ln(10); // Extra line break for spacing
    }

    // Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
    }
}

// Define database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_vikram";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch invoice data from database
    $stmt = $conn->prepare("SELECT * FROM tbl_invoice WHERE invoice_id = :invoice_id");
    $stmt->bindParam(':invoice_id', $_GET['invoice_id']);
    $stmt->execute();
    $invoice = $stmt->fetch(PDO::FETCH_ASSOC);

    // Fetch user data from database
    $stmt = $conn->prepare("SELECT * FROM tbl_users WHERE user_id = :user_id");
    $stmt->bindParam(':user_id', $invoice['user_id']);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Fetch cart items data from database
    $stmt = $conn->prepare("SELECT c.car_name, c.car_price, c.car_sale_price, cart.car_quantity FROM tbl_cars c JOIN tbl_cart cart ON c.car_id = cart.car_id WHERE cart.invoice_id = :invoice_id");
    $stmt->bindParam(':invoice_id', $_GET['invoice_id']);
    $stmt->execute();
    $cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Create a new PDF instance
    $pdf = new PDF();
    $pdf->AddPage();

    $pdf->AliasNbPages();
    // Setting up font style
    $pdf->SetFont('Arial', 'B', 12);

    // Setting name of the customer
    $pdf->Cell(10, 10, 'Customer Name: ' . $user['user_name'], 0, 0, 'L');
    // Setting invoice date
    $pdf->Cell(170, 10, 'Invoice Number: ' . $invoice['invoice_id'], 0, 0, 'R');
    $pdf->Ln();
    // Setting customer address
    $pdf->Cell(10, 10, 'Customer Address: ' . $user['user_address'], 0, 0, 'L');

    $pdf->Cell(170, 10, 'Invoice Date: ' . $invoice['invoice_date'], 0, 0, 'R');
    $pdf->Ln();

    // Add title
    $pdf->Cell(0, 10, 'Invoice', 0, 1, 'C');

    // Add header row
    $pdf->Cell(60, 10, 'Car Name', 1);
    $pdf->Cell(40, 10, 'Price', 1);
    $pdf->Cell(40, 10, 'Quantity', 1);
    $pdf->Cell(50, 10, 'Total', 1);
    $pdf->Ln();

    // Add cart items
    $totalAmount = 0;
    foreach ($cartItems as $item) {
        $name = $item['car_name'];
        $price = $item['car_price'];
        $quantity = $item['car_quantity'];
        $total = $price * $quantity;

        $pdf->Cell(60, 10, $name, 1);
        $pdf->Cell(40, 10, '$' . number_format($price, 2), 1);
        $pdf->Cell(40, 10, $quantity, 1);
        $pdf->Cell(50, 10, '$' . number_format($total, 2), 1);
        $pdf->Ln();

        $totalAmount += $total;
    }

    // Add tax amount
    $totalTaxAmount = $totalAmount * 0.13;
    $pdf->Cell(140, 10, 'Total Tax Amount', 1);
    $pdf->Cell(50, 10, '$' . number_format($totalTaxAmount, 2), 1);
    $pdf->Ln();

    // Add total amount
    $pdf->Cell(140, 10, 'Total Amount', 1);
    $pdf->Cell(50, 10, '$' . number_format($totalAmount + $totalTaxAmount, 2), 1);
    $pdf->Ln();

    // Payment mode
    $pdf->Cell(0, 10, 'Payment Mode: ' . $invoice['invoice_payment_mode'], 0, 1, 'L');
    $pdf->Ln();

    // Terms and conditions
    $pdf->SetFont('Arial', 'I', 10);
    $pdf->MultiCell(0, 10, "Terms and Conditions:\n- Payment is due within 30 days.\n- Goods once sold will not be taken back.", 0, 'L');
    $pdf->Ln();

    // Customer signature
    $pdf->Cell(0, 10, 'Customer Signature: ____________________', 0, 1, 'R');
    $pdf->Ln();

    // Output PDF
    $pdf->Output();
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
