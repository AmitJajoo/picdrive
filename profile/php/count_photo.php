<?php 
session_start();
$username=$_SESSION['username'];
require("../../php/database.php");
						$get_id = "SELECT id FROM users WHERE username='$username'";
						$response = $db->query($get_id);
						$data = $response->fetch_assoc();
						$table_name = "user_".$data['id'];
						$count = "SELECT count('id') AS total FROM $table_name";
						$response = $db->query($count);
						$data = $response->fetch_assoc();
						echo $data['total']." PHOTOS";
						$_SESSION['table_name'] = $table_name;
					?>

					<?php
// database connection close

 $db->close();

?>