// show password

$(document).ready(function(){
	$(".show-icon").click(function(){
		if ($("#password").attr("type")=="password"){

			$(this).css({color:"black"});
			$("#password").attr("type","text");
		}
		else{
			$(this).css({color:"#ccc"});
			$("#password").attr("type","password");
		}
	});
});



$(document).ready(function(){
	$(".login-show-icon").click(function(){
		if ($("#login-password").attr("type")=="password"){

			$(this).css({color:"black"});
			$("#login-password").attr("type","text");
		}
		else{
			$(this).css({color:"#ccc"});
			$("#login-password").attr("type","password");
		}
	});
});