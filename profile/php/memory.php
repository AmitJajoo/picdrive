<?php

require("../../php/database.php");
session_start();
$username = $_SESSION['username'];

$get_status = "SELECT storage,used_storage,plans FROM users WHERE username='$username'";
						$response = $db->query($get_status);
						$data = $response->fetch_assoc();
						$total = $data['storage'];
						$used = $data['used_storage'];
						$plan = $data['plans'];
						if($plan == 'starter' || $plan == 'free')
						{
							$free_space = round($total - $used,2);
	                        
							$percentage = round(($used*100)/$total,2);
							$color="";
							if ($percentage>80)
							{
								$color="bg-danger";
							}
							else{
								$color = "bg-primary";
							}
	                        $response = [$plan,$used."MB/".$total."MB",$free_space,$percentage];
	                        echo json_encode($response);
                    	}
                    	else{
                    		$response=  [$plan,$used."MB"];
                    		echo json_encode($response);

                    	}
                        

?>

<?php
// database connection close

 $db->close();

?>