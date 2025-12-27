<?php 

    function formatName($name) {
        return trim($name);
    }

    function validateEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
    
    function saveStudent($name, $email, $course, $conn) {
        $name  = mysqli_real_escape_string($conn, $name);
        $email = mysqli_real_escape_string($conn, $email);
        $course  = mysqli_real_escape_string($conn, $course);

        $sql = "INSERT INTO students (name, email, course) VALUES ('$name', '$email', '$course')";

        $result = mysqli_query($conn, $sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
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