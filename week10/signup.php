<?php

require 'db.php';

$message = '';

try {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        if (!$email) {
            throw new Exception("Invalid emaill address");
        }

        $password = $_POST["password"];
        if (!isset($password)) {
            throw new Exception("Password is empty.");
        } else if (strlen($password) < 8) {
            throw new Exception("Password must be of at least 8 characters.");
        }
        
        $password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (email, password) VALUES (?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email, $password]);

        $message = "User signed up successfully";
        header('refresh: 2; url=login.php');
    }

} catch (Exception $e) {
    $message = "Something went wrong.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>
</head>
<body>

<h2>Signup</h2>

<?php if ($message): ?>
    <p><?php echo $message; ?></p>
<?php endif; ?>

<form method="POST">
    <label>Email:</label><br>
    <input type="text" name="email"><br><br>

    <label>Password:</label><br>
    <input type="password" name="password"><br><br>

    <button type="submit">Signup</button>
</form>

<br>
<a href="login.php">Go to Login</a>

</body>
</html>
