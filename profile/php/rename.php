<?php
session_start();
require("../../php/database.php");
$new_name = $_POST['photo_name'];
$old_path = $_POST['photo_path'];
$pathinfo = pathinfo($old_path);
$dirname = $pathinfo['dirname'];
$extension = $pathinfo['extension'];
time().rand()."_".$userid;
$new_image_name = "../".$dirname."/".$new_name.".".$extension;
if(file_exists($new_image_name)){
	echo "File already exits";
}
else{
	if(rename("../".$old_path,$new_image_name)){
		$previous_image_path="../".$old_path;
		$image_nme = $new_name.".".$extension;
		$table_name = $_SESSION['table_name'];
		$update_table = "UPDATE $table_name SET image_path = '$new_image_name', image_name = '$image_nme' WHERE image_path='$previous_image_path'";
		if($db->query($update_table)){
			echo "success";
		}
		else{
			echo "update failed";
		}
		
	}
	else{
		echo "failed";
	}
}

 
?>

<?php
// database connection close

 $db->close();

?>