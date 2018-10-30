<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Welcome to Kompi Family</title>
	
</head>
<body>
		<h2>Login</h2>
		<form method="post" action="login.php">
		<?php include('errors.php'); ?>

			Username:</br>
			<input type="text" name="username" ></br>
			Password:</br>
			<input type="password" name="password"></br>
			<button type="submit"  name="login_user">Login</button>		
		<p>
			Not yet a member? <a href="register.php">Sign up</a>
		</p>
	</form>
</body>
</html>