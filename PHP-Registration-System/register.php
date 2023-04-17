<!DOCTYPE html>
<html>
<head>
	<title>Registration Form</title>
</head>
<body>
	<h2>Registration Form</h2>
	<form method="post" action="register.php">
		<label for="username">Username:</label>
		<input type="text" id="username" name="username" required><br><br>
		
		<label for="email">Email:</label>
		<input type="email" id="email" name="email" required><br><br>
		
		<label for="password">Password:</label>
		<input type="password" id="password" name="password" required><br><br>
		
		<label for="confirm_password">Confirm Password:</label>
		<input type="password" id="confirm_password" name="confirm_password" required><br><br>
		
		<label for="captcha">Captcha:</label>
		<input type="text" id="captcha" name="captcha" required><br><br>
		
		<input type="hidden" name="csrf_token" value="<?php echo bin2hex(openssl_random_pseudo_bytes(16)); ?>">
		
		<input type="submit" name="submit" value="Register">
	</form>
</body>
</html>
