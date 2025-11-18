<?php
// Database connection settings
$host = "sql105.infinityfree.com";
$username = "if0_39669901";
$password = "Quewon2025";
$database = "if0_39669901_p";

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
} else {
   // echo "Database connected successfully!";
}
?>
