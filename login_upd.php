<?php
require_once 'config.php';

$course_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$sql = "SELECT * FROM courses WHERE id = $course_id";
$course_result = $conn->query($sql);
$course = $course_result->fetch_assoc();

if (!$course) {
    die("Course not found");
}

$sql_modules = "SELECT * FROM modules WHERE course_id = $course_id";
$modules_result = $conn->query($sql_modules);

$is_enrolled = false;

if (isset($_SESSION['user_id'])) {

    $user_id = $_SESSION['user_id'];

    $check_sql = "SELECT * FROM user_courses
                  WHERE user_id = $user_id
                  AND course_id = $course_id";

    $check_result = $conn->query($check_sql);

    $is_enrolled = $check_result->num_rows > 0;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo htmlspecialchars($course['title']); ?>
        - DMU Portal
    </title>

    <link rel="stylesheet" href="style.css">

    <style>

    .btn-secondary{
        display:inline-block;
        padding:15px 35px;
        border-radius:50px;
        text-decoration:none;
        font-weight:600;
        margin:10px;
        transition:.3s;
        background:white;
        color:#111827;
    }

    .btn-secondary:hover{
        background:#f3f4f6;
        transform:translateY(-5px);
    }

    </style>

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

<div class="container">

    <div class="glass" style="margin-top:40px; text-align:center;">

        <h1>
            <?php echo htmlspecialchars($course['title']); ?>
        </h1>

        <br>

        <p>
            <?php echo htmlspecialchars($course['description']); ?>
        </p>

        <br>

        <?php if(isset($_SESSION['user_id'])): ?>

            <?php if($is_enrolled): ?>

                <a
                    href="dashboard.php"
                    class="btn btn-primary"
                >
                    Continue Course
                </a>

                <a
                    href="unenrol_course.php?course_id=<?php echo $course_id; ?>"
                    class="btn btn-secondary"
                    onclick="return confirm('Are you sure you want to unenrol from this course?');"
                >
                    Unenrol
                </a>

            <?php else: ?>

                <a
                    href="register_course.php?course_id=<?php echo $course_id; ?>"
                    class="btn btn-primary"
                >
                    Enrol Now
                </a>

            <?php endif; ?>

        <?php else: ?>

            <a
                href="login.php"
                class="btn btn-primary"
            >
                Login to Enrol
            </a>

        <?php endif; ?>

    </div>

    <br><br>

    <h2 style="text-align:center;">
        Course Modules
    </h2>

    <div class="course-grid">

        <?php if($modules_result->num_rows > 0): ?>

            <?php while($module = $modules_result->fetch_assoc()): ?>

                <div class="course-card">

                    <h3>
                        <?php echo htmlspecialchars($module['code']); ?>
                    </h3>

                    <br>

                    <p>
                        <?php echo htmlspecialchars($module['title']); ?>
                    </p>

                    <br>

                    <a
                        href="module.php?id=<?php echo $module['id']; ?>"
                        class="btn btn-primary"
                    >
                        View Module
                    </a>

                </div>

            <?php endwhile; ?>

        <?php else: ?>

            <div class="course-card">

                <h3>No Modules Available</h3>

                <br>

                <p>
                    Modules will be added soon.
                </p>

            </div>

        <?php endif; ?>

    </div>

</div>

</body>
</html>
