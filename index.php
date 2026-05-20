<?php require_once 'config.php'; ?>
<!DOCTYPE html>
<html>
<body>
    <h1>Welcome to University</h1>
    <?php if (isset($_SESSION['user_id'])): ?>

<p>
    Hello, <?php echo $_SESSION['user_name']; ?>!

    <a href="dashboard.php">
        Dashboard
    </a> |

    <a href="logout.php">
        Logout
    </a>
</p>

<?php else: ?>

<p>
    <a href="login.php">Login</a> |
    <a href="signup.php">Sign Up</a>
</p>

<?php endif; ?>
</body>
</html>
