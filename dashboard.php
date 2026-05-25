<?php
require_once 'config.php';

// If user is not logged in, redirect to login page
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

// Get courses the user is enrolled in
$sql = "SELECT c.* FROM courses c 
        JOIN user_courses uc ON c.id = uc.course_id 
        WHERE uc.user_id = $user_id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Welcome, <?php echo $_SESSION['user_name']; ?>!</h1>
    <p><a href="index.php">Home</a> | <a href="logout.php">Logout</a></p>
    
    <h2>My Courses</h2>
    
    <?php if ($result->num_rows > 0): ?>
        <ul>
            <?php while($course = $result->fetch_assoc()): ?>
                <li>
                    <a href="course.php?id=<?php echo $course['id']; ?>">
                        <?php echo $course['title']; ?>
                    </a>
                </li>
            <?php endwhile; ?>
        </ul>
    <?php else: ?>
        <p>You are not enrolled in any courses yet. 
           <a href="index.php">Browse courses</a></p>
    <?php endif; ?>
</body>
</html>
