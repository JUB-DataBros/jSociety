<!doctype html>
<html>
  <head>
    <title>jSociety</title>
    <link rel="stylesheet" type="text/css" href="css/layout.css">
  </head>
  <body>
    <?php
      //session_start();
      //include("partials/dbconnect.php");
      include('partials/header.php');
      include('partials/sidebar.php');
      if(isset($_GET['page'])) {
        //echo "<script>alert('GET[Page]: " . $_GET['page'] . "')</script><br>";
        //echo "<script>loadPage('" . $_GET['page'] . "')</script>";
      }
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
