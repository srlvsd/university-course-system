<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'config.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $check_sql = "SELECT id FROM users WHERE email = '$email'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {

        $error = "This email is already registered.";

    } else {

        $sql = "INSERT INTO users (name, email, password)
                VALUES ('$name', '$email', '$password')";

        if ($conn->query($sql) === TRUE) {

            $success = "Registration successful! You can now login.";

        } else {

            $error = "Error: " . $conn->error;

        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - DMU Portal</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<nav class="navbar">

    <div class="logo">
        DMU Portal
    </div>

    <div class="nav-links">
        <a href="index.php">Home</a>
        <a href="login.php">Login</a>
    </div>

</nav>

<div class="container">

    <div class="form-container">

        <h1>Create Account</h1>

        <?php if($error): ?>
            <p class="error">
                <?php echo $error; ?>
            </p>
        <?php endif; ?>

        <?php if($success): ?>

            <p class="success">
                <?php echo $success; ?>
            </p>

            <br>

            <a href="login.php" class="btn btn-primary">
                Go to Login
            </a>

        <?php else: ?>

            <form method="POST">

                <input
                    type="text"
                    name="name"
                    placeholder="Full Name"
                    required
                >

                <input
                    type="email"
                    name="email"
                    placeholder="University Email"
                    required
                >

                <input
                    type="password"
                    name="password"
                    placeholder="Password"
                    required
                >

                <button type="submit">
                    Create Account
                </button>

            </form>

            <br>

            <p style="text-align:center;">
                Already have an account?
                <a href="login.php" style="color:white;">
                    Login Here
                </a>
            </p>

        <?php endif; ?>

    </div>

</div>

</body>
</html>
