<?php
session_start();

// check if user is already logged in
if (isset($_SESSION['user_id'])) {
    header('Location: profile.php');
    exit;
}

// include database connection
require_once 'db.php';

// define variables and initialize with empty values
$username = $password = '';
$username_err = $password_err = '';

// process submitted form data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // validate username
    if (empty(trim($_POST['username']))) {
        $username_err = 'Please enter your username.';
    } else {
        $username = trim($_POST['username']);
    }

    // validate password
    if (empty(trim($_POST['password']))) {
        $password_err = 'Please enter your password.';
    } else {
        $password = trim($_POST['password']);
    }

    // if no errors, attempt to login
    if (empty($username_err) && empty($password_err)) {
        $sql = 'SELECT id, username, password FROM users WHERE username = ?';

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param('s', $param_username);

            $param_username = $username;

            if ($stmt->execute()) {
                $stmt->store_result();

                if ($stmt->num_rows == 1) {
                    $stmt->bind_result($id, $username, $hashed_password);

                    if ($stmt->fetch()) {
                        if (password_verify($password, $hashed_password)) {
                            session_start();

                            $_SESSION['user_id'] = $id;
                            $_SESSION['username'] = $username;

                            header('Location: profile.php');
                            exit;
                        } else {
                            $password_err = 'Invalid password.';
                        }
                    }
                } else {
                    $username_err = 'Invalid username.';
                }
            }
        }

        $stmt->close();
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?php echo $username; ?>">
        <span><?php echo $username_err; ?></span>
        <br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password">
        <span><?php echo $password_err; ?></span>
        <br><br>
        <input type="submit" name="submit" value="Login">
    </form>
    <p>Don't have an account? <a href="register.php">Register here</a>.</p>
</body>
</html>
