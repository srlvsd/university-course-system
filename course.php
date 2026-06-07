<?php
require_once 'config.php';

$course_id = $_GET['id'];
$sql = "SELECT * FROM courses WHERE id = $course_id";
$course = $conn->query($sql)->fetch_assoc();
$sql_modules = "SELECT * FROM modules WHERE course_id = $course_id";
$modules_result = $conn->query($sql_modules);

$is_enrolled = false;
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $check_sql = "SELECT * FROM user_courses WHERE user_id = $user_id AND course_id = $course_id";
    if ($conn->query($check_sql)->num_rows > 0) {
        $is_enrolled = true;
    }
}

?>
<!DOCTYPE html>
<html>
<body>
    <h1><?php echo $course['title']; ?></h1>
    <p><?php echo $course['description']; ?></p>

    <?php if ($is_enrolled): ?>
        <p>You are already enrolled in this course</p>
    <?php else: ?>
        <a href="register_course.php?course_id=<?php echo $course_id; ?>">Enrol</a>
    <?php endif; ?>

 <h2>Course Modules</h2>
    <ul>
        <?php while ($module = $modules_result->fetch_assoc()): ?>
            <li>
                <a href="module.php?id=<?php echo $module['id']; ?>">
                    <?php echo $module['title']; ?>
                </a>
            </li>
        <?php endwhile; ?>
    </ul>
</body>
</html>
