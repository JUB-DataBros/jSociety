<!-- <script>loadIndex();</script> -->
<div>
  Name:
  <input type="text" name="ename"><br>
  Club:
  <select name="eclub">
  <?php
    include_once("../essentials/db.php");
    include_once("../essentials/security_check.php");

    $stmt = "SELECT c.id c.name FROM JSO_CLUB c WHERE c.organisor = :id";
    $query = runSQL($stmt, array(':id' => $_SESSION['id']));
    // $result[0][0] = 0; //
    // $result[0][1] = "Chess Society"; //
    // $result[1][0] = 2; //
    // $result[1][1]="Computer Science"; //
    // $result[2][0] = 2; //
    // $result[2][1] = "Waffle Club"; //

    $result = $query->fetchAll();
    foreach ($result as $club) {
      echo "<option value='" . $club[0] . "'>" . $club[1] . "</option>";
    }
  ?>
  </select><br>
  Place: <input type="text" name="eplace"><br>
  Starts at: <input type="time" name="estart"> Ends at: <input type="time" name="eend"><br>
  Detail: <textarea name="edetail" rows="3"></textarea><br>
  <button onClick="alert('Event successfully created'); window.location.href='?page=events'" name="create_event_detail">Create Event</script>
</div>
