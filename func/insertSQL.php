<?php
         $pdo = new PDO('mysql:host=localhost;dbname=forum', 'root', '');
   if(isset($_POST['type'])){
      if($_POST['type']== 'newThread'){

         execute($_POST['sql']);
         $id = SQLQuery2("SELECT PKID_thread FROM thread WHERE theme='?' AND FK_creator=?",$_POST['theme'],$_POST['creator']);
         echo $id['PKID_thread'];
         
      }else if($_POST['type']== 'report'){
         
         execute($_POST['query1'].$_SESSION['PKID'].$_POST['query2']);
         
      }else if($_POST['type']== 'reportdone'){
         execute($_POST['query1'].$_SESSION['PKID'].$_POST['query2']);
      }else if($_POST['type']== 'getThreads'){
         
         if($_POST['fk'] ==0){
            $statement = $pdo->prepare("SELECT threads FROM menu WHERE FK_menu IS NULL");
            $statement->execute();   
         
         }else {
            $statement = $pdo->prepare("SELECT threads FROM menu WHERE FK_menu = ?");
            $statement->execute(array('0' => $_POST['fk']));   
         
         }          
         $temp = $statement->fetch();
         echo $temp['threads'];
      }
      
   }else{
      execute($_POST['sql']);
      echo "fertig";
   }
      
      
     function execute($sql){
      global $pdo;
      	$statement = $pdo->prepare($sql);
      	$statement->execute();
      }
      
      function SQLQuery($query){

         global $pdo;
         $temp=$pdo->query($query);
         $temp->execute();
         return $temp->fetch();
      }
      
      
   
?>