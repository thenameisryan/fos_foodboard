<?php
include("include/connectdb.php");

$qry = "SELECT * FROM fos_cat 
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
    <title>Categories </title>
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
                <!-- ============================================================== -->
                <!-- pageheader -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                            <h2 class="pageheader-title">Categories <a href="add-menu-categories.php" class="btn btn-rounded btn-dark btn-xs"><i class="fas fa-plus"> Add </i></a></h2>
                            <p class="pageheader-text">Text goes in here.</p>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Menu</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Categories</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end pageheader -->
                <!-- ============================================================== -->
                    <div class="dashboard-short-list">
                        <div class="row">
                            <!-- ============================================================== -->
                            <!-- shortable list  -->
                            <!-- ============================================================== -->
                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 co-12">
                                <section class="card card-fluid">
                                    <h5 class="card-header drag-handle"> Menu Categories </h5>
                                    <ul class="sortable-lists list-group list-group-flush list-group-bordered" id="items">
                                        <?php for($c=0; $c<$num_items; $c++){ ?>
                                        <?php $cat = mysqli_fetch_assoc($result_items);?>
                                        <li class="list-group-item align-items-center drag-handle">
                                            <span class="drag-indicator"></span>
                                            <div> <?php echo $cat['cat_title'];?> </div>
                                            <div class="btn-group ml-auto">
                                                <button class="btn btn-sm btn-outline-light" onclick="location.href='edit-cat.php?edt=<?php echo $cat['uid'];?>'">Edit</button>
                                                <button class="btn btn-sm btn-danger" onclick="location.href='wipe.php?del=<?php echo $cat['uid'];?>'">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                            </div>
                                        </li>
                                        <?php } ?>
                                    </ul>
                                </section>
                            </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end shortable list  -->
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
        <!-- end wrapper -->
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
    <script src="assets/vendor/shortable-nestable/Sortable.min.js"></script>
    <script src="assets/vendor/shortable-nestable/sort-nest.js"></script>
    <script src="assets/vendor/shortable-nestable/jquery.nestable.js"></script>
</body>
 
</html>