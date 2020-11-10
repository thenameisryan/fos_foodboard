<?php
include("include/connectdb.php");

$qry = "SELECT * FROM fos_prod 
        WHERE client_uid = '".$_SESSION['user_id']."'";  
$result_items = mysqli_query($db, $qry);
$num_items = mysqli_num_rows($result_items);

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
    <title>Items</title>
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
            <div class="dashboard-ecommerce">
                <div class="container-fluid dashboard-content ">
                    <!-- ============================================================== -->
                    <!-- pageheader  -->
                    <!-- ============================================================== -->
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="page-header">
                                <h2 class="pageheader-title">Items <a href="add-menu-items.php" class="btn btn-rounded btn-dark btn-xs"><i class="fas fa-plus"> Add </i></a></h2>
                                <div class="page-breadcrumb">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="index.php" class="breadcrumb-link">Dashboard</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Menu</li>
                                            <li class="breadcrumb-item active" aria-current="page">Items</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end pageheader  -->
                    <!-- ============================================================== -->
                    <div class="row">
                        <div class="col-xl-9 col-lg-8 col-md-8 col-sm-12 col-12">
                            <div class="row">
                            <?php for($c=0; $c<$num_items; $c++){ ?>
							<?php $prod = mysqli_fetch_assoc($result_items);?>
                                <div class="col-xl-4 col-lg-6 col-md-12 col-sm-12 col-12">
                                    <div class="product-thumbnail">
                                        <div class="product-img-head">
                                            <div class="product-img">
                                                <img src="<?php echo $prod['prod_image'];?>" alt="" class="img-fluid"></div>
                                        </div>
                                        <div class="product-content">
                                            <div class="product-content-head">
                                                <h3 class="product-title"><?php echo $prod['prod_name'];?></h3>
                                                <div class="product-rating d-inline-block">
                                                    <i class="fa fa-fw fa-star"></i>
                                                    <i class="fa fa-fw fa-star"></i>
                                                    <i class="fa fa-fw fa-star"></i>
                                                    <i class="fa fa-fw fa-star"></i>
                                                    <i class="fa fa-fw fa-star"></i>
                                                </div>
                                                <!-- .figure-caption -->
                                        <figcaption class="figure-caption">
                                            <p class="text-muted mb-0"><?php echo $prod['prod_desc'];?></p>
                                        </figcaption>
                                        <!-- /.figure-caption -->
                                                <div class="product-price">RM<?php echo $prod['prod_price'];?></div>
                                            </div>
                                            <div class="product-btn">
                                                <a href="detail-items.php?edt=<?php echo $prod['uid'];?>" class="btn btn-light">Details</a>
                                                <a href="edit-menu-items.php?edt=<?php echo $prod['uid'];?>" class="btn btn-light">Edit</a>
                                                <a href="wipe.php?delitms=<?php echo $prod['uid'];?>" class="btn btn-danger"><i class="far fa-trash-alt"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
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
            <!-- end wrapper  -->
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
</body>
 
</html>