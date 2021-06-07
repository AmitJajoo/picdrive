<!DOCTYPE html>
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
<!-- css -->

  <link rel="stylesheet" href="style/style.css">


	<title>Pic Drive</title>
</head>
<body class="animated fadeIn slower">

	<div class="container-fluid">
		<div class="row">
			<div class="col-md-4 p-0">
				<img src="images/main_pic.jpg" class="shadow-lg w-100">
			</div>
			<div class="col-md-4 px-5 py-4">
				<h3 class="ml-2 mb-3">SIGN UP</h3>
				<form class="sign_up_form" autocomplete="off">
					<input type="text" name="fullname" id="fullname" placeholder="ENTER YOUR NAME" required="required">

					<div class="email-box">
					<input type="email" name="email" id="email" placeholder="EMAIL" required="required">
					<i class="fa fa-circle-o-notch fa-spin d-none email-loader" style="font-size: 18px;"></i>
					</div>

					<div class="password-box">
					<input type="password" name="password" id="password" placeholder="PASSWORD" required="required">
					<i class="fa fa-eye show-icon" style="font-size: 18px;"></i>
					</div>

					<div class="w-100"><button class="btn float-left py-2 click-btn">CLICK TO IMPROVE SECURITY</button>
					<button class="btn float-right generate-btn">GENERATE</button></div>

					<button class="btn submit-btn m-3" type="submit" disabled="disabled">Register Now</button>

					
				</form>
				<div class="signup-notice"></div>
				<div class="px-2 d-none activator ">
					<span>Please check your email for activation code</span>
					<input type="text" name="code" id="code" class="my-3" placeholder="Activation Code">
					<button class="btn btn-dark activate-btn">Activate Now</button>
				</div>
			</div>
			<div class="col-md-4 px-5 py-4">
				
				<h3 class="ml-2 mb-3">LOGIN IN</h3>
				<form class="login_form" autocomplete="off">
					
					<div class="email-box">
					<input type="email" name="email" id="login-email" placeholder="USERNAME" required="required">
					
					</div>

					<div class="password-box">
					<input type="password" name="password" id="login-password" placeholder="PASSWORD" required="required">
					<i class="fa fa-eye login-show-icon" style="font-size: 18px;"></i>
					</div>

					

					<button class="btn float-right login-submit-btn m-3" type="submit">Login now</button>
					
					
				</form><br><br><br>
				<div class="login-notice  p-2"></div>
				<div class="px-2 login-activator d-none">
					<span>Please check your email for activation code</span>
					<input type="text" name="code" id="login-code" class="my-3" placeholder="Activation Code">
					<button class="btn btn-dark activate-btn">Activate Now</button>
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

<!-- js  -->
<script src="js/ajax_random_password.js"></script>
<script type="text/javascript" src="js/ajax_user_check.js"></script>
<script type="text/javascript" src="js/ajax_sign_up.js"></script>
<script type="text/javascript" src="js/ajax_activate.js"></script>
<script type="text/javascript" src="js/ajax_login.js"></script>
<script src="js/index.js"></script>


</body>
</html>