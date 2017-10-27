<?php
  $dbAddress=""
  $dbUsername="";
  $dbPassword="";
  $dbName="";
  mysql_connect($dbAddress, $dbUsername, $dbPassword);
  mysql_select_db($dbName) or die(mysql_error());
  mysql_set_charset('utf8');
?>
