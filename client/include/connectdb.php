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
$landing_contact = "000-0000000";
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
if (isset($_POST['reg_user'])) {
  	// receive all input values from the form
	$client_id = mysqli_insert_id($db);
	$restname = mysqli_real_escape_string($db, $_POST['restname']);
	$username = mysqli_real_escape_string($db, $_POST['username']);
  	$email = mysqli_real_escape_string($db, $_POST['email']);
  	$password_1 = mysqli_real_escape_string($db, $_POST['pass1']);
  	$password_2 = mysqli_real_escape_string($db, $_POST['pass2']);

  	// form validation: ensure that the form is correctly filled ...
  	// by adding (array_push()) corresponding error unto $errors array
  	if (empty($username)) { array_push($errors, "Username is required."); }
  	if (empty($email)) { array_push($errors, "Email is required."); }
  	if (empty($password_1)) { array_push($errors, "Password is required."); }
  	if ($password_1 != $password_2) {
		array_push($errors, "The two passwords do not match.");
  	}

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
  		$password = base64_encode($password_1);//encrypt the password before saving in the database
  		$query = "INSERT INTO fos_client (client_username, client_email, client_pass, client_res_name, client_qr, date_created, created_by) 
  				  VALUES('$username', '$email', '$password', '$restname', 'false', '$datenow', 'USER')";
		mysqli_query($db, $query);
  		$query_user = "SELECT * FROM fos_client WHERE client_username='$username'";
  		$results = mysqli_query($db, $query_user);
		$user_info = mysqli_fetch_assoc($results);
		$client_uid_info = $user_info['uid'];
		$query_landing = "INSERT INTO fos_landing (client_uid, landing_desc, landing_location, landing_contact, landing_image, date_created) 
  				  VALUES('$client_uid_info', '$landing_desc', '$landing_location', '$landing_contact', '$landing_image', '$datenow')";
		mysqli_query($db, $query_landing);
		$query_cat = "INSERT INTO fos_cat (client_uid, cat_title, date_created) 
  				  VALUES('$client_uid_info', '$cat_title', '$datenow')";
  		mysqli_query($db, $query_cat);
  		$_SESSION['user_id'] = $user_info['uid'];
		$_SESSION['username'] = $username;
		$_SESSION['res_name'] = $user_info['client_res_name'];
  		$_SESSION['user_loggedin'] = "true";
  		header('location: index.php');
  	}
}

// LOGIN USER
if (isset($_POST['login_user'])) {
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
	$query = "SELECT * FROM fos_client WHERE client_username='$username' AND client_pass='$password' LIMIT 1";
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
	  	$_SESSION['res_name'] = $user['client_res_name'];
		$_SESSION['user_loggedin'] = "true";
		header('location: index.php');
		
	}else {
	  	array_push($errors, "Wrong username/password combination.");
	}
  }
}

//CONTACT FORM
if (isset($_POST['send_contact'])) {
	// $contact_id = str_pad($randNum, 6, "CT", STR_PAD_LEFT); //generate random number
	$contact_name = mysqli_real_escape_string($db, $_POST['contact_name']);
	$contact_email = mysqli_real_escape_string($db, $_POST['contact_email']);
	$contact_subject = mysqli_real_escape_string($db, $_POST['contact_subject']);
	$contact_message = mysqli_real_escape_string($db, $_POST['contact_msg']);

	if (empty($contact_name)) { array_push($errors, "* Name is required"); }
	if (empty($contact_email)) { array_push($errors, "* Email is required"); }
	if (empty($contact_subject)) { array_push($errors, "* Subject is required"); }
	if (empty($contact_message)) { array_push($errors, "* Message is required"); }

	// $user_check_query = "SELECT * FROM contact WHERE contact_id='$contact_id' LIMIT 1";
	// $result = mysqli_query($db, $user_check_query);
	// $id = mysqli_fetch_assoc($result);
	  
	// if ($id) { // if id exists
	//     if ($id['contact_id'] === $contact_id) {
	//       	$contact_id = str_pad($randNum, 6, "CT", STR_PAD_LEFT);
	//     }
	// }

	if ($_SESSION['user_role'] == 'USER') {
		$user_role = 'USER';
	}elseif ($_SESSION['user_role'] == 'ADMIN') {
		$user_role = 'ADMIN';
	}else{
		$user_role = 'NON-USER';
	}

	if (count($errors) == 0) {
		$query = "INSERT INTO contact (contact_name, contact_email, contact_subject, contact_message, contact_date_created, contact_created_by) 
				  VALUES('$contact_name', '$contact_email', '$contact_subject','$contact_message', '$datenow', '$user_role')";
	  	mysqli_query($db, $query);
	  	$_SESSION['success'] = "Your message has successfully sent. We will get back to you as soon as possible through email.";
	  	header('location: home.php');
 	}
	  
}

//PROFILE CHANGE EMAIL
if (isset($_POST['edit_profile'])) {
	$email_change = mysqli_real_escape_string($db, $_POST['email_change']);

	if (empty($email_change)) { array_push($errors, "* Email is required"); }

	$user_check_query = "SELECT * FROM user WHERE useremail='$email_change' LIMIT 1";
	$result = mysqli_query($db, $user_check_query);
	$user = mysqli_fetch_assoc($result);
	  
	if ($user) { // if user exists
	    if ($user['useremail'] === $email_change) {
	      array_push($errors, "* Email already exists");
	    }
	}

	if (count($errors) == 0) {
  	$query = "UPDATE user
			SET useremail = '$email_change'
			WHERE userid = '".$_SESSION['user_id']."'";
  	mysqli_query($db, $query);
  	$_SESSION['success'] = "Email has been successfully updated.";
  	header('location: home.php');
  }
}

