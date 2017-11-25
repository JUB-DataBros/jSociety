<h1>This is a search page!</h1>


<?php
// Trying to find the matching words
// inner,left,rgiht joins will give us same answer because all tables we are combining has common attributes
// in select need to change some attribute names because there was some name clashes

// looks the club and hobby name
$sql["club"] = "SELECT C.NAME AS cname, C.ID AS cid, H.NAME AS hname
	FROM JSO_CLUB  C INNER JOIN JSO_HOBBY H ON C.FOCUS = H.ID
	WHERE C.NAME = %:keyword% OR H.NAME = %:keyword%";
// looks the student name, college name, major name
$sql["student"] = "SELECT S.NAME AS sname, S.ID AS sid, M.NAME AS mname, CO.NAME AS coname, S.EMAIL AS email
	FROM ((JSO_STUDENT S INNER JOIN JSO_MAJOR M ON M.ID = S.MAJOR)
			   INNER JOIN JOS_COLLEGE ON CO.ID = S.COLLEGE)
	WHERE S.EMAIL = %:keyword% S.NAME = %:keyword% OR M.NAME = %:keyword% OR CO.NAME = %:keyword%";
// Looks the Event name, description and the club name
$sql["event"] = "SELECT C.NAME AS cname, E.ID AS eid, E.NAME AS ename, E.STARTIME as start, E.ENDTIME as end, COUNT(S.ID), E.DETAIL as detail
	FROM (((JSO_EVENT E INNER JOIN JSO_CLUB C ON C.ID = E.ORGANIZEDBY)
			 INNER JOIN JSO_STUDENT_EVENT SE ON SE.EVENTID = E.ID)
			 INNER JOIN JSO_STUDENT S ON SE.STUDENTID = S.ID)
	WHERE (E.NAME = %:keyword% OR E.DETAIL = %:keyword% OR C.NAME = %:keyword%) AND E.ENDTIME > NOW()
	ORDER BY E.STARTTIME DESC";

$arg = array(':keyword' => $_GET["keyword"]);

foreach($sql as $key => $search){
	//$query[$key] = runSQL($sql[$key], $arg);
}

?>
<h2>CLUBS</h2>
 <div class="club-button">
 	 <button name=<?php echo "someid";?> onclick="load('getclub',$('#someid').val())">Club1<br>Sport</button>
 	 <button name=<?php echo "someid";?> onclick="load('getclub',$('#someid').val())">Club1<br>Sport</button>
 	 <button name=<?php echo "someid";?> onclick="load('getclub',$('#someid').val())">Club1<br>Sport</button>
 	 <button name=<?php echo "someid";?> onclick="load('getclub',$('#someid').val())">Club1<br>Sport</button>
 	 <button name=<?php echo "someid";?> onclick="load('getclub',$('#someid').val())">Club1<br>Sport</button>
 	 <button name=<?php echo "someid";?> onclick="load('getclub',$('#someid').val())">Club1<br>Sport</button>
</div> 


<!--<?php
/* mysql_fetch_array kullanılmıyıcak
	 while($result = mysql_fetch_array($query["club"])){
		echo '<td>'.$result["cname"].'</td>';
		echo '<td>'.$result["hname"].'</td>';
	 }*/

	?>-->

<h2>STUDENT</h2>
<h2>EVENT</h2>

<div  class="header-event-table">
		<table>
		<tr>
		<td>Event Name</td>
		<td>Created By</td>
		<td style="width:24%;">Details</td>
		<td>Start-Time</td>
		<td>End-Time</td>
		</tr>
		</table>
</div>
<div class="event-table">

	<button name="someid" onclick="load('getevent', $('#someid').val())">
		<table>
		<tr>
		<td>Event Name</td>
		<td>Created By</td>
		<td style="width:24%;">qweqeqşlmas dadla daslk asdk adaaşsdl aasşld kaşm aşsld asdşcamğ</td>
		<td>Start-Time</td>
		<td>End-Time</td>
		</tr>
		</table>
	</button>
	<button name="someid" onclick="load('getevent', $('#someid').val())">
		<table>
		<tr>
		<td>Event Name</td>
		<td>Created By</td>
		<td  style="width:24%;">qweqeqşlmas dadla daslk asdk adaaşsdl aasşld kaşm aşsld asdşcamğ</td>
		<td>Start-Time</td>
		<td>End-Time</td>
		</tr>
		</table>
	</button>
	<button name="someid" onclick="load('getevent', $('#someid').val())">
		<table>
		<tr>
		<td>Event Name</td>
		<td>Created By</td>
		<td  style="width:24%;">qweqeqşlmas dadla daslk asdk adaaşsdl aasşld kaşm aşsld asdşcamğ</td>
		<td>Start-Time</td>
		<td>End-Time</td>
		</tr>
		</table>
	</button>
	<button name="someid" onclick="load('getevent', $('#someid').val())">
		<table>
		<tr>
		<td>Event Name</td>
		<td>Created By</td>
		<td style="width:24%;">qweqeqşlmas dadla daslk asdk adaaşsdl aasşld kaşm aşsld asdşcamğ</td>
		<td>Start-Time</td>
		<td>End-Time</td>
		</tr>
		</table>
	</button>	
</div>

