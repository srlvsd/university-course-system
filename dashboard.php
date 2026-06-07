<?php
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT c.* FROM courses c
        JOIN user_courses uc ON c.id = uc.course_id
        WHERE uc.user_id = $user_id";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - DMU Portal</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<nav class="navbar">

    <div class="logo">
        DMU Portal
    </div>

    <div class="nav-links">
        <a href="index.php">Home</a>
        <a href="logout.php">Logout</a>
    </div>

</nav>

<div class="container">

    <div class="glass" style="margin-top:40px; text-align:center;">

        <h1>
            Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!
        </h1>

        <br>

        <p>
            Manage your enrolled courses and continue your
            academic journey through the DMU Course Management System.
        </p>

    </div>

    <br><br>

    <h2 style="text-align:center;">
        My Courses
    </h2>

    <div class="course-grid">

        <?php if($result->num_rows > 0): ?>

            <?php while($course = $result->fetch_assoc()): ?>

                <div class="course-card">

                    <h3>
                        <?php echo htmlspecialchars($course['title']); ?>
                    </h3>

                    <br>

                    <p>
                        <?php echo htmlspecialchars($course['description']); ?>
                    </p>

                    <br>

                    <a
                        href="course.php?id=<?php echo $course['id']; ?>"
                        class="btn btn-primary"
                    >
                        Open Course
                    </a>

                </div>

            <?php endwhile; ?>

        <?php else: ?>

            <div class="course-card">

                <h3>No Courses Yet</h3>

                <br>

                <p>
                    You are not currently enrolled in any courses.
                </p>

                <br>

                <a
                    href="index.php"
                    class="btn btn-primary"
                >
                    Browse Courses
                </a>

            </div>

        <?php endif; ?>

    </div>

</div>

</body>
</html>
