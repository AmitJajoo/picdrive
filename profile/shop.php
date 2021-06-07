<?php
require("../php/database.php");
session_start();
$username=$_SESSION['username'];
if(empty($username)){
	header("Location:../index.php");
	exit;
}



$starter = '<ul class="list-group w-100">
				<li class="list-group-item bg-success">
					<h3 class="text-center text-white">STARTER PLAN</h3>
				</li>
				<li class="list-group-item">1GB STORAGE</li>
				<li class="list-group-item" style="color:#ddd">24*7 TECHNICAL SUPPORT</li>
				<li class="list-group-item" style="color:#ddd">INSTANT EMAIL SOLUTION</li>
				<li class="list-group-item" style="color:#ddd">DATA SECURITY</li>
				<li class="list-group-item" style="color:#ddd">SEO SERVICES</li>
				<li class="list-group-item bg-light text-center buy-btn" amount="99" plan="starter" storage="1024" style="cursor:pointer">
					<h4><i class="fa fa-inr"></i>99.00/monthly</h4>
				</li>
			</ul>

			';

$excluive = '<ul class="list-group w-100">
				<li class="list-group-item bg-warning">
					<h3 class="text-center text-white">EXCLUSIVE PLAN</h3>
				</li>
				<li class="list-group-item">UNLIMITED STORAGE</li>
				<li class="list-group-item">24*7 TECHNICAL SUPPORT</li>
				<li class="list-group-item">INSTANT EMAIL SOLUTION</li>
				<li class="list-group-item">DATA SECURITY</li>
				<li class="list-group-item">SEO SERVICES</li>
				<li class="list-group-item bg-light text-center buy-btn" amount="500" plan="exclusive" storage="unlimited" style="cursor:pointer">
					<h4><i class="fa fa-inr"></i>500.00/monthly</h4>
				</li>
			</ul>

';

$get_plans = "SELECT plans FROM users WHERE username='$username'";
$response = $db->query($get_plans);
$data = $response->fetch_assoc();
$plans = $data['plans'];

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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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
				$_SESSION['buyer_name'] = $response_name['full_name'];
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

<div class="container-fluid">
	<div class="row">
		<div class="col-md-6 p-5">
			<?php
				if($plans == 'free')
				{
					echo $starter;
				}
				elseif ($plans == 'starter') {
					echo "<button class='btn btn-light shadow-lg p-5 '><h1>
						You are currently using Starter plan
					</h1></button>";
				}
			?>
		</div>

		<div class="col-md-6 p-5">
			<?php
				if($plans == "free" || $plans == "starter")
				{
					echo $excluive;
				}
			?>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12 p-5 text-center">
			<?php 
				if($plans == 'exclusive')
				{
					echo "<button class='btn btn-light shadow-lg p-5'><h1>
						You are using our most expensive plan
					</h1></button>";
				}
			?>
		</div>
	</div>
</div>
<!-- ajax cdn -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<!-- bootstrap js -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<script src="js/profile.js"></script>

<script>
	$(document).ready(function(){
		$(".buy-btn").each(function(){
			$(this).click(function(){
				var amount = $(this).attr("amount");
				var plan = $(this).attr("plan");
				var storage = $(this).attr("storage");
				location.href = "php/payment.php?amount="+amount+"&plan="+plan+"&storage="+storage;
			});
		});
	});

</script>
</body>
</html>

<?php
// database connection close

 $db->close();

?>