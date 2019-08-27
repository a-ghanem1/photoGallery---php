$(document).ready(function(){
	var userHref;
	var userHrefSplitted;
	var userId;
	var imageSrc;
	var imageHrefSplitted;
	var imageName;
	var photoId;

	$(".modal_thumbnails").click(function(){
		$("#set_user_image").prop('disabled',false);
		userHref = $("#user-id").prop('href');
		userHrefSplitted = userHref.split("=");
		userId = userHrefSplitted[userHrefSplitted.length - 1];

		imageSrc = $(this).prop("src");		
		imageSrcSplitted = imageSrc.split("/");
		imageName = imageSrcSplitted[imageSrcSplitted.length - 1];

		photoId = $(this).attr("data");
		
		$.ajax({
			url: "includes/ajax_code.php",
			data: {photo_id: photoId},
			type: "POST",
			success: function(data) {
				if(!data.error) {
					$("#modal_sidebar").html(data);
				}
			}
		});
	});

	$("#set_user_image").click(function(){
		$.ajax({
			url: "includes/ajax_code.php",
			data: {image_name: imageName, user_id: userId},
			type: "POST",
			success: function(data){
				if(!data.error) {
					$(".user_image_box a img").prop('src', data);
				}
			}
		});
	});

	tinymce.init({selector:'textarea'});
});