$(document).ready(function(){
	$("#email").on("change",function(){
		if($(this).val() != ""){
			$.ajax({
				type:"POST",
				url:"php/check_user.php",
				data:{
					username : btoa($(this).val())
				},
				cache:false,
				beforeSend:function(){
					$(".email-loader").removeClass("d-none");
				},
				success:function(response){
					if (response.trim() == "users found"){
						$(".email-loader").removeClass("fa fa-circle-o-notch fa-spin");
						$(".email-loader").addClass("fa fa-times-circle text-warning");
						$(".submit-btn").attr("disabled","disabled");
					}
					else{
						$(".email-loader").removeClass("fa fa-circle-o-notch fa-spin");
						$(".email-loader").addClass("fa fa-check-circle text-primary");
						$(".submit-btn").removeAttr("disabled")
					}
					
				}
			});

		}
	});
});