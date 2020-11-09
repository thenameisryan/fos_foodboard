<?php
include("include/connectdb.php");

$qry_profile = "SELECT * FROM fos_client
                WHERE uid = '".$_SESSION['user_id']."'";  
$result_profile = mysqli_query($db, $qry_profile);

if(isset($_COOKIE["username"])) {
    $user = $_COOKIE["username"];
}
if(isset($_SESSION["username"])) {
    $user = $_SESSION["username"];
}

if(!isset($user)) {
    header("location: include/403-page.html");
}

?>
<!doctype html>
<html lang="en">

 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Change Password</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/libs/css/style.css">
    <link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <script>
	window.onload=function(){
	  	document.getElementById("button_edit_profile").style.display='none';

	}
	function showButton(){
	  	document.getElementById("button_edit_profile").style.display='block';
	}

	function showPass() {
	  	var x = document.getElementById("inputoldPass");
	  	var y = document.getElementById("inputPass1");
	  	var z = document.getElementById("inputPass2");
	  	if (x.type === "password") {
	   		x.type = "text";
	   		document.getElementById("eye").className='fa fa-eye-slash';
	 	} else {
	    	x.type = "password";
	    	document.getElementById("eye").className='fa fa-eye';
	 	}
	 	if (y.type === "password") {
	   		y.type = "text";
	   		document.getElementById("eye").className='fa fa-eye-slash';
	 	} else {
	    	y.type = "password";
	    	document.getElementById("eye").className='fa fa-eye';
	 	}
	 	if (z.type === "password") {
	   		z.type = "text";
	   		document.getElementById("eye").className='fa fa-eye-slash';
	 	} else {
	    	z.type = "password";
	    	document.getElementById("eye").className='fa fa-eye';
	 	}
	}
	</script>
</head>

<body>
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper">
        <!-- ============================================================== -->
        <!-- navbar -->
        <!-- ============================================================== -->
        <?php
        include("include/navbar.php");
        ?>
        <!-- ============================================================== -->
        <!-- end navbar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- left sidebar -->
        <!-- ============================================================== -->
        <?php
        include("include/sidebar.php");
        ?>
        <!-- ============================================================== -->
        <!-- end left sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
        <div class="dashboard-wrapper">
            <div class="container-fluid dashboard-content">
                <div class="row">
                    <div class="col-xl-10">
                        <!-- ============================================================== -->
                        <!-- pageheader  -->
                        <!-- ============================================================== -->
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="page-header" id="top">
                                    <h2 class="pageheader-title">Change Password</h2>
                                    <p class="pageheader-text">Text goes in here.</p>
                                    <div class="page-breadcrumb">
                                        <nav aria-label="breadcrumb">
                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item"><a href="index.php" class="breadcrumb-link">Dashboard</a></li>
                                                <li class="breadcrumb-item active" aria-current="page">Change Password</li>
                                            </ol>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ============================================================== -->
                        <!-- end pageheader  -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- basic form  -->
                        <!-- ============================================================== -->
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                <div class="card">
                                    <h5 class="card-header">Change your password Form </h5>
                                    <div class="card-body">
                                        <form method="post" action="change-password.php">
                                        <h5>Click to show password &nbsp; &nbsp; &nbsp;<i class="fa fa-eye" style="font-size:24px" id="eye" onclick="showPass()"></i></h5>
                                            <div class="form-group">
                                                <label for="inputText1" class="col-form-label">Old Password</label>
                                                <input type="password" class="form-control" name="old_pass" id="inputoldPass" value="<?php if(isset($_POST['old_pass'])) {echo $_POST['old_pass'];}?>" onkeyup="showButton()">
                                            </div>
                                            <div class="form-group">
                                                <label for="inputText2" class="col-form-label">New Password</label>
                                                <input type="password" class="form-control" name="change_password_1" id="inputPass1" value="<?php if(isset($_POST['change_password_1'])) {echo $_POST['change_password_1'];}?>" onkeyup="showButton()">
                                            </div>
                                            <div class="form-group">
                                                <label for="inputText3" class="col-form-label">Confirm New Password</label>
                                                <input type="password" class="form-control" name="change_password_2" id="inputPass2" value="<?php if(isset($_POST['change_password_2'])) {echo $_POST['change_password_2'];}?>" onkeyup="showButton()">
                                            </div>
                                            <?php include('include/errors.php'); ?>
                                            <div class="form-group pt-2">
                                                <button class="btn btn-block btn-primary" type="submit" name="edit_pass" id="button_edit_profile">Make Changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ============================================================== -->
                        <!-- end basic form  -->
                        <!-- ============================================================== -->
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end wrapper -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        <?php
        include("include/footer.php");
        ?>
        <!-- ============================================================== -->
        <!-- end footer -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="assets/vendor/slimscroll/jquery.slimscroll.js"></script>
    <script src="assets/libs/js/main-js.js"></script>
    <script src="assets/vendor/inputmask/js/jquery.inputmask.bundle.js"></script>
</body>
 
</html>