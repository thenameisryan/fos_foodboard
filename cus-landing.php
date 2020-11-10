<?php
include("php/connectdb.php");

//user session needs to be destroyed in this page
$qry = "SELECT * FROM fos_landing 
            INNER JOIN fos_client ON fos_landing.client_uid = fos_client.uid
            WHERE client_uid = '".$_GET['r']."'";  
$results = mysqli_query($db, $qry);
$landing = mysqli_fetch_assoc($results);

$qry_queue = "SELECT * FROM fos_queue 
					WHERE client_uid = '".$_GET['r']."'"; 
$result_queue = mysqli_query($db, $qry_queue);
$num_queue = mysqli_num_rows($result_queue);

// echo $_SESSION['inqnum'];
// echo $_SESSION['Qcname'];
// echo $_SESSION['Qccon'];
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Jekyll v4.0.1">
  <title>FoodBoard</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/carousel/">
  <link rel="apple-touch-icon" sizes="180x180" href="img/favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="img/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="img/favicon/favicon-16x16.png">
  <link rel="manifest" href="img/favicon/site.webmanifest">
  <!-- Bootstrap core CSS -->
  <link href="assets/dist/css/bootstrap.css" rel="stylesheet">

  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>
  <!-- Custom styles for this template -->
  <link href="assets/dist/css/carousel.css" rel="stylesheet">
</head>

