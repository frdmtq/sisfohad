<?php
require("../../_db.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Images Upload Ajax</title>
<link rel="stylesheet" href="<?php echo $baseurl."css/style.default.css"; ?>" type="text/css" />
<script src="<?php echo $baseurl."js/jquery-1.9.0.js"; ?>" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery.form.js"></script>
<script type="text/javascript" >
 $(document).ready(function() { 
            $('#photoimg').change(function(){ 
				$("#preview").html('');
				$("#preview").html('<img src="loader.gif" alt="Uploading...."/>');
			$("#imageform").ajaxForm({
						target: '#preview'
		}).submit();
	});
}); 
</script>
</head>
<body>
<form id="imageform" method="post" enctype="multipart/form-data" action='ajaxupload.php'>
<span id="pimg">Pilih Browse untuk cari photo
<input type="file" id="photoimg" name="photoimg" class="btn btn-medium btn-primary"  /></span>
</form>
<div id='preview' align="center" >
</div>
</body>
</html>
