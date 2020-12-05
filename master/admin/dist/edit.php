<?php
include("include/connectdb.php");

//EDIT LANDING PAGE
if (isset($_POST['edit_res'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $pass1 = mysqli_real_escape_string($db, $_POST['pass1']);
    $pass2 = mysqli_real_escape_string($db, $_POST['pass2']);
    $res_name = mysqli_real_escape_string($db, $_POST['restname']);
	$res_desc = mysqli_real_escape_string($db, $_POST['res_desc']);
	$res_location = mysqli_real_escape_string($db, $_POST['res_location']);
	$res_contact = mysqli_real_escape_string($db, $_POST['res_contact']);
	$id_res = mysqli_real_escape_string($db, $_GET['id']);
	$target_dir = "client/assets/landing-bg/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

	if (empty(basename($_FILES["fileToUpload"]["name"]))) { array_push($errors, "* Landing Background Image is required"); }

	// Check file size
	if ($_FILES["fileToUpload"]["size"] > 1000000) {
	    array_push($errors, "Sorry, your file is too large.");
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
		array_push($errors, "Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
    }
    if ($pass1 != $pass2) {
		array_push($errors, "The two passwords do not match.");
	  }
	if (count($errors) == 0) {
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
    $password = base64_encode($pass1);
  	$query = "UPDATE fos_landing
			SET landing_desc = '$res_desc',
			landing_location = '$res_location',
			landing_contact = '$res_contact',
			landing_image = '$target_file',
			date_edited = '$datenow'
			WHERE client_uid = '".$id_res."'";
      mysqli_query($db, $query);
    $query2 = "UPDATE fos_client
			SET client_res_name = '$res_name',
			client_username = '$username',
            client_email = '$email',
			client_pass = '$password'
			WHERE uid = '".$id_res."'";
  	mysqli_query($db, $query2);
  	header('location: client.php');
  	}
}

$qry_landing = "SELECT * FROM fos_client
                INNER JOIN fos_landing ON fos_client.uid = fos_landing.client_uid 
                WHERE client_uid = '".$_GET['id']."'";  
$result = mysqli_query($db, $qry_landing);
$landing = mysqli_fetch_assoc($result);

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Edit Restaurant - FoodBoard Admin</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <!-- NAVBAR -->
        <?php include("include/navbar.html"); ?>
        <div id="layoutSidenav">
        <!-- SIDEBAR -->
        <?php include("include/sidebar.html"); ?>
        <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                    <h1 class="mt-4">Edit Restaurant</h1>
                        <div class="row">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Edit Restaurant Form</h3></div>
                                    <div class="card-body">
                                        <form method="post" action="" enctype="multipart/form-data">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputUsername">Username</label>
                                                        <input class="form-control py-4" id="inputFirstName" type="text" name="username" placeholder="Enter username" value="<?php if(isset($_POST['username'])) {echo $_POST['username'];}else{ echo $landing['client_username'];}?>" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputEmail">E-mail</label>
                                                        <input class="form-control py-4" id="inputLastName" type="text" name="email" aria-describedby="emailHelp" placeholder="Enter e-mail" value="<?php if(isset($_POST['email'])) {echo $_POST['email'];}else{ echo $landing['client_email'];}?>" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputPassword">Password</label>
                                                        <input class="form-control py-4" id="inputPassword" type="text" name="pass1" placeholder="Enter password" value="<?php if(isset($_POST['pass1'])) {echo $_POST['pass1'];}else{ echo base64_decode($landing['client_pass']);}?>" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputConfirmPassword">Confirm Password</label>
                                                        <input class="form-control py-4" id="inputConfirmPassword" type="text" name="pass2" placeholder="Confirm password" value="<?php if(isset($_POST['pass2'])) {echo $_POST['pass2'];}else{ echo base64_decode($landing['client_pass']);}?>" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputRestaurantName">Restaurant Name</label>
                                                <input class="form-control py-4" id="inputEmailAddress" type="text" name="restname" placeholder="Enter restaurant name" value="<?php if(isset($_POST['restname'])) {echo $_POST['restname'];}else{ echo $landing['client_res_name'];}?>" />
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputRestaurantContact">Restaurant Contact</label>
                                                <input class="form-control py-4" id="inputEmailAddress" type="text" name="res_contact" placeholder="Enter restaurant contact" value="<?php echo $landing['landing_contact']; ?>" />
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="exampleFormControlTextarea1">Restaurant Description</label>
                                                <textarea class="form-control form-control-lg" id="exampleFormControlTextarea1" type="form-control" rows="3" name="res_desc" placeholder="<?php if(!isset($_POST['res_desc'])) { echo "ex. we serve italian delights";}?>"><?php if(isset($_POST['res_desc'])) { echo htmlentities($_POST['res_desc']); }else{ echo $landing['landing_desc'];}?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="exampleFormControlTextarea2">Restaurant Location</label>
                                                <textarea class="form-control form-control-lg" id="exampleFormControlTextarea2" type="form-control" rows="3" name="res_location" placeholder="<?php if(!isset($_POST['res_location'])) { echo "ex. Penang, Malaysia";}?>" value="<?php if(isset($_POST['res_location'])) {echo $_POST['location'];}?>"><?php if(isset($_POST['res_location'])) { echo htmlentities($_POST['res_location']); }else{ echo $landing['landing_location'];}?></textarea>
                                            </div>
                                            <div class="custom-file mb-3">
                                            <input type="file" class="custom-file-input" name="fileToUpload" id="fileToUpload" required="">
                                            <label class="custom-file-label" for="customFile">Restaurant
                                                Image</label>
                                            </div>
                                            <div class="form-group mt-4 mb-0"><button class="btn btn-block btn-primary" type="submit" name="edit_res">Make Changes</button></div>
                                        </form>
                                    </div>
                                    <?php if(count($errors) > 0) {?>
                                    <div class="card-footer text-center">
                                        <div class="small"><?php include('include/errors.php'); ?></div>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            <div id="layoutAuthentication_footer">
                <!-- FOOTER -->
                <?php include("include/footer.html"); ?>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
