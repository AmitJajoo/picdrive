$(document).ready(function(){
	$(".submit-btn").click(function(e){
		e.preventDefault();
		$.ajax({
			type:"POST",
			url:"php/sign_up.php",
			data:{
				fullname:btoa($("#fullname").val()),
				username:btoa($("#email").val()),
				password:btoa($("#password").val()),

			},
			cache:false,
			beforeSend:function(){
				$(".submit-btn").html("Processing Please wait...");
				$(".submit-btn").attr("disabled","disabled");
			},
			success:function(response){
				if(response.trim()=="sending success"){
					$(".sign_up_form").fadeOut(500,function(){
						$(".activator").removeClass("d-none");
					});
				}
				else{
					var message = document.createElement("DIV");
					message.className = "alert alert-warning p-2";
					message.innerHTML = "<b>Something went wrong please try again after some time</b>";
					$(".signup-notice").append(message);
					$(".submit-btn").html("Register Now");
					$(".sign_up_form").trigger('reset');
					$(".email-loader").addClass("d-none");
					setTimeout(function(){
						$(".signup-notice").html("");
					},2000);
				}
			}
		});
	});
});