<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

 $db=pg_pconnect  ("host = localhost port=5432 dbname=projectdb user=student password=student") or die ('I cannot connect to the database  because: ');

if(isset($_POST['confSearch'])) {
            if(isset($_GET['go'])) {
              if(preg_match("/^[a-zA-Z0-9]+/", $_POST["conf"])){ 
                  
                  $name=$_POST["conf"]; 
                            
                  //-query  the database table 
                  
                    $sql2 = "SELECT paper.paperid, title, type, keyword, conference.venue, conference.year, link FROM paper INNER JOIN Conference ON conference.paperid =  paper.paperid WHERE conference.venue LIKE '%".$name."%' ORDER BY conference.venue LIMIT 10";
              
              $result2 = pg_query($db, $sql2);
             
                 echo "\t<div class='headYear'>Conferences with name: $name</div>\n";
                while ($line = pg_fetch_array($result2, null, PGSQL_ASSOC)) {
                    echo "\t<div class='publication'><div class = 'confTag'><p style='margin: 5px 0 0 1px'>C</p></div><div class='pubText'>\n";
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
                    echo "\t<div class='blockEdit'><a href='index.php?page=edit&pid=$id&kind=0'><div class='edit'>EDIT</div></a><a href='index.php?page=delete&id=$id'><div class='del'>DELETE</div></a></div></div></div>\n";
                }
                
          //<div class = 'confTag'><p style='margin: 5px 0 0 1px'>C</p></div>
            }
                  
                  
              } else {
                  echo "<p>  </p>";
              }
            }
            
            
            pg_close();