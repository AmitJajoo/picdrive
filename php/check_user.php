<?php

require("database.php");
$username = base64_decode($_POST['username']);

$check = "SELECT username from users WHERE username='$username'";

$response = $db->query($check);

if ($response->num_rows != 0){
	echo "users found";
}
else{
	echo "user not found";
}

?>
<?php
// database connection close

 $db->close();

?>