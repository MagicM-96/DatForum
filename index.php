<?PHP
require_once 'func/index.func.php';
?>
<!DOCTYPE html>
	<html>
		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
			<title id="pageTitle">DatForum</title>    <!-- Titel wird im footer gesetzt -->
			<link rel="SHORTCUT ICON" href="layout/favicon.ico" />
         <!-- Das neueste kompilierte und minimierte CSS -->
         <link rel="stylesheet" href="bootstrap/less/dist/css/bootstrap.min.css">

         <!-- Optionales Theme -->
         <link rel="stylesheet" href="bootstrap/less/dist/css/bootstrap-theme.min.css">

         <!-- Latest compiled and minified JavaScript -->
         <script src="bootstrap/jquery-3.2.1.min.js"></script>
         <script src="bootstrap/less/dist/js/bootstrap.min.js" ></script>
      	<audio autoplay="true" loop="trueM" class="hide" controls>
            <source src="inc/backgroundsong.mp3" type="audio/mpeg">
         </audio>
		</head>
		<body>
			<div class="container">
			<?php
           require_once 'inc/navbar.php';
           #Je nachdem, welche Seite gew�nscht ist, wird die entsprechende geladen
           if(!isset($_GET["p"])){
					include 'inc/index/index.php';
				}elseif($_GET["p"]=="impr"){
					include 'inc/index/impressum.php';
				}else{
					include 'inc/index/index.php';
				}
           
            
           include_once 'inc/footer.html';
         ?>
         </div>
		</body>
	</html>