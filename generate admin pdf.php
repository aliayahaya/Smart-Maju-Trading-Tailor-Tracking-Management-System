<?php
require_once('tcpdf/tcpdf.php');

// Database connection
$conn = new mysqli("localhost", "root", "", "tailortrack");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch attendance data
$admin_query = mysqli_query($conn, "SELECT * FROM admin") or die(mysqli_error($con));

// Create a new PDF document
$pdf = new TCPDF();
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Tailor Track System');
$pdf->SetTitle('Admin List Report');
$pdf->SetHeaderData('', 0, 'Admin List Report', 'Generated on: ' . date('Y-m-d'));
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetMargins(15, 15, 15);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->AddPage();
$pdf->SetFont('helvetica', '', 12);

// Table header
$html = '<h2>Admin List Report</h2>
        <table border="1" cellpadding="5">
        <tr style="background-color: #c69b6b; color: white;">
        <th>ID</th>
        <th>Name</th>
        <th>Phone</th>
        <th>Email</th>
        </tr>';

// Add rows
if ($admin_query->num_rows > 0) {
    while ($row = $admin_query->fetch_assoc()) {
        $html .= "<tr><td>{$row['admin_id']}</td><td>{$row['admin_name']}</td><td>{$row['admin_phone']}</td><td>{$row['admin_email']}</td></tr>";
    }
} else {
    $html .= "<tr><td colspan='4'>No admin records found.</td></tr>";
}

$html .= '</table>';
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output('admin_list_report.pdf', 'D'); // Download PDF

$conn->close();
?>
