<?php
session_start();

// Check if user is logged in
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

// Get user details from database
// Replace with your own code to fetch user details from your database
$user_id = $_SESSION["id"];
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "myDB";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM users WHERE id=$user_id";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
} else {
    echo "User not found.";
}

mysqli_close($conn);

?>

<!DOCTYPE html>
<html>
<head>
	<title>User Profile</title>
</head>
<body>
	<h2>Welcome, <?php echo $row['username']; ?>!</h2>
	<p>Email: <?php echo $row['email']; ?></p>
	<p>Full Name: <?php echo $row['full_name']; ?></p>
	
	<a href="logout.php">Logout</a>
</body>
</html>
