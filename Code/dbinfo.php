<?php
$hn = 'localhost';
$db = 'SB_FIT';
$un = 'root';
$pw = 'root';

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
?>
