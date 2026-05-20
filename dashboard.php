<?php
require_once 'config.php';

$user_id = $_SESSION['user_id'];

$sql = "SELECT c.* FROM courses c 
        JOIN user_courses uc ON c.id = uc.course_id 
        WHERE uc.user_id = $user_id";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<body>
    <h1>Dashboard</h1>
    <p>Hello, <?php echo $_SESSION['user_name']; ?>!
        <a href="logout.php">Logout</a>
    </p>

   <h2>Your Enrolled Courses</h2>

    <?php if ($result->num_rows > 0): ?>
        <ul>
            <?php while ($course = $result->fetch_assoc()): ?>
                <li>
                    <a href="course.php?id=<?php echo $course['id']; ?>">
                        <?php echo $course['title']; ?>
                    </a>
                </li>
            <?php endwhile; ?>
        </ul>
    <?php else: ?>
        <p>You are not enrolled in any courses yet. <a href="index.php">Browse courses</a></p>
    <?php endif; ?>
</body>
</html>
