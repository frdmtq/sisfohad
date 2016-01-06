<?php
require("../../_db.php");
?>
<link rel="stylesheet" href="<?php echo $baseurl."css/style.default.css"; ?>" type="text/css" />
<SCRIPT LANGUAGE="JavaScript">
<!-- Begin
function sendValue (s,obj1,s2,obj2,s3,obj3){

window.opener.document.getElementById(obj1).value = s;
window.opener.document.getElementById(obj2).value = s2;
window.opener.document.getElementById(obj3).value = s3;
window.close();
}
//  End -->
</script>
<?php
error_reporting(0);
if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){
$path = "uploads/"; //set your folder path
$filename = $_FILES['photoimg']['tmp_name']; //get the temporary uploaded image name
$valid_formats = array("jpg", "png", "gif", "bmp", "jpeg","GIF","JPG","PNG"); //add the formats you want to upload
	
		$name = $_FILES['photoimg']['name']; //get the name of the image
		$size = $_FILES['photoimg']['size']; //get the size of the image
		if(strlen($name)) //check if the file is selected or cancelled after pressing the browse button. 
		{
			list($txt, $ext) = explode(".", $name); //extract the name and extension of the image
			if(in_array($ext,$valid_formats)) //if the file is valid go on.
			{
			if($size < 2098888) // check if the file size is more than 2 mb
			{
			$actual_image_name =  str_replace(" ", "_", $txt)."_".time().".".$ext; //actual image name going to store in your folder
			$tmp = $_FILES['photoimg']['tmp_name']; 
			if(move_uploaded_file($tmp, $path.$actual_image_name)) //check the path if it is fine
				{
					move_uploaded_file($tmp, $path.$actual_image_name); //move the file to the folder
					//display the image after successfully upload
					echo "<img src='uploads/".$actual_image_name."'  class='preview' width='200px' height='200px'> <br><input type='hidden' name='actual_image_name' id='actual_image_name' value='$actual_image_name' />";
					?><br />
                    <a href="#" onClick="sendValue('<?php echo $baseurl."includes/imguploads/uploads/".$actual_image_name; ?>','photo','<?php echo $ext; ?>','ext','<?php echo $actual_image_name; ?>','nfile');"><span class="btn btn-success"><i class="icon-edit"></i>Pilih</span></a></td>   
                    <?php
				}
			else
				{
				echo "failed";
				}
			}
			else
			{
				echo "Image file size max 2 MB";					
			}
			}
			else
			{
				echo "Invalid file format..";	
			}
		}
		else
		{		
			echo "Please select image..!";
		}		
	exit;
	}
?>
