<?php

use setasign\Fpdi\Fpdi;
include 'connect.php';
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
    
$pdf->SetFont('Arial', '', 12);
$pdf->SetXY(10, 10); $pdf->Write(0,"ID");
$pdf->SetXY(40, 10); $pdf->Write(0,"NAME");
$pdf->SetXY(70, 10); $pdf->Write(0,"CONTACT");
$pdf->SetXY(110, 10); $pdf->Write(0,"EMAIL");
$pdf->SetXY(170, 10); $pdf->Write(0,"PASSWORD");

$y=22;
// Loop through each row in the result set
while ($row = mysqli_fetch_assoc($result)) {
    // Fetch data from the current row
    $id = $row['ID'];
    $name = $row['Name'];
    $contact = $row['Contact'];
    $email = $row['Email'];
    $password = $row['Password'];

    $pdf->SetXY(10,$y); $pdf->Write(0,$id);
    $pdf->SetXY(40, $y); $pdf->Write(0,$name);
    $pdf->SetXY(70, $y); $pdf->Write(0,$contact);
    $pdf->SetXY(110, $y); $pdf->Write(0,$email);
    $pdf->SetXY(170, $y); $pdf->Write(0,$password);

    $y+=10;

    if ($y > 270) {
        $pdf->AddPage();
        // Reset Y position and any other necessary parameters for the new page
        $y = 10;
    }
    /* Output data in the PDF
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, "ID: $id", 0, 1);
    $pdf->Cell(0, 10, "Name: $name", 0, 1);
    $pdf->Cell(0, 10, "Contact: $contact", 0, 1);
    $pdf->Cell(0, 10, "Email: $email", 0, 1);
    $pdf->Cell(0, 10, "Password: $password", 0, 1);
    */
}

// Clean (erase) the output buffer and turn off output buffering
ob_end_clean();

$pdf->Output('myfile.pdf', 'D');

?>