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
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/jquery-migrate-1.1.1.min.js"></script>
</head>
<body class="loginbody">

    <div class="loginwrapper">
        <div class="loginwrap zindex100 animate2 bounceInDown">
        <h1 class="logintitle"><span class="iconfa-lock"></span> <?php echo $nama_usaha; ?><span class="subtitle"><?php echo $nama_aplikasi; ?></span></h1>
            <div class="loginwrapperinner">
            <?php
			if(isset($_GET['p']) && $_GET['p']=='login')
			{
			?>
				<?php include("login.php") ?>
             <?php
			}else{
			 ?>
             <p class="animate6 bounceIn"><button class="btn btn-default btn-block" onClick="window.location='index.php?p=login'">LOGIN</button></p>
             <p class="animate6 bounceIn"><button class="btn btn-default btn-block" onClick="window.location='absen.php'">ABSENSI</button></p>
             <?php
			}
			?>
            </div><!--loginwrapperinner-->
        </div>
        <div class="loginshadow animate3 fadeInUp"></div>
    </div><!--loginwrapper-->
    
    
    <script type="text/javascript">
    jQuery.noConflict();
    
    jQuery(document).ready(function(){
        
        var anievent = (jQuery.browser.webkit)? 'webkitAnimationEnd' : 'animationend';
        jQuery('.loginwrap').bind(anievent,function(){
            jQuery(this).removeClass('animate2 bounceInDown');
        });
        
        jQuery('#username,#password').focus(function(){
            if(jQuery(this).hasClass('error')) jQuery(this).removeClass('error');
        });
        
        jQuery('#loginform button').click(function(){
            if(!jQuery.browser.msie) {
                if(jQuery('#username').val() == '' || jQuery('#password').val() == '') {
                    if(jQuery('#username').val() == '') jQuery('#username').addClass('error'); else jQuery('#username').removeClass('error');
                    if(jQuery('#password').val() == '') jQuery('#password').addClass('error'); else jQuery('#password').removeClass('error');
                    jQuery('.loginwrap').addClass('animate0 wobble').bind(anievent,function(){
                        jQuery(this).removeClass('animate0 wobble');
                    });
                } else {
                    jQuery('.loginwrapper').addClass('animate0 fadeOutUp').bind(anievent,function(){
                        jQuery('#loginform').submit();
                    });
                }
                return false;
            }
        });
    });
    </script>

</body>
</html>