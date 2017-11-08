<button type="button" onclick="sidebarClick(createevent)">Create New Event</button>

<?php
  $sql = "SELECT name, createdby, detail FROM dabr_events";
  $result = runSQL($sql);
  echo "<table><b><tr><td>Name</td><td>Created By</td><td><Details></td></tr></b>";
  while($row = mysql_fetch_assoc($result)){
    echo "<tr><td>" . $row['name'] . "</td><td>" . $row['createdby'] . "</td><td>" . $row['detail'] . "</td></tr>";
  }
  echo "</table>";
?>
