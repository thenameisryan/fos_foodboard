<?php 
include("include/connectdb.php");
if (isset($_GET['id'])) {
    $qry_cat = "DELETE FROM fos_cat WHERE client_uid ='".$_GET['id']."'";
    $qry_client = "DELETE FROM fos_client WHERE uid ='".$_GET['id']."'";
    $qry_landing = "DELETE FROM fos_landing WHERE client_uid ='".$_GET['id']."'";
    $qry_order = "DELETE FROM fos_order WHERE client_uid ='".$_GET['id']."'";
    //$qry_orderitem = "DELETE FROM fos_orderitem WHERE uid ='".$_GET['id']."'";
    $qry_prod = "DELETE FROM fos_prod WHERE client_uid ='".$_GET['id']."'";
    $qry_queue = "DELETE FROM fos_queue WHERE client_uid ='".$_GET['id']."'";
    $qry_review = "DELETE FROM fos_review WHERE client_uid ='".$_GET['id']."'";
    mysqli_query($db, $qry_cat);
    mysqli_query($db, $qry_client);
    mysqli_query($db, $qry_landing);
    mysqli_query($db, $qry_order);
    mysqli_query($db, $qry_prod);
    mysqli_query($db, $qry_queue);
    mysqli_query($db, $qry_review);
    header('location: client.php');
}
?>