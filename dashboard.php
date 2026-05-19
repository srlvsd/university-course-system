$sql = "SELECT c.* FROM courses c 
        JOIN user_courses uc ON c.id = uc.course_id 
        WHERE uc.user_id = $user_id";
$result = $conn->query($sql);
