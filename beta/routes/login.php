<script src="js/login.js"></script>
<?php
  if(isset($_COOKIE['username']) && isset($_COOKIE['token'])) {
    echo "<script>loadPage('routes/feed.php');</script>";
  }
  else {
    echo "<script>localStorage.removeItem('crypto_key');</script>";
  }
?>
<script>localStorage.removeItem("crypto_key");</script>
<?php
  session_start();
  include("essentials/db.php");
  if($_SESSION['authentication'] == 1) {
    die("<script>loadPage('routes/feed.php');</script>");
  }
  $s = False;
  $timeout = 0;
  while($s == False && timeout < 10) {
    $new_challenge = hash("sha256", bin2hex(openssl_random_pseudo_bytes(256, $s)), false);
    // if the random number is cryptographically secure, $s is set True
    $timeout++;
  }
  if($s == True) {
    $_SESSION['crypto_challenge'] = $new_challenge;
    setcookie("challenge", $_SESSION['crypto_challenge'],0 ,"/jSociety/beta/"); //To be changed upon deployment
  }
  else {
    writeLOG("Crypto challenge could not be generated in 'login.php'");
    die("<h1>Unexpected Error</h1><br>Error code: J1001. <a onClick=\"loadPage('index.php')\">Click here to continue</a>");
  }
?>

<form method="POST" style="margin-left:20%;margin-top:15%">
  <?php
    //echo $_SESSION['authentication'] . "<br>";
    if($_SESSION['authentication'] == -1) {
      echo "<div style='color:red'>Incorrect Username or Password</div><br>";
      $_SESSION['authentication'] = 0;
    }
  ?>
  <input type="text" id="login_username" placeholder="e-mail address">
  @jacobs-university.de
  <br>
  <input type="password" id="login_password" placeholder="********">
  <br><br>
  <input type="button" name="login_submit" value="Login" style="margin-left:85px"
      onclick="loginAttempt(<?php echo isset($_GET['page']) ? $_GET['page'] : "''";?>)">
      <?php //Handle redirection upon non-logged-on page request ?>
  <br><br>
  <a name="forgotpwlink" style="margin-left:30px; color:royalblue" onClick="loadPage('routes/forgotpw.php<?php echo isset($_GET['page']) ? "?page=" . $_GET['page'] : "";?>')">Forgot your password?</a>
  <?php //Carry $_GET['page'] across pages ?>

</form>

<script>
    var sessionid = "<?php echo session_id();?>";
    var crypto_challenge = "<?php echo $_SESSION['crypto_challenge'];?>";
    if (localStorage.getItem("username") !== null) {
      document.getElementById("login_username").value = localStorage.getItem("username");
      //Auto-fill username if previously existed
      //ALSO IMPLEMENT TO FORGOTPW.PHP PAGE
    }
</script>
