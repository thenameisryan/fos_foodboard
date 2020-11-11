<?php
session_start();
date_default_timezone_set("Asia/Kuala_Lumpur");
$datenow = date('d-m-Y H:i:s');
$hour = time() + 3600 * 24 * 30;
$errors = array(); 
$randNum = mt_rand(1, 9999);

// CONNECT TO THE DATABASE
$db = mysqli_connect('localhost', 'root', '', 'fos_foodboard');
//$livedb = mysqli_connect('us-cdbr-east-02.cleardb.com', 'b28d97703c10fa', '7a57ff43', 'fos-foodboard');
if (!$db) {
    die('Could not connect: ' . mysql_error());
}

//REVIEW FORM
if (isset($_POST['submit_review'])) {
	$reviewer_rating = mysqli_real_escape_string($db, $_POST['reviewer_rating']);
	$reviewer_review = mysqli_real_escape_string($db, $_POST['reviewer_review']);
	$res_id = mysqli_real_escape_string($db, $_POST['res_id']);

	if (count($errors) == 0) {
		$query = "INSERT INTO fos_review (client_uid, review_stars, review_content, date_created) 
				  VALUES('$res_id', '$reviewer_rating', '$reviewer_review', '$datenow')";
	  	mysqli_query($db, $query);
	  	header('location: cus-landing.php?r=' . $res_id);
 	}
	  
}

if (isset($_POST['submit_order'])) {
	header('location: payment.php');
}

if (isset($_POST['submit_queue'])) {
	$queue_cus_name = mysqli_real_escape_string($db, $_POST['queue_cus_name']);
	$queue_cus_contact = mysqli_real_escape_string($db, $_POST['queue_cus_contact']);
	$queue_cus_size = mysqli_real_escape_string($db, $_POST['queue_cus_size']);
	$res_id = mysqli_real_escape_string($db, $_POST['res_id']);
	$curqNum = mysqli_real_escape_string($db, $_POST['curqNum']);

	$qNum = $curqNum + 1;

	if (count($errors) == 0) {
		$query = "INSERT INTO fos_queue (client_uid ,queue_number, queue_cus_name, queue_cus_contact, queue_status, queue_cus_size, date_created) 
					VALUES('$res_id', '$qNum', '$queue_cus_name', '$queue_cus_contact', 'WAITING', '$queue_cus_size', '$datenow')";
		mysqli_query($db, $query);
		$sql_id = "SELECT * FROM fos_queue WHERE queue_cus_name='$queue_cus_name' 
					AND client_uid='$res_id' 
					AND queue_cus_contact = '$queue_cus_contact' LIMIT 1";
		$result_id = mysqli_query($db, $sql_id);
		$id = mysqli_fetch_assoc($result_id);
		$_SESSION['inq'] = "true";
		$_SESSION['inqnum'] = $id['uid'];
		$_SESSION['inqnum2'] = $id['queue_number'];
		$_SESSION['Qcname'] = $queue_cus_name;
    	$_SESSION['Qccon'] = $queue_cus_contact;
    
		header('location: cus-landing.php?r=' . $res_id);
	  
	 }
	  
}
//delete queue
if (isset($_POST['delete_queue'])) {
	$res_id = mysqli_real_escape_string($db, $_POST['res_id']);
	$curqNum = mysqli_real_escape_string($db, $_POST['curqNum']);
	$qcname = mysqli_real_escape_string($db, $_POST['Qcname']);

	$qNum = $curqNum - 1;

	$sql_id = "SELECT * FROM fos_queue WHERE queue_cus_name='".$qcname."' 
					AND client_uid='$res_id' 
					";
	$result_id = mysqli_query($db, $sql_id);
	$id = mysqli_fetch_assoc($result_id);
	$qry_exit = "DELETE FROM fos_queue WHERE uid ='".$_SESSION['inqnum']."'";
	mysqli_query($db, $qry_exit);
	$qry_update_q = "UPDATE fos_queue SET queue_number = queue_number - 1 
						WHERE queue_number != '1' AND client_uid ='".$res_id."' 
						AND queue_number >= '".$id['queue_number']."'";
	mysqli_query($db, $qry_update_q);
	session_destroy();
	unset($_SESSION['inq']);
	unset($_SESSION['inqnum']);
	unset($_SESSION['Qcname']);
	unset($_SESSION['Qccon']);
    header('location: cus-landing.php?r=' . $res_id);
}
?>