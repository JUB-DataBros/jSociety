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
      //Not for security purpose. Security is handled in individual pages
          switch($_GET['page']){
            case "feed":
            case "profile":
            case "events":
            case "clubs":
            case "settings":
            case "disclaimer":
              echo "<script>loadPage('routes/" . $_GET['page'] . ".php');";
              break;
            default:
              echo "<script>loadPage('routes/feed.php');";
          }
      }
      else {
        echo "<script>loadPage('routes/login.php');</script>";
      }
    ?>
    <div class="body"></div>

  </body>
</html>
