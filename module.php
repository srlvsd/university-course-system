<?php
require_once 'config.php';

$module_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$sql = "SELECT * FROM modules WHERE id = $module_id";
$result = $conn->query($sql);

$module = $result->fetch_assoc();

if (!$module) {
    die("Module not found");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo htmlspecialchars($module['title']); ?>
        - DMU Portal
    </title>

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

<div class="container">

    <div
        class="glass"
        style="
            max-width:900px;
            margin:60px auto;
            text-align:left;
        "
    >

        <h1 style="margin-bottom:20px;">
            <?php echo htmlspecialchars($module['title']); ?>
        </h1>

        <hr style="margin-bottom:25px; opacity:.3;">

        <p style="margin-bottom:15px;">
            <strong>Module Code:</strong>
            <?php echo htmlspecialchars($module['code']); ?>
        </p>

        <p style="margin-bottom:15px;">
            <strong>Instructor:</strong>
            <?php echo htmlspecialchars($module['staff_name']); ?>
        </p>

        <p style="margin-bottom:25px;">
            <strong>Description:</strong>
        </p>

        <p style="line-height:1.8;">
            <?php echo htmlspecialchars($module['description']); ?>
        </p>

        <br><br>

        <a
            href="javascript:history.back()"
            class="btn btn-primary"
        >
            ← Back
        </a>

    </div>

</div>

</body>
</html>
