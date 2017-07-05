<!DOCTYPE html>
<html>
   <head>
     <meta charset="UTF-8">
     <title>Neuer Post</title>
     
     <!-- Das neueste kompilierte und minimierte CSS -->
      <link rel="stylesheet" href="bootstrap/less/dist/css/bootstrap.min.css">

      <!-- Optionales Theme -->
      <link rel="stylesheet" href="bootstrap/less/dist/css/bootstrap-theme.min.css">

      <!-- Latest compiled and minified JavaScript -->
      <script src="bootstrap/jquery-3.2.1.min.js"></script>
      <script src="bootstrap/less/dist/js/bootstrap.min.js" ></script>
     
     <link rel="stylesheet" type="text/css" href="trix/trix.css">
     <script type="text/javascript" src="trix/trix.js"></script>

     
   </head>

   <body>
      <div class="container">
      
         <?php
            require_once('inc/navbar.php');
         ?>
         <div class="row">
            <h2>Thread erstellen</h2>
         </div>
         <div class="row">
         
         <trix-editor></trix-editor>
         
         </div>
         
         <div class="row">
            <div class="btn-group pull-right" role="group">
               <?php
                  if($_GET['type']=='edit'){
                     echo '<a class ="btn btn-default btn-textfield" id="edit"><span class="glyphicon glyphicon-envelope"></span> Abschicken!</a>';
                  }else {
                     echo '<a class ="btn btn-default btn-textfield" id="new"><span class="glyphicon glyphicon-envelope"></span> Abschicken!</a>';                     
                  }
                ?>
            </div> 
         </div>
         
         <?php
            include_once('inc/footer.html');
         ?>
      </div>
     
      <script>
      
         document.addEventListener("trix-initialize", function(event) {
            var element = document.querySelector("trix-editor");
            element.editor.insertString("Hello");
          });
      
      
        $(document).ready(function() {
            var d = new Date();
            
            
            //Button f�r neuen Post
            $('#new').button().click(function(){
            
                  var text = $('#trix').val();
            
                  //Einf�gen in post wird erstellt
                  var query =  "INSERT INTO `post` (`PKID_post`, `FK_user`, `FK_thread`, `date`, `time`, `text`) VALUES (NULL, '"+getUrlVars()["creator"]+"', '"
                  +getUrlVars()["id"]+"', '"+d.getFullYear()+"-"+(d.getMonth()+1)+"-"+d.getDate()+"', '"+d.getHours()+"-"+d.getMinutes()+"-"+d.getSeconds()+"', '"+text+"');";
                  
                  //Post wird erstellt
                  var sql = {sql: query};
                  
                  //post wird aufgerufen
                  
                  $.post("func/insertSQL.php",sql);
                  
                  //update number of posts
                  var query = "UPDATE user SET numberposts = numberposts+1 WHERE PKID_user = "+getUrlVars()["creator"];
                  var sql2= {
                     sql:  query
                  };
                  $.post("func/insertSQL.php",sql2);
                  
                  
                  $("#trix").animate({"left":"+=100px"},function() {location.href = "thread.php?thread="+getUrlVars()["id"]});
             });   
             
             //Button f�r editieren 
             $('#edit').button().click(function(){
                 // Text wird gespeichert
                 var text = $('#trix').val();
                  
                  //Post wird erstellt
                  var sql = {sql: query};
                  //post wird aufgerufen
                  $.post("func/insertSQL.php",sql);
                  $("#summernote").animate({"left":"+=100px"},function() {location.href = "thread.php?thread="+getUrlVars()["id"]});
             }); 
             
              function getUrlVars()
               {
                   var vars = [], hash;
                   var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
                   for(var i = 0; i < hashes.length; i++)
                   {
                       hash = hashes[i].split('=');

                       if($.inArray(hash[0], vars)>-1)
                       {
                           vars[hash[0]]+=","+hash[1];
                       }
                       else
                       {
                           vars.push(hash[0]);
                           vars[hash[0]] = hash[1];
                       }
                   }

                   return vars;
               }
             
        });
        
       
      </script>
     
      
   </body>
</html>