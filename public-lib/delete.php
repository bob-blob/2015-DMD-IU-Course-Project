<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$db=pg_pconnect  ("host = localhost port=5432 dbname=projectdb user=student password=student") or die ('I cannot connect to the database  because: '); 
$paperid = $_GET['id'];


echo '<h1 style="font-family: sans; color: #002E3D; text-align: center; margin-top:25%;">Publication deleted :(</h1>';
 pg_query($db, "DELETE FROM Journal WHERE paperid = ".$paperid."");
 pg_query($db, "DELETE FROM Conference WHERE paperid = ".$paperid."");
 pg_query($db, "DELETE FROM published_paper WHERE paperid = ".$paperid."");
  pg_query($db, "DELETE FROM paper WHERE paperid = ".$paperid."");
 
 pg_close();        