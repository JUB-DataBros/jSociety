<!doctype html>
<html>
  <head>
    <title>
      jSociety
    </title>
    <link rel="stylesheet" type="text/css" href="css/layout.css">
  </head>
  <body>
    <script src="js/jquery.js"></script>
    <script src="js/main.js"></script>
    <?php
      SESSION_START();
      include('partials/header.php');
      if($_SESSION['authentication'] == 1) {
      //$_SESSION['authentication'] is only used to direct to the correct page
        echo "<script>loadPage('routes/feed.php');</script>";
      }
      else {
        echo "<script>loadPage('routes/login.php');</script>";
      }
      if(isset($_GET['page'])) {
        switch($_GET['page']){
          case "feed":
          case "profile":
          case "events":
          case "clubs":
          case "settings":
          case "disclaimer":
            echo "<script>loadPage('routes/' + getPage + '.php');";
            break;
        }
      }
    ?>
    <div class="body"></div>

  </body>
</html>
