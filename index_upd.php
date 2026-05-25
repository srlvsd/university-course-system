<?php
require_once 'config.php';

// Get all courses from the database
$sql = "SELECT * FROM courses";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home - University Courses</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Welcome to the University</h1>
    
    <?php if (isset($_SESSION['user_id'])): ?>
        <p>Hello, <?php echo $_SESSION['user_name']; ?>! 
           <a href="dashboard.php">Dashboard</a> | 
           <a href="logout.php">Logout</a>
        </p>
    <?php else: ?>
        <p><a href="login.php">Login</a> | <a href="signup.php">Sign Up</a></p>
    <?php endif; ?>

    <h2>Our Courses</h2>
    
    <?php if ($result->num_rows > 0): ?>
        <ul>
            <?php while($course = $result->fetch_assoc()): ?>
                <li>
                    <a href="course.php?id=<?php echo $course['id']; ?>">
                        <?php echo $course['title']; ?>
                    </a>
                    <p><?php echo $course['description']; ?></p>
                </li>
            <?php endwhile; ?>
        </ul>
    <?php else: ?>
        <p>No courses available yet.</p>
    <?php endif; ?>
</body>
</html>
