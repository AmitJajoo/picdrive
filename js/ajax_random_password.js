$(document).ready(function(){
	$(".generate-btn").click(function(e){
		e.preventDefault();
		$("#password").attr("type","text");
		$(".show-icon").css({color:"#000"});
		$.ajax({
			type:"POST",
			url:"php/random_password.php",
			cache:false,
			beforeSend:function(){
				$(".show-icon").removeClass("fa fa-eye");
				$(".show-icon").addClass("fa fa-circle-o-notch");
			},
			success:function(response){
				$("#password").val(response);
				$(".show-icon").removeClass("fa fa-circle-o-notch");
				$(".show-icon").addClass("fa fa-eye");

			}
		});
	});
});
