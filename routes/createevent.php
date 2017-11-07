<form method="POST">
Name: <input type="text" name="create_event_name"><br>
Detail: <input type="text" name="create_event_detail" style="height:200px"><br>
<input type="submit" name="create_event_detail" value="Create">
</form>

<?php
  if(isset($_POST['create_event_detail'])) {
    $sql = "INSERT INTO dabr_events VALUES(name='" . mysqli_real_escape_string($_POST['create_event_name']) . "', createdby='" . $_SESSION['username'] . "', detail='" . mysql_real_escape_string($_POST['create_event_detail']) . "')";
    $rs = $conn->query($sql);
    if($rs === false) {
      trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
    }
    else {
      echo "Event successfully created";
    }
  }
?>
