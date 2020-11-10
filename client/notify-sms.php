<?php 
    include("include/connectdb.php");
    include("assets/vendor/vendor/autoload.php");

    $restaurantName = $_SESSION['res_name'];
    $cusName = $_GET['n'];

    $liveAPIkey = "PvamK0S38HbhAbm7bJe2U4n8b";
    $testAPIkey = "hSwqwVnx8Cxnbmyj4kAg9Ivmo";
    $msgBody = "Hi $cusName, you are ready to be seated. From " . $restaurantName;

	$MessageBird = new \MessageBird\Client($testAPIkey);
	$Message = new \MessageBird\Objects\Message();
	$Message->originator = 'FoodBoard';
	$Message->recipients = array(+60164157901);
	$Message->body = $msgBody;

	print_r(json_encode($MessageBird->messages->create($Message)));
    header('location: manage-queue.php');

?>