<?php

require("../../php/database.php");
session_start();
$username = $_SESSION['username'];
$plan =  $_GET['plan'];
$storage = $_GET['storage'];
$purchase_date = date('Y-m-d');

if($plan == 'starter' || $plan=='free')
{
	$cal_date = new DateTime($purchase_date);
	$cal_date->add(new DateInterval('P30D'));
	$expiry_date = $cal_date->format('Y-m-d');

	$select_storage  = "SELECT storage from users WHERE username = '$username'";
	$response = $db->query($select_storage);
	$data = $response->fetch_assoc();
	$final_storage ;
	if(empty($_SESSION['renew']))
	{
		$final_storage = $storage+$data['storage'];
	}
	else
	{
		$final_storage = 0+$data['storage'];
	}

	//update storage
	$update_storage="UPDATE users SET plans='$plan',storage='$final_storage',purchase_date='$purchase_date',expiry_date='$expiry_date' WHERE username='$username'";
	if($db->query($update_storage))
	{
		header("Location:../profile.php");
	}
	else{
		echo "Update failed";
	}
}
else
{
	$cal_date = new DateTime($purchase_date);
	$cal_date->add(new DateInterval('P30D'));
	$expiry_date = $cal_date->format('Y-m-d');

	$update_storage="UPDATE users SET plans='$plan',storage='0',purchase_date='$purchase_date',expiry_date='$expiry_date' WHERE username='$username'";
	if($db->query($update_storage))
	{
		header("Location:../profile.php");
	}
	else
	{
		echo "Update failed";
	}
}



?>

<?php
// database connection close

 $db->close();

?>