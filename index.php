<?php

session_start();

require_once ('php/CreateDb.php');
require_once ('./php/component.php');

$d = $_GET['r'];

// create instance of Createdb class
$database = new CreateDb("fos_foodboard", "fos_prod");

if (isset($_POST['add'])){
    /// print_r($_POST['product_id']);
    if(isset($_SESSION['cart'])){

        $item_array_id = array_column($_SESSION['cart'], "product_id");

        if(in_array($_POST['product_id'], $item_array_id)){
            header('location: index.php?r='.$d);
        }else{

            $count = count($_SESSION['cart']);
            $item_array = array(
                'product_id' => $_POST['product_id']
            );

            $_SESSION['cart'][$count] = $item_array;
        }

    }else{

        $item_array = array(
                'product_id' => $_POST['product_id']
        );

        // Create new session variable
        $_SESSION['cart'][0] = $item_array;
        //print_r($_SESSION['cart']);
    }
}


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


<?php require_once ("php/header.php"); ?>
<div class="container">
        <div class="row text-center py-5">
            <?php
                $result = $database->getData();
                while ($row = mysqli_fetch_assoc($result)){
                    component($row['prod_name'], $row['prod_price'], $row['prod_image'], $row['uid'],$row['client_uid']);
                }
            ?>
        </div>
</div>





<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
