<?php
require('dashboard/pdf/fpdf.php'); 
if(isset($_GET["names"])){
    $names=$_GET["names"];
    $idno=$_GET["idno"];
    $plot_name=$_GET["plot_name"];
    $phone_no=$_GET["phone_no"];
    $date=$_GET["date"];
    $agreement=$_GET["agreement"];
    $principal=$_GET["principal"];
    $daily=$_GET["daily"];
    $due=$_GET["due"];
    $front_id=$_GET['front_id'];
    $back_id=$_GET['back_id'];
    $plan=$_GET['plan'];
    }
class PDF extends FPDF {
    function Header() {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'MATRICK CONSULTANCY LOAN AGREEMENT', 0, 1, 'C');
        $this->Ln(10);
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
    }
}

$pdf = new PDF();
$pdf->AddPage();

// Borrower Information
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 6, 'This agreement is between (borrower)              '. $names , 0, 1, 'B');
$pdf->Cell(0, 6, 'ID number                                                          '.$idno, 0, 1);
$pdf->Cell(0, 6, 'Residence                                                          '.$plot_name, 0, 1);
$pdf->Cell(0, 6, 'The telephone number                                       '.$phone_no, 0, 1);
$pdf->Ln(5);

// Lender Information
$pdf->Cell(0, 6, 'Lender (Martin Kyalo) of ID No. 28022945 on this day of '.$date, 0, 1);
$pdf->Ln(5);

// Loan Amount
$pdf->Cell(0, 6, 'LOAN AMOUNT', 0, 1);
$pdf->Cell(0, 6, 'The borrower agrees to repay Ksh. '.$agreement, 0, 1);
$pdf->Ln(5);

// Interest Rate
$pdf->Cell(0, 6, 'INTEREST RATE', 0, 1);
$pdf->Cell(0, 6, 'Both agree upon an interest rate of 25% that is to be acquired for '.$plan, 0, 1);
$pdf->Ln(5);

// Term of Repayment
$pdf->Cell(0, 6, 'TERM OF REPAYMENT', 0, 1);
$pdf->Cell(0, 6, 'I agree to be paying lender (Martin Kyalo) Ksh '.$daily.' for '.$plan, 0, 1);
$pdf->Cell(0, 6, 'From '.$date.' to '.$due, 0, 1);

$pdf->Cell(0, 6, 'Principal amount Ksh '.$principal, 0, 1);
$pdf->Ln(10);

// Lender, Borrower, and Witness Sections
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 5, 'LENDER', 0, 1);
$pdf->Cell(0, 5, 'Name: Martin Kyalo', 0, 1);
$pdf->Cell(0, 5, 'Signature ..................', 0, 1);
$pdf->Cell(0, 5, 'Date '.$date, 0, 1);

$pdf->Ln(10);

$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 5, 'Borrower', 0, 1);
$pdf->Cell(0, 5, 'Name: '.$names, 0, 1);
$pdf->Cell(0, 5, 'Signature ..................', 0, 1);
$pdf->Cell(0, 5, 'Date '.$date, 0, 1);
$pdf->Ln(10);

$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 5, 'Witness', 0, 1);
$pdf->Cell(0, 5, 'Name: ..........................', 0, 1);
$pdf->Cell(0, 5, 'Signature ........................', 0, 1);
$pdf->Cell(0, 5, 'Date '.$date, 0, 1);

$pdf->Ln(10);

// Assuming you want the images to be 50x50 pixels and positioned side by side.
$pdf->Image($front_id, 10, $pdf->GetY(), 80, 50);
$pdf->Image($back_id, 100, $pdf->GetY(), 80, 50);

$pdf->Output('LoanAgreement.pdf', 'D');
