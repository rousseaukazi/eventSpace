<?php

 
 // Connects to your Database 
 mysql_connect("localhost", "suman", "ninjas1158!") or die(mysql_error()); 
 mysql_select_db("suman_eventSpace") or die(mysql_error()); 

$data = mysql_query("SELECT * FROM Users") 
 or die(mysql_error()); 

?>
