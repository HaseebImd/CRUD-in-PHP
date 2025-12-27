<?php
// Database configuration
$host = "localhost";
$username = "root";
$password = "";
$database = "crud_demo";

// Create connection
$conn = mysqli_connect($host, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Start session
session_start();
?>
