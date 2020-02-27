<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$db=pg_pconnect  ("host = localhost port=5432 dbname=projectdb user=student password=student") or die ('I cannot connect to the database  because: '); 
     // paper params
     $paperid = $_GET['pid'];
     
    
     
     $title = $_POST['title'];
     $type =$_POST['type'];
     $keywords =  $_POST['keyword'];
     $link = $_POST['link'];
     $year = $_POST['year'];
     
     // author params
     $authors = split('[&.-]', $_POST['name']);
     $workplaces = split('[&.-]', $_POST['workplace']);
     
     // Conf params
     $venue = $_POST['venue'];
     
     // Journal
     $journalName = $_POST['journalName'];
     $volume = $_POST['volume'];
     $number = $_POST['number'];
     $pages = $_POST['pages'];
     
     
     
     $result = pg_query($db, "SELECT name FROM author natural join published_paper natural join paper WHERE paper.paperid = '".$paperid."'");
     
     
     $authorsOld = pg_fetch_all_columns($result, 0);
     $authorsOld = array_values($authorsOld);
    
     
     
      $i=0; 
     $workplaces = array_values($workplaces);
    foreach($authors as $name=>$val){
         pg_query($db, "UPDATE author SET name  = '".$val."' WHERE name LIKE '".$authorsOld[$i]."'");
         pg_query($db, "UPDATE author SET workplace = '".$workplaces[$i]."' WHERE name LIKE '".$val."'");
          
          $i++;
    }
    
    
            pg_query($db, "UPDATE Paper SET Title = '".$title."' WHERE paperid =".$paperid.""); 
            pg_query($db, "UPDATE Paper SET Type = '".$type."' WHERE paperid =".$paperid.""); 
            pg_query($db, "UPDATE Paper SET keyword = '".$keywords."' WHERE paperid =".$paperid.""); 
            pg_query($db, "UPDATE Paper SET link = '".$link."' WHERE paperid =".$paperid."");
            pg_query($db, "UPDATE Paper SET year = '".$year."' WHERE paperid =".$paperid.""); 
            
             pg_query($db, "UPDATE Journal SET journal.name = '".$journalName."' WHERE paperid =".$paperid.""); 
              pg_query($db, "UPDATE Journal SET volume = '".$volume."' WHERE paperid =".$paperid.""); 
                  pg_query($db, "UPDATE Journal SET number = '".$number."' WHERE paperid =".$paperid.""); 
                      pg_query($db, "UPDATE Journal SET pages = '".$pages."' WHERE paperid =".$paperid.""); 
                          pg_query($db, "UPDATE Journal SET year = '".$year."' WHERE paperid =".$paperid.""); 
                      
                pg_query($db, "UPDATE Conference SET venue = '".$venue."' WHERE paperid =".$paperid."");
                    pg_query($db, "UPDATE Conference SET year = '".$year."'WHERE paperid =".$paperid.""); 
            
      
        
          
          
          
     
           echo '<h1 style="font-family: sans; color: #002E3D; text-align: center;">Publication successfully created</h1>';
          $sql3 = "SELECT paper.paperid,  title, type, keyword, conference.venue, conference.year, link FROM author NATURAL JOIN published_paper NATURAL JOIN paper INNER JOIN Conference ON conference.paperid =  paper.paperid WHERE paper.paperid =(SELECT MAX(paperid) FROM paper) LIMIT 1";
              
              $result3 = pg_query($db, $sql3);
             
                
              
                while ($line = pg_fetch_array($result3, null, PGSQL_ASSOC)) {
                    echo "\t<div class='publication' style='margin: auto;'><div class = 'confTag'><p style='margin: 5px 0 0 1px'>C</p></div><div class='pubText'>\n";
                    $c = 1;
                    foreach ($line as $col_value) {
     
                        if($c ==5){
                            
                            $sql4 = "SELECT author.name FROM author natural join published_paper natural join paper WHERE paperid ='$new'";
                            $result4 = pg_query($db, $sql4);
                            if (pg_num_rows($result4)==1){
                                echo '<p class="authors"><strong class="authorTag">Author</strong>: ';
                            } elseif(pg_num_rows($result4)>1){
                                echo '<p class="authors"><strong class="authorTag">Authors</strong>: ';
                            }
                            $count = 0;
                            while($line2 = pg_fetch_row($result4)){
                            foreach ($line2 as $key=>$value) {
                                $count++;
                                if($count == pg_num_rows($result4 )){
                                echo $value.".";
                                } else{
                                    echo $value.",  ";
                                }
                            }
                            }
                            echo '</p>';
                        }
                        switch ($c) {
                            case 1:
                                $new = $col_value;
                                $c++;
                                break;
                            case 2:
                                echo "\t<h5>$col_value</h5>\n";
                                $c++;
                                break;
                            case 3:
                                echo "\t<div class='innerText'><div class='type'><p>$col_value</p></div>\n";
                                $c++;
                                break;
                            case 4:
                                echo "\t<div class='keyWords'><p>$col_value</p></div>\n";
                                $c++;
                                break;
                            case 5:
                                echo "\t<p class='confName'><span style='color: black;  '>Conference: </span>$col_value,\n";
                                $c++;
                                break;
                            case 6:
                                echo " $col_value</p>";
                                $c++;
                                break;
                            case 7:
                                echo "\tLink: <a href='$col_value'>$col_value</a></div>\n";
                                $c = 1;
                                break;
                        }
                    }
                    echo "\t</div></div>\n";
                }
                
 
         $sql = "SELECT paper.paperid, title, type, keyword, journal.name, Volume, Number, Pages, paper.year, link FROM author natural join published_paper natural join paper inner join journal on journal.paperid = paper.paperid WHERE paper.paperid =(SELECT MAX(paperid) FROM paper) LIMIT 1"; 
              //-run  the query against the mysql query function 13	  
          
                  $result=pg_query($db, $sql);
                  
                
                  
                  while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
                    echo "\t<div class='publication' style='margin: auto'><div class = 'journalTag'><p style='margin-left: 10px'>J</p></div><div class='pubText'>\n";
                    $c=1;
                    
                    
                    foreach ($line as $col_value) {
                        
                        if($c==5){
                            
                            $sql2 = "SELECT author.name FROM author natural join published_paper natural join paper WHERE paperid ='$new'";
                            $result2 = pg_query($db, $sql2);
                            if (pg_num_rows($result2)==1){
                               
                                echo '<p class="authors"><strong class="authorTag">Author</strong>: ';
                            } elseif(pg_num_rows($result2)>1){
                                echo '<p class="authors"><strong class="authorTag">Authors</strong>: ';
                            }
                            $count = 0;
                            while($line2 = pg_fetch_row($result2)){
                            foreach ($line2 as $key=>$value) {
                                $count++;
                                if($count == pg_num_rows($result2 )){
                                echo $value.".";
                                } else{
                                    echo $value.",  ";
                                }
                            }
                            }
                            echo '</p>';
                            
                        }
                    
                        switch($c) {
                            case 1:
                                $new = $col_value;
                                $c++;
                                break;
                            case 2: 
                                echo "\t<h5>$col_value</h5>\n";
                                $c++;
                                break;
                            case 3:
                                echo "\t<div class='innerText'><div class='type'><p>$col_value</p></div>\n";
                                $c++;
                                break;
                            case 4:
                                echo "\t<div class='keyWords'><p>$col_value</p></div>\n";
                                $c++;
                                break;  
                        
                            case 5:
                                echo "\t<p class='journal'><span style='color: black;  '>Journal: </span>$col_value, ";
                                $c++;
                                break;
                            case 6:
                                echo "vol.$col_value, ";
                                $c++;
                                break;
                            case 7:
                                echo "$col_value, ";
                                $c++;
                                break;
                            case 8:
                                echo "p. $col_value, ";
                                $c++;
                                break;
                            case 9:
                                echo "$col_value year </p> ";
                                $c++;
                                break;
                            case 10:
                                echo "\tLink: <a href='$col_value'>$col_value</a></div>\n";
                                $c = 1;
                                break;
                        }
                    } 
                    echo "\t</div></div>\n";
                }
    // UPDATE author SET name  = 'Boris Anus' WHERE name = (SELECT name FROM author natural join published_paper natural join paper WHERE paper.paperid = '');
     //UPDATE author SET workplace = 'Microsoft' WHERE authorid = (SELECT authorid FROM author WHERE name LIKE 'Boris Anus');