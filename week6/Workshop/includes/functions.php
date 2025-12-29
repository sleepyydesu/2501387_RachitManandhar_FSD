<?php 

    function formatName($name) {
        return trim($name);
    }

    function validateEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
    
    function saveStudent($name, $email, $course, $conn)
    {
        $stmt = mysqli_prepare(
            $conn,
            "INSERT INTO students (name, email, course) VALUES (?, ?, ?)"
        );

        if (!$stmt) {
            return false;
        }

        mysqli_stmt_bind_param($stmt, "sss", $name, $email, $course);

        $result = mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);

        return $result;
    }

    function fetchStudents($conn) {
        $students = [];

        $sql = "SELECT * from students ORDER BY id DESC";
        $result = mysqli_query($conn, $sql);

        if (!$result) {
            return $students;
        }

        while ($row = mysqli_fetch_assoc($result)) {
            $students[] = $row;
        }

        return $students;
    }

?>