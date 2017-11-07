<?php
  $dbAddress="localhost"
  $dbUsername="";
  $dbPassword="";
  $dbName="test";
  $conn = new mysqli($dbAddress, $dbUsername, $dbPassword, $dbName);
  if ($conn->connect_error) {
    trigger_error('Database connection failed: '  . $conn->connect_error, E_USER_ERROR);
  }
  //mysql_select_db($dbName) or die(mysql_error());
  //mysql_set_charset('utf8');
?>
