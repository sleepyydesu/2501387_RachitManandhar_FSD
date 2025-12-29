<?php
    require './db.php';

    $id = (int) $_GET['id'];

    $result = mysqli_query($conn, "SELECT * FROM students WHERE id = $id");
    $student = mysqli_fetch_assoc($result);

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $name   = $_GET['name'];
        $email  = $_GET['email'];
        $course = $_GET['course'];

        $stmt = mysqli_prepare(
            $conn,
            "UPDATE students 
            SET name = ?, email = ?, course = ?
            WHERE id = ?"
        );

        mysqli_stmt_bind_param($stmt, "sssi", $name, $email, $course, $id);
        mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);
    }
    
    header("Location: " . $_SERVER['HTTP_REFERER']);

?>