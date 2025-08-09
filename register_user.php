<?php

// Connect to the database
$con = mysqli_connect("localhost", "root", "", "tailortrack") 
    or die("Connection failed: " . mysqli_connect_error());

// Get form data and sanitize input
$name = mysqli_real_escape_string($con, $_POST["name"]);
$phone = mysqli_real_escape_string($con, $_POST["phone"]);
$email = mysqli_real_escape_string($con, $_POST["email"]);
$username = mysqli_real_escape_string($con, $_POST["username"]);
$password = mysqli_real_escape_string($con, $_POST["password"]);
$role = mysqli_real_escape_string($con, $_POST["role"]);

// Insert into register table
$sql = "INSERT INTO register (name, phone, email, username, password, role)
        VALUES ('$name', '$phone', '$email', '$username', '$password', '$role')";

if (mysqli_query($con, $sql)) {
    $register_id = mysqli_insert_id($con); // Get the new user's ID

    // Insert into role-specific table
    if ($role === 'admin') {
        mysqli_query($con, "INSERT INTO admin (admin_id, admin_name, admin_phone, admin_email) 
                            VALUES ('$user_id', '$name', '$phone', '$email')") 
            or die("Admin insert error: " . mysqli_error($con));
    } elseif ($role === 'tailor') {
        mysqli_query($con, "INSERT INTO tailor (tailor_id, tailor_name, tailor_phone, tailor_email) 
                            VALUES ('$user_id', '$name', '$phone', '$email')") 
            or die("Tailor insert error: " . mysqli_error($con));
    } elseif ($role === 'management') {
        mysqli_query($con, "INSERT INTO management (management_id, management_name) 
                            VALUES ('$user_id', '$name')") 
            or die("Tailor insert error: " . mysqli_error($con));
    }
    

    echo "<script>
        alert('New user registered successfully');
        window.location.href = 'login.php';
    </script>";
} else {
    echo "<script>
        alert('Error: " . mysqli_error($con) . "');
        window.location.href = 'login.php';
    </script>";
}

// Close the database connection
mysqli_close($con);

?>
