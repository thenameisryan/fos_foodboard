<?php 
    include("include/connectdb.php");

    $qry_inqueue = "SELECT * FROM  fos_queue 
            WHERE client_uid = '".$_SESSION['user_id']."' AND queue_number = '1'";  
    $result_inqueue = mysqli_query($db, $qry_inqueue);
    $inq = mysqli_fetch_assoc($result_inqueue);
	$qry_next = "DELETE FROM fos_queue WHERE uid ='".$inq['uid']."'";
    mysqli_query($db, $qry_next);
    $qry_update_q = "UPDATE fos_queue SET queue_number = queue_number - 1 
						WHERE client_uid ='".$_SESSION['user_id']."' 
						AND queue_number > 1";
	mysqli_query($db, $qry_update_q);
    header('location: index.php');

?>