<?php
include("include/connectdb.php");

$qry_order = "SELECT * FROM fos_order
        WHERE client_uid = '".$_SESSION['user_id']."' ORDER BY date_created DESC";  
$result_order = mysqli_query($db, $qry_order);
$num_order = mysqli_num_rows($result_order);

$qry_queue = "SELECT * FROM fos_queue 
					WHERE client_uid =  '".$_SESSION['user_id']."'";  
$result_queue = mysqli_query($db, $qry_queue);
$num_queue = mysqli_num_rows($result_queue);

$qry_inqueue = "SELECT * FROM  fos_queue 
            WHERE client_uid = '".$_SESSION['user_id']."' ORDER BY  queue_number ASC LIMIT 1";  
$result_inqueue = mysqli_query($db, $qry_inqueue);
$inq = mysqli_fetch_assoc($result_inqueue);

if(isset($_COOKIE["username"])) {
    $user = $_COOKIE["username"];
}
if(isset($_SESSION["username"])) {
    $user = $_SESSION["username"];
}

if(!isset($user)) {
    header("location: include/403-page.html");
}

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['user_id']);
    unset($_SESSION['username']);
    unset($_SESSION['user_loggedin']);
    setcookie("username", "", $hour);
    setcookie("password", "", $hour);
    setcookie("active", "false", $hour);
    header("location: login.php");
}
?>

<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/libs/css/style.css">
    <link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <link rel="stylesheet" href="assets/vendor/charts/chartist-bundle/chartist.css">
    <link rel="stylesheet" href="assets/vendor/charts/morris-bundle/morris.css">
    <link rel="stylesheet" href="assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendor/charts/c3charts/c3.css">
    <link rel="stylesheet" href="assets/vendor/fonts/flag-icon-css/flag-icon.min.css">
    <title>Dashboard</title>
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
                                <h2 class="pageheader-title"> Dashboard </h2>
                                <p class="pageheader-text">Text goes in here.</p>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end pageheader  -->
                    <!-- ============================================================== -->
                    <div class="ecommerce-widget">
                        <div class="row">
                            <!-- ============================================================== -->

                                          <!-- recent orders  -->
                            <!-- ============================================================== -->
                            <div class="col-xl-9 col-lg-12 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    <h5 class="card-header">Recent Orders</h5>
                                    <div class="card-body p-0">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead class="bg-light">
                                                    <tr class="border-0">
                                                        <th class="border-0">#</th>
                                                        <th class="border-0">Order ID</th>
                                                        <th class="border-0">Order Time</th>
                                                        <th class="border-0">Customer ID</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php for($c=0; $c<$num_order; $c++){ ?>
							                    <?php $order = mysqli_fetch_assoc($result_order);?>
                                                    <tr>
                                                        <td><?php echo $c+1;?></td>
                                                        <td><a href="order-detail.php?id=<?php echo $order['uid'];?>"><?php echo $order['uid'];?></a></td>
                                                        <td><?php echo $order['date_created'];?></td>
                                                        <td><?php echo $order['order_cusid'];?></td>
                                                    </tr>
                                                <?php } ?>
                                                    <tr>
                                                        <td colspan="9"><a href="manage-order.php" class="btn btn-outline-light float-right">View Details</a></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end recent orders  -->
                            <!-- ============================================================== -->

                                          <!-- recent orders  -->
                            <!-- ============================================================== -->
                            <div class="col-xl-9 col-lg-12 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    <h5 class="card-header">Virtual Queue</h5>
                                    <div class="card-body p-0">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead class="bg-light">
                                                    <tr class="border-0">
                                                        <th class="border-0"># in line</th>
                                                        <th class="border-0">Customer Name</th>
                                                        <th class="border-0">Customer Contact</th>
                                                        <th class="border-0">Size</th>
                                                        <th class="border-0">Date Created</th>
                                                        <th class="border-0">Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php for($c=0; $c<$num_queue; $c++){ ?>
                                                <?php $q = mysqli_fetch_assoc($result_queue);?>
                                                    <tr>
                                                        <td><?php echo $q['queue_number'];?></td>
                                                        <td><?php echo $q['queue_cus_name'];?></td>
                                                        <td><?php echo $q['queue_cus_contact'];?></td>
                                                        <td><?php echo $q['queue_cus_size'];?> person</td>
                                                        <td><?php echo $q['date_created'];?></td>
                                                        <td><?php echo $q['queue_status'];?></td>
                                                    </tr>
                                                <?php } ?>
                                                    <tr>
                                                        <td colspan="9"><a href="serve-next.php" class="btn btn-primary float-right"><i class="fas fa-arrow-circle-up"></i> Serve Next</a> <a href="ready.php?qindex=<?php echo $inq['uid'];?>" class="btn btn-success float-right">Ready</a> <a href="manage-queue.php" class="btn btn-outline-light float-right">View Details</a></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end recent orders  -->

    
                            
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
    <!-- end main wrapper  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <!-- jquery 3.3.1 -->
    <script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <!-- bootstap bundle js -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <!-- slimscroll js -->
    <script src="assets/vendor/slimscroll/jquery.slimscroll.js"></script>
    <!-- main js -->
    <script src="assets/libs/js/main-js.js"></script>
    <!-- chart chartist js -->
    <script src="assets/vendor/charts/chartist-bundle/chartist.min.js"></script>
    <!-- sparkline js -->
    <script src="assets/vendor/charts/sparkline/jquery.sparkline.js"></script>
    <!-- morris js -->
    <script src="assets/vendor/charts/morris-bundle/raphael.min.js"></script>
    <script src="assets/vendor/charts/morris-bundle/morris.js"></script>
    <!-- chart c3 js -->
    <script src="assets/vendor/charts/c3charts/c3.min.js"></script>
    <script src="assets/vendor/charts/c3charts/d3-5.4.0.min.js"></script>
    <script src="assets/vendor/charts/c3charts/C3chartjs.js"></script>
    <script src="assets/libs/js/dashboard-ecommerce.js"></script>
</body>
 
</html>