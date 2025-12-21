<?php
    include 'includes/header.php';
    require 'includes/functions.php';

    $error = "";
    $success = "";

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        try {
            $firstName = $_POST['firstname'] ?? '';
            $lastName  = $_POST['lastname'] ?? '';
            $email     = $_POST['email'] ?? '';
            $skillsStr = $_POST['skills'] ?? '';

            if (empty($firstName) || empty($lastName) || empty($email) || empty($skillsStr)) {
                throw new Exception("All fields are required.");
            }

            $fullName = formatName($firstName . " " . $lastName);

            if (!validateEmail($email)) {
                throw new Exception("Invalid email address.");
            }

            $skillsArray = cleanSkills($skillsStr);

            if (count($skillsArray) === 0) {
                throw new Exception("Please enter at least one skill.");
            }

            saveStudent($fullName, $email, $skillsArray);

            $success = "Student added successfully!";
        } catch (Exception $e) {
            $error = $e->getMessage();
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

            #skills {
                height: 50px;
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
            <h2>Add Student</h2>
            <form action="" method="post">
                <div class="formName">
                    <input id="fname" type="text" name="firstname" placeholder="First Name">
                    <input id="lname" type="text" name="lastname" placeholder="Last Name">
                </div>
                <div class="formDetails">
                    <input id="email" type="email" name="email" placeholder="Email Address">
                </div>
                <input id="skills" type="text" name="skills" placeholder="Skills (Comma-separated)">
                
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

<?php
    include 'includes/footer.php';
?>