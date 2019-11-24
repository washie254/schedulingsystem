<?php 
	date_default_timezone_set("Africa/Nairobi");
	session_start();
	// variable declaration
	$username = "";
	$email    = "";
	$errors = array(); 
	$_SESSION['success'] = "";

	// connect to database
	$db = mysqli_connect('localhost', 'root', '', 'dkut_scheduling_system');

	// LOGIN ADMINISTRATOR
	if (isset($_POST['login_specialist'])) {
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
			$query = "SELECT * FROM doctors WHERE username='$username' AND password='$password'";
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

	if (isset($_POST['update_info'])) {
		$uname = mysqli_real_escape_string($db, $_POST['uname']);
		$fname = mysqli_real_escape_string($db, $_POST['fname']);
		$lname = mysqli_real_escape_string($db, $_POST['lname']);
		$phone = mysqli_real_escape_string($db, $_POST['phone']);
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$aboutdoc =mysqli_real_escape_string($db, $_POST['aboutdoc']);
		$docid =mysqli_real_escape_string($db, $_POST['uid']);

		if (empty($fname)) { array_push($errors, "First name is required"); }
		if (empty($lname)) { array_push($errors, "Last Name is required"); }
		if (empty($phone)) { array_push($errors, "Phone Required"); }

		// form validation: ensure that the form is correctly filled
		function validate_phone_number($phone)
		{
			// Allow +, - and . in phone number
			$filtered_phone_number = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
			// Remove "-" from number
			$phone_to_check = str_replace("-", "", $filtered_phone_number);
			// Check the lenght of number
			// This can be customized if you want phone number from a specific country
			if (strlen($phone_to_check) < 9 || strlen($phone_to_check) > 14) {
			return false;
			} else {
			return true;
			}
		}
		//VALIDATE PHONE NUMBER 
		if (validate_phone_number($phone) !=true) {
			array_push($errors, "Invalid phone number");
		}

		if (count($errors) == 0) {
			$query = "UPDATE doctors
						SET
							username = '$uname',
							email ='$email',
							fname = '$fname',	
							lname = '$lname',
							telno	= '$phone',
							aboutdoc = '$aboutdoc'
						
						WHERE id ='$docid'";
			$result = mysqli_query($db, $query);
			$_SESSION['username'] = $uname;
			header('location:profile.php');
		}

	}
	
	//ALLOCATE TIME
	if (isset($_POST['allocatetime'])) {
		$sid = mysqli_real_escape_string($db, $_POST['sid']);
		$time = mysqli_real_escape_string($db, $_POST['allocatedtime']);
		$instructions = mysqli_real_escape_string($db, $_POST['instructions']);
		$status ='SCHEDULED TIME';

		if (empty($sid)) { array_push($errors, "cannot resolve the schedule id"); }
		if (empty($time)) { array_push($errors, "award a time"); }
		if (empty($instructions)) { array_push($errors, "provide some notes or instructions for the client to follow"); }

		
		if (count($errors) == 0) {
			$query = "UPDATE schedules
						SET
							time_scheduled = '$time',
							status ='$status',
							remarks = '$instructions'
						
						WHERE id ='$sid'";
			$result = mysqli_query($db, $query);
			header('location:schedules.php');
		}

	}
?>