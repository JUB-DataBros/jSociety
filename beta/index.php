<!doctype html>
<html>
  <head>
    <title>
      jGrader
    </title>
    <link rel="stylesheet" type="text/css" href="css/layout.css">
  </head>
  <body>
    <script src="js/jquery.js"></script>
    <script src="js/main.js"></script>
    <script src="js/sha256.js"></script>
    <?php
      SESSION_START();
      nclude('partials/header.php');
      if($_SESSION['login'] != 1) {
        $_SESSION['crypto_counter'] = 0; // Increment every time
        $_SESSION['crypto_challenge'] = time() + $_SERVER['REMOTE_ADDR'];
      }
    ?>
    <input type="hidden" name="crypto_counter" value="
      <?php echo $_SESSION['crypto_counter']; ?>>
    <input type="hidden" name="crypto_challenge" value="
      <?php echo $_SESSION['crypto_challenge']; ?>>

    <div class="body"></div>

  </body>
</html>
