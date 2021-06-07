$(document).ready(function(){
	$(".login-submit-btn").click(function(e){
		e.preventDefault();
		var username = btoa($("#login-email").val());
		var password = btoa($("#login-password").val());

		$.ajax({
			type:"POST",
			url:"php/login.php",
			data:{
				username:username,
				password:password
			},
			cache:false,
			beforeSend:function(){
				$(".login-submit-btn").html("Please Wait...");
				$(".login-submit-btn").attr("disabled","disabled");
			},
			success:function(response){
				if (response.trim() == "login success"){
					location.href = "profile/profile.php";
				}
				else if(response.trim() == "login pending"){
					$(".login_form").fadeOut(500,function(){
						$(".login-activator").removeClass("d-none");
						$(".activate-btn").click(function(){
							$.ajax({
								type:"POST",
								url:"php/activator.php",
								data:{
									code:btoa($("#login-code").val()),
									username:btoa($("#login-email").val())
								},
								beforeSend:function(){
									$(".activate-btn").html("Please Wait we are checking...");
									$(".activate-btn").attr("disabled","disabled");
								},
								success:function(response){
									if(response.trim() == "user verified"){
										window.location = "profile/profile.php";
									}
									else{
										$(".activate-btn").html("Activate Now");
										$(".activate-btn").removeAttr("disabled");
										$("#login-code").val("");
										var notice = document.createElement("DIV");
										notice.className = 'alert alert-warning';
										notice.innerHTML = "<b>Wrong Activation Code</b>";
										$(".login-notice").append(notice);
										
										setTimeout(function(){
											$(".login-notice").html("");
										},5000);
										}
								}
							});
						});
					});
				}
				else if(response.trim() == 'wrong password'){
					var message = document.createElement("DIV");
					message.className = 'alert alert-warning';
					message.innerHTML = "Wrong Password";
					$(".login-notice").append(message);
					$(".login_form").trigger('reset');
					$(".login-submit-btn").html("Login now");
					$(".login-submit-btn").removeAttr("disabled");
					setTimeout(function(){
						$(".login-notice").html("");
					},5000);
				}
				else {
					var message = document.createElement("DIV");
					message.className = 'alert alert-warning';
					message.innerHTML = "Please Sign up..";
					$(".login-notice").append(message);
					$(".login_form").trigger('reset');
					$(".login-submit-btn").html("Login now");
					$(".login-submit-btn").removeAttr("disabled");
					setTimeout(function(){
						$(".login-notice").html("");
					},5000);
				}
			}

		});
	});
});