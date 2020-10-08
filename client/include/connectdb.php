<?php
session_start();
date_default_timezone_set("Asia/Kuala_Lumpur");
$datenow = date('d-m-Y H:i:s');
$hour = time() + 3600 * 24 * 30;
$errors = array(); 
$randNum = mt_rand(1, 9999);
//test

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
  		$query = "INSERT INTO fos_client (client_username, client_email, client_pass, client_res_name, date_created, created_by) 
  				  VALUES('$username', '$email', '$password', '$restname', '$datenow', 'USER')";
  		mysqli_query($db, $query);
  		$query = "SELECT * FROM fos_client WHERE username='$username'";
  		$results = mysqli_query($db, $query);
 		$user = mysqli_fetch_assoc($results);
  		$_SESSION['user_id'] = $user['uid'];
		$_SESSION['username'] = $username;
		$_SESSION['res_name'] = $user['client_res_name'];
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

// CREATE NEW USER
if (isset($_POST['create_new_user'])) {
  // receive all input values from the form
	$user_id = mysqli_insert_id($db);
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email_reg = mysqli_real_escape_string($db, $_POST['email']);
  $user_type = mysqli_real_escape_string($db, $_POST['user_type']);
  $user_role = mysqli_real_escape_string($db, $_SESSION['user_role']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "* Username is required"); }
  if (empty($email_reg)) { array_push($errors, "* Email is required"); }
  if (empty($user_type)) { array_push($errors, "* User Type is required"); }
  if (empty($password_1)) { array_push($errors, "* Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "* The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM user WHERE username='$username' OR useremail='$email_reg' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "* Username already exists");
    }

    if ($user['useremail'] === $email_reg) {
      array_push($errors, "* Email already exists");
    }
  }

  //register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = base64_encode($password_1);//encrypt the password before saving in the database
  	$query = "INSERT INTO user (username, useremail, userpass, user_type, date_created, created_by) 
  			  VALUES('$username', '$email_reg', '$password', '$user_type', '$datenow', '$user_role')";
  	mysqli_query($db, $query);
  	$_SESSION['success'] = "Successfully created new user.";
  	header('location: user_list.php');
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
  	echo $prod_check_query = "SELECT * FROM fos_prod WHERE prod_name='$prod_name' AND client_uid='$client_uid' LIMIT 1";
  	$result = mysqli_query($db, $prod_check_query);
  	$prod = mysqli_fetch_assoc($result);

  	if ($prod) { // if user exists
  	  	if ($prod['prod_name'] === $prod_name) {
  	    	array_push($errors, "Product Name already exists.");
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
// ADD NEW BLOG
if (isset($_POST['add_new_blog'])) {
 	// receive all input values from the form
 	$blog_title = mysqli_real_escape_string($db, $_POST['blog_title']);
 	$blog_desc = mysqli_real_escape_string($db, $_POST['blog_desc']);
 	$blog_author = mysqli_real_escape_string($db, $_POST['blog_author']);
 	$blog_cat = mysqli_real_escape_string($db, strtoupper($_POST['blog_cat']));
 	$user = mysqli_real_escape_string($db, $_SESSION['username']);
	$target_dir = "img/uploads/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($blog_title)) { array_push($errors, "* Blog title is required"); }
  if (empty($blog_desc)) { array_push($errors, "* Blog description is required"); }
  if (empty($blog_author)) { array_push($errors, "* Blog author is required"); }

// // Check if file already exists
// if (file_exists($target_file)) {
//     array_push($errors, "Sorry, file already exists.");
//     $uploadOk = 0;
// }
// Check file size
if ($_FILES["fileToUpload"]["size"] > 1000000) {
    array_push($errors, "Sorry, your file is too large.");
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
	array_push($errors, "Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
}

  if (count($errors) == 0) {
  	move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
  	$query = "INSERT INTO blog (blog_title, blog_image, blog_description, blog_category, blog_written_by, blog_date_created, blog_created_by) 
  			  VALUES('$blog_title','$target_file', '$blog_desc','$blog_cat', '$blog_author','$datenow','$user')";
  	mysqli_query($db, $query);
  	$_SESSION['success'] = "Successfully added new blog.";
  	header('location: blog_list.php');
  }
}
// BUILD
if (isset($_POST['submit_build'])) {
  // receive all input values from the form
  $cpu = mysqli_real_escape_string($db, $_POST['cpu']);
  $cpu_quantity = mysqli_real_escape_string($db, $_POST['quantity'][0]);
  $cpu_cooler = mysqli_real_escape_string($db, $_POST['cpucooler']);
  $cpucooler_quantity = mysqli_real_escape_string($db, $_POST['quantity'][1]);
  $ram = mysqli_real_escape_string($db, $_POST['ram']);
  $ram_quantity = mysqli_real_escape_string($db, $_POST['quantity'][2]);
  $motherboard = mysqli_real_escape_string($db, $_POST['mboard']);
  $mboard_quantity = mysqli_real_escape_string($db, $_POST['quantity'][3]);
  $graphics_card = mysqli_real_escape_string($db, $_POST['gcard']);
  $gcard_quantity = mysqli_real_escape_string($db, $_POST['quantity'][4]);
  $storage = mysqli_real_escape_string($db, $_POST['storage']);
  $storage_quantity = mysqli_real_escape_string($db, $_POST['quantity'][5]);
  $casing = mysqli_real_escape_string($db, $_POST['case']);
  $casing_quantity = mysqli_real_escape_string($db, $_POST['quantity'][6]);
  $power_supply = mysqli_real_escape_string($db, $_POST['powersup']);
  $powersup_quantity = mysqli_real_escape_string($db, $_POST['quantity'][7]);
  $optical_drive = mysqli_real_escape_string($db, $_POST['optdrive']);
  $optdrive_quantity = mysqli_real_escape_string($db, $_POST['quantity'][8]);
  $software = mysqli_real_escape_string($db, $_POST['software']);
  $software_quantity = mysqli_real_escape_string($db, $_POST['quantity'][9]);
  $monitor = mysqli_real_escape_string($db, $_POST['monitor']);
  $monitor_quantity = mysqli_real_escape_string($db, $_POST['quantity'][10]);
  $other = mysqli_real_escape_string($db, $_POST['other']);
  $other_quantity = mysqli_real_escape_string($db, $_POST['quantity'][11]);
  $user_id = mysqli_real_escape_string($db, $_SESSION['user_id']);
  //$total = ($cpu * $cpu_quantity) + ($cpu_cooler * $cpucooler_quantity) + ($ram * $ram_quantity) + ($motherboard * $mboard_quantity) + ($graphics_card * $gcard_quantity) + ($storage * $storage_quantity) + ($casing * $casing_quantity) + ($power_supply * $powersup_quantity) + ($optical_drive * $optdrive_quantity) + ($software * $software_quantity) + ($monitor * $monitor_quantity) + ($other * $other_quantity);
  
  // form validation:
  //if (empty($username)) { array_push($errors, "* Username is required"); }

  //register user if there are no errors in the form
  if (count($errors) == 0) {
  	if ($_SESSION['user_login'] == "true") {
  		$query = "INSERT INTO build(userid, cpu, cpu_quantity, cpu_cooler, cpucooler_quantity, ram, ram_quantity, motherboard, mboard_quantity, graphics_card, gcard_quantity, storage, storage_quantity, casing, casing_quantity, power_supply, powersup_quantity, optical_drive, optdrive_quantity, software, software_quantity, monitor, monitor_quantity, other, other_quantity, build_date_created) 
  			  VALUES('$user_id','$cpu', '$cpu_quantity', '$cpu_cooler', '$cpucooler_quantity', '$ram', '$ram_quantity', '$motherboard', '$mboard_quantity', '$graphics_card', '$gcard_quantity', '$storage', '$storage_quantity', '$casing', '$casing_quantity','$power_supply', '$powersup_quantity', '$optical_drive', '$optdrive_quantity', '$software', '$software_quantity', '$monitor', '$monitor_quantity', '$other', '$other_quantity','$datenow')";
  	mysqli_query($db, $query);
  	header('location: order.php');
  	}else{
  		//$query = "INSERT INTO temp_build(userid, cpu, cpu_quantity, cpu_cooler, cpucooler_quantity, ram, ram_quantity, motherboard, mboard_quantity, graphics_card, gcard_quantity, storage, storage_quantity, casing, casing_quantity, power_supply, powersup_quantity, optical_drive, optdrive_quantity, software, software_quantity, monitor, monitor_quantity, other, other_quantity, build_date_created) 
  			  //VALUES('$temp_user_id','$cpu', '$cpu_quantity', '$cpu_cooler', '$cpucooler_quantity', '$ram', '$ram_quantity', '$motherboard', '$mboard_quantity', '$graphics_card', '$gcard_quantity', '$storage', '$storage_quantity', '$casing', '$casing_quantity','$power_supply', '$powersup_quantity', '$optical_drive', '$optdrive_quantity', '$software', '$software_quantity', '$monitor', '$monitor_quantity', '$other', '$other_quantity','$datenow')";
  		//mysqli_query($db, $query);
  		//header('location: login.php');
  	}
  }
}
?>