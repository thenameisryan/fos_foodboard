<?php 
include("include/connectdb.php");
if(isset($_GET['del'])) {
    echo $qry_delete = "DELETE FROM fos_cat WHERE uid ='".$_GET['del']."'";
    mysqli_query($db, $qry_delete);
    header('location: menu-categories.php');
}
?>