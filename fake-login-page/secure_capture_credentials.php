<?php
// Start session for potential use
session_start();

// Database connection (replace with your actual database credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "secure_login";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get and sanitize input
    $user = htmlspecialchars($_POST['username']);
    $pass = htmlspecialchars($_POST['password']);
    
    // Hash the password
    $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);
    
    // Save the credentials securely to the database
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $user, $hashed_pass);
    
    if ($stmt->execute()) {
        // Redirect to a secure login success page
        header("Location: secure_login_successful.html");
    } else {
        // Handle errors (e.g., user already exists)
        echo "Error: " . $stmt->error;
    }
    
    $stmt->close();
    $conn->close();
}
?>
