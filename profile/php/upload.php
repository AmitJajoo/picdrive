<?php

require("../../php/database.php");
session_start();
$username=$_SESSION['username'];
$get_id = "SELECT id FROM users WHERE username = '$username'";
$get_response = $db->query($get_id);
$data = $get_response->fetch_assoc();
$folder_name = "../gallery/user_".$data['id']."/";
$file = $_FILES["data"];
$user_path = $file['tmp_name'];
$file_name = strtolower($file['name']);
$file_size = round($file['size']/1024/1024,2);

$table_name = "user_".$data['id'];
$complete_path=$folder_name.$file_name;



// check free space

$check_space = "SELECT storage,used_storage,plans FROM users WHERE username='$username'";
$response = $db->query($check_space);
$data = $response->fetch_assoc();
$total_storage = $data['storage'];
$used_storage = $data['used_storage'];
$plan =$data['plans'];
$free_storage=$total_storage-$used_storage; 
if($plan == "starter" || $plan == "free")
{
	if($file_size<$free_storage)
	{

		if(file_exists($folder_name.$file_name)){
			echo "File already exists please rename your file or upload other file";
		}
		else{
			if(move_uploaded_file($user_path, $folder_name.$file_name))
			{
				$store_data="INSERT INTO $table_name(image_name,image_path,image_size) VALUES ('$file_name','$complete_path',$file_size)";
				if($db->query($store_data)){
	 				$select_storage = "SELECT used_storage FROM users WHERE username='$username'";
	 				$response=$db->query($select_storage);
	 				$data = $response->fetch_assoc();
	 				$used_memory = $data['used_storage']+$file_size;
	 				$update_storage = "UPDATE users SET used_storage='$used_memory' WHERE username='$username'";
	 				if ($db->query($update_storage))
	 				{
	 					echo "success";
	 				}
	 				else{
	 					echo "Failed to update used storage column";
	 				}

				}
				else{
					echo "Failed to store image in database";
				}
				
			}
			else{
				echo "upload failed";
			}
		}
	}
	else
	{
		echo "File size is too larger kindly purchase some memory space";
	}
}

else
{
	if(file_exists($folder_name.$file_name)){
			echo "File already exists please rename your file or upload other file";
		}
		else{
			if(move_uploaded_file($user_path, $folder_name.$file_name))
			{
				$store_data="INSERT INTO $table_name(image_name,image_path,image_size) VALUES ('$file_name','$complete_path',$file_size)";
				if($db->query($store_data)){
	 				$select_storage = "SELECT used_storage FROM users WHERE username='$username'";
	 				$response=$db->query($select_storage);
	 				$data = $response->fetch_assoc();
	 				$used_memory = $data['used_storage']+$file_size;
	 				$update_storage = "UPDATE users SET used_storage='$used_memory' WHERE username='$username'";
	 				if ($db->query($update_storage))
	 				{
	 					echo "success";
	 				}
	 				else{
	 					echo "Failed to update used storage column";
	 				}

				}
				else{
					echo "Failed to store image in database";
				}
				
			}
			else{
				echo "upload failed";
			}
		}
}
?>


<?php
// database connection close

 $db->close();

?>