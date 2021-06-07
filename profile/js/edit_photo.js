
//rename
$(document).ready(function(){
	$(".edit").click(function(){
		var edit_icon = $(this);
		var image_path=$(this).attr("data-location");
		var footer = this.parentElement;
		var span = footer.getElementsByTagName("SPAN")[0];
		span.contentEditable = true;
		span.focus();
		var old_name= span.innerHTML;
		$(this).addClass("d-none");
		var save = footer.getElementsByClassName("save")[0];
		var loader = footer.getElementsByClassName("loader")[0];
		$(save).removeClass("d-none");
		$(save).click(function(){
			var photo_name = span.innerHTML;
			$.ajax({
				type:"POST",
				url:"php/rename.php",
				data:{
					photo_name:photo_name,
					photo_path : image_path
				},
				cache:false,
				beforeSend:function(){
					$(loader).removeClass("d-none");
					$(save).addClass("d-none");
				},
				success:function(response){
					if(response.trim()=="File already exits")
					{
						alert(response);
						$(loader).addClass("d-none");
						$(save).removeClass("d-none");
						span.focus();
					}
					else if(response.trim()=="success")
					{
						span.innerHTML = photo_name;
						span.contentEditable = false;
						$(loader).addClass("d-none");
						$(save).addClass("d-none");
						$(edit_icon).removeClass("d-none");
						var previous_download_link=footer.getElementsByClassName("download")[0].getAttribute("data-location");
						var current_download_link=previous_download_link.replace(old_name,photo_name);
						footer.getElementsByClassName("download")[0].setAttribute("data-location",current_download_link);
						footer.getElementsByClassName("download")[0].setAttribute("file-name",photo_name);
						footer.getElementsByClassName("trash")[0].setAttribute("data-location",current_download_link);
						footer.getElementsByClassName("edit")[0].setAttribute("data-location",current_download_link);
						footer.getElementsByClassName("edit")[0].setAttribute("file-name",photo_name);
						footer.getElementsByClassName("edit")[0].setAttribute("data-location",current_download_link);

					}
				}
			});
		});
	});
});

//download image

$(document).ready(function(){
	$(".download").each(function(){
		$(this).click(function(){
			var photo_location = $(this).attr("data-location");
			var filename = $(this).attr("file-name");
			var a = document.createElement("A");
			a.href=photo_location;
			a.download = filename;
			a.click();
		
		});
	});
});

//delete image

$(document).ready(function(){
	$(".trash").each(function(){
		$(this).click(function(){
			var delete_icon = this;
			$.ajax({
				type:"POST",
				url:"php/delete.php",
				data:{
					photo_location : $(this).attr("data-location")
				},
				cache:false,
				beforeSend:function(){
					$(this).removeClass("fa fa-trash");
					$(this).addClass("fa fa-spinner fa-spin");
				},
				success:function(response){
					if(response.trim() == "success")
					{

						delete_icon.parentElement.parentElement.parentElement.style.display = "none";
					}
				}
			});
		});
	});
});