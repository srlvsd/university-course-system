$user_id = $_SESSION['user_id'];
$course_id = $_GET['course_id'];

$sql = "INSERT INTO user_courses (user_id, course_id) VALUES ($user_id, $course_id)";
$conn->query($sql);
header("Location: course.php?id=$course_id");
