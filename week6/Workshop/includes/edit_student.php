<?php
    require './db.php';

    $id = (int) $_GET['id'];

    $result = mysqli_query($conn, "SELECT * FROM students WHERE id = $id");
    $student = mysqli_fetch_assoc($result);

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $name   = $_GET['name'];
        $email  = $_GET['email'];
        $course = $_GET['course'];

        mysqli_query(
            $conn,
            "UPDATE students 
            SET name='$name', email='$email', course='$course' 
            WHERE id=$id"
        );

    }
    
    header("Location: " . $_SERVER['HTTP_REFERER']);

?>