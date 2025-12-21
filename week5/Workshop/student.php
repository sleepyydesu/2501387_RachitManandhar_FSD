<?php
    include 'includes/header.php';
    require 'includes/functions.php';

    $message = "";

    $studentsFile = 'students.txt';
    $students = [];

    if (file_exists($studentsFile)) {
        $lines = file($studentsFile);

        foreach ($lines as $line) {
            list($name, $email, $skillsString) = explode(';', $line);

            $students[] = [
                'name'   => $name,
                'email'  => $email,
                'skills' => cleanSkills($skillsString)
            ];
        }
    }
    else {
        $message = "<p style='color:red;text-align:center;'>Error reading the file.</p>";
    }
?>

<html>
    <head>
        <style>
            body {
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .main {
                width: 800px;
                max-width: 90%;
                background: rgba(255, 255, 255, 0.15);
                backdrop-filter: blur(12px);
                border: 1px solid rgba(255, 255, 255, 0.25);
                border-radius: 15px;
                box-shadow: 0 4px 25px rgba(0,0,0,0.35);
                padding: 30px;
            }

            .main h2 {
                text-align: center;
                margin-bottom: 25px;
                color: black;
                font-family: cursive;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 25px;
            }

            th, td {
                border: 1px solid black; 
                padding: 10px;
                text-align: left;
                vertical-align: top;
                font-family: cursive;
            }

            td ul {
                margin-left: 0;
                padding-left: 18px;
            }

            td ul li {
                line-height: 1.4;
                font-size: 14px;
                font-family: cursive;
            }


        </style>
    </head>
    <body>
        <div class="main">
            <h2>Students:</h2>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Skills</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($students)): ?>
                        <?php foreach ($students as $student): ?>
                            <tr>
                                <td><?= htmlspecialchars($student['name']) ?></td>
                                <td><?= htmlspecialchars($student['email']) ?></td>
                                <td>
                                    <ul>
                                        <?php foreach ($student['skills'] as $skill): ?>
                                            <li><?= htmlspecialchars($skill) ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3" style="text-align: center;">No students found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <?php if (!empty($message)) echo $message; ?>
        </div>
    </body>
</html>

<?php
    include 'includes/footer.php';
?>