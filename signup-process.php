<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "database1";
$con = mysqli_connect($servername, $username, $password, $database);

if (!$con) {
    die("Error connecting to the database: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    $name = sanitizeInput($_POST['fname']);
    $email = sanitizeInput($_POST['femail']);
    $number = sanitizeInput($_POST['fnumber']);
    $purpose = sanitizeInput($_POST['purpose']);
    $b_group = sanitizeInput($_POST['bloodgroup']);
    $date = sanitizeInput($_POST['dob']);
    $address = sanitizeInput($_POST['faddress']);
    $location = sanitizeInput($_POST['city']);
    
    // Prepare the SQL statement with placeholders
    $sql = "INSERT INTO signup_data (`name`, `email`, `contact_no`, `purpose`, `bloodgroup`, `dob`, `address`, `location`) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    // Create a prepared statement
    $stmt = mysqli_prepare($con, $sql);
    if (!$stmt) {
        die("Error preparing the statement: " . mysqli_error($con));
    }

    // Bind the parameters to the prepared statement
    mysqli_stmt_bind_param($stmt, "ssssssss", $name, $email, $number, $purpose, $b_group, $date, $address, $location);

    // Execute the prepared statement
    if (mysqli_stmt_execute($stmt)) {
        echo '<script>
            window.location.href = "aboutus.html";
        </script>';
        exit;
    } else {
        echo "Error: " . mysqli_stmt_error($stmt);
    }

    // Close the prepared statement and database connection
    mysqli_stmt_close($stmt);
    mysqli_close($con);
}

// Function to sanitize user input
function sanitizeInput($input) {
    // Remove leading/trailing whitespaces
    $input = trim($input);
    // Convert special characters to HTML entities
    $input = htmlspecialchars($input);
    // Escape special characters to prevent SQL injection
    $input = mysqli_real_escape_string($con, $input);
    return $input;
}
?>
