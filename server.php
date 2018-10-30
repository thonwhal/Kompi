<?php 
	session_start();

	
	$username = "";
	$email    = "";
	$errors = array(); 
	$_SESSION['success'] = "";

	
	$db = mysqli_connect('localhost', 'root', '', 'registration');

	
	if (isset($_POST['reg_user'])) {
		
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$name = mysqli_real_escape_string($db, $_POST['name']);
		$city = mysqli_real_escape_string($db, $_POST['city']);
		$bday = mysqli_real_escape_string($db, $_POST['bday']);
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
		$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

		
		if (empty($username)) { array_push($errors, "Username is required"); }
		if (empty($name)) { array_push($errors, "Name is required"); }
		if (empty($city)) { array_push($errors, "City is required"); }
		if (empty($bday)) { array_push($errors, "Birthday is required"); }
		if (empty($email)) { array_push($errors, "Email is required"); }
		if (empty($password_1)) { array_push($errors, "Password is required"); }
		
		if ($password_1 != $password_2) {
			array_push($errors, "The two passwords do not match");
		}
		
		if (count($errors) == 0) {
			$password = md5($password_1);
			$query = "INSERT INTO users (username, name, city, bday, email, password) 
					  VALUES('$username', '$name', '$city', '$bday', '$email', '$password')";
			mysqli_query($db, $query);

			$_SESSION['username'] =$name;
			$_SESSION['success'] = "You are now logged in";
			header('location: index.php');
		}

	}

	

	
	if (isset($_POST['login_user'])) {
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$password = mysqli_real_escape_string($db, $_POST['password']);

		if (empty($username)) {
			array_push($errors, "Username is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}

		if (count($errors) == 0) {
			$password = md5($password);
			$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
			$results = mysqli_query($db, $query);

			if (mysqli_num_rows($results) == 1) {
				$_SESSION['username'] = $username;
				$_SESSION['success'] = "You are now logged in";
				header('location: index.php');
			}else {
				array_push($errors, "Wrong username/password combination");
			}
		}
	}

?>