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
        <li data-target="#myCarousel" data-slide-to="1"></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg"
            preserveAspectRatio="xMidYMid slice" focusable="false" role="img">
            <rect width="100%" height="100%" fill="#777" /></svg>
          <div class="container">
            <div class="carousel-caption text-left">
              <h1>Ryan's Burger Place</h1>
              <p>Inspired by ShakeShack, In-N-Out and the likes, we decided that Malaysia needed its own version too.
                So, we started with one simple objective. Sell a really good, juicy burger on a fresh bun. No shortcuts.
              </p>
            </div>
          </div>
        </div>
        <div class="carousel-item">
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
        </div>
      </div>
      <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>


    <!-- Marketing messaging and featurettes
  ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

    <div class="container marketing">

      <!-- Three columns of text below the carousel -->
      <div class="row">
        <div class="col-lg-4">
          <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg"
            preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 140x140">
            <title>Placeholder</title>
            <rect width="100%" height="100%" fill="#777" /><text x="50%" y="50%" fill="#777" dy=".3em">140x140</text>
          </svg>
          <h2></h2>
          <p><a class="btn btn-secondary" href="main.php" role="button">View Menu &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
          <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg"
            preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 140x140">
            <title>Placeholder</title>
            <rect width="100%" height="100%" fill="#777" /><text x="50%" y="50%" fill="#777" dy=".3em">140x140</text>
          </svg>
          <h2></h2>
          <p><a class="btn btn-secondary" href="#" role="button">Track Order &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
          <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg"
            preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 140x140">
            <title>Placeholder</title>
            <rect width="100%" height="100%" fill="#777" /><text x="50%" y="50%" fill="#777" dy=".3em">140x140</text>
          </svg>
          <h2></h2>
          <p><a class="btn btn-secondary" href="#" role="button">Call for Assistance &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
      </div><!-- /.row -->


      <!-- START THE FEATURETTES -->

      <hr class="featurette-divider">

      <div class="row featurette">
        <div class="col-md-7">
          <h2 class="featurette-heading">Virtual Queue <span class="text-muted">You are in line. </span></h2>
        </div>
        <div class="col-md-5">

          <ul class="list-group list-group-flush">
            <li class="list-group-item d-flex justify-content-between align-items-center">John <span
                class="badge badge-primary badge-pill">1</span></li>
            <li class="list-group-item d-flex justify-content-between align-items-center">Amy <span
                class="badge badge-primary badge-pill">2</span></li>
            <li class="list-group-item d-flex justify-content-between align-items-center active">Jane </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">Mark <span
                class="badge badge-primary badge-pill">4</span></li>
            <li class="list-group-item d-flex justify-content-between align-items-center">Paul <span
                class="badge badge-primary badge-pill">5</span></li>
          </ul>

          <hr class="featurette-divider">

          <!-- /END THE FEATURETTES -->

        </div><!-- /.container -->


        <!-- FOOTER -->
        <footer class="container">
          <p class="float-right"><a href="#">Back to top</a></p>
          <p>&copy; 2017-2020 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
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
