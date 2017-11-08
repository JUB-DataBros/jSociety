<div>
Name: <input type="text" name="ename"><br>
Club: <select name="eclub"></select><br>
Place: <input type="text" name="eplace"><br>
Starts at: <input type="time" name="estart"> Ends at: <input type="time" name="eend"><br>
Detail: <textarea name="edetail" rows="3"></textarea><br>
<input type="submit" name="create_event_detail" value="Create">
</div>

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
