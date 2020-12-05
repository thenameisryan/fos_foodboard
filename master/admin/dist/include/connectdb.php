<?php
session_start();
date_default_timezone_set("Asia/Kuala_Lumpur");
$datenow = date('d-m-Y H:i:s');
$hour = time() + 3600 * 24 * 30;
$errors = array(); 
$randNum = mt_rand(1, 9999);

//Defaults
/* Landing Page */
$landing_desc = "This is a default description. You are able to change this in the dashboard.";
$landing_location = "This is a default location. You are able to change this in the dashboard.";
$landing_contact = "(000) 000-0000";
$landing_image = "assets/landing-bg/card-img-3.jpg";
/* Categories */
$cat_title = "All";

// CONNECT TO THE DATABASE
$db = mysqli_connect('localhost', 'root', '', 'fos_foodboard');
//$livedb = mysqli_connect('us-cdbr-east-02.cleardb.com', 'b28d97703c10fa', '7a57ff43', 'fos-foodboard');
if (!$db) {
    die('Could not connect: ' . mysql_error());
}

// REGISTER USER
if (isset($_POST['reg_admin'])) {
	// receive all input values from the form
  $client_id = mysqli_insert_id($db);
  $restname = mysqli_real_escape_string($db, $_POST['restname']);
  $landing_desc = mysqli_real_escape_string($db, $_POST['res_desc']);
  $landing_location = mysqli_real_escape_string($db, $_POST['res_location']);
  $landing_contact = mysqli_real_escape_string($db, $_POST['res_contact']);
  $username = mysqli_real_escape_string($db, $_POST['username']);
	$email = mysqli_real_escape_string($db, $_POST['email']);
	$password_1 = mysqli_real_escape_string($db, $_POST['pass1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['pass2']);
  $target_dir = "client/assets/landing-bg/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

	// form validation: ensure that the form is correctly filled ...
	// by adding (array_push()) corresponding error unto $errors array
	if (empty($username)) { array_push($errors, "Username is required."); }
	if (empty($email)) { array_push($errors, "Email is required."); }
	if (empty($password_1)) { array_push($errors, "Password is required."); }
	if ($password_1 != $password_2) {
	  array_push($errors, "The two passwords do not match.");
	}
  if (empty(basename($_FILES["fileToUpload"]["name"]))) { $target_file = $landing_image . basename($_FILES["fileToUpload"]["name"]);  }

  // Check file size
  if ($_FILES["fileToUpload"]["size"] > 1000000) {
	  array_push($errors, "Sorry, your file is too large.");
  }
  // Allow certain file formats
  // if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  // && $imageFileType != "gif" ) {
  // 	array_push($errors, "Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
  // }

	// first check the database to make sure 
	// a user does not already exist with the same username and/or email and/or restaurant name
	$user_check_query = "SELECT * FROM fos_client WHERE client_username='$username' OR client_email='$email' OR client_res_name='$restname' LIMIT 1";
	$result = mysqli_query($db, $user_check_query);
	$user = mysqli_fetch_assoc($result);

	if ($user) { // if user exists
		  if ($user['client_username'] === $username) {
			array_push($errors, "Username already exists.");
		  }

		  if ($user['client_email'] === $email) {
			array_push($errors, "Email already exists.");
	  }

	  if ($user['client_res_name'] === $restname) {
		  array_push($errors, "Restaurant Name already exists.");
	  }
	}

	// register user if there are no errors in the form
	if (count($errors) == 0) {
	  move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
		$password = base64_encode($password_1);//encrypt the password before saving in the database
		$query = "INSERT INTO fos_client (client_username, client_email, client_pass, client_res_name, client_qr, date_created, created_by) 
				  VALUES('$username', '$email', '$password', '$restname', 'false', '$datenow', 'USER')";
	  mysqli_query($db, $query);
		$query_user = "SELECT * FROM fos_client WHERE client_username='$username'";
		$results = mysqli_query($db, $query_user);
	  $user_info = mysqli_fetch_assoc($results);
	  $client_uid_info = $user_info['uid'];
	  $query_landing = "INSERT INTO fos_landing (client_uid, landing_desc, landing_location, landing_contact, landing_image, date_created) 
				  VALUES('$client_uid_info', '$landing_desc', '$landing_location', '$landing_contact', '$target_file', '$datenow')";
	  mysqli_query($db, $query_landing);
	  $query_cat = "INSERT INTO fos_cat (client_uid, cat_title, date_created) 
				  VALUES('$client_uid_info', '$cat_title', '$datenow')";
		mysqli_query($db, $query_cat);
		header('location: client.php');
	}
}

// LOGIN USER
if (isset($_POST['login_admin'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
  	array_push($errors, "Username is required.");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required.");
  }

  //login user if there are no errors in the form
  if (count($errors) == 0) {
 	$password = base64_encode($password);
	$query = "SELECT * FROM fos_admin WHERE admin_username='$username' AND admin_pass='$password' LIMIT 1";
	$results = mysqli_query($db, $query);
	$user = mysqli_fetch_assoc($results);
	if (mysqli_num_rows($results) == 1) {
		if($_POST['remember_me']== '1' || $_POST['remember_me']== 'on'){
            setcookie('username', $username, $hour);
			setcookie('password', $password, $hour);
			setcookie('active', 'true', $hour);
        }
		$_SESSION['user_id'] = $user['uid'];
	  	$_SESSION['username'] = $username;
		$_SESSION['user_loggedin'] = "true";
		header('location: index.php');
		
	}else {
	  	array_push($errors, "Wrong username/password combination.");
	}
  }
}
?>