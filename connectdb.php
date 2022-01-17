<?php
// Database credentials.
$serverName = 'localhost';
$dBUserName = 'root';
$dBPassword = '';
$dbName = 'aston_events';

$conn = mysqli_connect($serverName, $dBUserName, $dBPassword, $dbName);

// Check connection
if ($conn === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>