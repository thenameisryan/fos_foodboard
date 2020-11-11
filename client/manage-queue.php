<?php 
include("include/connectdb.php");

$qry_queue = "SELECT * FROM fos_queue 
					WHERE client_uid =  '".$_SESSION['user_id']."'";  
$result_queue = mysqli_query($db, $qry_queue);
$num_queue = mysqli_num_rows($result_queue);

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
    <title>Manage Queue</title>
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
                            <h2 class="pageheader-title">Manage Queue </h2>
                            <p class="pageheader-text">Text goes in here.</p>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item">Virtual Queue</li>
                                        <li class="breadcrumb-item active" aria-current="page">Manage Queue</li>
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
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <h5 class="card-header">Virtual Queue</h5>
                                <div class="card-body">
                                    <div class="table-responsive ">
                                    <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col"># in line</th>
                                            <th scope="col">Customer Name</th>
                                            <th scope="col">Customer Contact</th>
                                            <th scope="col">Size</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Date Created</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php for($c=0; $c<$num_queue; $c++){ ?>
                                    <?php $q = mysqli_fetch_assoc($result_queue);?>
                                        <tr>
                                            <td scope="row"><?php echo $q['queue_number'];?></td>
                                            <td><?php echo $q['queue_cus_name'];?></td>
                                            <td><?php echo $q['queue_cus_contact'];?></td>
                                            <td><?php echo $q['queue_cus_size'];?> person</td>
                                            <td><?php echo $q['queue_status'];?></td>
                                            <td><?php echo $q['date_created'];?></td>
                                            <td><a href="notify-sms.php?n=<?php echo $q['queue_cus_name'];?>" class="btn btn-info rounded">Notify</a> <a href="ready.php?q=<?php echo $q['uid'];?>" class="btn btn-success rounded">Ready</a> <a href="wipe.php?exq=<?php echo $q['uid'];?>" class="btn btn-danger rounded"><i class="fas fa-times-circle"></i></a></td>
                                        </tr>
                                    <?php } ?>
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
