<?php
require_once('tcpdf/tcpdf.php');

// Database connection
$conn = new mysqli("localhost", "root", "", "tailortrack");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch attendance data
$tailor_query = mysqli_query($conn, "SELECT * FROM tailor") or die(mysqli_error($con));

// Create a new PDF document
$pdf = new TCPDF();
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Tailor Track System');
$pdf->SetTitle('Tailor List Report');
$pdf->SetHeaderData('', 0, 'Tailor List Report', 'Generated on: ' . date('Y-m-d'));
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetMargins(15, 15, 15);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->AddPage();
$pdf->SetFont('helvetica', '', 12);

// Table header
$html = '<h2>Tailor List Report</h2>
        <table border="1" cellpadding="5">
        <tr style="background-color: #c69b6b; color: white;">
        <th>ID</th>
        <th>Name</th>
        <th>Phone</th>
        <th>Email</th>
        </tr>';

// Add rows
if ($tailor_query->num_rows > 0) {
    while ($row = $tailor_query->fetch_assoc()) {
        $html .= "<tr>
        <td>{$row['tailor_id']}</td>
        <td>{$row['tailor_name']}</td>
        <td>{$row['tailor_phone']}</td>
        <td>{$row['tailor_email']}</td>
        </tr>";
    }
} else {
    $html .= "<tr><td colspan='4'>No tailor records found.</td></tr>";
}

$html .= '</table>';
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output('tailor_list_report.pdf', 'D'); // Download PDF

$conn->close();
?>
