<?php
include("include/connectdb.php");

if(isset($_GET['search'])) {
    $search = $_GET['search'];
    $search = preg_replace("#[^0-9a-z]i#","", $search);
    $qry = "SELECT * FROM fos_client
                WHERE client_res_name LIKE '%$search%' OR
                client_username LIKE '%$search%' OR
                client_email LIKE '%$search%'";  
    $result = mysqli_query($db, $qry);
    $num = mysqli_num_rows($result);
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Delete Restaurant - FoodBoard Admin</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <style>
        .card {
            margin: 0 auto; /* Added */
            float: none; /* Added */
            margin-bottom: 10px; /* Added */
        }
            </style>
    </head>
    <body class="sb-nav-fixed">
        <!-- NAVBAR -->
        <?php include("include/navbar.html"); ?>
        <div id="layoutSidenav">
        <!-- SIDEBAR -->
        <?php include("include/sidebar.html"); ?>
        <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Delete Restaurant</h1>
                        <form method="get" action="">
                        <div class="input-group">
                            <input class="form-control" type="text" name="search" placeholder="Search for..." value="<?php if(isset($_GET['search'])) {echo $_GET['search'];}?>" />
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                                </div>
                        </div>
                        </form>
                    </div>
                    <?php if(isset($_GET['search']) && $num > 0) { ?>
                            <?php for($c=0; $c<$num; $c++){ ?>
                            <?php $client = mysqli_fetch_assoc($result);?>
                                <div class="card w-50 text-center">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $client['client_res_name'];?></h5>
                                    <p class="card-text">Username : <?php echo $client['client_username'];?></p>
                                    <p class="card-text">E-mail : <?php echo $client['client_email'];?></p>
                                    <p class="card-text">Created On : <?php $date = $client['date_created']; $new_date = date("F j, Y", strtotime($date)); echo $new_date;?></p>
                                </div>
                                <div class="card-footer text-muted">
                                <a class="btn btn-danger btn-block" href="wipe.php?id=<?php echo $client['uid']; ?>"><i class="fas fa-minus-circle"></i> Delete</a>
                               
                                </div>
                                </div>
                                
                                
                          
                            <?php } ?>
                        
                    <?php }elseif(isset($_GET['search'])){ ?>
                        <div class="container-fluid">
                        <h3 class="mt-4">No search results</h3>
                    <?php } ?>
                </main>
            <div id="layoutAuthentication_footer">
                <!-- FOOTER -->
                <?php include("include/footer.html"); ?>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
