<?php

header("location: views/login.html");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es-CL">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>BioRis :: Home</title>
		<link rel="stylesheet" href="ES/inc/tools/bootstrap/css/bootstrap.paper.min.css">
		<link href="style/index.css" rel="stylesheet" type="text/css" />
		<link rel="SHORTCUT ICON" href="images/favicon.ico">
		<script src="ES/inc/js/jquery-2.1.4.min.js"></script>
		<script src="ES/inc/js/menu.js" type="text/javascript"></script>
		<script src="ES/inc/tools/bootstrap/js/bootstrap.min.js"></script>

		<script>
			var show_menu_top = true;
			var lang = '<?php echo $lang?>';
			$(document).ready(function(){

				$(" #nav ul ").css({display: "none"}); // Opera Fix
				$(" #nav li").hover(function(){
						$(this).find('ul:first').css({visibility: "visible",display: "none"}).show(400);
						},function(){
						$(this).find('ul:first').css({visibility: "hidden"});
						});
				$("#header").fadeIn("600");
				$("#contentMain").attr('src', lang+'/inc/contentMain.php');
			});
		</script>
	</head>
	<body>
		<? include("inc/menuTop.php");?>
		<iframe id= "contentMain" name="contentMain"  height= "100%" frameborder="0" marginheight="0" marginwidth="0" scrolling="no">
			<p>Tu navegador no puede usar BioRis!</p>
		</iframe>
	</body>
</html>
