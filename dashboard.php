$sql = "SELECT c.* FROM courses c 
        JOIN user_courses uc ON c.id = uc.course_id 
        WHERE uc.user_id = $user_id";
$result = $conn->query($sql);

echo "<h1>Dashboard</h1>";

if ($result->num_rows > 0) {

    echo "<ul>";

    while($course = $result->fetch_assoc()) {

        echo "<li>{$course['title']}</li>";

    }

    echo "</ul>";

} else {

    echo "<p>
    You are not enrolled in any courses yet.
    <a href='index.php'>Browse courses</a>
    </p>";

}
