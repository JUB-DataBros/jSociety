<h1>This is the events page!</h1>

<?php
  //session_start();
  //include("partials/dbconnect.php");
  $sql = "SELECT name, createdby, detail FROM dabr_events";
  $rs = $conn->query($sql);
  if($rs === false) {
    trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
  }
  else {
    $rows_returned = $rs->num_rows;
  }

  $rs->data_seek(0);
  echo "<table><b><tr><td>Name</td><td>Created By</td><td><Details></td></tr></b>";
  while($row = $rs->fetch_assoc()){
    echo "<tr><td>" . $row['name'] . "</td><td>" . $row['createdby'] . "</td><td>" . $row['detail'] . "</td></tr>";
  }
  echo "</table>";
?>
