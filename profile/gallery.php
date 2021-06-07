<?php
session_start();
$username=$_SESSION['username'];
if(empty($username)){
	header("Location:../index.php");
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

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<title>Gallery</title>
<style>
	span:focus{
		outline: 2px dashed red;
		box-shadow: 0px 0px 5px grey;
		padding: 2px;
	}
	.modal-backdrop {
   background-color: rgba(0,0,0,0.1) !important;
   
}

</style>

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


<div class="container mt-3 ">
	<div class="row">
<?php
$table_name = $_SESSION['table_name'];
$get_image_path = "SELECT * FROM $table_name";
$response = $db->query($get_image_path);
while($data = $response->fetch_assoc()){
	$image_name = pathinfo($data['image_name']);
	$image_name = $image_name['filename'];
	$path=str_replace("../", "",$data['image_path']);
	// echo "<img src='".$path."' width='200px'>";
	echo "<div class='col-md-3 mb-3 '>
		<div class='card shadow-lg'>
			<div class='card-body d-flex justify-content-center align-items-center'>
				<img src='".$path."' id='pic' width='100' height='150' class='rounded-circle pic'>
			</div>
			<div class='card-footer d-flex justify-content-around align-items-center'>
				<span>".$image_name."</span>
				<i class='fa fa-save save d-none' data-location=".$path."></i>
				<i class='fa fa-spinner fa-spin d-none loader' data-location=".$path."></i>

				<i class='fa fa-edit edit' data-location=".$path."></i>
				<i class='fa fa-download download' data-location=".$path." file-name=".$image_name."></i>
				<i class='fa fa-trash trash' id='delete' data-location=".$path."></i>
			</div>
		</div>

	</div>";
}
?>
</div>
</div>


<div class="modal animated my-5 bounceIn" tabindex="1" id="view_image">
  <div class="modal-dialog">
  	<i class="fa fa-times-circle float-right text-white" data-dismiss="modal"></i>
    <div class="modal-content">
      
      <div class="modal-body">
        
      </div>
      
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
<script src="js/edit_photo.js"></script>
<script src="js/image_modal.js"></script>

</body>
</html>


<?php
// database connection close

 $db->close();

?>