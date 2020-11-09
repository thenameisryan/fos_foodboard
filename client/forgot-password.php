<?php
include("include/connectdb.php"); 
//test
?>

<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Forgot Password</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/libs/css/style.css">
    <link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <style>
    html,
    body {
        height: 100%;
    }

    body {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: center;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
    }
    </style>
    <script>
        function goBack() {
        window.history.back()
        }
    </script>
</head>

<body>
    <!-- ============================================================== -->
    <!-- login page  -->
    <!-- ============================================================== -->
    <div class="splash-container">
        <div class="card ">
            <div class="card-header text-center"><a class="navbar-brand">FoodBoard</a><span class="splash-description">Please enter your user information.</span></div>
            <div class="card-body">
                <form method="post" action="forgot-password.php">
                    <div class="form-group">
                        <input class="form-control form-control-lg" type="email" name="email" placeholder="Your email" value="<?php if(isset($_POST['email'])) {echo $_POST['email'];}?>" autocomplete="off">
                    </div>
                    <?php include('include/errors.php'); ?>
                    <button type="submit" class="btn btn-primary btn-lg btn-block" name="forgot_password">Submit</button>
                </form>
            </div>
            <div class="card-footer-item card-footer-item-bordered">
                <a onclick="goBack()" class="footer-link">Back</a>
            </div>
        </div>
    </div>
  
    <!-- ============================================================== -->
    <!-- end login page  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
</body>
 
</html>