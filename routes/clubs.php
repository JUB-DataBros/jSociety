Display clubs:
<select id="selector" onChange="loadPage('routes/clubs.php?show=' + $('#selector').val())">
	<option value='def'>Interested</option>
	<option value='all' <?php $show = $_GET['show'] ? $_GET['show'] : "def"; if($show=="all") echo "selected";?>>All</option>
</select>
<table>
<?php
	include_once("../essentials/db.php");
	include_once("../essentials/security_check.php");
	if ($_GET['show'] == "all") {
		$sql = "SELECT c.ID, c.NAME, s.NAME, h.NAME FROM JSO_CLUB AS c, JSO_STUDENT AS s, JSO_HOBBY as h, JSO_STUDENT_HOBBY AS sh WHERE c.APPROVED = 1 AND c.ORGANISOR = s.ID AND c.FOCUS = h.ID AND h.ID = sh.HOBBYID";
		//SQL code is incorrect. JSO_HOBBY does not have subhobbies
		$result = runSQL($sql, array());
		if($result == null) {
			die("<h1 style='color:red'>Error in database querying</h1> <br>Error Code: Q1005");
		}
		$clubs = $result -> fetchAll();
		for ($i=0; $i<count($clubs); $i+=2) {
			echo "<tr><th>{$clubs[$i]['c.NAME']}</th><th>{$clubs[$i+1]['c.NAME']}</th></tr>
						<tr><td>{$clubs[$i]['h.NAME']}</td><td>{$clubs[$i+1]['h.NAME']}</td></tr>
						<tr><td>Organized by: {$clubs[$i]['s.NAME']}</td><td> Organized by: {$clubs[$i+1]['s.NAME']}</td></tr>";
		}
	} else {
		$sql = "SELECT c.ID, c.NAME, s.NAME, h.NAME FROM JSO_CLUB AS c, JSO_STUDENT AS s WHERE c.APPROVED = 1 AND c.ORGANISOR = s.ID AND c.FOCUS = h.ID AND c.FOCUS IN (SELECT HOBBYID FROM JSO_STUDENT_HOBBY AS h WHERE STUDENTID = :studentid)";
		$args = array(":studentid" => $_SESSION['studentid']);
		$result = runSQL($sql, $args);
		if($result == null) {
			die("<h1 style='color:red'>Error in database querying</h1> <br>Error Code: Q1006");
		}
		$clubs = $result -> fetchAll();
		for ($i=0; $i<count($clubs); $i+=2) {
			echo "<tr><th>{$clubs[$i]['c.NAME']}</th><th>{$clubs[$i+1]['c.NAME']}</th></tr>
						<tr><td>{$clubs[$i]['h.NAME']}</td><td>{$clubs[$i+1]['h.NAME']}</td></tr>
						<tr><td>Organized by: {$clubs[$i]['s.NAME']}</td><td> Organized by: {$clubs[$i+1]['s.NAME']}</td></tr>";
		}
	}

?>
