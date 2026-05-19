$sql = "SELECT * FROM courses";
$result = $conn->query($sql);

while($course = $result->fetch_assoc()) {
    echo "<li><a href='course.php?id={$course['id']}'>{$course['title']}</a></li>";
}

