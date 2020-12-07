<?php 
include("include/connectdb.php");

$qry_order = "SELECT * FROM fos_orderitem 
					WHERE order_number =  '".$_GET['id']."'";  
$result_order = mysqli_query($db, $qry_order);
$num_order = mysqli_num_rows($result_order);

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
    <title>Order Detail</title>
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
            <div class="container-fluid  dashboard-content">
                <!-- ============================================================== -->
                <!-- pageheader -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                            <h2 class="pageheader-title">Order Detail </h2>
                            <p class="pageheader-text">Text goes in here.</p>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item">Orders</li>
                                        <li class="breadcrumb-item">Manage Orders</li>
                                        <li class="breadcrumb-item active" aria-current="page">Order Detail</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end pageheader -->
                <!-- ============================================================== -->
               
                    <div class="row">
                        <!-- ============================================================== -->
                        <!-- responsive table -->
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
                                                        <th class="border-0">Order Number</th>
                                                        <th class="border-0">Product Name</th>
                                                        <th class="border-0">Product Price</th>
                                                        <th class="border-0">Product Quantity</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php $total = 0; for($c=0; $c<$num_order; $c++){ ?>
							                    <?php $order = mysqli_fetch_assoc($result_order);?>
                                                    <tr>
                                                        <td><?php echo $c+1;?></td>
                                                        <td><?php echo $order['order_number'];?></td>
                                                        <td><?php echo $order['prod_name'];?></td>
                                                        <td>RM <?php echo $order['prod_price'];?></td>
                                                        <td><?php echo $order['prod_quantity'];?></td>
                                                    </tr>
                                                <?php $total = $total + ($order["prod_quantity"] * $order["prod_price"]); } ?> 
                                                    <tr>
                                                        <td colspan="9"><span class="float-right" style="font-weight:bold;">Total RM<?php echo $total;?></span></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- ============================================================== -->
                        <!-- end responsive table -->
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
    <!-- jquery 3.3.1  -->
    <script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <!-- bootstap bundle js -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <!-- slimscroll js -->
    <script src="assets/vendor/slimscroll/jquery.slimscroll.js"></script>
    <!-- main js -->
    <script src="assets/libs/js/main-js.js"></script>
	<script type="text/javascript">
		$('#edit').click(function() {
		 var text = $('.text-email').text();
		 var input = $('<input type="email" name="email_change" placeholder="<?php echo $user_profile['useremail'];?>" value="<?php if(isset($_POST['email_change'])) {print htmlspecialchars($_POST['email_change']);}?>" onkeyup="showButton()" autocomplete="new-password"/>')
		 $('.text-email').text('').append(input);
		});
	</script>
</body>
 
</html>
