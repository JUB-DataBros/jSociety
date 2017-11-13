<!-- <script>loadIndex();</script> -->
<div>
  Name: <input type="text" name="ename"><br>
  Club: <select name="eclub">
  <?php
    //include("partials/db.php");

    $stmt = "SELECT c.id c.name FROM JSO_CLUB c WHERE c.organisor = {$_SESSION['id']}";
    //$query = runSQL($stmt);
    $result[0][0] = 0; //
    $result[0][1] = "Chess Society"; //
    $result[1][0] = 2; //
    $result[1][1]="Computer Science"; //
    $result[2][0] = 2; //
    $result[2][1] = "Waffle Club"; //

    //while($result = mysql_fetch_array($query)){
    $i = 0;
    while($i < 3){
      echo "<option value='" . $result[$i][0] . "'>" . $result[$i][1] . "</option>";
      $i = $i + 1;
    }
  ?></select><br>
  Place: <input type="text" name="eplace"><br>
  Starts at: <input type="time" name="estart"> Ends at: <input type="time" name="eend"><br>
  Detail: <textarea name="edetail" rows="3"></textarea><br>
  <button onClick="alert('Event successfully created'); window.location.href='?page=events'" name="create_event_detail">Create Event</script>
</div>
