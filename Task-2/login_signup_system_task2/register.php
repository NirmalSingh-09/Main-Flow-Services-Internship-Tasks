<?php
session_start();
// If already logged in, redirect to home
if (isset($_SESSION['account_loggedin'])) {
    header('Location: home.php');
    exit;
}

// Database connection details
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'phplogin';

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check required fields
    if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])) {
        $message = 'Please fill in all fields!';
    } else {
        // Check if username already exists
        if ($stmt = $con->prepare('SELECT id FROM accounts WHERE username = ?')) {
            $stmt->bind_param('s', $_POST['username']);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $message = 'Username already taken!';
            } else {
                // Insert new account
                if ($stmt = $con->prepare('INSERT INTO accounts (username, password, email, registered) VALUES (?, ?, ?, NOW())')) {
                    $password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    $stmt->bind_param('sss', $_POST['username'], $password_hash, $_POST['email']);
                    $stmt->execute();
                    header('Location: index.php?registered=1');
                    exit;
                } else {
                    $message = 'Could not prepare statement!';
                }
            }
            $stmt->close();
        } else {
            $message = 'Could not prepare statement!';
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,minimum-scale=1" />
    <title>Register</title>
    <link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="register">
    <h1>Create Account</h1>

    <?php if ($message): ?>
        <p style="color:red; text-align:center;"><?=htmlspecialchars($message)?></p>
    <?php endif; ?>

    <form action="register.php" method="post" class="form register-form">
        <label class="form-label" for="username">Username</label>
        <input class="form-input" type="text" name="username" id="username" placeholder="Choose a username" required />

        <label class="form-label" for="email">Email</label>
        <input class="form-input" type="email" name="email" id="email" placeholder="Your email address" required />

        <label class="form-label" for="password">Password</label>
        <input class="form-input" type="password" name="password" id="password" placeholder="Choose a password" required />

        <button class="btn blue" type="submit">Register</button>

        <p class="register-link">Already have an account? <a href="index.php" class="form-link">Login</a></p>
    </form>
</div>
</body>
</html>
