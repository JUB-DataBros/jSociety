<div>
Name: <input type="text" name="ename"><br>
Club: <select name="eclub">
<?php
include("partials/db.php");

$stmt = "SELECT c.id c.name FROM JSO_CLUB c WHERE c.organisor = {$_SESSION['id']}";
$query = runSQL($stmt);

while($result = mysql_fetch_array($query)){
  echo "<option value=\"{$result[0]}\">{$result[1]}</option>
  ";
}
?></select><br>
Place: <input type="text" name="eplace"><br>
Starts at: <input type="time" name="estart"> Ends at: <input type="time" name="eend"><br>
Detail: <textarea name="edetail" rows="3"></textarea><br>
<input type="submit" name="create_event_detail" value="Create">
</div>
