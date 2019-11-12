<?php 
	session_start();
	// variable declaration
	$username = "";
	$email    = "";
	$errors = array(); 
	$_SESSION['success'] = "";

	// connect to database
	$db = mysqli_connect('localhost', 'root', '', 'dkut_scheduling_system');

	// LOGIN ADMINISTRATOR
	if (isset($_POST['login_admin'])) {
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
			$query = "SELECT * FROM admins WHERE username='$username' AND password='$password'";
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

	// ==== == = == ==REG ADMIN

	if (isset($_POST['reg_admin'])) {
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$email = mysqli_real_escape_string($db,$_POST['email']);
		$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
		$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

		if (empty($username)) { array_push($errors, "Username is required"); }
		if (empty($password_1)) { array_push($errors, "Password is required"); }

		if ($password_1 != $password_2) {
			array_push($errors, "The two passwords do not match");
		}

		if (count($errors) == 0) {
			$password = md5($password_1);//encrypt the password before saving in the database
			$query = "INSERT INTO admins (username, email, password) 
					  VALUES('$username', '$email', '$password')";
			mysqli_query($db, $query);

			$_SESSION['username'] = $username;
			$_SESSION['success'] = "You are now logged in";
			header('location: index.php');
		}
	}

	if (isset($_POST['reject'])) {
		$reason = mysqli_real_escape_string($db, $_POST['reason']);
		$bid= mysqli_real_escape_string($db,$_POST['bid']);

		if (empty($reason)) { array_push($errors, "You Have to add reason for rejection"); }

		if (count($errors) == 0) {//encrypt the password before saving in the database
			$query = "UPDATE bookings SET 
						status='REJECTED',
						reasonforrejection = '$reason'
						WHERE id = '$bid'
					";
			mysqli_query($db, $query);

			header('location: bookings.php');
		}
	}


	//rejister a specialist
	if (isset($_POST['add_doc'])) {
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$email = mysqli_real_escape_string($db,$_POST['email']);
		$categoryid = mysqli_real_escape_string($db, $_POST['category']);
		$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
		$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

		if (empty($email)) { array_push($errors, "Email is required"); }
		if (empty($username)) { array_push($errors, "Username is required"); }
		if (empty($password_1)) { array_push($errors, "Password is required"); }
		if (empty($categoryid)) { array_push($errors, "couldnt identify the category"); }

		if ($password_1 != $password_2) {
			array_push($errors, "The two passwords do not match");
		}

		//Loook for the category name 
		$result = $db->query("select * FROM categories WHERE id ='$categoryid'");
		while ($row = $result->fetch_assoc()) {
			// unset($category);
			$category = $row['catname'];       
		}

		if (count($errors) == 0) {
			$password = md5($password_1);//encrypt the password before saving in the database
			$query = "INSERT INTO doctors (username, email, categoryid, categoryname, password) 
					  VALUES('$username', '$email','$categoryid','$category','$password')";
			mysqli_query($db, $query);

			header('location: doctors.php');
		}
	}

?>