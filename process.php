<?php
session_start(); // Start the session

$con = mysqli_connect ("localhost", "root", "", "tailortrack") or die
(mysqli_connect_errno($con));


if (isset($_POST["username"])) {
    $username = mysqli_real_escape_string($con, $_POST["username"]);
    $password = mysqli_real_escape_string($con, $_POST["password"]);
    $role = $_POST["role"];

    // Query to check the username and password
    $semak = mysqli_query($con, "SELECT * FROM register WHERE username='$username' AND password='$password'") or die(mysqli_error($con));

    $bilrekod = mysqli_num_rows($semak);

    if ($bilrekod == 0) {
        echo "Wrong username or password";
    } else {
        $datarekod = mysqli_fetch_assoc($semak); // Fetch user details
        $_SESSION["username"] = $username;
        $userData = mysqli_fetch_array($semak);

        if ($role === "Admin") {
            header("Location: admin.php"); // Redirect to staff dashboard
            exit();
        } elseif ($role === "Tailor") {
            header("Location: tailor.php"); // Redirect to tailor dashboard
            exit();
        }
        elseif ($role === "Management") {
            header("Location: management.php"); // Redirect to management dashboard
            exit();
        }
    }
}
?>