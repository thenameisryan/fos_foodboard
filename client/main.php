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
      <a class="navbar-brand" href="landing.php"> Back</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
        aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Ryan's Burger Place</a>
          </li>
        </ul>
        <form class="form-inline mt-2 mt-md-0">
          <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>
  </header>
  <!-- Start Sub-header -->
  <div class="nav-scroller bg-white shadow-sm">
    <nav class="nav nav-underline">
      <a class="nav-link active" href="#">
        All
        <!-- <span class="badge badge-pill bg-light align-text-bottom">17</span> -->
      </a>
      <a class="nav-link" href="#">Appetizers</a>
      <a class="nav-link" href="#">Main</a>
      <a class="nav-link" href="#">Favourites</a>
      <a class="nav-link" href="#">Other</a>
      <a class="nav-link" href="#">Beverages</a>
      <a class="nav-link" href="#">Alcohol</a>
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
  <section class="latest-product spad">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-6">
          <div class="card" style="width: 20rem;">
            <img class="card-img-top" src="img/product/lp-1.jpg" alt="Card image cap">
            <div class="card-block">
              <h4 class="card-title">Vegetable</h4>
              <p class="card-text">Price: RM1.00</p>
              <a href="#" data-name="Vegetable" data-price="1.0" class="add-to-cart btn btn-primary">Add to cart</a>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="card" style="width: 20rem;">
            <img class="card-img-top" src="img/product/lp-2.jpg" alt="Card image cap">
            <div class="card-block">
              <h4 class="card-title">Capsaicin</h4>
              <p class="card-text">Price: RM10.00</p>
              <a href="#" data-name="Capsaicin" data-price="10.0" class="add-to-cart btn btn-primary">Add to cart</a>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="card" style="width: 20rem;">
            <img class="card-img-top" src="img/product/lp-3.jpg" alt="Card image cap">
            <div class="card-block">
              <h4 class="card-title">Chicken</h4>
              <p class="card-text">Price: RM3.85</p>
              <a href="#" data-name="Chicken" data-price="3.85" class="add-to-cart btn btn-primary">Add to cart</a>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="card" style="width: 20rem;">
            <img class="card-img-top" src="img/product/alert.png" alt="Card image cap">
            <div class="card-block">
              <h4 class="card-title">Orange</h4>
              <p class="card-text">Price: RM2.00</p>
              <a href="#" data-name="Orange" data-price="2.0" class="add-to-cart btn btn-primary">Add to cart</a>
            </div>
          </div>
        </div>
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
      <li><button type="button" class="btn btn-success">Submit Order</button></li>
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
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button class="clear-cart btn btn-danger">Clear Cart</button></div>
          <button type="button" class="btn btn-success">Submit Order</button>
        </div>
      </div>
    </div>
  </div>
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
