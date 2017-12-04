<!doctype html>
<html>
  <head>
    <title>jSociety</title>
    <link rel="stylesheet" type="text/css" href="css/layout.css">
    <link rel="stylesheet" type="text/css" href="css/search.css">
  </head>
  <body>
    <?php
      session_start();
      //include("partials/db.php");
      include('partials/header.php');
      include('partials/sidebar.php');
    ?>
    <div class="body">
      <br>
    </div>
    <script src="js/jquery.js"></script>
    <script src="js/main.js"></script>
    <script>
      $(document).ready(loadIndex());
    </script>
  </body>
</html>
