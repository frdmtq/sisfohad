<?php
session_start();
require("_db.php");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">

<title><?php echo $nama_aplikasi." ".$nama_usaha; ?></title>
<link rel="stylesheet" href="css/style.default.css" type="text/css" />
</head>
<body class="loginbody">
<?php include($path_web."/pages/web/absen.php") ?>          
</body>
</html>