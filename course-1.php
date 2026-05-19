$sql_modules = "SELECT * FROM modules WHERE course_id = $course_id";
$modules_result = $conn->query($sql_modules);

while($module = $modules_result->fetch_assoc()) {
    echo "<li><a href='module.php?id={$module['id']}'>{$module['title']}</a></li>";
}
