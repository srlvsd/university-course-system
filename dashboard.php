<?php
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

$all_courses_sql = "SELECT * FROM courses";
$all_courses = $conn->query($all_courses_sql);

$my_courses_sql = "SELECT c.* FROM courses c
                   JOIN user_courses uc ON c.id = uc.course_id
                   WHERE uc.user_id = $user_id";

$my_courses = $conn->query($my_courses_sql);
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
        <a href="dashboard.php">Dashboard</a>
        <a href="logout.php">Logout</a>
    </div>

</nav>

<div class="container">

    <div class="glass" style="margin-top:40px;text-align:center;">

        <h1>
            Welcome,
            <?php echo htmlspecialchars($_SESSION['user_name']); ?>!
        </h1>

        <br>

        <p>
            Manage your enrolled courses and explore all available programmes.
        </p>

    </div>

    <br><br>

    <h2 style="text-align:center;">
        My Enrolled Courses
    </h2>

    <div class="course-grid">

        <?php if($my_courses->num_rows > 0): ?>

            <?php while($course = $my_courses->fetch_assoc()): ?>

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
                        Continue Course
                    </a>

                </div>

            <?php endwhile; ?>

        <?php else: ?>

            <div class="course-card">

                <h3>No Courses Yet</h3>

                <br>

                <p>
                    You are not enrolled in any courses.
                </p>

            </div>

        <?php endif; ?>

    </div>

    <br><br><br>

    <h2 style="text-align:center;">
        All Available Courses
    </h2>

    <div class="course-grid">

        <?php while($course = $all_courses->fetch_assoc()): ?>

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
                    View Course
                </a>

            </div>

        <?php endwhile; ?>

    </div>

</div>

</body>
</html>
