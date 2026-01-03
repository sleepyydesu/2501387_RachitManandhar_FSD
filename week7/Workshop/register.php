<?php
    require 'includes/db.php';
    require 'includes/header.php';

    $error = "";
    $success = "";

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $id = $_POST["student_id"];
        $name = $_POST["firstname"] . " " . $_POST["lastname"];
        $password = $_POST["password"];
        if(empty($id) || empty($name) || empty($password)) {
            $error = "Please fill all the fields.";
        }   else {
            try {
                $sql = "INSERT INTO students(student_id, full_name, password_hash) VALUES (:id, :name, :password)";
                $stmt = $pdo->prepare($sql);

                $stmt->execute([
                    ":id" => $id,
                    ":name" => $name,
                    ":password" => password_hash($password, PASSWORD_BCRYPT)
                ]);

                $success = "Student registered successfully!";
            } catch (PDOException $e) {
                $error = "Error: " . $e->getMessage();
            }
        }
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
                width: 400px;
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

            .formName {
                display: flex;
                gap: 10px;
            }

            .main input {
                width: 100%;
                margin: 12px 0;
                padding: 10px 5px;
                background: transparent;
                border: none;
                border-bottom: 2px solid rgba(255, 255, 255, 1);
                border-radius: 10px;
                color: black;
                font-size: 16px;
                resize: none;
                outline: none;
                transition: 0.3s ease;
                font-family: cursive;
            }

            .main input::placeholder {
                color: rgba(0, 0, 0 ,1);
                font-family: cursive;
            }

            .main input:hover {
                background: rgba(255, 255, 255, 0.35);
                transform: translateY(-2px);
                box-shadow: 0 5px 15px rgba(0,0,0,0.25);
            }

            .main input:focus {
                border-bottom: 2px solid rgba(0, 0, 0, 1);
            }

            .formDetails {
                display: flex;
                gap: 10px;
            }

            button {
                width: 100%;
                padding: 12px 0;
                margin-top: 15px;
                background: rgba(255, 255, 255, 0.25);
                border: none;
                border-radius: 8px;
                color: black;
                font-size: 17px;
                font-weight: bold;
                font-family: cursive;
                letter-spacing: 1px;
                backdrop-filter: blur(4px);
                cursor: pointer;
                transition: 0.3s ease;
            }

            button:hover {
                background: rgba(255, 255, 255, 0.35);
                transform: translateY(-2px);
                box-shadow: 0 5px 15px rgba(0,0,0,0.25);
            }

            button:active {
                transform: translateY(1px);
            }
        </style>
    </head>
    <body>
        <div class="main">
            <h2>Register</h2>
            <form action="" method="post">
                <div class="formDetails">
                    <input id="id" type="text" name="student_id" placeholder="Student ID">
                </div>
                <div class="formName">
                    <input id="fname" type="text" name="firstname" placeholder="First Name">
                    <input id="lname" type="text" name="lastname" placeholder="Last Name">
                </div>
                <input id="password" type="password" name="password" placeholder="Password">
                
                <?php if ($error): ?>
                    <p style="color:red; text-align:center;"><?php echo $error; ?></p>
                <?php endif; ?>

                <?php if ($success): ?>
                    <p style="color:green; text-align:center;"><?php echo $success; ?></p>
                <?php endif; ?>
                
                <button type="submit">Add</button>
            </form>
        </div>
    </body>
</html>