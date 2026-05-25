<?php
require_once 'config.php';

// Get all courses from the database
$sql = "SELECT * FROM courses";
$result = $conn->query($sql);
?>
