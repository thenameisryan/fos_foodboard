<?php
include("php/connectdb.php");

$qry_name = "SELECT * FROM fos_client
        WHERE uid = '".$_GET['r']."'";  
$result_name = mysqli_query($db, $qry_name);
$num_name = mysqli_num_rows($result_name);

$qry = "SELECT * FROM fos_prod 
        WHERE client_uid = '".$_GET['r']."'";  
$result_items = mysqli_query($db, $qry);
$num_items = mysqli_num_rows($result_items);

$qry_cat = "SELECT * FROM fos_cat 
        WHERE client_uid = '".$_GET['r']."'";  
$result_cat = mysqli_query($db, $qry_cat);
$num_cat = mysqli_num_rows($result_cat);

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
    .show-cart li {
      display: flex;
    }

    .card {
      margin-bottom: 20px;
    }

    .card-img-top {
      width: 200px;
      height: 200px;
      align-self: center;
    }

    /*---------------------
  Latest Product
-----------------------*/

    .latest-product {
      padding-top: 10px;
      padding-bottom: 0;
    }

    .latest-product__text h4 {
      font-weight: 700;
      color: #1c1c1c;
      margin-bottom: 45px;
    }

    .latest-product__slider.owl-carousel .owl-nav {
      position: absolute;
      right: 20px;
      top: -75px;
    }

    .latest-product__slider.owl-carousel .owl-nav button {
      height: 30px;
      width: 30px;
      background: #F3F6FA;
      border: 1px solid #e6e6e6;
      font-size: 14px;
      color: #636363;
      margin-right: 10px;
      line-height: 30px;
      text-align: center;
    }

    .latest-product__slider.owl-carousel .owl-nav button span {
      font-weight: 700;
    }

    .latest-product__slider.owl-carousel .owl-nav button:last-child {
      margin-right: 0;
    }

    .latest-product__item {
      margin-bottom: 20px;
      overflow: hidden;
      display: block;
    }

    .latest-product__item__pic {
      float: left;
      margin-right: 26px;
    }

    .latest-product__item__pic img {
      height: 110px;
      width: 110px;
    }

    .latest-product__item__text {
      overflow: hidden;
      padding-top: 10px;
    }

    .latest-product__item__text h6 {
      color: #252525;
      margin-bottom: 8px;
    }

    .latest-product__item__text span {
      font-size: 18px;
      display: block;
      color: #252525;
      font-weight: 700;
    }

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
  <link href="assets/dist/css/offcanvas.css" rel="stylesheet">
</head>

<body>
  <header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <a class="navbar-brand" href="cus-landing.php?r=<?php echo $_GET['r'];?>"> Back</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
        aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true"><?php for($c=0; $c<$num_name; $c++) { ?>
    <?php $name = mysqli_fetch_assoc($result_name);?><?php echo $name['client_res_name'];?><?php } ?></a>
          </li>
        </ul>
        <form class="form-inline mt-2 mt-md-0" method="get" action="cus-menu.php" id="searchForm">
          <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit" value="searchForm">Search</button>
        </form>
      </div>
    </nav>
  </header>
  <!-- Start Sub-header -->
  <div class="nav-scroller bg-white shadow-sm">
    <nav class="nav nav-underline">
    <?php for($c=0; $c<$num_cat; $c++) { ?>
    <?php $cat = mysqli_fetch_assoc($result_cat);?>
      <a class="nav-link active" href="#">
        <?php echo $cat['cat_title'];?>
        <!-- <span class="badge badge-pill bg-light align-text-bottom">17</span> -->
      </a>
    <?php } ?>  
      <!-- <a class="nav-link" href="#">Appetizers</a>
      <a class="nav-link" href="#">Main</a>
      <a class="nav-link" href="#">Favourites</a>
      <a class="nav-link" href="#">Other</a>
      <a class="nav-link" href="#">Beverages</a>
      <a class="nav-link" href="#">Alcohol</a> -->
    </nav>
  </div>
  <!-- End Sub-header -->
  <!-- <div class="container-fluid">
    <div class="row">
      <nav id="sidebarMenu" class=".col-6 .col-md-4 d-md-block bg-light">
        <div class="sidebar-sticky pt-3">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link active" href="#">
                Appetizers 
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                Main
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                Favourites
              </a>
            </li>
          </ul>
          <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Beverages</span>
            <a class="d-flex align-items-center text-muted" href="#" aria-label="Add a new report">
              <span data-feather="plus-circle"></span>
            </a>
          </h6>
          <ul class="nav flex-column mb-2">
            <li class="nav-item">
              <a class="nav-link" href="#">
                Homemade
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                Sodas
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                Alcohol
              </a>
            </li>
          </ul>
        </div>
      </nav> -->

  <!-- Latest Product Section Begin -->
