<?php
include("php/connectdb.php");
$obj = new Database();

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
     .product-display {
    background-color:#f0f0f0;
    border-radius:5px; padding:16px;
    height:460px;
    text-align:center;

 }
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
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true"><?php for($c=0; $c<$num_name; $c++) { ?>
    <?php $name = mysqli_fetch_assoc($result_name);?><?php echo $name['client_res_name'];?><?php } ?></a>
          </li>
        </ul>
        <!-- <form class="form-inline mt-2 mt-md-0" method="get" action="cus-menu.php" id="searchForm">
          <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit" value="searchForm">Search</button>
        </form> -->
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

  <!-- Latest Product Section Begin -->
  <section class="latest-product spad">
  <div class="container" > 
                     <!-- <li><a data-toggle="tab" href="#cart">Cart <span class="badge"> -->
                     <div class="row">
                     <?php  
                     $query = "SELECT * FROM fos_prod WHERE client_uid = '".$_GET['r']."' ORDER BY uid ASC";  
                     $result = $obj->conn->query($query);  
                     while($row = $result->fetch_assoc())  
                     {  
                     ?>  
                     
                     <div class="col-lg-4" style="margin-bottom: 20px;">  
                          <div class="product-display">  
                               <img src="client/<?php echo $row["prod_image"]; ?>" class="card-img-top" /><br />  
                               <h4 class="text-info"><?php echo $row["prod_name"]; ?></h4>  
                               <h4 class="text-danger">RM <?php echo $row["prod_price"]; ?></h4>  
                               <input type="text" name="quantity" id="quantity<?php echo $row["uid"]; ?>" class="form-control" value="1" />  
                               <input type="hidden" name="hidden_name" id="name<?php echo $row["uid"]; ?>" value="<?php echo $row["prod_name"]; ?>" />  
                               <input type="hidden" name="hidden_price" id="price<?php echo $row["uid"]; ?>" value="<?php echo $row["prod_price"]; ?>" />  
                               <input type="button" name="add_to_cart" id="<?php echo $row["uid"]; ?>" style="margin-top:5px;" class="btn btn-primary form-control add_to_cart" value="Add to Cart" />  
                          </div>  
                     </div> 
                      
                     <?php  
                     }  
                     ?>  
                     </div>  
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
        <div class="table-responsive" id="order_table">  
                               <table class="table table-bordered">  
                                    <tr>  
                                         <th width="40%">Product Name</th>  
                                         <th width="10%">Quantity</th>  
                                         <th width="20%">Price (RM)</th>  
                                         <th width="15%">Total (RM)</th>  
                                         <th width="5%">Action</th>  
                                    </tr>  
                                    <?php  
                                    if(!empty($_SESSION["shopping_cart"]))  
                                    {  
                                         $total = 0;  
                                         foreach($_SESSION["shopping_cart"] as $keys => $values)  
                                         {                                               
                                    ?>  
                                    <tr>  
                                         <td><?php echo $values["product_name"]; ?></td>  
                                         <td><input type="text" name="quantity[]" id="quantity<?php echo $values["product_id"]; ?>" value="<?php echo $values["product_quantity"]; ?>" data-product_id="<?php echo $values["product_id"]; ?>" class="form-control quantity" /></td>  
                                         <td align="right"><?php echo $values["product_price"]; ?></td>  
                                         <td align="right"><?php echo number_format($values["product_quantity"] * $values["product_price"], 2); ?></td>  
                                         <td><button name="delete" class="btn btn-danger btn-xs delete" id="<?php echo $values["product_id"]; ?>">X</button></td>  
                                    </tr>  
                                    <?php  
                                              $total = $total + ($values["product_quantity"] * $values["product_price"]);
                                              $_SESSION['nav_total_price'] = $total;
                                         }  
                                    ?>  
                                    <tr>  
                                         <td colspan="3" align="right">Total (RM)</td>  
                                         <td align="right"><?php echo number_format($total, 2); ?></td>  
                                         <td></td>  
                                    </tr>
                                         <tr>  
                                         <td colspan="5" align="center">
                                           <form action="cart.php" method="post">
                                           <div class="modal-footer"></div>
                                            <input type="hidden" name="client_id" value="<?php echo $_GET['r'];?>">
                                             <input type="submit" name="place_order" value="Submit Order" class="btn btn-success btn-block">
                                           
                                         </td>  
                                    
                                    </tr>
                                    <?php  
                                    }  
                                    ?>  
                               </table>  
                          </div>
        </div>
        </div>
      </div>
    </div>
  </div>
           </div> 
  </section>
  <!-- Latest Product Section End -->

  </div>
  </div>
  <nav class="navbar navbar-inverse bg-inverse fixed-bottom bg-dark">
    <ul class="nav navbar-nav">
      <li><button type="button" class="btn btn-info" data-toggle="modal" data-target="#cart">Cart (<span class="badge">
                      <?php 
                        if(isset($_SESSION["shopping_cart"]))
                        {
                         echo count($_SESSION["shopping_cart"]);
                        }
                        else
                        {
                          echo '0';
                        }
                      ?></span>)</button></li>
    </ul>

    <ul class="nav navbar-nav navbar-center">
      <!-- <li><a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Total: RM <?php if(isset($_SESSION['nav_total_price'])) { echo $_SESSION['nav_total_price']; }else{ echo "0";} ?></a>
      </li> -->
    </ul>

    <ul class="nav navbar-nav navbar-right">
      <li><input type="submit" name="place_order" value="Submit Order" class="btn btn-success btn-block"></li>
    </ul>
  </nav>
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script>
 //Jquery code to add product to Cart usign Ajax method  
 $(document).ready(function(data){  
      $('.add_to_cart').click(function(){  
           var product_id = $(this).attr("id");  
           var product_name = $('#name'+product_id).val();  
           var product_price = $('#price'+product_id).val();  
           var product_quantity = $('#quantity'+product_id).val();  
           var action = "add";  
           if(product_quantity > 0)  
           {  
                $.ajax({  
                     url:"action.php",  
                     method:"POST",  
                     dataType:"json",  
                     data:{  
                          product_id:product_id,   
                          product_name:product_name,   
                          product_price:product_price,   
                          product_quantity:product_quantity,   
                          action:action  
                     },  
                     success:function(data)  
                     {  
                          $('#order_table').html(data.order_table);  
                          $('.badge').text(data.cart_item);  
                          alert("Product has been Added into Cart");  
                     }  
                });  
           }  
           else  
           {  
                alert("Please Enter atleast one quantity");  
           }  
      }); 

//Jquery code to Remove product to Cart using Ajax method
      $(document).on('click','.delete',function() {
        var product_id = $(this).attr("id");
        var action = "remove";
        if (confirm("Are you sure you want to remove the product")) {
          $.ajax({  
                     url:"action.php",  
                     method:"POST",  
                     dataType:"json",  
                     data:{  
                          product_id:product_id,     
                          action:action  
                     },  
                     success:function(data)  
                     {  
                          $('#order_table').html(data.order_table);  
                          $('.badge').text(data.cart_item);  
                         // alert("Product has been Added into Cart");  
                     }  
                });


        }else {
          return false;
        }
      });

//Jquery code to live price update on  change of product quantity using Ajax method
      $(document).on('keyup', '.quantity', function(){  
           var product_id = $(this).data("product_id");  
           var quantity = $(this).val();  
           var action = "quantity_change";  
           if(quantity != '')  
           {  
                $.ajax({  
                     url :"action.php",  
                     method:"POST",  
                     dataType:"json",  
                     data:{product_id:product_id, quantity:quantity, action:action},  
                     success:function(data){  
                          $('#order_table').html(data.order_table);  
                     }  
                });  
           }  
      });  
 });  
 </script>

</body>

</html>
