<?php
require_once 'config.php';

$course_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$sql = "SELECT * FROM courses WHERE id = $course_id";
$course_result = $conn->query($sql);
$course = $course_result->fetch_assoc();

$sql_modules = "SELECT * FROM modules WHERE course_id = $course_id";
$modules_result = $conn->query($sql_modules);

$is_enrolled = false;
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $check_sql = "SELECT * FROM user_courses WHERE user_id = $user_id AND course_id = $course_id";
    $check_result = $conn->query($check_sql);
    $is_enrolled = $check_result->num_rows > 0;
}
?>
