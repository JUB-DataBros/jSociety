<!--
This must be included in every partial other than login.php and forgotpw.php
//Those partial pages will not run if $_GET['token'] is not valid
//login.php creates its own (crypto) challenge
-->
<?php
  SESSION_START();

  if($_SESSION['authentication'] != 1) {
    echo "<script> loadPage('partials/login.php'); </script>";
  }
  if($isset($_GET['username'])) {
    //Fetch salted password from DB
    $_SESSION['salted_password'] = substr($_GET['username'], 0, 3) + "123";
    //In this test case, password for each username starts with
    //first 3 letters of the username and followed by "123"
  }
  else {
    die("<h1>Authentication Failed</h1><script>loadPage('partials/login.php');</script>");
  }
  if(isset($_GET['token']) &&
    $_GET['token'] ===
    hash("sha256", hash("sha256", $_GET['username']
                                + $_SESSION['salted_password']
                                + session_id())
                 + $_SESSION['challenge']
    )
  ) {
    $_SESSION['authentication'] = 1;
    $_SESSION['username'] = $_GET['username']; //It will be needed
    include("sidebar.php");
  }
  else {
    $_SESSION['authentication'] = -1;
    die("<h1>Authentication Failed</h1><script>loadPage('partials/login.php'); </script>);
  }

  //Prepare the next challenge
  $s = False;
  $timeout = 0;
  while($s == False && timeout < 10) {
    $new_challenge = bin2hex(openssl_random_pseudo_bytes(16, $s));
    // if the random number is cryptographicallysecure, $s is set True
    $timeout++;
  }
  if($s == True) {
    $_SESSION['crypto_challenge'] = $new_challenge;
  }
  else {
    die("New challenge cannot be securely generated");
  }
?>
<div class="hidden">
  <input type="hidden" name="crypto_challenge" value="<?php echo $_SESSION['crypto_challenge']; ?>">
  <input type="hidden" name="session_id" value="<?php echo session_id(); ?>">
</div>
