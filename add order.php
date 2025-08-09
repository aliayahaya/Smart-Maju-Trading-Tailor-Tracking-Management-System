<?php
// Establish database connection
$con = mysqli_connect("localhost", "root", "", "tailortrack");

// Check connection
if (mysqli_connect_errno()) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_order'])) {
    // Sanitize and validate form inputs
    $service_type = mysqli_real_escape_string($con, $_POST['service_type']);
    $order_type = mysqli_real_escape_string($con, $_POST['order_type']);
    // Determine which size was submitted
    switch ($order_type) {
        case 'Muslimah Clothes':
            $size = mysqli_real_escape_string($con, $_POST['size_muslimah']);
            break;
        case 'Kids Clothes':
            $size = mysqli_real_escape_string($con, $_POST['size_kids']);
            break;
        case 'Adult Long Sleeves':
            $size = mysqli_real_escape_string($con, $_POST['size_long']);
            break;
        case 'Adult Short Sleeves':
            $size = mysqli_real_escape_string($con, $_POST['size_short']);
            break;
        default:
            $size = '';
            break;
    }
    $order_date = mysqli_real_escape_string($con, $_POST['order_date']);
    $due_date = mysqli_real_escape_string($con, $_POST['due_date']);
    $quantity = mysqli_real_escape_string($con, $_POST['quantity']);
    $notes = mysqli_real_escape_string($con, $_POST['notes']);

    // Insert data into the database
    $sql = "INSERT INTO `order` (service_type, order_type, size, order_date, due_date, quantity, notes)
            VALUES ('$service_type', '$order_type', '$size', '$order_date', '$due_date', '$quantity', '$notes')";

    if (mysqli_query($con, $sql)) {
        echo "<script>alert('Order submitted successfully'); window.location.href = 'admin.php';</script>";
        // Redirect to another page or display success message
        // header("Location: admin.php");
    } else {
        echo "<script>alert('Error: " . mysqli_error($con) . "');</script>";
    }
}

// Close the database connection
mysqli_close($con);
?>
