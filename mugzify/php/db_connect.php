<?php
$host = "localhost";  // Use `docker inspect trtkp24_17` if a different IP is needed
$user = "trtkp24_17";  // Replace with your MySQL username
$password = "SpmBB18T";  // Replace with your MySQL password
$database = "trtkp24_17";  // Your database name

// Create a connection
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set UTF-8 encoding (optional but recommended)
$conn->set_charset("utf8");

// Uncomment below to test connection
// echo "Connected successfully";

?>