<body>

  <main role="main">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <!-- you were doing this half way cus-landing -->
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img class="d-block w-100" src="<?php $new_path = "client/".$landing['landing_image']; echo $new_path;?>"
            alt="First slide">
          <div class="container">
            <div class="carousel-caption text-left">
              <h1><?php echo $landing['client_res_name'];?></h1>
              <p><?php echo $landing['landing_desc'];?>
              </p>
              <h5><?php echo $landing['landing_location'];?></h5>
              <h6><?php echo $landing['landing_contact'];?></h5>
            </div>
          </div>
        </div>
        <!-- <div class="carousel-item">
          <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg"
            preserveAspectRatio="xMidYMid slice" focusable="false" role="img">
            <rect width="100%" height="100%" fill="#777" /></svg>
          <div class="container">
            <div class="carousel-caption">
              <h1>How do we do it?</h1>
              <p>The patty is pan fried, grilled, smoked or flame broiled. Hamburgers are often served with cheese,
                lettuce, tomato, onion, pickles, bacon, or chiles; condiments such as ketchup, mustard, mayonnaise,
                relish, or "special sauce"; and are frequently placed on sesame seed buns. A hamburger topped with
                cheese is called a cheeseburger.</p>
              <p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p>
            </div>
          </div>
        </div> -->
      </div>
      <!-- <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span> </a>
      <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span> </a> -->
    </div>


    <!-- Marketing messaging and featurettes
  ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

    <div class="container marketing">
      <!-- Three columns of text below the carousel -->
      <div class="row">
        <div class="col-lg-4">
          <img src="img/landing-icons/menu.png" class="bd-placeholder-img rounded-circle" width="140" height="140"
            xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img"
            aria-label="Placeholder: 140x140">
          <h2></h2>
          <p><a class="btn btn-primary" href="cus-menu.php?r=<?php echo $_GET['r'];?>" role="button">View Menu
              &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
          <img src="img/landing-icons/track.png" class="bd-placeholder-img rounded-circle" width="140" height="140"
            xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img"
            aria-label="Placeholder: 140x140">
          <h2></h2>
          <p><a class="btn btn-primary" href="#" role="button">Track Order &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
          <img src="img/landing-icons/review.png" class="bd-placeholder-img rounded-circle" width="140" height="140"
            xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img"
            aria-label="Placeholder: 140x140">
          <h2></h2>
          <p><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
              Give Review &raquo;
            </button></p>
        </div><!-- /.col-lg-4 -->
      </div><!-- /.row -->

      <!-- Modal -->
      <form method="post" action="cus-landing.php" id="reviewForm">
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
          aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Give us a review </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label for="exampleFormControlSelect1">Rating </label>
                  <select class="form-control" id="exampleFormControlSelect1" name="reviewer_rating">
                    <option value="1">1 Stars</option>
                    <option value="2">2 Stars</option>
                    <option value="3">3 Stars</option>
                    <option value="4">4 Stars</option>
                    <option value="5">5 Stars</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleFormControlTextarea1">Review </label>
                  <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="reviewer_review" value="<?php if(isset($_POST['reviewer_review'])) {echo $_POST['reviewer_review'];}?>"></textarea>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <input type="hidden" name="res_id" value="<?php echo $_GET['r'];?>">
                <button type="submit" class="btn btn-primary" name="submit_review">Submit </button>
              </div>
            </div>
          </div>
        </form>  
      </div>

      <!-- START THE FEATURETTES -->

      <hr class="featurette-divider">
      
      <div class="row featurette">
        <div class="col-md-7">
        <h2 class="featurette-heading">Virtual Queue <span class="text-muted" style="font-size:28px;"><?php if (isset($_SESSION['inq']) && $_SESSION['inq'] == 'true') { ?>You are in line. <?php }else{ ?>You are <span class="text-muted" style="text-decoration:underline;">not</span> in line.<?php } ?></span></h2>
        </div>
        <div class="col-md-5">
          <ul class="list-group list-group-flush">
          <?php for($c=0; $c<1; $c++){ ?>
          <?php $q = mysqli_fetch_assoc($result_queue);?>
            <li class="list-group-item d-flex justify-content-between align-items-center"><?php echo $q['queue_cus_name'];?> (<?php echo $q['queue_cus_size'];?> person)<span
                class="badge badge-<?php if($c == 0) { echo "success"; }else { echo "primary"; };?> badge-pill"><?php if($c == 0) { echo "Ready to be seated"; }else { echo $c+1; };?></span></li>
          <?php } ?>
          </ul>
          <?php if (isset($_SESSION['inq']) && $_SESSION['inq'] == 'true') { ?>
          <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center">
            <span style="font-size:18px;font-weight: bold;"> waiting in line : number <span style="text-decoration:underline;"><strong>28</strong></span></span>
            </li>
          </ul>
          <?php } ?>
          <ul class="list-group">
            <?php if (isset($_SESSION['inq']) && $_SESSION['inq'] == 'true') { ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
            <button type="button" data-toggle="modal" data-target="#exampleModalCenter3" class="btn btn-danger btn-block"><span style="text-decoration:underline;">E</span>xit Queue</span></button>
            </li>
            <?php }else{ ?>
              <li class="list-group-item d-flex justify-content-between align-items-center">
              <button type="button" data-toggle="modal" data-target="#exampleModalCenter2" class="btn btn-success btn-block">Queue Here &raquo;</button>
            </li>
          <?php } ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
            <span style="font-size:14px;"> estimated waiting time: <span style="text-decoration:underline;"><strong>28</strong></span> minutes </span>
            </li>
          </ul>
          <hr class="featurette-divider">

          <!-- /END THE FEATURETTES -->

          <form method="post" action="cus-landing.php" id="queueForm">
        <div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog"
          aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Your Contact Information </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-group">
                    <label for="queue-cus-name">Name </label>
                    <input type="text" class="form-control" name="queue_cus_name" id="queue-cus-name" placeholder="Your Name">
                  </div>
                <div class="form-group">
                    <label for="queue-cus-contact">Phone Number </label>
                    <input type="text" class="form-control" name="queue_cus_contact" id="queue-cus-contact" placeholder="Your contact number">
                  </div>
                <div class="form-group">
                    <label for="queue-cus-size">How many are we expecting? </label>
                    <input type="number" class="form-control" name="queue_cus_size" id="queue_cus_size">
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <input type="hidden" name="res_id" value="<?php echo $_GET['r'];?>">
                <button type="submit" class="btn btn-primary" name="submit_queue">Submit </button>
              </div>
            </div>
          </div>
        </form>  
      </div>
      <form method="post" action="cus-landing.php" id="deleteqForm">
        <div class="modal fade" id="exampleModalCenter3" tabindex="-1" role="dialog"
          aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Confirm Exiting </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-group">
                    <label for="confirmation">Do you want to exit from the queue? </label>
                  </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <input type="hidden" name="res_id" value="<?php echo $_GET['r'];?>">
                <button type="submit" class="btn btn-danger" name="delete_queue">Yes </button>
              </div>
            </div>
          </div>
        </form>
        </div><!-- /.container -->
      </div>
      <!-- FOOTER -->
      <footer class="container">
        <p class="float-right"><a href="#">Back to top</a></p>
        <p>Copyright © 2020 FoodBoard. All rights reserved.</p>
      </footer>
  </main>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
  </script>
  <script>
    window.jQuery || document.write('<script src="assets/js/vendor/jquery.slim.min.js"><\/script>')
  </script>
  <script src="assets/dist/js/bootstrap.bundle.js"></script>
</body>

</html>
