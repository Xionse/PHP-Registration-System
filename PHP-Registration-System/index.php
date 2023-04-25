<?php
    // Start a session to maintain user login state
    session_start();
    
    // Include/include the necessary files.
    require_once('config.php');
    require_once('db.php');
    require_once('functions.php');
    
    // Check if the user is already logged in
    if (isset($_SESSION['user_id'])) {
        header("Location: profile.php");
        exit();
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>PHP Registration System. </title>
        <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    </head>
    <body>
        <div class="container">
            <h1>Welcome to the PHP Registration System</h1>
            <p>Please register or log in to continue.</p>
            <div class="buttons">
                <a href="register.php" class="btn">Register</a>
                <a href="login.php" class="btn">Log In</a>
            </div>
        </div>
    </body>
</html>
