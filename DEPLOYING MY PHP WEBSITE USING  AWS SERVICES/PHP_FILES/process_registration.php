<?php
include 'config.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Sanitize inputs
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);

    $sql = "INSERT INTO users (name, email) VALUES ('$name', '$email')";
    if($conn->query($sql)){
        $message = "Registration Successful!";
    } else {
        $message = "Error: " . $conn->error;
    }
    header("Location: index.php?message=" . urlencode($message));
    exit;
}
?>