$module_id = $_GET['id'];
$sql = "SELECT * FROM modules WHERE id = $module_id";
$module = $conn->query($sql)->fetch_assoc();
echo "<h1>{$module['title']}</h1>";
echo "<p>Code: {$module['code']}</p>";
echo "<p>Instructor: {$module['staff_name']}</p>";