//PROFILE CHANGE PASS
if (isset($_POST['edit_pass'])) {
	$current_user = mysqli_real_escape_string($db, $_SESSION['user_id']);
	$old_pass = mysqli_real_escape_string($db, $_POST['old_pass']);
	$change_password_1 = mysqli_real_escape_string($db, $_POST['change_password_1']);
  	$change_password_2 = mysqli_real_escape_string($db, $_POST['change_password_2']);

	if (empty($old_pass)) { array_push($errors, "* Old Password is required"); }
	if (empty($change_password_1)) { array_push($errors, "* Password is required"); }
	if (empty($change_password_2)) { array_push($errors, "* Confirm Password is required"); }
	if ($change_password_1 != $change_password_2) {
		array_push($errors, "* The two passwords do not match");
  	}

	$old_pass_check_query = "SELECT * FROM user WHERE userid='$current_user' LIMIT 1";
	$result = mysqli_query($db, $old_pass_check_query);
	$user = mysqli_fetch_assoc($result);
	if ($user) { // valid old pass
	    if ($user['userpass'] !== base64_encode($old_pass)) {
	      array_push($errors, "* Old password do not match");
	    }
	}

	if (count($errors) == 0) {
		$password = base64_encode($change_password_1);
  	$query = "UPDATE user
			SET userpass = '$password'
			WHERE userid = '".$_SESSION['user_id']."'";
  	mysqli_query($db, $query);
  	$_SESSION['success'] = "Password has been successfully updated. <br><b>Note</b>: changing your password will log you out of any sessions you may have in other browsers. This may cause you to lose any unsaved partlists in those sessions.";
  	header('location: home.php');
  }
}

// ADD NEW PRODUCT
if (isset($_POST['add_menu_item'])) {
 	// receive all input values from the form
	$client_uid = mysqli_real_escape_string($db, $_SESSION['user_id']);
 	$prod_name = mysqli_real_escape_string($db, $_POST['prod_name']);
	$prod_desc = mysqli_real_escape_string($db, $_POST['prod_desc']);
	$prod_price = mysqli_real_escape_string($db, $_POST['prod_price']);
	$target_dir = "assets/uploads/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

	// form validation: ensure that the form is correctly filled ...
	// by adding (array_push()) corresponding error unto $errors array
	if (empty($prod_name)) { array_push($errors, "* Product name is required"); }
	if (empty($prod_price)) { array_push($errors, "* Product price is required"); }

	// first check the database to make sure 
  	// an item does not already exist with the same name
  	$prod_check_query = "SELECT * FROM fos_prod WHERE prod_name='$prod_name' AND client_uid='$client_uid' LIMIT 1";
  	$result = mysqli_query($db, $prod_check_query);
  	$prod = mysqli_fetch_assoc($result);

  	if ($prod) { // if item exists
  	  	if ($prod['prod_name'] === $prod_name) {
  	    	array_push($errors, "* Product name already exists.");
  	  	}
  	}

	// Check if file already exists
	// if (file_exists($target_file)) {
	//     array_push($errors, "Sorry, file already exists.");
	//     $uploadOk = 0;
	// }

	// Check file size
	if ($_FILES["fileToUpload"]["size"] > 1000000) {
		array_push($errors, "Sorry, your file is too large.");
	}

	// // Allow certain file formats
	if(empty($_FILES["fileToUpload"]["name"])){
		$target_file = "assets/images/eco-product-img-1.png";
	}else{
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
			array_push($errors, "Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
		}
	}

	if (count($errors) == 0) {
		move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
		$query = "INSERT INTO fos_prod (client_uid, prod_name , prod_image, prod_desc, prod_price, date_created) 
				VALUES('$client_uid','$prod_name','$target_file','$prod_desc', '$prod_price','$datenow')";
		mysqli_query($db, $query);
		header('location: menu-items.php');
	}
}

// ADD NEW CATEGORY
if (isset($_POST['add_menu_cat'])) {
	// receive all input values from the form
   	$client_uid = mysqli_real_escape_string($db, $_SESSION['user_id']);
	$cat_name = mysqli_real_escape_string($db, $_POST['cat_name']);
   

   // form validation: ensure that the form is correctly filled ...
   // by adding (array_push()) corresponding error unto $errors array
   if (empty($cat_name)) { array_push($errors, "* Category name is required"); }

   // first check the database to make sure 
	 // an item does not already exist with the same name
	 $cat_check_query = "SELECT * FROM fos_cat WHERE cat_title='$cat_name' AND client_uid='$client_uid' LIMIT 1";
	 $result = mysqli_query($db, $cat_check_query);
	 $cat = mysqli_fetch_assoc($result);

	 if ($cat) { // if user exists
		   if ($prod['cat_title'] === $prod_name) {
			 array_push($errors, "Category Name already exists.");
		   }
	 }

   if (count($errors) == 0) {
	   $query = "INSERT INTO fos_cat (client_uid, cat_title, date_created) 
			   VALUES('$client_uid','$cat_name', '$datenow')";
	   mysqli_query($db, $query);
	   header('location: menu-categories.php');
   }
}
?>