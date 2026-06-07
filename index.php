<?php
require_once 'config.php';

$sql = "SELECT * FROM courses";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DMU Course Management System</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<nav class="navbar">

    <div class="logo">
        DMU Portal
    </div>

    <div class="nav-links">

        <a href="index.php">Home</a>

        <?php if(isset($_SESSION['user_id'])): ?>

            <a href="dashboard.php">Dashboard</a>
            <a href="logout.php">Logout</a>

        <?php else: ?>

            <a href="login.php">Login</a>
            <a href="signup.php">Register</a>

        <?php endif; ?>

    </div>

</nav>

<section class="hero">

    <div class="hero-content">

        <h1>De Montfort University</h1>

        <p>
            Agile-Based Course and Module Management System
            designed to help students explore courses,
            register modules and manage their academic journey.
        </p>

        <?php if(isset($_SESSION['user_id'])): ?>

            <a href="dashboard.php" class="btn btn-primary">
                Go to Dashboard
            </a>

        <?php else: ?>

            <a href="login.php" class="btn btn-primary">
                Login
            </a>

            <a href="signup.php" class="btn btn-secondary">
                Register
            </a>

        <?php endif; ?>

        <div class="glass" style="max-width:700px; margin:40px auto 0;">

            <h2 style="margin-bottom:15px;">
                Start Your Learning Journey
            </h2>

            <p>
                Browse courses, view modules, register online
                and manage your studies through one integrated
                university portal.
            </p>

        </div>

    </div>

</section>

<div class="container">

    <h2 style="text-align:center; margin-bottom:30px;">
        Available Courses
    </h2>

    <div class="course-grid">

        <?php if($result->num_rows > 0): ?>

            <?php while($course = $result->fetch_assoc()): ?>

                <div class="course-card">

                    <h3>
                        <?php echo htmlspecialchars($course['title']); ?>
                    </h3>

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

        <?php else: ?>

            <div class="course-card">
                <h3>No Courses Available</h3>
                <p>Courses will appear here once added.</p>
            </div>

        <?php endif; ?>

    </div>

</div>

</body>
</html>
