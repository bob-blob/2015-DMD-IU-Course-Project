<?php

    
     $db=pg_pconnect  ("host = localhost port=5432 dbname=projectdb user=student password=student") or die ('I cannot connect to the database  because: '); 
     // paper params
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
     
          
     $check = $_POST['inlineRadioOptions'];
     
    
     $i=0;  $c =0 ;
     $workplaces = array_values($workplaces);
    foreach($authors as $name=>$val){
         pg_query($db, "INSERT INTO author(AuthorID, name, workplace) VALUES((SELECT MAX(AuthorID)+1 FROM author), '".$val."', '".$workplaces[$i]."')");
        if($c==0){ pg_query($db, "INSERT INTO paper(PaperID, type, keyword, title, link, year ) VALUES((SELECT MAX(PaperID)+1 FROM paper), '".$type."', '".$keywords."', '".$title."', '".$link."', '".$year."')"); }
          pg_query($db, " INSERT INTO published_paper(AuthorID, PaperID) VALUES((SELECT AuthorID FROM Author WHERE name LIKE '".$val."'), (SELECT MAX(PaperID) FROM Paper))");
          $c++; 
          $i++;
          }
          
     
    
     if($check == "option1"){
         pg_query($db, "INSERT INTO conference(PaperID, Venue, Year) VALUES((SELECT MAX(PaperID) FROM Paper), '".$venue."', '".$year."')");
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
                
         
     } else {
         pg_query($db, "INSERT INTO journal(PaperID, Name, Volume, Number, Pages, Year) VALUES((SELECT MAX(PaperID) FROM Paper), '".$journalName."', '".$volume."', '".$number."', '".$pages."', '".$year."')");
          echo '<h1 style="font-family: sans; color: #002E3D; text-align: center;">Publication successfully created</h1>';
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
     }
     