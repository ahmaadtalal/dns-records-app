<?php
// db_connect.php

// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Database credentials
$servername = "sql12.freemysqlhosting.net";  // Your MySQL server address
$username = "sql12752373";  // Your database username
$password = "MCVgyDCKgE";   // Your database password
$dbname = "sql12752373";    // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
