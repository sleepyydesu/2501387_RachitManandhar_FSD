<?php
    include 'includes/header.php';
?>

<html>
    <head>
        <title>Student Portfolio Manager</title>
        <style>
            body {
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .main {
                width: 400px;
                background: rgba(255, 255, 255, 0.15);
                backdrop-filter: blur(12px);
                border: 1px solid rgba(255, 255, 255, 0.25);
                border-radius: 15px;
                box-shadow: 0 4px 25px rgba(0,0,0,0.35);
                padding: 30px;
            }
            
            h1 {
                text-align: center;
                font-family: cursive;
            }

            .functions {
                display: flex;
                flex-direction: column;
                margin-top: 2rem;
            }

            .functions a {
                margin-bottom: 25px;
                padding: 20px 0;
                background: rgba(255, 255, 255, 1);
                border: 1px solid black;
                text-align: center;
                border-radius: 10px;
                transition: 0.3s ease;
            }

            .functions a:hover {
                transform: scale(1.08);
                background: rgba(204, 220, 225, 0.75);
            }
        </style>
    </head>
    <body>
        <div class="main">
            <h1>WELCOME</h1>
            <div class="functions">
                <a href="add_student.php">Add Student</a>
                <a href="upload.php">Upload File</a>
                <a href="student.php">View Students</a>
            </div>
        </div>
    </body>
</html>

<?php
    include 'includes/footer.php';
?>