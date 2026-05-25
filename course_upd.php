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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $course['title']; ?> - University Courses</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <p><a href="index.php">← Back to Home</a></p>
    
    <h1><?php echo $course['title']; ?></h1>
    <p><?php echo $course['description']; ?></p>
    
    <h2>Course Modules</h2>
    
    <?php if ($modules_result->num_rows > 0): ?>
        <ul>
            <?php while($module = $modules_result->fetch_assoc()): ?>
                <li>
                    <a href="module.php?id=<?php echo $module['id']; ?>">
                        <?php echo $module['code']; ?> - <?php echo $module['title']; ?>
                    </a>
                </li>
            <?php endwhile; ?>
        </ul>
    <?php else: ?>
        <p>No modules available yet.</p>
    <?php endif; ?>
    
    <!-- Enrol button (only for logged in users) -->
    <?php if (isset($_SESSION['user_id'])): ?>
        <?php if ($is_enrolled): ?>
            <p>✅ You are already enrolled in this course</p>
        <?php else: ?>
            <a href="register_course.php?course_id=<?php echo $course_id; ?>" class="button">
                Enrol in this course
            </a>
        <?php endif; ?>
    <?php else: ?>
        <p><a href="login.php">Login</a> to enrol in this course</p>
    <?php endif; ?>
</body>
</html>
