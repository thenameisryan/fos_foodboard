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
if (isset($_GET['exq'])) {
    $qry_inqueue = "SELECT * FROM  fos_queue 
            WHERE client_uid = '".$_SESSION['user_id']."' ORDER BY  queue_number DESC LIMIT 1";  
    $result_inqueue = mysqli_query($db, $qry_inqueue);
    $inq = mysqli_fetch_assoc($result_inqueue);
	$qry_exit = "DELETE FROM fos_queue WHERE uid ='".$_GET['exq']."'";
    mysqli_query($db, $qry_exit);
    $qry_update_q = "UPDATE fos_queue SET queue_number = queue_number - 1 
						WHERE queue_number != '1' AND client_uid ='".$_SESSION['user_id']."' 
						AND queue_number >= '".$inq['queue_number']."'";
	mysqli_query($db, $qry_update_q);
    header('location: manage-queue.php');
}
if (isset($_GET['delord'])) {
	$qry_delord = "DELETE FROM fos_order WHERE uid ='".$_GET['delord']."'";
    mysqli_query($db, $qry_delord);
    $qry_delorditem = "DELETE FROM fos_orderitem WHERE order_number ='".$_GET['delord']."'";
	mysqli_query($db, $qry_delorditem);
    header('location: manage-order.php');
}
?>