$check_sql = "SELECT * FROM user_courses WHERE user_id = $user_id AND course_id = $course_id";
if ($conn->query($check_sql)->num_rows === 0) {
    $conn->query($sql);
}

