<?php
include("include/connectdb.php");

//EDIT LANDING PAGE
if (isset($_POST['edit_item'])) {
    $item_name = mysqli_real_escape_string($db, $_POST['item_name']);
	$item_desc = mysqli_real_escape_string($db, $_POST['item_desc']);
	$item_price = mysqli_real_escape_string($db, $_POST['item_price']);
	$current_item = mysqli_real_escape_string($db, $_GET['edt']);
	$target_dir = "assets/uploads/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

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
  	$query = "UPDATE fos_prod
			SET prod_price = '$item_price',
			prod_desc = '$item_desc',
			prod_name = '$item_name',
			prod_image = '$target_file',
			date_edited = '$datenow'
			WHERE uid = '".$current_item."'";
  	mysqli_query($db, $query);
  	header('location: menu-items.php');
  	}
}

$qry_items = "SELECT * FROM fos_prod
                WHERE uid = '".$_GET['edt']."'";
$result = mysqli_query($db, $qry_items);
$item = mysqli_fetch_assoc($result);

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
                                    <h2 class="pageheader-title">Edit Menu Items </h2>
                                    <p class="pageheader-text">Text goes in here.</p>
                                    <div class="page-breadcrumb">
                                        <nav aria-label="breadcrumb">
                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item"><a href="index.php" class="breadcrumb-link">Dashboard</a></li>
                                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Menu</a></li>
                                                <li class="breadcrumb-item"><a href="menu-items.php" class="breadcrumb-link">Items</a></li>
                                                <li class="breadcrumb-item active" aria-current="page">Edit Menu Items</li>
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
                                    <h5 class="card-header">Edit </h5>
                                    <div class="card-body">
                                        <form method="post" action="" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label for="inputText1" class="col-form-label">Product Name</label>
                                                <input id="inputText1" type="text" class="form-control" name="item_name" value="<?php if(isset($_POST['item_name'])) {echo $_POST['item_name'];}else{echo $item['prod_name'];}?>" placeholder="<?php echo $item['prod_name'] ;?>" onclick="">
                                            </div>
                                            <div class="form-group">
                                                <label>Product Price</label>
                                                <div class="form-group input-group mb-3">
                                                    <div class="input-group-prepend"><span class="input-group-text">RM</span></div>
                                                    <input type="number" class="form-control"
                                                        id="currency-mask" name="item_price" value="<?php if(isset($_POST['item_price'])) {echo $_POST['item_price'];}?>" placeholder="<?php echo $item['prod_price'] ;?>">
                                                </div>
                                            </div>
                                            <div class="product-description">
                                                <div class="form-group">
                                                    <label for="inputText2" class="col-form-label">Product Descriptions</label>
                                                    <input id="inputText2" type="text" class="form-control" name="item_desc" value="<?php if(isset($_POST['item_desc'])) {echo $_POST['item_desc'];}else{echo $item['prod_desc'];}?>" placeholder="<?php echo $item['prod_desc'] ;?>" onclick="">
                                                </div>
                                                <div class="custom-file mb-3">
                                                <input type="file" class="custom-file-input" name="fileToUpload" id="fileToUpload">
                                                <label class="custom-file-label" for="customFile">Product Image</label>
                                                </div>
                                                <?php include('include/errors.php'); ?>
                                                <div class="form-group pt-2">
                                                    <button class="btn btn-block btn-primary" type="submit" name="edit_item">Make Changes</button>
                                                </div>
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