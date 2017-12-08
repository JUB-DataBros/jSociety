<?php
include_once("../essentials/db.php");
include_once("../essentials/security_check.php");
<<<<<<< HEAD
  $sql = "SELECT NAME, ORGANIZEDBY, DETAIL, STARTTIME, ENDTIME FROM JSO_EVENT WHERE APPROVED = 1";
  $result = runSQL($sql, Array());
  if($result == null) {
    die("<h1 style='color:red'>Error in database querying</h1> <br>Error Code: Q1007");
  }
  $result = $result -> fetchAll();
  /*
=======
echo "<button type='button' onclick='loadPage(routes/createevent.php)'>Create New Event</button><br>";
  //$sql = "SELECT name, createdby, detail FROM dabr_events";
  //$result = runSQL($sql);
>>>>>>> 760c8220da8e19ee87af43a8161dee873616aab8
  $result[0]['name'] = "Chess Society Meeting"; //
  $result[0]['createdby'] = "John Doe"; //
  $result[0]['detail'] = "Come to Mercator common room"; //
  $result[1]['name']="CS Club Meeting"; //
  $result[1]['createdby'] = "Alex Doranter"; //
  $result[1]['detail'] = "Bring your laptops"; //
  $result[2]['name'] = "Waffle Thursday"; //
  $result[2]['createdby'] = "Arya Stark"; //
  $result[2]['detail'] = "Order your waffles on facebook"; //
*/

  echo "<table style='border-spacing:50px'><tr><th>Event Name</th><th>Created By</th><th>Details</th><th>Begins</th><th>Ends</th></tr>";
  $i = 0; //
  while($i < count($result)){ //
    //$row = $result[i];
    echo "<tr><td>" . $result[$i]['NAME'] . "</td><td>" . $result[$i]['ORGANIZEDBY'] . "</td><td>" . $result[$i]['DETAIL'] . "</td><td>" . $result[$i]['STARTTIME'] . "</td><td>" . $result[$i]['ENDTIME'] . "</td></tr>"; //
    $i = $i + 1; //
  }
  echo "</table>";
?>
