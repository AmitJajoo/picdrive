<?php

$db = new mysqli("localhost","root","","pic_drive");

if($db->connect_error){
	die("Database is not connected");
}


?>