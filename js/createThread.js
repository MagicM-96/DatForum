        $(document).ready(function() {
/* Setzt den richtig Radiobbutton auf selected
	Blendet den Texteditor jeweils ein oder aus */
//				$('#menupoint').prop('checked',true);
				$('input[type=radio][name=thread][value=thread]').prop('checked',true);
	         $('#trixdiv').show();
	         $('input[type=radio][name=thread]').on('change', function() {
	         switch($(this).val()) {
	             case 'thread':
	                 $('#trixdiv').show();
	                 break;
	             case 'menupoint':
	                 $('#trixdiv').hide();
	                 break;
	             }
	         });
/* Abschicken button gedr�ckt */
            $('#target').button().click(function(){
            
               var text = $('#trix').val();
					var d = new Date();
               if($('input[name=thread]:checked').val() == 'menupoint'){
               	
               	createMenuPoint(text, d);
               } else { 
						createThread(text, d);
               }
                
             });    
             
/* Erstellt in der Datenbank einen Thread */
             function createThread(text, d){
             	var query = {sql: "INSERT INTO `thread` (`PKID_thread`, `FK_menu`, `theme`, `FK_Creator`) VALUES (NULL, '"
               	+getUrlVars()["id"]+"', '"+ $('#threadtitle').val() +"', '"+getUrlVars()["creator"]+"');", 
                  type: "newThread",
                  theme: $('#threadtitle').val(),
                  creator: getUrlVars()["creator"]
               };
               
               var query21 = "INSERT INTO `post` (`PKID_post`, `FK_user`, `FK_thread`, `date`, `time`, `text`) VALUES (NULL, '"+getUrlVars()["creator"]+"', '";
               var query22 = "', '"+d.getFullYear()+"-"+d.getMonth()+"-"+d.getDate()+"', '"+d.getHours()+"-"+d.getMinutes()+"-"+d.getSeconds()+"', '"+text+"');";
/* sendSQL adds post with correct ID */               
               sendSQL(query, query21, query22);
                     
               //update number of posts
               var query = "UPDATE user SET numberposts = numberposts+1 WHERE PKID_user = "+getUrlVars()["creator"];
               var sql = {
               	sql: query
               }
               var answer = $.post("func/insertSQL.php", sql);
                  answer.done(function(){
                     var url = "forum.php?p=menu&menu="+getUrlVars()["id"]+"&page=last";
                     $(location).attr('href',url);
               });
             }
             
/* Erstellt in der Datenbank einen Men�punkt */
             function createMenuPoint(texxt, d){
             	var threads;
                  var sql={
                     type: "getThreads",
                     fk: getUrlVars()["id"]
                  }
                  $.post("func/insertSQL.php", sql, function(result){
                     threads = result;
                  });  
                  
                  if($('#menupoint'))
                    var query;               
                  if(getUrlVars()["id"] == 0){
                     query = "INSERT INTO `menu` (`PKID_menu`, `FK_menu`, `title`, `threads`) VALUES (NULL, NULL, '"+ $('#threadtitle').val() +"', '0')";
                  }else {
                     query = "INSERT INTO `menu` (`PKID_menu`, `FK_menu`, `title`, `threads`) VALUES (NULL, "+getUrlVars()["id"]+", '"+ $('#threadtitle').val() +"', '"+threads+"')";
                  }
                  
                  
                  var sql = {
                     sql: query
                  }
                  var answer = $.post("func/insertSQL.php", sql, function(result) {
                  	alert(reuslt);
                  });
                  answer.done(function(){
                     var url = "forum.php?p=menu&menu="+getUrlVars()["id"]+"&page=last";
                     $(location).attr('href',url);
                  });
             }
             
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
             
             
               function sendSQL(sql1, sql21, sql22) {
                  $.post("func/insertSQL.php",sql1, function(result){
                  
                     var query = sql21 + String(result) + sql22;
                     var newStr= {sql: query};
                     $.post("func/insertSQL.php", newStr);
                  
                  });
                  
               }
             
             
        });
        