<?php
include("include/connectdb.php");

//EDIT LANDING PAGE
if (isset($_POST['edit_landing'])) {
	$landing_desc = mysqli_real_escape_string($db, $_POST['res_desc']);
	$landing_location = mysqli_real_escape_string($db, $_POST['res_location']);
	$landing_contact = mysqli_real_escape_string($db, $_POST['res_contact']);
	$current_user = mysqli_real_escape_string($db, $_SESSION['user_id']);
	$target_dir = "assets/landing-bg/";
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
	if (count($errors) == 0) {
	move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
  	echo $query = "UPDATE fos_landing
			SET landing_desc = '$landing_desc',
			landing_location = '$landing_location',
			landing_contact = '$landing_contact',
			landing_image = '$target_file',
			date_edited = '$datenow'
			WHERE client_uid = '".$current_user."'";
  	mysqli_query($db, $query);
  	//header('location: edit_landing.php');
  	}
}

$qry_landing = "SELECT * FROM fos_landing
                WHERE client_uid = '".$_SESSION['user_id']."'";  
$result = mysqli_query($db, $qry_landing);
$landing = mysqli_fetch_assoc($result);

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
    <title>Concept - Bootstrap 4 Admin Dashboard Template</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/libs/css/style.css">
    <link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
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
                                    <h2 class="pageheader-title">Edit Landing Page</h2>
                                    <p class="pageheader-text">Text goes in here.</p>
                                    <div class="page-breadcrumb">
                                        <nav aria-label="breadcrumb">
                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item"><a href="index.php" class="breadcrumb-link">Dashboard</a></li>
                                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Landing Page</a></li>
                                                <li class="breadcrumb-item active" aria-current="page">Edit Landing Page</li>
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
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="section-block" id="inputmask">
                                    <h3 class="section-title">Basic Form Elements</h3>
                                    <p>Use custom button styles for actions in forms, dialogs, and more with support for multiple sizes, states, and more.</p>
                                </div>
                                <div class="card">
                                    <h5 class="card-header">Landing Page </h5>
                                    <div class="card-body">
                                        <form method="post" action="" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label for="inputText1" class="col-form-label">Restaurant Name</label>
                                                <input id="inputText1" type="text" class="form-control" name="res_name" value="<?php echo $_SESSION['res_name']?>" onclick="" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlTextarea1">Restaurant Description</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="res_desc" value="<?php if(isset($_POST['res_desc'])) {echo $_POST['res_desc'];}else{echo $landing['landing_desc'];}{echo $landing['landing_desc'];}?>" placeholder="<?php echo $landing['landing_desc']?>"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlTextarea2">Restaurant Location</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea2" rows="3" name="res_location" value="<?php if(isset($_POST['res_location'])) {echo $_POST['res_contact'];}else{echo $landing['landing_location'];}?>" placeholder="<?php echo $landing['landing_location']?>"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Restaurant Contact <small class="text-muted">(999) 999-9999</small></label>
                                                <input type="text" class="form-control phone-inputmask" name="res_contact" id="phone-mask" im-insert="true" value="<?php if(isset($_POST['res_contact'])) {echo $_POST['res_contact'];}else{echo $landing['landing_contact'];}?>" placeholder="<?php echo $landing['landing_contact']?>">
                                            </div>
                                            <div class="custom-file mb-3">
                                                <input type="file" class="custom-file-input" name="fileToUpload" id="fileToUpload">
                                                <label class="custom-file-label" for="customFile">Restaurant Image</label>
                                            </div>
                                            <?php include('include/errors.php'); ?>
                                            <div class="form-group pt-2">
                                                <!-- <input type="hidden" name="edit_prod_id" value="<?php echo $prod['product_id'];?>"> -->
                                                <button class="btn btn-block btn-primary" type="submit" name="edit_landing">Make Changes</button>
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
    <script>
    $(function(e) {
        "use strict";
        $(".date-inputmask").inputmask("dd/mm/yyyy"),
            $(".phone-inputmask").inputmask("(999) 999-9999"),
            $(".international-inputmask").inputmask("+9(999)999-9999"),
            $(".xphone-inputmask").inputmask("(999) 999-9999 / x999999"),
            $(".purchase-inputmask").inputmask("aaaa 9999-****"),
            $(".cc-inputmask").inputmask("9999 9999 9999 9999"),
            $(".ssn-inputmask").inputmask("999-99-9999"),
            $(".isbn-inputmask").inputmask("999-99-999-9999-9"),
            $(".currency-inputmask").inputmask("$9999"),
            $(".percentage-inputmask").inputmask("99%"),
            $(".decimal-inputmask").inputmask({
                alias: "decimal",
                radixPoint: "."
            }),

            $(".email-inputmask").inputmask({
                mask: "*{1,20}[.*{1,20}][.*{1,20}][.*{1,20}]@*{1,20}[*{2,6}][*{1,2}].*{1,}[.*{2,6}][.*{1,2}]",
                greedy: !1,
                onBeforePaste: function(n, a) {
                    return (e = e.toLowerCase()).replace("mailto:", "")
                },
                definitions: {
                    "*": {
                        validator: "[0-9A-Za-z!#$%&'*+/=?^_`{|}~/-]",
                        cardinality: 1,
                        casing: "lower"
                    }
                }
            })
    });
    </script>
</body>
 
</html>