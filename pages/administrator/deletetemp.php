<?php
$files = glob($path_web.'includes/imguploads/uploads/*'); // get all file names
foreach($files as $file){ // iterate files
  if(is_file($file))
    unlink($file); // delete file
}
echo"Sudah dihapus";
?>