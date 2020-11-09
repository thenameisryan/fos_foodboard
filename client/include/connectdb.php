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
if (isset($_POST['reg_user'])) {
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
	$target_dir = "assets/landing-bg/";
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

//REVIEW FORM
if (isset($_POST['submit_review'])) {
	$reviewer_rating = mysqli_real_escape_string($db, $_POST['reviewer_rating']);
	$reviewer_review = mysqli_real_escape_string($db, $_POST['reviewer_review']);
	$res_id = mysqli_real_escape_string($db, $_POST['res_id']);

	if (count($errors) == 0) {
		$query = "INSERT INTO fos_review (client_uid, review_stars, review_content, date_created) 
				  VALUES('$res_id', '$reviewer_rating', '$reviewer_review', '$datenow')";
	  	mysqli_query($db, $query);
	  	header('location: cus-landing.php?r=' . $res_id);
 	}
	  
}

//PROFILE CHANGE EMAIL
if (isset($_POST['edit_profile'])) {
	$email_change = mysqli_real_escape_string($db, $_POST['email_change']);

	if (empty($email_change)) { array_push($errors, "* Email is required"); }

	$user_check_query = "SELECT * FROM fos_client WHERE client_email='$email_change' LIMIT 1";
	$result = mysqli_query($db, $user_check_query);
	$user = mysqli_fetch_assoc($result);
	  
	if ($user) { // if user exists
	    if ($user['client_email'] === $email_change) {
	      array_push($errors, "* Email already exists");
	    }
	}

	if (count($errors) == 0) {
  	$query = "UPDATE fos_client
			SET client_email = '$email_change'
			WHERE uid = '".$_SESSION['user_id']."'";
  	mysqli_query($db, $query);
  	header('location: profile.php');
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

	$old_pass_check_query = "SELECT * FROM fos_client WHERE uid='$current_user' LIMIT 1";
	$result = mysqli_query($db, $old_pass_check_query);
	$user = mysqli_fetch_assoc($result);
	if ($user) { // valid old pass
	    if ($user['client_pass'] !== base64_encode($old_pass)) {
	      array_push($errors, "* Old password do not match");
	    }
	}

	if (count($errors) == 0) {
		$password = base64_encode($change_password_1);
  	$query = "UPDATE fos_client
			SET client_pass = '$password'
			WHERE uid = '".$_SESSION['user_id']."'";
  	mysqli_query($db, $query);
  	header('location: index.php');
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
/*
  Accept email of user whose password is to be reset
  Send email to user to reset their password
*/
if (isset($_POST['forgot_password'])) {
	$email = mysqli_real_escape_string($db, $_POST['email']);
	// ensure that the user exists on our system
	$query = "SELECT client_email FROM fos_client WHERE client_email='$email'";
	$results = mysqli_query($db, $query);
  
	if (empty($email)) {
	  array_push($errors, "Your email is required");
	}else if(mysqli_num_rows($results) <= 0) {
	  array_push($errors, "Sorry, no user exists on our system with that email");
	}
	// generate a unique random token of length 100
	$token = bin2hex(random_bytes(50));
  
	if (count($errors) == 0) {
		// store token in the password-reset database table against the user's email
		$sql = "INSERT INTO fos_rcvrpass(email, token) VALUES ('$email', '$token')";
		$results = mysqli_query($db, $sql);
	
		// Send email to user with the token in a link they can click on
		// $to = $email;
		$subject = "Reset your password on foodboard.com";
		$email_body = "Hi there, click on this <a href=\"localhost/fos_foodboard/client/new-password.php?token=" . $token . "\">link</a> to reset your password on our site";
		// $msg = wordwrap($msg,70);
		// $headers = "From: info@foodboard.com";
		// mail($to, $subject, $msg, $headers);
		require_once('assets/vendor/PHPMailer/PHPMailerAutoload.php');
	  	$mail = new PHPMailer();
    	$mail->isSMTP();
    	$mail->SMTPAuth = true;
    	$mail->SMTPSecure = 'ssl';
    	$mail->Host = 'smtp.gmail.com';
    	$mail->Port = '465';
    	$mail->isHTML();
    	$mail->Username = 'officialfoodboard@gmail.com';
    	$mail->Password = 'foodboard2020';
    	$mail->SetFrom('no-reply@foodboard.com');
    	$mail->Subject = 'Reset your password on foodboard.com';
    	$mail->Body = $email_body;
    	$mail->AddAddress($email);
		$mail->Send();
		header('location: pending.php?email=' . $email);
	}
}
  
// ENTER A NEW PASSWORD
if (isset($_POST['new_password'])) {
	$new_pass = mysqli_real_escape_string($db, $_POST['new_pass']);
	$new_pass_c = mysqli_real_escape_string($db, $_POST['new_pass_c']);
	$token = mysqli_real_escape_string($db,$_POST['token']);
  
	if (empty($new_pass) || empty($new_pass_c)) array_push($errors, "Password is required");
	if ($new_pass !== $new_pass_c) array_push($errors, "Password do not match");
	if (count($errors) == 0) {
	  // select email address of user from the password_reset table 
	  $sql = "SELECT * FROM fos_rcvrpass WHERE token='$token' LIMIT 1";
	  $results = mysqli_query($db, $sql);
	  $email = mysqli_fetch_assoc($results)['email'];
  
	  if ($email) {
		$new_pass = base64_encode($new_pass);
		$sql = "UPDATE fos_client SET client_pass='$new_pass' WHERE client_email='$email'";
		$results = mysqli_query($db, $sql);
		header('location: login.php');
	  }
	}
}

if (isset($_POST['submit_order'])) {
	header('location: client/payment.php');
}
?>