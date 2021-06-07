<?php

require("database.php");
$fullname = base64_decode($_POST['fullname']);
$username = base64_decode($_POST['username']);
$password = md5(base64_decode($_POST['password']));


$pattern = "ab6chi14jklqrEFGHIJtuv78wxyz0ABCDdeKsLMN23OPQfgRST9UVWX5YZ";

$length = strlen($pattern)-1;

$i;
$code=[];
for($i=0;$i<6;$i++){
	$indexing_number = rand(0,$length);
	$code[] = $pattern[$indexing_number];
}

$activation_code = implode($code);
$store_user = "INSERT INTO users(full_name,username,password,activation_code) VALUES('$fullname','$username','$password','$activation_code')";
if($db->query($store_user)){
	$check_mail=mail($username,"Activation Code","Thanks for choosing us your activation code is : ".$activation_code);
	if($check_mail){
		echo "sending success";
	}else{
		echo "sending failed";
	}
}else{
	echo "SIGN UP FAILED";
}


?>

<?php
// database connection close

 $db->close();

?>