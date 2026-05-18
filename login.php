<?php
require_once 'config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);
    
    if ($result->num_rows === 1) {
        $_SESSION['user_id'] = $result->fetch_assoc()['id'];
        header('Location: dashboard.php');
    }
}
?>
