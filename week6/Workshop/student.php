<?php
    include 'includes/header.php';
    require 'includes/functions.php';
    require 'includes/db.php';

    $message = "";

    $students = fetchStudents($conn);


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

            .edit {
                margin-left: 5px;
            }

            .edit, .delete {
                margin-top: 5px;
                height: 24px;
            }

            .separate {
                font-size: 26px;
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
                        <th>Edit/Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($students)): ?>
                        <?php foreach ($students as $student): ?>
                            <tr>
                                <td><?= htmlspecialchars($student['name']) ?></td>
                                <td><?= htmlspecialchars($student['email']) ?></td>
                                <td><?= htmlspecialchars($student['course']) ?></td>
                                <td>
                                    <a href="#" onclick="
                                        let name = prompt('Edit name:', '<?= htmlspecialchars($student['name'], ENT_QUOTES) ?>');

                                        let email = prompt('Edit email:', '<?= htmlspecialchars($student['email'], ENT_QUOTES) ?>');

                                        let course = prompt('Edit course:', '<?= htmlspecialchars($student['course'], ENT_QUOTES) ?>');

                                        window.location.href =
                                        'includes/edit_student.php?id=<?= $student['id'] ?>' +
                                        '&name=' + encodeURIComponent(name) +
                                        '&email=' + encodeURIComponent(email) +
                                        '&course=' + encodeURIComponent(course);

                                        return false;
                                    "><img class="edit" src="includes/icons/edit.png"></a>
                                    <span class="separate">|</span>
                                    <a href="includes/delete_student.php?id=<?= $student['id'] ?>"><img class="delete" src="includes/icons/delete.png"></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" style="text-align:center;">No students found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <?php if (!empty($message)) echo $message; ?>
        </div>
    </body>
</html>