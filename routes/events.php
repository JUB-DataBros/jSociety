<?php
  include("../essentials/security_check.php");
  //$sql = "SELECT name, createdby, detail FROM dabr_events";
  //$result = runSQL($sql);
  $result[0]['name'] = "Chess Society Meeting"; //
  $result[0]['createdby'] = "John Doe"; //
  $result[0]['detail'] = "Come to Mercator common room"; //
  $result[1]['name']="CS Club Meeting"; //
  $result[1]['createdby'] = "Alex Doranter"; //
  $result[1]['detail'] = "Bring your laptops"; //
  $result[2]['name'] = "Waffle Thursday"; //
  $result[2]['createdby'] = "Arya Stark"; //
  $result[2]['detail'] = "Order your waffles on facebook"; //

  echo "<table><tr><th>Event Name</th><th>Created By</th><th><Details></th></tr>";
  //while($row = mysql_fetch_assoc($result)){
  $i = 0; //
  while($i < 3){ //
    //$row = $result[i];
    echo "<tr><td>" . $result[$i]['name'] . "</td><td>" . $result[$i]['createdby'] . "</td><td>" . $result[$i]['detail'] . "</td></tr>"; //
    $i = $i + 1; //
  }
  echo "</table>";
?>
