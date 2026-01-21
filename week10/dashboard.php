<?php

require 'session.php';
require 'db.php';

$user_email = '';

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT email FROM users WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user_id]);
    $user = $stmt->fetch();
    if ($user) {
        $user_email = $user['email'];
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ($_POST["csrf_token"] == $_SESSION["csrf_token"]) {
        $_SESSION = [];

        session_destroy();

        header("Location: dashboard.php");
        exit;
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>

<h1>Welcome to my site</h1>
<?php if ($user_email): ?>
    <p>Logged In User : <?php echo htmlspecialchars($user_email); ?></p>
<?php endif; ?>

<?php if(!isset($_SESSION['user_id'])): ?>
    <a href="login.php">
        <button>Login</button>
    </a>
<?php else: ?>
    <form method="POST">
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <button type="submit">Logout</button>
    </form>
<?php endif; ?>

</body>
</html>
