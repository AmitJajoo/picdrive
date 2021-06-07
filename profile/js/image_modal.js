$(document).ready(function(){
  $(".pic").each(function(){
  	$(this).click(function(){
  	var image = document.createElement("IMG");
  	image.src = $(this).attr("src");
  	image.style.width="100%";
	image.style.height="50%";
  	$(".modal-body").html(image);
    $("#view_image").modal();

  });
  });
});