<?php
  $dbAddress="localhost";
  $dbUsername="";
  $dbPassword="";
  $dbName="test";
  $conn = mysql_connect($dbAddress, $dbUsername, $dbPassword);
  if (!$conn) {
    die("<h1>Database connection failed</h1><br>Error:<br>" . mysql_error());
  }
  mysql_select_db($dbName) or die("<h1>Database selection failed</h1><br>Error:<br>" . mysql_error());
  mysql_set_charset('utf8');


  function runSQL($sql) {
    $query = mysql_query($sql);

    if(!$query) {
      writeLOG("FAIL SQL Query: " . $sql . " Error: " . mysql_error());
    }
    else {
      writeLOG("SUCCESS SQL Query: " . $sql);
    }
    return $query;
  }

  function writeLOG($action) {
    if($_SESSION['type'] == 0) { //ADMINLOG --> username
      $sql = "INSERT INTO JSO_ADMINLOG VALUES(USERNAME = '" . $_SESSION['username'] . "', ACTION = '" . $action . "')";
      mysql_query($sql); //Cannot handle error here
    }
    elseif($_SESSION['type'] == 1) { //STUDENTLOG --> id
      $sql = "INSERT INTO JSO_STUDENTLOG VALUES(ID = '" . $_SESSION['id'] . "', ACTION = '" . $action . "')";
      mysql_query($sql); //Cannot handle error here
    }
    else {
      die("<h1>Invalid SQL Query</h1><br>Invalid type in runsql(" . $sql . ", " . $_SESSION['type'] . ")");
      return 0;
    }
  }

?>
