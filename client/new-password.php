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
    <title>Login</title>
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
</head>

<body>
    <!-- ============================================================== -->
    <!-- login page  -->
    <!-- ============================================================== -->
    <div class="splash-container">
        <div class="card ">
            <div class="card-header text-center"><a class="navbar-brand">FoodBoard</a><span class="splash-description">Please enter your user information.</span></div>
            <div class="card-body">
                <form method="post" action="new-password.php">
                <div class="form-group">
                    <input class="form-control form-control-lg" type="password" name="new_pass" required=""
                        placeholder="New Password" value="<?php if(isset($_POST['new_pass'])) {echo $_POST['new_pass'];}?>">
                </div>
                <div class="form-group">
                    <input class="form-control form-control-lg" type="password" name="new_pass_c" required=""
                        placeholder="Confirm Password"
                        value="<?php if(isset($_POST['new_pass_c'])) {echo $_POST['new_pass_c'];}?>">
                </div>
                    <?php include('include/errors.php'); ?>
                    <input type="hidden" name="token" value="<?php echo $_GET['token'];?>">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" name="new_password">Submit</button>
                </form>
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