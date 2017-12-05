<html>
<body>
<?php
$users = array("c.stelter", "c.breland", "c.finkle", "c.alexander", "c.valero", "c.morena", "b.stelter", "b.breland", "b.finkle" ,"b.alexander", "b.valero", "b.morena", "m.stelter", "m.breland", "m.finkle", "m.alexander", "m.valero", "m.morena", "o.stelter", "o.breland", "o.finkle", "o.alexander", "o.valero", "o.morena", "t.stelter", "t.breland", "t.finkle", "t.alexander", "t.valero", "t.morena", "m.stelter", "m.breland", "m.finkle", "m.alexander", "m.valero", "m.morena");
$salt = hash("sha256", "jSociety by DataBros", false);
$password = "test123";

echo "<table><br>";
foreach($users as $username) {
  $salted_password = hash("sha256", $username . $salt . $password, false);
  echo "<tr><td>" . $username . "</td><td>" . $salted_password . "</td></tr><br>";
}
echo "</table>";

?>
</body>
</html>
