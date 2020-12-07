<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Payment </title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/libs/css/style.css">
    <link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
	<style type="text/css">
	body { text-align: center; }
	</style>
</head>

<body>
 <!-- ============================================================== -->
    <!-- login page  -->
    <!-- ============================================================== -->
    <div class="splash-container">
        <div class="card ">
            <div class="card-header text-center"> <button onclick="goBack()" class="footer-link">Return to Menu</button></div>
            <div class="card-body">
			<script src="https://www.paypal.com/sdk/js?client-id=sb"></script>
			<script>paypal.Buttons().render('body');</script><br>
            </div>
            <div class="card-footer-item card-footer-item-bordered">
               
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end login page  -->

    <!-- Optional JavaScript -->
    <script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="assets/vendor/slimscroll/jquery.slimscroll.js"></script>
    <script src="assets/libs/js/main-js.js"></script>
    <script src="assets/vendor/inputmask/js/jquery.inputmask.bundle.js"></script>
    <script>
function goBack() {
  window.history.back();
  window.history.back();
}
</script>
</body>
 
</html>