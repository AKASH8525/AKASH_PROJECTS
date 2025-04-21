<?php
// config.php
$host = "your-rds-endpoint"; // e.g., yourdbinstance.abcdefghijk.us-east-1.rds.amazonaws.com
$db_username = "your-db-username";
$db_password = "your-db-password";
$dbname = "your-database-name";

$conn = new mysqli($host, $db_username, $db_password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>