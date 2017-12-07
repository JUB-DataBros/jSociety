<!doctype html>
<html>
  <head>
    <title>jSociety</title>
    <link rel="stylesheet" type="text/css" href="css/layout.css">
    <link rel="stylesheet" type="text/css" href="css/search.css">
    <script src="js/jquery.js"></script>
    <script src="js/main.js"></script>
    <script src="js/sha256.js"></script>
  </head>
  <body>
    <?php
      session_start();
      //header("Cache-Control: no-cache, must-revalidate");
      include("essentials/db.php");
      include('partials/header.php');
      if($_SESSION['authentication'] == 1) {
      //$_SESSION['authentication'] is only used to direct to the correct page
      //Not for security purpose. Security is handled in individual pages
        include('partials/sidebar.php');
        switch($_GET['page']){
          case "feed":
          case "profile":
          case "events":
          case "clubs":
          case "settings":
          case "disclaimer":
          case "forgotpw":
          case "register":
            echo "<script>loadPage('routes/" . $_GET['page'] . ".php');</script>";
            break;
          default:
            echo "<script>loadPage('routes/feed.php');</script>";
        }
      }
      else {
        switch($_GET['page']){
          case "forgotpw":
          case "register":
            echo "<script>loadPage('routes/" . $_GET['page'] . ".php');</script>";
            break;
          default:
            echo "<script>loadPage('routes/login.php');</script>";
        }
      }
    ?>
    <div class="body">
      <br>
    </div>
  </body>
</html>
