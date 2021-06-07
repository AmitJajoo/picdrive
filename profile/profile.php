<?php

session_start();
$username=$_SESSION['username'];
if(empty($username))
{
	header("Location: ../index.php");
	exit;
}
?>

<html>
<head>
	
	<!-- google font -->
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Francois+One&display=swap" rel="stylesheet">

<!-- fa fa icon -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



<!-- bootstrap css -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">



<!-- animation css -->
	<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />

<title>Profile</title>


</head>
<body style="background-color:#FCD0CF;">
	<nav class="navbar navbar-expand-md bg-dark navbar-dark">
		<a class="navbar-brand" href="#" style="text-transform: capitalize;">
			<?php
				require("../php/database.php");
				$email = $_SESSION['username'];
				$name = "SELECT full_name from users WHERE username='$email'";
				$response = $db->query($name);
				$response_name=$response->fetch_assoc();
				echo $response_name['full_name'];
			?>
		</a>
		<ul class="navbar-nav ml-auto">
			<li class="nav-item">
				<a class="nav-link" href="php/logout.php">
					<i class="fa fa-sign-out" style="font-size: 18px;"></i>Logout
				</a>
			</li>
		</ul>
	</nav>
<br/>
<div class="upload-notice fixed-top">
	
</div>
<div class="container-fluid">
	<div class="row">
		
		<div class="col-md-3 p-5 border">
			<div class="w-100 mb-5 bg-white rounded shadow-lg d-flex flex-column justify-content-center align-items-center" style="height: 250px;">
				<i class="fa fa-folder-open upload-icon" style="font-size: 100px"></i>
				<h4 class="upload-header">UPLOADED FILE</h4>
				<span class="free_space">
					<?php
						$get_status = "SELECT storage,used_storage,plans FROM users WHERE username='$username'";
						$response = $db->query($get_status);
						$data = $response->fetch_assoc();
						$total = $data['storage'];
						$used = $data['used_storage'];
						$plan = $data['plans'];
						if($plan == 'starter' || $plan == 'free')
						{
							$free_space = $total - $used;
                        	echo  "FREE SPACE : ".$free_space."MB";
                    	}
                    	else{
                    		echo "FREE SPACE : UNLIMITED";
                    	}
					?>
				</span>
				<div class="progress upload-progress-con d-none w-50 my-2">
  					<div class="progress-bar progress-control progress-bar-animated progress-bar-striped " role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
				</div>
				<div class="progress-details d-none">
					<span class="progress-percentage"></span>
					<i class="fa fa-pause-circle"></i>
					<i class="fa fa-times-circle"></i>
				</div>
			</div>


			<div class="w-100 mb-5 bg-white rounded shadow-lg d-flex flex-column justify-content-center align-items-center" style="height: 250px;">
				<i class="fa fa-database" style="font-size: 80px"></i>
				<h4>MEMORY STATUS</h4>
				<span class="memory-status">
					<?php
						$get_status = "SELECT storage,used_storage,plans FROM users WHERE username='$username'";
						$response = $db->query($get_status);
						$data = $response->fetch_assoc();
						$total = $data['storage'];
						$used = $data['used_storage'];
						$plan = $data['plans'];
						if($plan == 'starter' || $plan == 'free')
						{
							$display = "";
							echo $used."MB/".$total."MB";
							$percentage = round(($used*100)/$total,2);
							$color="";
							if ($percentage>80)
							{
								$color="bg-danger";
							}
							else{
								$color = "bg-primary";
							}
						}
						else
						{
							$display="d-none";
							echo "USED STORAGE : ".$used."MB";
						}
					?>
				</span>
				<div class="progress w-50 my-2 <?php echo $display; ?>">
  					<div class="progress-bar memory-progress <?php echo $color; ?> " style="width: <?php echo $percentage.'%'; ?>">
  						
  					</div>
				</div>
				
			</div>

		</div>
		<div class="col-md-6 p-5 border"></div>
		<div class="col-md-3 p-5 border">
			
			<div class="w-100 mb-5 bg-white rounded shadow-lg d-flex flex-column justify-content-center align-items-center" style="height: 250px;">
				<a href="gallery.php" class="text-black image-link"><i class="fa fa-image" style="font-size: 80px"></i></a>
				<h4>GALLERY</h4>
				<span class="count_photo">
					<?php 
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
				</span>
				
			</div>
			<!-- memory -->
			<div class="w-100 mb-5 bg-white rounded shadow-lg d-flex flex-column justify-content-center align-items-center" style="height: 250px;">
				<a href="shop.php" class="text-black shopping-link"><i class="fa fa-shopping-cart" style="font-size: 100px"></i></a>
				<h4>MEMORY SHOPPING</h4>
				<span>
					STARTS FROM <i class="fa fa-inr"></i> 99.00 mo
				</span>
				
			</div>
		</div>
		
	</div>
</div>
	<!-- bootstrap js -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<!-- ajax cdn -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="js/profile.js"></script>

</body>
</html>


<?php

$current_date = date('Y-m-d');
$get_expiry_date = "SELECT expiry_date,plans,full_name FROM users WHERE username = '$username'";
$response = $db->query($get_expiry_date);
$data = $response->fetch_assoc();

$plans = $data['plans'];
if($plans != 'free' )
{
	$expiry_date=$data['expiry_date'];
	$cal_date =  new DateTime($expiry_date);
	$cal_date->sub(new DateInterval('P5D'));
	$five_day_before=$cal_date->format('Y-m-d');
	if($current_date == $five_day_before)
	{
		echo "<div class='alert alert-warning py-3 rounded-0 shadow-lg fixed-top'>
		<i class='fa fa-times-circle close' data-dismiss='alert'></i><b>You have only 5 days left to renew your plan</b>
		</div>";
	}

	else if($current_date>$five_day_before)
	{
		$manual_expiry_date = date_create($expiry_date);
		$manual_current_date= date_create($current_date);
		$date_diff = date_diff($manual_current_date,$manual_expiry_date);
		$left_days = $date_diff->format("%a");
		echo "<div class='alert alert-warning py-3 rounded-0 shadow-lg fixed-top'>
		<i class='fa fa-times-circle close' data-dismiss='alert'></i><b>You have only ".$left_days." days left to renew your plan</b>
		</div>";
		if($current_date>=$expiry_date)
		{
			$amount="";
			$storage="";
			if ($plans == 'starter')
			{
				$amount = 99;
				$storage = 1024;
			}
			else{
				$amount = 500;
				$storage="unlimited";
			}
			
			$renew_link="php/payment.php?amount=".$amount."&plan=".$plans."&storage=".$storage;
			$_SESSION['renew'] = 'yes';
			$_SESSION['buyer_name'] = $data['full_name'];
			echo "<div class='d-flex alert alert-warning rounded-0 shadow-lg fixed-top'>
			<h4>Plan expiry choose an action</h4>
			<a href='".$renew_link."' class='btn btn-primary mx-3 '>Renew old Product</a>
			<a href='shop.php' class='btn btn-warning mr-3'>Purchase new plans</a>
			<a href='php/logout.php' class='btn btn-light shadow-sm'>Logout</a>
			</div>";

				
			echo "<style>.upload-icon,.shopping-link,.image-link{pointer-events:none}</style>";
		}
	}
}

?>


<?php
// database connection close

 $db->close();

?>