<?php
$config = parse_ini_file("../../../db.ini");

$db = new PDO("{$config['driver']}:dbname={$config['dbname']};host={$config['host']};charset={$config['charset']}", $config['username'], $config['password']);

if (!$db) {
  die("<h1>Database connection failed</h1><br>Error:<br>" . mysql_error());
  //die("<h1>Database connection failed</h1>"); -->This is for deployment
}

function runSQL($sql, $args) {
  /*
  * $sql  : Parametered statement. Parametes should be written as ":parameter_name"
  * $args : Associative array of parameters. Syntax: array(":parameter_name" => "value", ...)
  */
  $query = $db->prepare($sql);

  if(!$query -> execute($args)) {
    writeLOG("FAIL SQL Query: " . $sql . " Error: " . mysql_error());
  }
  else {
    writeLOG("SUCCESS SQL Query: " . $sql);
  }
  return $query;
  /*
  * For select statements, fetch or fetchAll functions should be called on $query
  */
}

function writeLOG($action) {
  //Notice that if type is not 'set', then it writes into ADMINLOG table with empty username
  //username in ADMINTABLE must be able to be NULL !!!!!!!!!!!!!!!!!!!!! 
  if($_SESSION['type'] == 0) { //ADMINLOG --> username
    $logq = $db->prepare("INSERT INTO JSO_ADMINLOG VALUES(USERNAME = ':username', ACTION = ':action')");
    $logq->execute(array(':username' => $_SESSION['username'], ':action' => $action)); //Cannot handle error here
  }
  elseif($_SESSION['type'] == 1) { //STUDENTLOG --> id
    $logq = $db->prepare("INSERT INTO JSO_STUDENTLOG VALUES(ID = ':username', ACTION = ':action')");
    $logq->execute(array(':username' => $_SESSION['id'], ':action' => $action)); //Cannot handle error here
  }
  else {
    die("<h1>Unexpected Error</h1><br>Error code: J1002. <a onClick=\"loadPage('routes/feed.php')\">Click here to continue</a>\"");
    //Cannot keep the log
  }
}

?>
