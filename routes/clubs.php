<select id="selector" onchange="loadPage('routes/clubs.php', {show: $('#selector').val()})">
	<option value='def'>Interested</option>
	<option value='all' <?php $show = $_GET['show'] ? $_GET['show'] : "def"; if($show=="all") echo "selected";?>>All</option>
</select>
<table>
<?php
include("../essentials/security_check.php");
include("../essentials/db.php");
if ($show == "all") {
	$stmt = "SELECT c.ID, c.NAME, s.NAME, h.NAME FROM JSO_CLUB AS c, JSO_STUDENT AS s WHERE c.APPROVED = 1 AND c.ORGANISOR = s.ID AND c.FOCUS = h.ID";
	$query = runSQL($stmt, array());
	$clubs = $query -> fetchAll();
	for ($i=0; $i<count($clubs); $i+=2) {
		echo "<tr><th>{$clubs[$i]['c.NAME']}</th><th>{$clubs[$i+1]['c.NAME']}</th></tr>
					<tr><td>{$clubs[$i]['h.NAME']}</td><td>{$clubs[$i+1]['h.NAME']}</td></tr>
					<tr><td>Organized by: {$clubs[$i]['s.NAME']}</td><td> Organized by: {$clubs[$i+1]['s.NAME']}</td></tr>";
	}
} else {
	$stmt = "SELECT c.ID, c.NAME, s.NAME, h.NAME FROM JSO_CLUB AS c, JSO_STUDENT AS s WHERE c.APPROVED = 1 AND c.ORGANISOR = s.ID AND c.FOCUS = h.ID AND c.FOCUS IN (SELECT HOBBYID FROM JSO_STUDENT_HOBBY WHERE STUDENTID = :student)";
	$query = runSQL($stmt, array(":student" => $_SESSION['studentid'])); // <------
	$clubs = $query -> fetchAll();
	for ($i=0; $i<count($clubs); $i+=2) {
		echo "<tr><th>{$clubs[$i]['c.NAME']}</th><th>{$clubs[$i+1]['c.NAME']}</th></tr>
					<tr><td>{$clubs[$i]['h.NAME']}</td><td>{$clubs[$i+1]['h.NAME']}</td></tr>
					<tr><td>Organized by: {$clubs[$i]['s.NAME']}</td><td> Organized by: {$clubs[$i+1]['s.NAME']}</td></tr>";
	}
}

?>
