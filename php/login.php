<?php 
require("database.php");

$username = base64_decode($_POST['username']);
$password = md5(base64_decode($_POST['password']));


$check_username = "SELECT username from users WHERE username='$username'";

$response = $db->query($check_username);

if($response->num_rows != 0 ){
	$check_password = "SELECT username,password FROM users WHERE username='$username' AND password='$password'";
	$response_password = $db->query($check_password);
	if($response_password->num_rows != 0 ){
		$check_active = "SELECT status FROM users WHERE username='$username' AND password='$password' AND status='active'";
		$response_active = $db->query($check_active);

		if($response_active->num_rows != 0){
			echo "login success";
			session_start();
			$_SESSION['username'] = $username;

		}
		else{
			$get_code = "SELECT activation_code FROM users WHERE username='$username' AND password='$password'";
			$response_get_code = $db->query($get_code);
			$data = $response_get_code->fetch_assoc();
			$final_code = $data['activation_code'];
			$check_mail=mail($username,"Activation Code","Thanks for choosing us your activation code is : ".$final_code);
			if ($check_mail){
				echo "login pending";	
			}
		}
	}
	else{
		echo "wrong password";
	}
}
else{
	echo "user not found"; 
}

?>

<?php
// database connection close

 $db->close();

?>