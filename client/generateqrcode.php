<?php
include("include/connectdb.php");
include("assets/vendor/phpqrcode/qrlib.php");
if(isset($_GET['qr'])){
    if($_GET['qr']=='t'){
        //encode url here
        $url = "https://localhost/fos_foodboard/cus-landing.php?r='".$_SESSION['user_id']."'"; 
  
        // $path variable store the location where to
        // store image and $file creates directory name
        // of the QR code file by using 'uniqid'
        // uniqid creates unique id based on microtime
        $resName = $_SESSION['res_name'];
        $path = 'assets/qrcodes/';
        $file = $path.$resName.uniqid().".png";

        // $ecc stores error correction capability('L')
        $ecc = 'L';
        $pixel_Size = 10;
        $frame_Size = 0;

        // Generates QR Code and Stores it in directory given
        QRcode::png($url, $file, $ecc, $pixel_Size, $frame_Size);
    }
}

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
                <!-- ============================================================== -->
                <!-- pageheader -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                            <h2 class="pageheader-title">Generate QR Code</h2>
                            <p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">QR Code</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Generate QR Code</li>
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
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="section-block" id="buttons">
                            <h3 class="section-title">QR Code</h3>
                            <p>Customers can scan your QR Code to quickly access the menu.</p>
                        </div>
                        <!-- .card -->
                        <div class="card card-figure">
                            <!-- .card-figure -->
                            <figure class="figure">
                                <!-- ============================================================== -->
                                <!-- qrcode  -->
                                <!-- ============================================================== -->
                                <!-- .figure-img -->
                                <?php 
                                echo "<div class='row'>";
                                echo "<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12'>";
                                echo "<div class='card' id='qrcode'>";
                                echo "<h5 class='card-header'>Your QR Code</h5>";
                                echo "<div class='card-body'>";
                                ?>
                                <?php if(isset($_GET['qr'])){ ?>
                                <center><img src="<?php
                                // Displaying the stored QR code from directory 
                                echo $file;?>"></center>  
                                <?php }else{ ?>
                                <?php } ?>
                                <?php
                                echo "</div>";
                                echo "</div>";
                                echo "</div>";
                                echo "</div>";
                                ?>
                                <!-- ============================================================== -->
                                <!-- end qrcode -->
                                <!-- ============================================================== -->
                                <?php if(isset($_GET['qr'])){ ?>
                                    <a download href="<?php echo $file; ?>" class="btn btn-rounded btn-primary">Download</a>
                                <?php }else{ ?>
                                    <a href="generateqrcode.php?qr=t" class="btn btn-rounded btn-primary">Generate your QR Code</a> 
                                <?php } ?>
                                
                                
                        </div>
                        <!-- /.card -->
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