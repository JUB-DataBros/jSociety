<?php
  $dbAddress="localhost"
  $dbUsername="";
  $dbPassword="";
  $dbName="test";
  $conn = mysql_connect($dbAddress, $dbUsername, $dbPassword, $dbName);
  if (!$conn) {
    die("<h1>Database connection failed</h1><br>Error:<br>" . mysql_error());
  }
  //mysql_select_db($dbName) or die(mysql_error());
  //mysql_set_charset('utf8');


  function runsql($sql, $type) {
    if($type == 0) {
      $logTable = "JSO_ADMINLOG";
    }
    elseif($type == 1) {
      $logTable = "JSO_ADMINLOG";
    }
    else {
      die("<h1>Invalid SQL Query</h1>")
      die("<br>Invalid type in runsql(" . $sql . ", " . $type . ")");
      return 0;
    }

    $query = mysql_query($sql);

    if(!$query) {
      return log("SQL Query: " . $sql . " Error: " . mysql_error());
    }
    else {
      log("Query: " . $sql );
      return $query;
    }
  }

  function log($action, $type) {
    if($type == 0) {
      $logTable = "JSO_ADMINLOG";
    }
    elseif($type == 1) {
      $logTable = "JSO_ADMINLOG";
    }
    else {
      die("<h1>Invalid type in runsql()</h1>");
      return 0;
    }


  }
?>
