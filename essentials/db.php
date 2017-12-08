<?php
$config = parse_ini_file("{$_SERVER['DOCUMENT_ROOT']}/../db.ini");

$db = new PDO("{$config['driver']}:dbname={$config['dbname']};host={$config['host']};charset={$config['charset']}", $config['username'], $config['password']);

if (!$db) {
  die("<h1>Database connection failed</h1><br>Error code: G1001");
  //Do not reveal error message
}

function runSQL($sql, $args) {
  /*
  * $sql  : Parametered statement. Parametes should be written as ":parameter_name"
  * $args : Associative array of parameters. Syntax: array(":parameter_name" => "value", ...)
  */
  global $db;
  $query = $db->prepare($sql);

  if(!$query -> execute($args)) {
    writeLOG("FAIL SQL Query: " . $sql . " Error: " . $db->errorCode());
    return null;
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
  global $db;
  if($_SESSION['usertype'] == 0
  || $_SESSION['usertype'] == NULL
  || $_SESSION['usertype'] == False) { //ANONYMOUS USER --> ADMINLOG --> username
    $logq = $db->prepare("INSERT INTO JSO_ADMINLOG VALUES(USERNAME = ':username', ACTION = ':action')");
    $logq->execute(array(':username' => 'ANONYMOUS', ':action' => $action));
  }
  elseif($_SESSION['usertype'] == 1) { //STUDENT --> STUDENTLOG --> id
    $logq = $db->prepare("INSERT INTO JSO_STUDENTLOG VALUES(ID = ':username', ACTION = ':action')");
    $logq->execute(array(':username' => $_SESSION['id'], ':action' => $action));
  }
  elseif($_SESSION['usertype'] == 2) { //ADMIN --> ADMINLOG --> username
    $logq = $db->prepare("INSERT INTO JSO_ADMINLOG VALUES(USERNAME = ':username', ACTION = ':action')");
    $logq->execute(array(':username' => $_SESSION['username'], ':action' => $action));
  }
  else { //INVALID USER TYPE
    $logq = $db->prepare("INSERT INTO JSO_ADMINLOG VALUES(USERNAME = ':username', ACTION = ':action')");
    $logq->execute(array(':username' => 'INVALIDUSERTYPE', ':action' => "Invalid User Type. id=" . $_SESSION['id'] . "; username=" . $_SESSION['username']));
    die("<h1 style='color:red'>Unexpected Error</h1><br>Error code: G1002");
  }
}

?>
