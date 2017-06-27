<?php
   require 'func/thread.func.php';
?>

<!DOCTYPE html>
<html>

   <!-- Das neueste kompilierte und minimierte CSS -->
   <link rel="stylesheet" href="bootstrap/less/dist/css/bootstrap.min.css">

   <!-- Optionales Theme -->
   <link rel="stylesheet" href="bootstrap/less/dist/css/bootstrap-theme.min.css">

   <!-- Latest compiled and minified JavaScript -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
   <script src="bootstrap/less/dist/js/bootstrap.min.js" ></script>
	

   <head>
      <title>Thread</title>
   </head>
   <body>
   
      <div class="container">
   
      <?php
         require 'inc/navbar.php';
         const MAX_ENTRY_NUMBER = 5;
      
      //wenn ben�tigte daten nicht gesetzt sind, zur�ck auf startseite
         if(!isset($_GET['thread'])){
            echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php\" />";
         }
         if(!isset($_GET['page'])){
            $_GET['page'] = getLastPage();
         }
         $thread = SQLQuery("SELECT FK_menu FROM thread WHERE PKID_thread = " .$_GET['thread']);
         $menupoint = SQLQuery("SELECT * FROM menu WHERE PKID_menu = " .$thread['FK_menu']);
      
         createBreadcrumb($thread['FK_menu']);
         create2ndRow();
         createPostOverview();
         create2ndRow();
         
      ?>
      
      <?php include_once('inc/footer.html'); ?>         
         
      </div>

   </body>
</html>