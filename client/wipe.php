<?php 
include("include/connectdb.php");
if(isset($_GET['del'])) {
    $qry_delete = "DELETE FROM fos_cat WHERE uid ='".$_GET['del']."'";
    mysqli_query($db, $qry_delete);
    header('location: menu-categories.php');
}
if(isset($_GET['delitms'])) {
    $qry_delete_items = "DELETE FROM fos_prod WHERE uid ='".$_GET['delitms']."'";
    mysqli_query($db, $qry_delete_items);
    header('location: menu-items.php');
}
?>