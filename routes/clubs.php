Display clubs:
<select id="selector">
	<option value="select" selected>Select</option>
	<option value='all' <?php echo ($_GET["show"] == "all" ? "selected" : "");?>>All</option>
	<option value='interested'<?php echo ($_GET["show"] == "interested" ? "selected" : "");?>>Interested</option>
</select>
<script>
	$('#selector').change(function(){
		if($(this).val() != "select") {
			//updateGet("show", $(this).val());
			loadPage("routes/clubs.php?show=" + $(this).val());
		}
	});
	//$('#selector').val('all').trigger('change');
</script>
<!--
<input type="radio" name="queryclubs" value='int' id="queryclubsint" <?php //echo ($_SESSION['show'] ? "selected='selected" : "");?> >Interested
<input type="radio" name="queryclubs" value='all' id="queryclubsall">All
<script>
	document.ready(function() {
		$("#queryclubsint").on('click', function(){
				loadPage('routes/clubs.php?show=int')
		})
		$("#queryclubsall").on('click', function(){
		    loadPage('routes/clubs.php?show=all')
		})
	});
</script>
-->
<table>
<?php
	//echo "GET show: " . $_GET['show'];
	include_once("../essentials/db.php");
	include_once("../essentials/security_check.php");
	if ($_GET['show'] == "all") {
		/*
		$sql = "SELECT c.NAME as NAME, s.NAME AS CREATEDBY, h.NAME AS FOCUS FROM JSO_CLUB AS c, JSO_STUDENT AS s, JSO_HOBBY as h, JSO_STUDENT_HOBBY AS sh WHERE c.APPROVED = 1 AND c.ORGANISOR = s.ID AND c.FOCUS = h.ID";
		//SQL code is incorrect. JSO_HOBBY does not have subhobbies
		$result = runSQL($sql, array());
		if($result == null) {
			die("<h1 style='color:red'>Error in database querying</h1> <br>Error Code: Q1005");
		}
		$clubs = $result -> fetchAll();

		echo "<table><tr><th>Club Name</th><th>Created By</th><th><Focus></th></tr>";
		$i = 0;
		while($i < count($result)){ //
			//$row = $result[i];
			//echo $result[i][0] . "<br>";
			echo "<tr><td>" . $result[$i]['NAME'] . "</td><td>" . $result[$i]['CREATEDBY'] . "</td><td>" . $result[$i]['FOCUS'] . "</td></tr>";
			$i = $i + 1; //
		}
		echo "</table>";
		*/
		die("<h1 style='color:purple'>This page is under construction</h1>");
	} elseif($_GET['show'] == "interested") {
		/*
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
		*/
		die("<h1 style='color:purple'>This page is under construction</h1>");
	}

?>
