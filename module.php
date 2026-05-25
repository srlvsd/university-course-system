<?php
require_once 'config.php';

$module_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$sql = "SELECT * FROM modules WHERE id = $module_id";
$result = $conn->query($sql);
$module = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $module['title']; ?> - University Courses</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <p><a href="javascript:history.back()">← Back</a></p>
    
    <h1><?php echo $module['title']; ?></h1>
    
    <p><strong>Module Code:</strong> <?php echo $module['code']; ?></p>
    <p><strong>Description:</strong> <?php echo $module['description']; ?></p>
    <p><strong>Instructor:</strong> <?php echo $module['staff_name']; ?></p>
</body>
</html>
