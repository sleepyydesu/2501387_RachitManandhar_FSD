<html>
    <head>
        <style>
            .header {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                display: flex;
                justify-content: space-evenly;
                gap: 5%;
            }

            .Hlinks {
                display: flex;
                justify-content: space-evenly;
                align-items: center;
                width: 20%;
                gap: 5%;
            }

            a {
                text-decoration: none;
                color: black;
                font-family: cursive;
            }
        </style>
    </head>
    <body>
        <div class="header">
            <a href="index.php"><h2>Student Portfolio Manager</h2></a>
            <div class="Hlinks">
                <a href="add_student.php">Add Student</a>
                <a href="upload.php">Upload File</a>
                <a href="student.php">View Students</a>
            </div>
        </div>
    </body>
</html>