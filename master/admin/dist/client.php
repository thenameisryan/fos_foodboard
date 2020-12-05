<?php
include("include/connectdb.php");

$qry = "SELECT * FROM fos_client";  
$result = mysqli_query($db, $qry);
$num = mysqli_num_rows($result);

$qry_delete = "SELECT * FROM fos_client";  
$result_delete = mysqli_query($db, $qry_delete);
$deletion = mysqli_fetch_assoc($result_delete);

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Restaurants - Foodboard Admin</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
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
                        <h1 class="mt-4">Restaurants List</h1>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>ID</th>
                                                <th>Restaurant Name</th>
                                                <th>Client Username</th>
                                                <th>Client E-mail</th>
                                                <th>Date Created</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>No.</th>
                                                <th>ID</th>
                                                <th>Restaurant Name</th>
                                                <th>Client Username</th>
                                                <th>Client E-mail</th>
                                                <th>Date Created</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                        <?php for($c=0; $c<$num; $c++){ ?>
							            <?php $client = mysqli_fetch_assoc($result);?>
                                            <tr>
                                                <td><?php echo $c+1 ;?></td>
                                                <td><?php echo $client['uid'];?></td>
                                                <td><?php echo $client['client_res_name'];?></td>
                                                <td><?php echo $client['client_username'];?></td>
                                                <td><?php echo $client['client_email'];?></td>
                                                <td><?php echo $client['date_created'];?></td>
                                                <td><a href="edit.php?id=<?php echo $client['uid']; ?>" class="btn btn-primary"><i class="fas fa-edit"></i> Edit </a> <a class="btn btn-danger" href="wipe.php?id=<?php echo $client['uid']; ?>"><i class="fas fa-minus-circle"></i> Delete</a></td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <!-- FOOTER -->
                <?php include("include/footer.html"); ?>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
    </body>
</html>
