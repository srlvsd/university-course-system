$user = $result->fetch_assoc();
if (password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_name'] = $user['name'];
    header('Location: dashboard.php');
    exit;
} else {
    $error = "Invalid password";
}

