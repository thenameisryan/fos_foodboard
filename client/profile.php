<?php 
include("include/connectdb.php");
$qry_profile = "SELECT * FROM fos_client 
					INNER JOIN fos_landing
					ON fos_client.uid = fos_landing.client_uid 
					WHERE fos_client.uid =  '".$_SESSION['user_id']."'";  
$result_profile = mysqli_query($db, $qry_profile);
$user_profile = mysqli_fetch_assoc($result_profile);

$qry_review = "SELECT * FROM fos_review 
					WHERE client_uid =  '".$_SESSION['user_id']."'";  
$result_review = mysqli_query($db, $qry_review);
$num_review = mysqli_num_rows($result_review);

$qry_review2 = "SELECT * FROM fos_review 
					WHERE client_uid =  '".$_SESSION['user_id']."'";  
$result_review2 = mysqli_query($db, $qry_review2);
$num_review2 = mysqli_num_rows($result_review2);

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
	<style type="text/css">
		#floatr{
		float:right;
		}
	</style>
	<script>
		window.onload=function(){
			document.getElementById("button_edit_profile").style.display='none';

		}
		function showButton(){
			document.getElementById("button_edit_profile").style.display='block';
		}
		function showHide() {
			var x = document.getElementById("edit");
			var y = document.getElementById("show");
			if (x.style.display === "none") {
				x.style.display = "block";
			} else {
				x.style.display = "none";
			}
			if (y.style.display === "none") {
				y.style.display = "block";
			} else {
				y.style.display = "none";
			}
		}
	</script>
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
            <div class="influence-profile">
                <div class="container-fluid dashboard-content ">
                    <!-- ============================================================== -->
                    <!-- pageheader -->
                    <!-- ============================================================== -->
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="page-header">
                                <h3 class="mb-2">Your Account <a href="edit-profile.php" class="btn btn-rounded btn-dark btn-xs"><i class="fas fa-edit"> Edit </i></a></h3>
                                <p class="pageheader-text">Text goes in here.</p>
                                <div class="page-breadcrumb">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="index.php" class="breadcrumb-link">Dashboard</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Your Account</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end pageheader -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- content -->
                    <!-- ============================================================== -->
                    <div class="row">
                        <!-- ============================================================== -->
                        <!-- profile -->
                        <!-- ============================================================== -->
                        <div class="col-xl-3 col-lg-3 col-md-5 col-sm-12 col-12">
                            <!-- ============================================================== -->
                            <!-- card profile -->
                            <!-- ============================================================== -->
                            <div class="card">
                                <div class="card-body">
                                    <div class="user-avatar text-center d-block">
                                        <img src="assets/images/user.png" alt="User Avatar" class="rounded-circle user-avatar-xxl">
                                    </div>
                                    <div class="text-center">
                                        <h2 class="font-24 mb-0"><?php echo $user_profile['client_res_name'];?></h2>
                                        <p><?php echo $user_profile['client_username'];?></p>
                                    </div>
                                </div>
                                <div class="card-body border-top">
                                    <h3 class="font-16">Contact Information </h3>
                                    <div class="">
                                        <ul class="list-unstyled mb-0">
                                        <li class="mb-2"><i class="fas fa-fw fa-envelope mr-2"></i><?php echo $user_profile['client_email'];?></li>
                                        <!-- <li class="mb-0"><i class="fas fa-fw fa-phone mr-2"></i><?php echo $user_profile['landing_contact'];?></li> -->
                                    </ul>
                                    </div>
                                </div>
                                <div class="card-body border-top">
								<?php 
									$as=0;$bs=0;$cs=0;$ds=0;$es=0;
									for($x=0; $x<$num_review2; $x++){
										$review = mysqli_fetch_assoc($result_review2);
										if($review['review_stars'] == 1){
											$as= $as + 1;
										}elseif($review['review_stars'] == 2){
											$bs= $bs + 1;
										}elseif($review['review_stars'] == 3){
											$cs= $cs + 1;
										}elseif($review['review_stars'] == 4){
											$ds= $ds + 1;
										}elseif($review['review_stars'] == 5){
											$es= $es + 1;
										}
									}
									$avg_rating = (1*$as+2*$bs+3*$cs+4*$ds+5*$es)/$num_review2;
									$int_rating = number_format($avg_rating);
								?>
                                    <h3 class="font-16">Rating</h3>
                                    <h1 class="mb-0"><?php echo number_format($avg_rating,1);?></h1>
                                    <div class="rating-star">
									<?php if($int_rating == 1){?>
										<i class="fa fa-fw fa-star"></i>
									<?php }elseif($int_rating == 2){?>		
                                        <i class="fa fa-fw fa-star"></i>
										<i class="fa fa-fw fa-star"></i>
									<?php }elseif($int_rating == 3){?>	
										<i class="fa fa-fw fa-star"></i>
										<i class="fa fa-fw fa-star"></i>
										<i class="fa fa-fw fa-star"></i>
									<?php }elseif($int_rating == 4){?>	
										<i class="fa fa-fw fa-star"></i>
										<i class="fa fa-fw fa-star"></i>
										<i class="fa fa-fw fa-star"></i>
										<i class="fa fa-fw fa-star"></i>
									<?php }elseif($int_rating == 5){?>	
										<i class="fa fa-fw fa-star"></i>
										<i class="fa fa-fw fa-star"></i>
										<i class="fa fa-fw fa-star"></i>
										<i class="fa fa-fw fa-star"></i>
										<i class="fa fa-fw fa-star"></i>
									<?php } ?>
                                        <p class="d-inline-block text-dark"><?php echo $num_review;?> Reviews </p>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end card profile -->
                            <!-- ============================================================== -->
                        </div>
                        <!-- ============================================================== -->
                        <!-- end profile -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- campaign data -->
                        <!-- ============================================================== -->
                        <div class="col-xl-9 col-lg-9 col-md-7 col-sm-12 col-12">
                            <!-- ============================================================== -->
                            <!-- campaign tab one -->
                            <!-- ============================================================== -->
                            <div class="influence-profile-content pills-regular">
                                <ul class="nav nav-pills mb-3 nav-justified" id="pills-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="pills-review-tab" data-toggle="pill" href="#pills-review" role="tab" aria-controls="pills-review" aria-selected="false">Reviews</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="pills-review" role="tabpanel" aria-labelledby="pills-review-tab">
                                        <div class="card">
                                            <h5 class="card-header">Reviews</h5>
											<?php for($c=0; $c<$num_review; $c++){ ?>
											<?php $rev = mysqli_fetch_assoc($result_review);?>
												<div class="card-body border-top">
													<div class="review-block">
														<p class="review-text font-italic m-0">"<?php echo $rev['review_content'];?>"</p>
														<div class="rating-star mb-4">
														<?php for($i=0; $i<$rev['review_stars']; $i++){ ?>
															<i class="fa fa-fw fa-star"></i>
														<?php } ?>
														</div>
													</div>
												</div>
											<?php } ?>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="pills-msg" role="tabpanel"
                                    	aria-labelledby="pills-msg-tab">
                                    	<div class="card">
                                    		<h5 class="card-header">Send Messages</h5>
                                    		<div class="card-body">
                                    			<form>
                                    				<div class="row">
                                    					<div class="col-xl-12 col-lg-9 col-md-7 col-sm-12 col-12">
                                    						<div class="table-responsive ">
                                    							<table class="table">
                                    								<thead>
                                    									<tr>
                                    										<th scope="col">#</th>
                                    										<th scope="col">First</th>
                                    										<th scope="col">Last</th>
                                    										<th scope="col">Handle</th>
                                    									</tr>
                                    								</thead>
                                    								<tbody>
                                    									<tr>
                                    										<th scope="row">1</th>
                                    										<td>Mark</td>
                                    										<td>Otto</td>
                                    										<td>@mdo</td>
                                    									</tr>
                                    									<tr>
                                    										<th scope="row">2</th>
                                    										<td>Jacob</td>
                                    										<td>Thornton</td>
                                    										<td>@fat</td>
                                    									</tr>
                                    									<tr>
                                    										<th scope="row">3</th>
                                    										<td colspan="2">Larry the Bird</td>
                                    										<td>@twitter</td>
                                    									</tr>
                                    								</tbody>
                                    							</table>
                                    						</div>
                                    					</div>
                                    				</div>
                                    			</form>
                                    		</div>
                                    	</div>
                                    </div>
                                    </div>
                                    </div>
                                    <!-- ============================================================== -->
                                    <!-- end campaign tab one -->
                                    <!-- ============================================================== -->
                        </div>
                        <!-- ============================================================== -->
                        <!-- end campaign data -->
                        <!-- ============================================================== -->
                    </div>
                </div>
            </div>
        <!-- ============================================================== -->
        <!-- end wrapper -->
        <!-- ============================================================== -->
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
