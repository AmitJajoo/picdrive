<?php
session_start();
$username = $_SESSION['username'];
require("../../php/database.php");
$photo_location = $_POST['photo_location'];
$complete_location = "../".$photo_location;
$table_name = $_SESSION['table_name'];
if(unlink($complete_location)){
	//get used storage
	$get_user_storage = "SELECT used_storage from users WHERE username='$username'";
	$response = $db->query($get_user_storage);
	$data = $response->fetch_assoc();
	$used_storage=$data['used_storage'];

	//get deleted image size
	$get_deleted_size = "SELECT image_size FROM $table_name WHERE image_path = '$complete_location'";
	$response_delete = $db->query($get_deleted_size);
	$response_data=$response_delete->fetch_assoc();
	$deleted_file_size = $response_data['image_size'];

	//update used storage
	$storage = $used_storage-$deleted_file_size;
	$update_storage = "UPDATE users SET used_storage = '$storage' WHERE username='$username'";

	if($db->query($update_storage))
	{
		$delete="DELETE FROM $table_name WHERE image_path = '$complete_location' ";
		if($db->query($delete))
		{
			echo "success";
		}
		else{
			echo "enable to delete from database";
		}
	}
	else{
		echo "failed to update used_storage";
	}
	
}
else{
	echo "photo can't delete";
}



?>

<?php
// database connection close

 $db->close();

?>