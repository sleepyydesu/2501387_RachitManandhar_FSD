<?php
    $firstname = $lastname = $email = $password = "";
    $feedbacks = [
        "firstname" => "",
        "lastname" => "",
        "email" => "",
        "password" => "",
        "confirmPassword" => "",
        "feedback" => "",
    ];

    if (isset($_POST['submit'])) {
        $firstname = $lastname = $email = $password = "";
        $feedbacks = [
            "firstname" => "",
            "lastname" => "",
            "email" => "",
            "password" => "",
            "confirmPassword" => "",
            "feedback" => "",
        ];


        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // var_dump($_POST);
            $continue = true;

            if (empty($_POST["firstname"])) {
                $feedbacks["firstname"] = "Please enter first name";
                $continue = false;
            }
            
            if (empty($_POST["lastname"])) {
                $feedbacks["lastname"] = "Please enter last name";
                $continue = false;
            }

            if (empty($_POST["email"])) {
                $feedbacks["email"] = "Please enter your email";
                $continue = false;
            } 
            else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                $feedbacks["email"] = "Invalid email format";
                $continue = false;
            }


            if (empty($_POST["password"])) {
                $feedbacks["password"] = "Please enter your password";
                $continue = false;
            } 
            else if (empty($_POST["confirmPassword"])) {
                $feedbacks["confirmPassword"] = "Please re-enter your password";
                $continue = false;
            }
            else {
                if ($_POST["confirmPassword"] === $_POST["password"]) {
                    if (strlen($_POST["password"]) < 8) {
                        $feedbacks["password"] = "Password must be atleast 8 characters";
                        $continue = false;
                    }
                    if (!preg_match('/[\W]/', $_POST["password"])) {
                        $feedbacks["password"] = "Password must contain atleast one special character";
                        $continue = false;
                    }
                    if (!preg_match('/\d/', $_POST["password"])) {
                        $feedbacks["password"] = "Password must contain atleast one number";
                        $continue = false;
                    }
                    if (!preg_match('/[a-z]/', $_POST["password"])) {
                        $feedbacks["password"] = "Password must contain atleast one lowercase letter";
                        $continue = false;
                    }
                    if (!preg_match('/[A-Z]/', $_POST["password"])) {
                        $feedbacks["password"] = "Password must contain atleast one uppercase letter";
                        $continue = false;
                    }
                }
                else {
                    $feedbacks["confirmPassword"] = "Passwords do not match.";
                    $continue = false;
                }
            }

            if ($continue) {
                if (!file_exists("users.json")) {
                    $feedbacks["feedback"] = "File was not found!";
                    $continue = false;
                }

                if ($continue) {
                    $file = file_get_contents("users.json");
                    if ($file === false) {
                        $feedbacks["feedback"] = "Unable to read users file.";
                        $continue = false;
                    }
                }

                if ($continue) {
                    $data = json_decode($file, true);
                    if (json_last_error() !== JSON_ERROR_NONE) {
                        $feedbacks["feedback"] = "Invalid JSON format.";
                        $continue = false;
                    }

                    $newUser = [
                        "firstname" => $_POST["firstname"],
                        "lastname" => $_POST["lastname"],
                        "email" => $_POST["email"],
                        "password" => password_hash($_POST["password"], PASSWORD_DEFAULT)
                    ];

                    $data[] = $newUser;
                }

                if ($continue) {
                    $result = file_put_contents("users.json", json_encode($data, JSON_PRETTY_PRINT));
                    if ($result === false) {
                        $feedbacks["feedback"] = "Unable to save user details.";
                        $continue = false;
                    }
                }

                if ($continue) {
                    header("Location: registration.php?success=1");
                    exit;
                }
            }
        }
    }
    
    if (isset($_GET['success'])) {
        $feedbacks["feedback"] = "User registered successfully!";
    }
?>

<!DOCTYPE html>
<head>
  <meta charset="UTF-8">
  <title>User Registration</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div class="login-container">
    <h2>Registration</h2>
    <form action="" method="post">
      <div class="formName">
        <div class="formFName">
            <input id="fname" type="text" name="firstname" placeholder="First Name">
            <span class="error"><?php echo $feedbacks["firstname"]; ?></span>
        </div>
        <div class="formLName">
            <input id="lname" type="text" name="lastname" placeholder="Last Name">
            <span class="error"><?php echo $feedbacks["lastname"]; ?></span>
        </div>
      </div>
      <div class="formDetails">
        <div class="formEmail">
            <input id="email" type="text" name="email" placeholder="Email Address">
            <span class="error"><?php echo $feedbacks["email"]; ?></span>
        </div>
        <div class="formPassword">
            <input id="password" type="password" name="password" placeholder="Password">
            <span class="error"><?php echo $feedbacks["password"]; ?></span>
        </div>
        <div class="formPassword">
            <input id="confirmPassword" type="password" name="confirmPassword" placeholder="Confirm Password">
            <span class="error"><?php echo $feedbacks["confirmPassword"]; ?></span>
        </div>
      </div>
      <p id="feedback"><?php echo $feedbacks["feedback"]; ?></p>
      <button type="submit" name="submit">Register</button>
    </form>
  </div>
</body>
</html>