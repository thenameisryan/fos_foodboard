<?php 
include("php/connectdb.php");
$obj = new Database();
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
  <!-- Custom styles for this template -->
  <link href="assets/dist/css/offcanvas.css" rel="stylesheet">
</head>
<body>
<div class="container">
	<?php

	if (isset($_POST['place_order']))
 	{
          $client = mysqli_real_escape_string($db, $_POST['client_id']);
		$insert_order = "INSERT INTO fos_order(client_uid,order_cusid,date_created,order_status)
		VALUES('$client', '$randNum','$datenow','PENDING')";
		$order_id = '';
		if($obj->conn->query($insert_order))
		{
			$order_id = $obj->conn->insert_id;

		}
		$_SESSION["order_id"] = $order_id; 
		$order_details = "";  
	    foreach($_SESSION["shopping_cart"] as $keys => $values)  
	        {  
	            $order_details .= "  
	            INSERT INTO fos_orderitem(order_number, 
	            prod_name,prod_price,prod_quantity)  
	            VALUES('".$order_id."', '".$values["product_name"]."',
	            '".$values["product_price"]."', '".$values["product_quantity"]."');";  
	        }  
	            if($obj->conn->multi_query($order_details))  
	            {  
	                unset($_SESSION["shopping_cart"]);  
	                echo '<script>alert("You have successfully place an order...Thank you")</script>';  
	                echo '<script>window.location.href="cart.php"</script>';  
	            }  
	}

	  if(isset($_SESSION["order_id"]))  
                {  
                     $customer_details = '';  
                     $order_details = '';  
                     $total = 0;  
                     $query = '  
                     SELECT * FROM fos_order  
                     INNER JOIN fos_orderitem  
                     ON fos_orderitem.order_number = fos_order.uid  
                     WHERE fos_order.uid = "'.$_SESSION["order_id"].'"  
                     ';  
                     $result = $obj->conn->query($query);  
                     while($row = $result->fetch_assoc())  
                     {  
                          $order_details .= "  
                               <tr>  
                                    <td>".$row["prod_name"]."</td>  
                                    <td>".$row["prod_quantity"]."</td>  
                                    <td>".$row["prod_price"]."</td>  
                                    <td>".number_format($row["prod_quantity"] * $row["prod_price"], 2)."</td>  
                               </tr>  
                          ";  
                          $total = $total + ($row["prod_quantity"] * $row["prod_price"]);  
                     }  
                     echo '  
                     <h3 align="center">Order Summary for Order No.'.$_SESSION["order_id"].'</h3>  
                     <div class="table-responsive">  
                          <table class="table">  
                                 
                               <tr>  
                                    <td class="text-center"><label style="font-weight:bold;font-size:24px">Order Details</label></td>  
                               </tr>  
                               <tr>  
                                    <td>  
                                         <table class="table table-bordered">  
                                              <tr>  
                                                   <th width="50%">Product Name</th>  
                                                   <th width="15%">Quantity</th>  
                                                   <th width="15%">Price (RM)</th>  
                                                   <th width="20%">Total (RM)</th>  
                                              </tr>  
                                              '.$order_details.'  
                                              <tr>  
                                                   <td colspan="3" align="right"><label style="font-weight:bold;font-size:18px">Total (RM)</label></td>  
                                                   <td style="font-weight:bold;font-size:18px">'.number_format($total, 2).'</td>  
                                              </tr>  
                                         </table>  
                                    </td>  
                               </tr>  
                          </table>  
                     </div>  
                     ';  
                }   
      ?>
      <form method="post" action="">
      <button type="submit" name="submit_order" class="btn btn-success btn-block">Checkout</button>
               </form>
</div>

</body>

</html>
