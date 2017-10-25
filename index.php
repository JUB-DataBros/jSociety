<!doctype html>
<html>
<head>
  <title>jSociety</title>
</head>
<body>
<?php
  include('partials/header.php');
  include('partials/sidebar.php');
?>
<div class="body">
</div>
<script src="js/jquery.js"></script>
<script src="js/main.js"></script>
<script>
getPage = findGetParameter("page");
switch(getPage){
  case "feed":
  case "profile":
  case "events":
  case "clubs":
  case "settings":
    loadPage("routes/" + getPage + ".php");
    break;
}
</script>
</body>
</html>
