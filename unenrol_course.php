<?php
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$course_id = isset($_GET['course_id']) ? (int)$_GET['course_id'] : 0;

$sql = "DELETE FROM user_courses
        WHERE user_id = $user_id
        AND course_id = $course_id";

if ($conn->query($sql)) {
    header('Location: dashboard.php');
    exit;
} else {
    echo "Error removing course: " . $conn->error;
}
?>
