<?php
require_once('tcpdf/tcpdf.php');

// Database connection
$conn = new mysqli("localhost", "root", "", "tailortrack");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch orders data
$orders_query = mysqli_query($conn, "SELECT * FROM `order` WHERE status = 'Pick-Up'") or die(mysqli_error($conn));

// Initialize total amount
$total_amount = 0;

// Create a new PDF document
$pdf = new TCPDF();
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Tailor Track System');
$pdf->SetTitle('Order History Report');
$pdf->SetHeaderData('', 0, 'Order History Report', 'Generated on: ' . date('Y-m-d'));
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetMargins(15, 15, 15);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->AddPage();
$pdf->SetFont('helvetica', '', 12);

// Table header
$html = '<h2>Order History Report</h2>
        <table border="1" cellpadding="8" cellspacing="0" style="border-collapse: collapse;">
        <tr style="background-color: #c69b6b; color: white;">
            <th tyle="padding: 8px;">ID</th>
            <th style="padding: 8px;">Service Type</th>
            <th style="padding: 8px;">Order Type</th>
            <th style="padding: 8px;">Size</th>
            <th style="padding: 8px;">Order Date</th>
            <th style="padding: 8px;">Due Date</th>
            <th style="padding: 8px;">Quantity</th>
            <th style="padding: 8px;">Amount Paid (RM)</th
        ></tr>';

// Add rows
if ($orders_query->num_rows > 0) {
    while ($row = $orders_query->fetch_assoc()) {
        $html .= "<tr>
        <td style='padding: 8px;'>{$row['order_id']}</td>
        <td style='padding: 8px;'>{$row['service_type']}</td>
        <td style='padding: 8px;'>{$row['order_type']}</td>
        <td style='padding: 8px;'>{$row['size']}</td>
        <td style='padding: 8px;'>{$row['order_date']}</td>
        <td style='padding: 8px;'>{$row['due_date']}</td>
        <td style='padding: 8px;'>{$row['quantity']}</td>
        <td style='padding: 8px;'>{$row['amount_paid']}</td>
        </tr>";
        $total_amount += $row['amount_paid'];
    }
} else {
    $html .= "<tr><td colspan='7' style='padding: 8px; text-align: center;'>No order records found.</td></tr>";
}

$html .= "<tr style='background-color: #f0f0f0;'>
            <td colspan='6' style='padding: 8px; text-align: right;'><strong>Total Amount Paid</strong></td>
            <td style='padding: 8px; text-align: right;'><strong>RM $total_amount.00</strong></td>
          </tr>";

$html .= '</table>';
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output('orders_report.pdf', 'D'); // Download PDF

$conn->close();
?>
