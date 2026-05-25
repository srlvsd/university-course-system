<?php
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$course_id = isset($_GET['course_id']) ? (int)$_GET['course_id'] : 0;

$check_sql = "SELECT * FROM user_courses WHERE user_id = $user_id AND course_id = $course_id";
$check_result = $conn->query($check_sql);

if ($check_result->num_rows === 0) {
    $sql = "INSERT INTO user_courses (user_id, course_id) VALUES ($user_id, $course_id)";
    $conn->query($sql);
}


header("Location: course.php?id=$course_id");
exit;
?>
