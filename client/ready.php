<?php 
include("include/connectdb.php");
if(isset($_GET['q'])) {
    $qry_ready = "UPDATE fos_queue SET queue_status = 'READY' WHERE uid ='".$_GET['q']."'";
    mysqli_query($db, $qry_ready);
    header('location: manage-queue.php');
}
if(isset($_GET['qindex'])) {
    $qry_ready = "UPDATE fos_queue SET queue_status = 'READY' WHERE uid ='".$_GET['qindex']."'";
    mysqli_query($db, $qry_ready);
    header('location: index.php');
}

?>