<form method="post" action="cus-menu.php" id="submitForm">
  <section class="latest-product spad">
    <div class="container">
      <div class="row">
          <?php for($c=0; $c<$num_items; $c++){ ?>
          <?php $prod = mysqli_fetch_assoc($result_items);?>
          <?php $client_img_path = "client/".$prod['prod_image'];?>
          <?php $client_prod_price = number_format(($prod['prod_price']*1.0),2);?>
            <div class="col-lg-4 col-md-6">
              <div class="card" style="width: 20rem;">
              <img class="card-img-top" src="<?php echo $client_img_path?>" alt="Image">
                <div class="card-block">
                  <h4 class="card-title"><?php echo $prod['prod_name'];?></h4>
                  <p class="card-text">Price: RM<?php echo $client_prod_price;?></p>
                  <a href="#" data-name="<?php echo $prod['prod_name'];?>" data-price="<?php echo $client_prod_price;?>" class="add-to-cart btn btn-primary">Add to cart</a>
                </div>
              </div>
            </div>
          <?php } ?>
        <!-- <div class="latest-product__slider owl-carousel">
                <div class="latest-prdouct__slider__item">
                    <a href="#" class="latest-product__item">
                        <div class="latest-product__item__pic">
                            <img src="img/latest-product/lp-1.jpg" alt="">
                        </div>
                        <div class="latest-product__item__text">
                            <h6>Food Name</h6>
                            <span>$30.00</span>
                        </div>
                    </a>
                    <a href="#" class="latest-product__item">
                        <div class="latest-product__item__pic">
                            <img src="img/latest-product/lp-2.jpg" alt="">
                        </div>
                        <div class="latest-product__item__text">
                            <h6>Food Name</h6>
                            <span>$30.00</span>
                        </div>
                    </a>
                    <a href="#" class="latest-product__item">
                        <div class="latest-product__item__pic">
                            <img src="img/latest-product/lp-3.jpg" alt="">
                        </div>
                        <div class="latest-product__item__text">
                            <h6>Food Name</h6>
                            <span>$30.00</span>
                        </div>
                    </a>
                </div>
              </div> -->
      
      </div>
    </div>
  </section>
  <!-- Latest Product Section End -->

  </div>
  </div>
  <nav class="navbar navbar-inverse bg-inverse fixed-bottom bg-faded">
    <ul class="nav navbar-nav">
      <li><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cart">Cart (<span
            class="total-count"></span>)</button></li>
    </ul>

    <ul class="nav navbar-nav navbar-center">
      <li><a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Total: <span class="total-cart"></a>
      </li>
    </ul>

    <ul class="nav navbar-nav navbar-right">
      <li><button type="submit" name="submit_order" class="clear-cart btn btn-success">Submit Order</button></li>
    </ul>
  </nav>
  <!-- Modal -->
  <div class="modal fade" id="cart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Cart</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <table class="show-cart table">

          </table>
          <div>Total price: $<span class="total-cart"></span></div>
        </div>
        <div class="modal-footer">
          <button class="clear-cart btn btn-danger">Clear Cart</button></div>
          <button type="submit" name="submit_order" class="clear-cart btn btn-success">Submit Order</button>
        </div>
      </div>
    </div>
  </div>
</form>
  <!-- FOOTER -->
  </main>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
  </script>
  <script>
    window.jQuery || document.write('<script src="assets/js/vendor/jquery.slim.min.js"><\/script>')
  </script>
  <script src="assets/dist/js/bootstrap.bundle.js"></script>
  <script src="assets/dist/js/shoppingcart.js"></script>

</body>

</html>
