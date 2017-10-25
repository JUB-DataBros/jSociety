<!doctype html>
<html>
<head>
  <title>jSociety</title>
  <link rel="stylesheet" type="text/css" href="css/layout.css">
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
  loadPage("routes/disclaimer.php"); //this is the home content now
  getPage = findGetParameter("page");
  //alert(getPage);
  switch(getPage){
    case "feed":
    case "profile":
    case "events":
    case "clubs":
    case "settings":
    case "disclaimer"
      loadPage("routes/" + getPage + ".php");
      break;
  }
  </script>
</body>
</html>
