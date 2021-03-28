<?php

?>
<!DOCTYPE html>
<html dir="rtl" >
<head>
<title> لوحة التحكم <<PMS</title>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<script src="../js/jquery.min.js"></script>
<script>
$(document).ready(function(){
	$('#file').on('change',function(e){
		console.log( e.target.files);
	$('#upload').submit();
	});
	
$('#formUpload').on('submit',function(e){
			   	
	e.preventDefault();
	
		   var formData=new FormData(this);

	
	$.ajax({
		type:'POST',
		url: 'upload.php',
		data:formData,
		contentType: false,
		processData: false,
		success: function (data) {
			data=JSON.parse(data);
			if (data.success) {
				alert(data.success+' files successfully uploaded!');
			} else {
				alert('error uploading your file!!!!');
			}
			console.log(data);
			//data=JSON.parse(data);

		},
		error: function (data) {
			alert('There was an error uploading your file!');
		}
});

});
});
</script>
</head>
<body>

		  <form  id="formUpload" enctype="multipart/form-data" >
				               <div class="w3-center" style="display:contents" >
				 إضافة صورة <img src="../images/electronics-img.png" width="40px" style="cursor:pointer" onclick="$('#file').click();"  >
							<div class="w3-center" id="image" class="w3-center" style="display:none">
							   <input type="file" id="file" name="file[]" multiple="multiple" accept="image/*" browse="gallery"  >
						    </div> 
				  </div>
				  <input type="submit" id="upload" name="upload" value="رفع" hidden>
				    </form>
					
					
</body>
</html>