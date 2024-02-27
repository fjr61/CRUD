<?php

use setasign\Fpdi\Fpdi;
include 'connect.php';
include 'display.php';
require_once('vendor/autoload.php');

// Start output buffering
ob_start();

$sql = "SELECT * FROM `user_accounts`";
$result = mysqli_query($con, $sql);

$pdf = new Fpdi();

if (!$result) {
    // Query failed
    die("Query failed: " . mysqli_error($con));
}

$pdf->AddPage();

// Loop through each row in the result set
while ($row = mysqli_fetch_assoc($result)) {
    // Fetch data from the current row
    $id = $row['ID'];
    $name = $row['Name'];
    $contact = $row['Contact'];
    $email = $row['Email'];
    $password = $row['Password'];

    // Output data in the PDF
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, "ID: $id", 0, 1);
    $pdf->Cell(0, 10, "Name: $name", 0, 1);
    $pdf->Cell(0, 10, "Contact: $contact", 0, 1);
    $pdf->Cell(0, 10, "Email: $email", 0, 1);
    $pdf->Cell(0, 10, "Password: $password", 0, 1);
}

// Clean (erase) the output buffer and turn off output buffering
ob_end_clean();

$pdf->Output('myfile.pdf', 'D');

?>