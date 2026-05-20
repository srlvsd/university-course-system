$course_id = $_GET['id'];
$sql = "SELECT * FROM courses WHERE id = $course_id";
$course = $conn->query($sql)->fetch_assoc();
echo "<h1>{$course['title']}</h1>";
echo "<p>{$course['description']}</p>";

if ($is_enrolled) {
    echo "<p>✅ You are already enrolled in this course</p>";
} else {
    echo "<a href='register_course.php?course_id=$course_id'>
          Enrol
          </a>";
}
