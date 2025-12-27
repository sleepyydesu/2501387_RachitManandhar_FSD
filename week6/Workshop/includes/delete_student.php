<?php
    require './db.php';

    if (isset($_GET['id'])) {
        $id = (int) $_GET['id'];

        mysqli_query($conn, "DELETE FROM students WHERE id = $id");
    }

    header("Location: " . $_SERVER['HTTP_REFERER']);
    
?>