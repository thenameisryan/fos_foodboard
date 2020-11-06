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
    <title>Concept - Bootstrap 4 Admin Dashboard Template</title>
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
<!-- ============================================================== -->
<!-- signup form  -->
<!-- ============================================================== -->

<body>
    <!-- ============================================================== -->
    <!-- signup form  -->
    <!-- ============================================================== -->
    <form class="splash-container" method="post" action="sign-up.php" enctype="multipart/form-data">
        <div class="card">
            <div class="card-header">
                <h3 class="mb-1">Registrations Form</h3>
                <p>Please enter your user information.</p>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <input class="form-control form-control-lg" type="text" name="restname" required=""
                        placeholder="Restaurant Name"
                        value="<?php if(isset($_POST['restname'])) {echo $_POST['restname'];}?>" autocomplete="off">
                </div>
                <div class="form-group">
                    <textarea class="form-control form-control-lg" rows="3" name="res_desc"
                        value="<?php if(isset($_POST['res_desc'])) {echo $_POST['res_desc'];}?>"
                        placeholder="Restaurant Description"></textarea>
                </div>
                <div class="form-group">
                    <textarea class="form-control form-control-lg" rows="3" name="res_location"
                        value="<?php if(isset($_POST['res_location'])) {echo $_POST['res_contact'];}?>"
                        placeholder="Restaurant Location"></textarea>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control phone-inputmask" name="res_contact" id="phone-mask"
                        im-insert="true"
                        value="<?php if(isset($_POST['res_contact'])) {echo $_POST['res_contact'];}?>"
                        placeholder="Restaurant Contact">
                </div>
                <div class="custom-file mb-3">
                    <input type="file" class="custom-file-input" name="fileToUpload" id="fileToUpload" required="">
                    <label class="custom-file-label" for="customFile">Restaurant
                        Image</label>
                </div>
                <div class="form-group">
                    <input class="form-control form-control-lg" type="text" name="username" required=""
                        placeholder="Username" value="<?php if(isset($_POST['username'])) {echo $_POST['username'];}?>"
                        autocomplete="off">
                </div>
                <div class="form-group">
                    <input class="form-control form-control-lg" type="email" name="email" required=""
                        placeholder="E-mail" value="<?php if(isset($_POST['email'])) {echo $_POST['email'];}?>"
                        autocomplete="off">
                </div>
                <div class="form-group">
                    <input class="form-control form-control-lg" type="password" name="pass1" required=""
                        placeholder="Password" value="<?php if(isset($_POST['pass1'])) {echo $_POST['pass1'];}?>">
                </div>
                <div class="form-group">
                    <input class="form-control form-control-lg" type="password" name="pass2" required=""
                        placeholder="Confirm Password"
                        value="<?php if(isset($_POST['pass2'])) {echo $_POST['pass2'];}?>">
                </div>
                <?php include('include/errors.php'); ?>
                <div class="form-group pt-2">
                    <button class="btn btn-block btn-primary" type="submit" name="reg_user">Register My Account</button>
                </div>
            </div>
            <div class="card-footer bg-white">
                <p>Already member? <a href="login.php" class="text-secondary">Login Here.</a></p>
            </div>
        </div>
    </form>
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